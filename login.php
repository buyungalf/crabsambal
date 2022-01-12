<?php include './templates/head.php' ?>

<meta name="description" content="Cake Template" />
<meta name="keywords" content="Cake, unica, creative, html" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />

<title>Checkout | Crabsambal</title>

<?php

include './templates/header.php';
require_once './lib/error_message.php';


if (!empty($user)) {
    echo "<script> window.location=" . parse_url($base_url)['path'] . "</script>\n";
}

$password = strtolower(trim($_POST['password'] ?? ''));
$email = strtolower(trim($_POST['email'] ?? ''));

$process = strtolower(trim($_POST['process'] ?? ''));


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
                // create session login 


                $_SESSION['user'] = [
                    'id' => $user['id_kustomer'],
                    'nama' => $user['nama_lengkap'],
                    'email' => $user['email'],
                    'alamat' => $user['alamat'],
                    'telpon' => $user['telpon']
                ];

                echo "<script> window.location='dashboard.php'</script>\n";
                exit;
            }
        } else {
            // check user exist 
            error_message('email', 'email belum terdaftar, silahkan daftar terlebih dahulu');
        }
    } else {
        error_message('password', 'email dan password tidak boleh kosong');
    }
}

?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>Login</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__links">
                    <a href="<?= $base_url ?>">Home</a>
                    <span>Login</span>
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
            <div class="d-flex flex-column-reverse flex-lg-row justify-content-center">
                <div class="col-lg-4">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col">
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
                            <div class="col checkout__input">
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
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Checkout Section End -->
<?php include './templates/footer.php' ?>