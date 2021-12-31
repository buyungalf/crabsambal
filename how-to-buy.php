<?php include './templates/head.php' ?>

<meta name="description" content="Cake Template">
<meta name="keywords" content="Cake, unica, creative, html">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>Cara Pembelian | Crabsambal</title>

<?php include './templates/header.php';

$result_cara_beli = mysqli_query($koneksi, "SELECT * FROM modul WHERE nama_modul = 'Cara Pembelian'");

?>

<!-- Blog Hero Begin -->
<div class="set-bg">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-7">
                <div class="blog__hero__text">
                    <div class="label">How To Buy</div>
                    <h2>Cara Pembelian</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8">
                <div class="blog__details__content">
                    <?= mysqli_fetch_array($result_cara_beli)['static_content'] ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->

<?php include './templates/footer.php' ?>