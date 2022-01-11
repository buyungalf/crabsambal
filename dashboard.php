<?php include './templates/head.php' ?>

<meta name="description" content="Cake Template" />
<meta name="keywords" content="Cake, unica, creative, html" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />

<title>dashboard | Crabsambal</title>

<?php

require_once './lib/error_message.php';

$user = $_SESSION['user'] ?? [];

if (empty($user)) {
    echo "<script> window.location=" . parse_url($base_url)['path'] . "</script>\n";
}


$nama = trim($_POST['nama'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$telpon = strtolower(trim($_POST['telpon'] ?? ''));
$email = strtolower(trim($_POST['email'] ?? ''));

$process = strtolower(trim($_POST['process'] ?? ''));

$password_lama = strtolower(trim($_POST['password_lama'] ?? ''));
$password_baru = strtolower(trim($_POST['password_baru'] ?? ''));

if ($process == 'simpan') {

    if (!validValue($nama)) {
        error_message('nama', 'nama tidak boleh kosong');
    }

    if (!validValue($alamat)) {
        error_message('alamat', 'alamat tidak boleh kosong');
    }

    if (!validValue($telpon)) {
        error_message('telpon', 'telpon tidak boleh kosong');
    }

    if (!preg_match("/^(\+62|62)?[\s-]?0?8[1-9]{1}\d{1}[\s-]?\d{4}[\s-]?\d{2,5}$/", $telpon)) {
        error_message('telpon', 'Nomor telpon tidak valid');
    }

    if (!preg_match("/^[a-zA-Z-' ]*$/", $nama)) {
        error_message('nama', 'Nama tidak boleh diisi dengan angka atau simbol');
    }

    // jika tidak error
    if (empty($errors) & validValue($nama) & validValue($alamat) & validValue($telpon)) {
        // simpan data kustomer 
        mysqli_query($koneksi, "UPDATE kustomer SET nama_lengkap='$nama', alamat='$alamat', telpon='$telpon' WHERE kustomer.email='$user[email]'");

        $_SESSION['user'] = [
            'id' => $user['id'],
            'nama' => $nama,
            'alamat' => $alamat,
            'email' => $user['email'],
            'telpon' => $telpon
        ];

        create_flash('Profile Berhasil di update');
    }
} elseif ($process == 'ubah') {
    if (!validValue($password_lama)) {
        error_message('password_lama', 'password lama tidak boleh kosong');
    }
    if (!validValue($password_baru)) {
        error_message('password_baru', 'password baru tidak boleh kosong');
    }

    if (empty($errors) & validValue($password_baru) & validValue($password_lama)) {
        $user_results = mysqli_query($koneksi, "SELECT * FROM kustomer WHERE email='$user[email]'");
        $user_data = mysqli_fetch_array($user_results);

        // check jika user ada 

        if (mysqli_num_rows($user_results) > 0) {
            $user_password = $user_data['password'];

            $password_check = password_verify($password_lama, $user_password);

            // check if password match
            if (!$password_check) {
                error_message('password_lama', 'password lama yang anda masukan salah');
            } else {
                $password_baru = password_hash($password_baru, PASSWORD_BCRYPT);

                mysqli_query($koneksi, "UPDATE kustomer SET password='$password_baru' WHERE kustomer.email='$user[email]'");
                create_flash('password berhasil di ubah');
            }
        }
    }
}



$kustomer_result = mysqli_query($koneksi, "SELECT nama_lengkap, password, alamat, telpon, email, id_kota FROM kustomer WHERE kustomer.email='$user[email]'");

$kustomer = mysqli_fetch_array($kustomer_result);

include './templates/header.php';

?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>Dashboard</h2>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Wishlist Section Begin -->
<section class="wishlist">
    <div class="container">
        <?php show_flash() ?>
        <div class="d-flex flex-column-reverse flex-lg-row">
            <!-- tampilkan untuk mendaftar atau login -->
            <div class="col-lg-7 ">
                <form action="" method="post">
                    <div class="spad">

                        <h6 class="checkout__title">Edit Profile</h6>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Nama Lengkap<span>*</span></p>
                                    <input type="text" name="nama" required placeholder="Masukan Nama Anda" class="checkout__input__add" value="<?= $kustomer['nama_lengkap'] ?? '' ?>" />
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
                                    <input type="text" name="email" disabled required placeholder="Masukan Email Anda" class="checkout__input__add" value="<?= $kustomer['email'] ?? '' ?>" style="cursor: not-allowed;" />
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Alamat Pengiriman<span>*</span></p>
                            <input type="text" name="alamat" required placeholder="Masukan Alamat Pengiriman" class="checkout__input__add" value="<?= $kustomer['alamat'] ?? '' ?>" />
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
                                    <input type="number" name="telpon" required placeholder="Nomor Telepon / Whatsapp" class="checkout__input__add" value="<?= $kustomer['telpon'] ?? '' ?>" />
                                    <?php if (!empty($errors['telpon'])) :
                                        for ($i = 0; $i < count($errors['telpon']); $i++) : ?>
                                            <p class="text-sm text-danger"><?= $errors['telpon'][$i] ?></p>
                                    <?php endfor;
                                    endif; ?>
                                </div>
                            </div>
                        </div>
                        <input type="submit" class="site-btn" value="simpan" name="process" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Wishlist Section End -->


<!-- Wishlist Section Begin -->
<section class="wishlist">
    <div class="container">
        <div class="d-flex flex-column-reverse flex-lg-row">
            <!-- tampilkan untuk mendaftar atau login -->
            <div class="col-lg-7 ">
                <form action="" method="POST">
                    <h6 class="checkout__title">Ganti Password</h6>
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="checkout__input">
                                <p>Password Lama<span>*</span></p>
                                <input type="password" name="password_lama" required placeholder="Masukan password Anda" class="checkout__input__add" />
                                <?php if (!empty($errors['password_lama'])) :
                                    for ($i = 0; $i < count($errors['password_lama']); $i++) : ?>
                                        <p class="text-sm text-danger"><?= $errors['password_lama'][$i] ?></p>
                                <?php endfor;
                                endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-7 checkout__input">
                            <p>Password Baru</p>
                            <input type="password" name="password_baru" required placeholder="Masukan Password Baru" class="checkout__input__add" />
                            <?php if (!empty($errors['password_baru'])) :
                                for ($i = 0; $i < count($errors['password_baru']); $i++) : ?>
                                    <p class="text-sm text-danger"><?= $errors['password_baru'][$i] ?></p>
                            <?php endfor;
                            endif; ?>
                        </div>
                    </div>

                    <input type="submit" class="site-btn" value="ubah" name="process" />
                </form>
            </div>
        </div>
    </div>
</section>
<!-- Wishlist Section End -->

<!-- Checkout Section End -->
<?php include './templates/footer.php' ?>