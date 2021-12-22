<?php include './templates/head.php' ?>

<meta name="description" content="Cake Template">
<meta name="keywords" content="Cake, unica, creative, html">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title> Katalog | Crabsambal</title>

<?php include './templates/header.php';
$result = mysqli_query($koneksi, "SELECT * FROM download ORDER BY id_download DESC");

?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>Download Katalog</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__links">
                    <a href="<?= $base_url ?>">Home</a>
                    <span>Download Katalog</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Contact Section Begin -->
<div class="container">
    <div class="blog__details__tags">
        <?php
        while ($file = mysqli_fetch_array($result)) : ?>
            <a href='download.php?file=<?= $file['nama_file'] ?>' class='site-btn'><?= $file['judul'] ?></a>
        <?php endwhile ?>
    </div>
</div>
<!-- Contact Section End -->



<?php include './templates/footer.php' ?>