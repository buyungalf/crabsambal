<?php include './templates/head.php' ?>

<meta name="description" content="Cake Template">
<meta name="keywords" content="Cake, unica, creative, html">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>Tentang Kami| Crabsambal</title>

<?php include './templates/header.php';

$profile_result = mysqli_query(
    $koneksi,
    "SELECT * FROM modul WHERE nama_modul = 'Profil Toko Online'"
);

?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>About</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__links">
                    <a href="<?= $base_url ?>">Home</a>
                    <span>About</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- About Section Begin -->
<section class="about spad" style="padding-top: 40px">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="about__text">
                    <?= mysqli_fetch_array($profile_result)['static_content'] ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section End -->

<?php include './templates/footer.php' ?>