<?php include './templates/head.php' ?>

<meta name="description" content="Cake Template" />
<meta name="keywords" content="Cake, unica, creative, html" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />

<title>Checkout | Crabsambal</title>

<?php

include './templates/header.php';
require_once './lib/error_message.php';


// Tampilkan produk-produk yang telah dimasukkan ke keranjang belanja
$cart_list_result = mysqli_query(
    $koneksi,
    "SELECT * FROM orders_temp, produk 
        WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk"
);

$nama = trim($_POST['nama'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$telpon = strtolower(trim($_POST['telpon'] ?? ''));
$password = strtolower(trim($_POST['password'] ?? ''));
$email = strtolower(trim($_POST['email'] ?? ''));
$password_register = strtolower(trim($_POST['password_register'] ?? ''));
$email_register = strtolower(trim($_POST['email_register'] ?? ''));
$kota = 1;


$process = strtolower(trim($_POST['process'] ?? ''));


$tgl_skrg = date("Ymd");
$jam_skrg = date("H:i:s");

function isi_keranjang()
{
    global $koneksi;
    global $sid;

    $isikeranjang = array();
    $sql = mysqli_query($koneksi, "SELECT * FROM orders_temp WHERE id_session='{$sid}'");

    while ($result = mysqli_fetch_array($sql)) {
        $isikeranjang[] = $result;
    }

    return $isikeranjang;
}

if (empty(isi_keranjang())) {
    create_flash('keranjang masih kosong', 'danger');
    echo "<script> window.location='shop'</script>\n";
}


if ($process == 'login') {
    // handle user login 
    if (validValue($email) && validValue($password)) {

        // check valid email
        $user_results = mysqli_query($koneksi, "SELECT * FROM kustomer WHERE email='{$email}'");
        $user = mysqli_fetch_array($user_results);

        if (mysqli_num_rows($user_results) > 0) {
            $user_password = $user['password'];

            $password_check = password_verify($password, $user_password);

            // check if password match
            if (!$password_check) {
                error_message('password', 'password yang anda masukan salah');
            } else {
                // create order transaction 
                mysqli_query($koneksi, "INSERT INTO orders(tgl_order,jam_order,id_kustomer) VALUES('{$tgl_skrg}','{$jam_skrg}','{$user['id_kustomer']}')");

                $id_order = mysqli_insert_id($koneksi);

                $isi_keranjang = isi_keranjang();

                // simpan data detail pemesanan  
                for ($i = 0; $i < count($isi_keranjang); $i++) {
                    mysqli_query($koneksi, "INSERT INTO orders_detail(id_orders, id_produk, jumlah) VALUES('$id_order',{$isi_keranjang[$i]['id_produk']}, {$isi_keranjang[$i]['jumlah']})");
                }

                // hapus data di order_temp
                for ($i = 0; $i < count($isi_keranjang); $i++) {
                    mysqli_query($koneksi, "DELETE FROM orders_temp WHERE id_orders_temp = {$isi_keranjang[$i]['id_orders_temp']}");
                }

                // // mendapatkan data pengelola 
                // // dapatkan email_pengelola dan nomor rekening dari database
                // $owner_results = mysqli_query($koneksi, "SELECT email_pengelola, nomor_rekening, nomor_hp FROM modul WHERE id_modul='43'");
                // $owner = mysqli_fetch_array($owner_results);

                // // Kirim email ke kustomer
                // $subjek = "Ini Subject ";
                // $pesan = "ini pesan";

                // // Kirim email dalam format HTML
                // $emailFrom = "From: $owner[email_pengelola]\r\n";
                // $emailFrom .= "Content-type: text/html\r\n";

                // mail($email, $subjek, $pesan, $emailFrom);

                // // Kirim email ke pengelola toko online
                // mail("$owner[email_pengelola]", $subjek, $pesan, $emailFrom);

                // redirect ke transaction dengan id order 
                echo "<script> window.location='transaksi?id_order={$id_order}'</script>\n";
            }
        } else {
            // check user exist 
            error_message('email', 'email belum terdaftar, silahkan daftar terlebih dahulu');
        }
    } else {
        error_message('password', 'email dan password tidak boleh kosong');
    }
} elseif ($process == 'daftar') {
    if (!validValue($nama)) {
        error_message('nama', 'nama tidak boleh kosong');
    }

    if (!validValue($alamat)) {
        error_message('alamat', 'alamat tidak boleh kosong');
    }

    if (!validValue($telpon)) {
        error_message('telpon', 'telpon tidak boleh kosong');
    }

    if (!validValue($password_register)) {
        error_message('password_register', 'password tidak boleh kosong');
    }

    if (!validValue($email_register)) {
        error_message('email_register', 'email tidak boleh kosong');
    }

    if (!preg_match("/^(\+62|62)?[\s-]?0?8[1-9]{1}\d{1}[\s-]?\d{4}[\s-]?\d{2,5}$/", $telpon)) {
        error_message('telpon', 'Nomor telpon tidak valid');
    }

    if (!filter_var($email_register, FILTER_VALIDATE_EMAIL)) {
        error_message('email_register', 'email yang anda masukan tidak valid');
    }

    if (!preg_match("/^[a-zA-Z-' ]*$/", $nama)) {
        error_message('nama', 'Nama tidak boleh diisi dengan angka atau simbol');
    }

    // jika tidak error
    if (empty($errors) & validValue($nama) & validValue($alamat) & validValue($telpon) & validValue($password_register) & validValue($email_register)) {

        // $_SESSION['daftar'] = [];
        // check user exist
        $user_results = mysqli_query($koneksi, "SELECT * FROM kustomer WHERE email='{$email_register}'");

        // user ada 
        if (mysqli_num_rows($user_results) > 0) {
            error_message('email_register', 'email sudah terdaftar, silahkan login');
        } else {
            $password_register = password_hash($password_register, PASSWORD_BCRYPT);
            // simpan data kustomer 
            mysqli_query($koneksi, "INSERT INTO kustomer(nama_lengkap, password, alamat, telpon, email, id_kota) VALUES('$nama','$password_register','$alamat','$telpon','$email_register','$kota')");

            // mendapatkan nomor kustomer
            $id_kustomer = mysqli_insert_id($koneksi);

            // simpan data pemesanan 
            mysqli_query($koneksi, "INSERT INTO orders(tgl_order,jam_order,id_kustomer) VALUES('$tgl_skrg','$jam_skrg','$id_kustomer')");

            // mendapatkan nomor orders
            $id_order = mysqli_insert_id($koneksi);

            $isi_keranjang = isi_keranjang();

            // simpan data detail pemesanan  
            for ($i = 0; $i < count($isi_keranjang); $i++) {
                mysqli_query($koneksi, "INSERT INTO orders_detail(id_orders, id_produk, jumlah) VALUES('$id_order',{$isi_keranjang[$i]['id_produk']}, {$isi_keranjang[$i]['jumlah']})");
            }

            // hapus data di order_temp
            for ($i = 0; $i < count($isi_keranjang); $i++) {
                mysqli_query($koneksi, "DELETE FROM orders_temp WHERE id_orders_temp = {$isi_keranjang[$i]['id_orders_temp']}");
            }

            // redirect ke transaction dengan id order 
            echo "<script> window.location='transaksi?id_order={$id_order}'</script>\n";
        }
    }
} elseif ($process == 'lanjut') {
    // process jika user sudah login 
    // check valid email
    $user_results = mysqli_query($koneksi, "SELECT * FROM kustomer WHERE email='{$user['email']}'");
    $user = mysqli_fetch_array($user_results);

    if (mysqli_num_rows($user_results) > 0) {
        $user_password = $user['password'];

        $password_check = password_verify($password, $user_password);

        // check if password match
        if (!$password_check) {
            error_message('password', 'password yang anda masukan salah');
        } else {
            // create order transaction 
            mysqli_query($koneksi, "INSERT INTO orders(tgl_order,jam_order,id_kustomer) VALUES('{$tgl_skrg}','{$jam_skrg}','{$user['id_kustomer']}')");

            $id_order = mysqli_insert_id($koneksi);

            $isi_keranjang = isi_keranjang();

            // simpan data detail pemesanan  
            for ($i = 0; $i < count($isi_keranjang); $i++) {
                mysqli_query($koneksi, "INSERT INTO orders_detail(id_orders, id_produk, jumlah) VALUES('$id_order',{$isi_keranjang[$i]['id_produk']}, {$isi_keranjang[$i]['jumlah']})");
            }

            // hapus data di order_temp
            for ($i = 0; $i < count($isi_keranjang); $i++) {
                mysqli_query($koneksi, "DELETE FROM orders_temp WHERE id_orders_temp = {$isi_keranjang[$i]['id_orders_temp']}");
            }

            // // mendapatkan data pengelola 
            // // dapatkan email_pengelola dan nomor rekening dari database
            // $owner_results = mysqli_query($koneksi, "SELECT email_pengelola, nomor_rekening, nomor_hp FROM modul WHERE id_modul='43'");
            // $owner = mysqli_fetch_array($owner_results);

            // // Kirim email ke kustomer
            // $subjek = "Ini Subject ";
            // $pesan = "ini pesan";

            // // Kirim email dalam format HTML
            // $emailFrom = "From: $owner[email_pengelola]\r\n";
            // $emailFrom .= "Content-type: text/html\r\n";

            // mail($email, $subjek, $pesan, $emailFrom);

            // // Kirim email ke pengelola toko online
            // mail("$owner[email_pengelola]", $subjek, $pesan, $emailFrom);

            // redirect ke transaction dengan id order 
            echo "<script> window.location='transaksi?id_order={$id_order}'</script>\n";
        }
    }
}

// handle new member 

?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>Checkout</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__links">
                    <a href="<?= $base_url ?>">Home</a>
                    <span>Checkout</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <div class="d-flex flex-column-reverse flex-lg-row">
                <?php if (empty($user)) : ?>
                    <!-- tampilkan untuk mendaftar atau login -->
                    <div class="col-lg-7 ">
                        <form action="" method="POST">
                            <h6 class="checkout__title">Member Lama</h6>
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email" required placeholder="Masukan Email Anda" class="checkout__input__add" />
                                        <?php if (!empty($errors['email'])) :
                                            for ($i = 0; $i < count($errors['email']); $i++) : ?>
                                                <p class="text-sm text-danger"><?= $errors['email'][$i] ?></p>
                                        <?php endfor;
                                        endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-7 checkout__input">
                                    <p>Password Akun</p>
                                    <input type="password" name="password" required placeholder="Masukan Password" class="checkout__input__add" />
                                    <?php if (!empty($errors['password'])) :
                                        for ($i = 0; $i < count($errors['password']); $i++) : ?>
                                            <p class="text-sm text-danger"><?= $errors['password'][$i] ?></p>
                                    <?php endfor;
                                    endif; ?>
                                </div>
                            </div>

                            <input type="submit" class="site-btn" value="login" name="process" />
                        </form>
                        <form action="" method="post">
                            <div class="spad">

                                <h6 class="checkout__title">Member Baru</h6>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Nama Lengkap<span>*</span></p>
                                            <input type="text" name="nama" required placeholder="Masukan Nama Anda" class="checkout__input__add" value="<?= $_SESSION['daftar']['nama'] ?? '' ?>" />
                                            <?php if (!empty($errors['nama'])) :
                                                for ($i = 0; $i < count($errors['nama']); $i++) : ?>
                                                    <p class="text-sm text-danger"><?= $errors['nama'][$i] ?></p>
                                            <?php endfor;
                                            endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Email<span>*</span></p>
                                            <input type="text" name="email_register" required placeholder="Masukan Email Anda" class="checkout__input__add" value="<?= $_SESSION['daftar']['email_register'] ?? '' ?>" />
                                            <?php if (!empty($errors['email_register'])) :
                                                for ($i = 0; $i < count($errors['email_register']); $i++) : ?>
                                                    <p class="text-sm text-danger"><?= $errors['email_register'][$i] ?></p>
                                            <?php endfor;
                                            endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout__input">
                                    <p>Alamat Pengiriman<span>*</span></p>
                                    <input type="text" name="alamat" required placeholder="Masukan Alamat Pengiriman" class="checkout__input__add" value="<?= $_SESSION['daftar']['alamat'] ?? '' ?>" />
                                    <?php if (!empty($errors['alamat'])) :
                                        for ($i = 0; $i < count($errors['alamat']); $i++) : ?>
                                            <p class="text-sm text-danger"><?= $errors['alamat'][$i] ?></p>
                                    <?php endfor;
                                    endif; ?>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="checkout__input">
                                            <p>Nomor Telpon<span>*</span></p>
                                            <input type="number" name="telpon" required placeholder="Nomor Telepon / Whatsapp" class="checkout__input__add" value="<?= $_SESSION['daftar']['telpon'] ?? '' ?>" />
                                            <?php if (!empty($errors['telpon'])) :
                                                for ($i = 0; $i < count($errors['telpon']); $i++) : ?>
                                                    <p class="text-sm text-danger"><?= $errors['telpon'][$i] ?></p>
                                            <?php endfor;
                                            endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="checkout__input__checkbox">
                                    <label for="acc">
                                        Buat Akun?
                                        <input type="checkbox" id="acc" name="create" />
                                        <span class="checkmark"></span>
                                    </label>
                                    <p>
                                        Buat akun dengan memasukkan password di bawah ini. Jika Anda sudah pernah membuat akun, silakan masuk di bagian atas halaman
                                    </p>
                                </div> -->
                                <div class="checkout__input">
                                    <p>Password Akun</p>
                                    <input type="password" name="password_register" required placeholder="Masukan Password" class="checkout__input__add" value="<?= $_SESSION['daftar']['password_register'] ?? '' ?>" />
                                    <?php if (!empty($errors['password_register'])) :
                                        for ($i = 0; $i < count($errors['password_register']); $i++) : ?>
                                            <p class="text-sm text-danger"><?= $errors['password_register'][$i] ?></p>
                                    <?php endfor;
                                    endif; ?>
                                </div>
                                <p>*) Harus di isi</p>

                                <input type="submit" class="site-btn" value="daftar" name="process" />
                            </div>
                        </form>
                    </div>
                <?php else :  ?>
                    <!-- tampilkan data user yanvg sudah login  -->

                    <div class="col-lg-7 ">

                        <form action="" method="POST">
                            <h6 class="checkout__title">Anda Sudah Login Sebagai</h6>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Nama </td>
                                        <td> : <b><?= $user['nama'] ?? '' ?></b> </td>
                                    </tr>
                                    <tr>
                                        <td>Alamat Lengkap </td>
                                        <td> : <?= $user['alamat'] ?? '' ?></td>
                                    </tr>
                                    <tr>
                                        <td>Telpon </td>
                                        <td> : <?= $user['telpon'] ?? '' ?></td>
                                    </tr>
                                    <tr>
                                        <td>E-mail </td>
                                        <td> : <?= $user['email'] ?? '' ?> </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="col-lg-7 checkout__input">
                                <p style="font-size: 14px;">Masukan Password Akun</p>
                                <input type="password" name="password" required placeholder="Masukan Password" class="checkout__input__add" />
                                <?php if (!empty($errors['password'])) :
                                    for ($i = 0; $i < count($errors['password']); $i++) : ?>
                                        <p class="text-sm text-danger"><?= $errors['password'][$i] ?></p>
                                <?php endfor;
                                endif; ?>
                            </div>

                            <input type="submit" class="site-btn" value="lanjut" name="process" />
                        </form>

                    </div>

                <?php endif ?>

                <div class="col-lg-5 ">
                    <div class="checkout__order" style="margin-bottom: 40px;">
                        <h6 class="order__title">Pesanan Anda</h6>
                        <div class="checkout__order__products">Produk <span>Total</span></div>
                        <ul class="checkout__total__products">
                            <?php
                            $total = 0;
                            if (mysqli_num_rows($cart_list_result) > 0) :
                                $no = 1;

                                while ($product_list_item = mysqli_fetch_array($cart_list_result)) :

                                    $disc        = ($product_list_item['diskon'] / 100) * $product_list_item['harga'];
                                    $hargadisc   = number_format(($product_list_item['harga'] - $disc), 0, ",", ".");

                                    $subtotal    = ($product_list_item['harga'] - $disc) * $product_list_item['jumlah'];

                                    $total       = $total + $subtotal;
                            ?>
                                    <li>
                                        <samp>0<?= $no ?>. </samp><?= $product_list_item['nama_produk'] ?>
                                        <span><?= 'Rp. ' .  format_rupiah($subtotal) ?></span>
                                    </li>
                                <?php $no++;
                                endwhile;
                            else : ?>
                                <li>
                                    Keranjang Masih Kosong,
                                    <a href="shop"> Tambah Produk</a>
                                </li>
                            <?php endif ?>
                        </ul>
                        <ul class="checkout__total__all">
                            <li>Total <span><?= 'Rp. ' . format_rupiah($total) ?></span></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Checkout Section End -->
<?php include './templates/footer.php' ?>