<?php include './templates/head.php' ?>

<meta name="description" content="Cake Template">
<meta name="keywords" content="Cake, unica, creative, html">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>Contact | Crabsambal</title>

<?php

include './templates/header.php';
require_once './lib/error_message.php';


$nama = strtolower(trim($_POST['nama'] ?? ''));
$email = strtolower(trim($_POST['email'] ?? ''));
$subjek = strtolower(trim($_POST['subjek'] ?? ''));
$pesan = strtolower(trim($_POST['pesan'] ?? ''));

if ($_POST) {

    $_SESSION['hubungi'] = [
        'nama' => $nama,
        'email' => $email,
        'subjek' => $subjek,
        'pesan' => $pesan
    ];

    if (!validValue($nama)) {
        error_message('nama', 'nama tidak boleh kosong');
    }
    if (!validValue($email)) {
        error_message('email', 'email tidak boleh kosong');
    }
    if (!validValue($subjek)) {
        error_message('subjek', 'subjek tidak boleh kosong');
    }
    if (!validValue($pesan)) {
        error_message('pesan', 'pesan tidak boleh kosong');
    }


    if (validValue($nama) && validValue($email) && validValue($subjek) && validValue($pesan)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            error_message('email', 'email yang anda masukan tidak valid');
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $nama)) {
            error_message('nama', 'Nama tidak boleh diisi dengan angka atau simbol');
        } else {
            $tgl_sekarang = date("Ymd");

            mysqli_query(
                $koneksi,
                "INSERT INTO hubungi(nama, email, subjek, pesan, tanggal) 
                VALUES('$nama', '$email', '$subjek', '$pesan','$tgl_sekarang')"
            );

            create_flash('Terimakasih telah menghubungi kami. Kami akan segera membalasnya ke email Anda.');

            // hapus session 
            $_SESSION['hubungi'] = [];
        }
    }
}


?>


<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <?php show_flash() ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__links">
                    <a href="<?= $base_url ?>">Home</a>
                    <span>Hubungi Kami</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="contact__text">
                    <h3>Hubungi Kami </h3>

                    <img src="img/cake-piece.png" alt="" />
                </div>
            </div>
            <div class="col-lg-8">
                <div class="contact__form">
                    <form action="" method="POST">
                        <div class="row">

                            <div class="col-lg-6 my-2 my-lg-0">
                                <input type="text" placeholder="Nama" name="nama" value="<?= $_SESSION['hubungi']['nama'] ?? '' ?>" />
                                <?php if (!empty($errors['nama'])) :

                                    for ($i = 0; $i < count($errors['nama']); $i++) : ?>
                                        <p class="text-sm text-danger"><?= $errors['nama'][$i] ?></p>
                                <?php endfor;
                                endif; ?>
                            </div>
                            <div class="col-lg-6 my-2 my-lg-0">
                                <input type="email" placeholder="Email" name="email" value="<?= $_SESSION['hubungi']['email'] ?? '' ?>" />
                                <?php if (!empty($errors['email'])) :
                                    for ($i = 0; $i < count($errors['email']); $i++) : ?>
                                        <p class="text-sm text-danger"><?= $errors['email'][$i] ?></p>
                                <?php endfor;
                                endif; ?>
                            </div>
                            <div class="col-lg-6 my-2 mb-4 my-lg-4">
                                <input type="text" placeholder="Subject" name="subjek" value="<?= $_SESSION['hubungi']['subjek'] ?? '' ?>" />
                                <?php if (!empty($errors['subjek'])) :
                                    for ($i = 0; $i < count($errors['subjek']); $i++) : ?>
                                        <p class="text-sm text-danger"><?= $errors['subjek'][$i] ?></p>
                                <?php endfor;
                                endif; ?>
                            </div>
                            <div class="col-lg-12">
                                <textarea placeholder="Pesan" name="pesan"><?= $_SESSION['hubungi']['pesan'] ?? '' ?></textarea>
                                <?php if (!empty($errors['pesan'])) :
                                    for ($i = 0; $i < count($errors['pesan']); $i++) : ?>
                                        <p class="text-sm text-danger"><?= $errors['pesan'][$i] ?></p>
                                <?php endfor;
                                endif; ?>
                                <button type="submit" class="site-btn">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<?php include './templates/footer.php' ?>