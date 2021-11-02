<?php include './templates/head.php';

$query_product = "SELECT produk.nama_produk, produk.produk_seo, produk.harga, produk.deskripsi, produk.stok, produk.berat, produk.gambar, kategori.nama_kategori, kategori.kategori_seo
            FROM produk
            INNER JOIN kategori ON 
            produk.id_kategori=kategori.id_kategori
            WHERE produk.produk_seo = '{$_GET['slug']}'";



$query_random = "SELECT produk.nama_produk, produk.produk_seo, produk.harga, produk.gambar, kategori.nama_kategori, kategori.kategori_seo
    FROM produk 
    INNER JOIN kategori ON 
    produk.id_kategori=kategori.id_kategori
    ORDER BY rand() LIMIT 5";

$product_result = mysqli_query($koneksi, $query_product);
$product_random_result = mysqli_query($koneksi, $query_random);

$product = mysqli_fetch_array($product_result);
?>

<meta name="description" content="Cake Template">
<meta name="keywords" content="Cake, unica, creative, html">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title><?= $product['nama_produk'] ?> | Crabsambal</title>

<?php include './templates/header.php' ?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>Product detail</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__links">
                    <a href="<?= $base_url ?>">Home</a>
                    <a href="shop">Shop</a>
                    <span><?= $product['nama_produk'] ?></span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product__details__img">
                    <div class="product__details__big__img">
                        <img class="big_img" src="assets/img/product/<?= $product['gambar'] ?>" alt="" />
                    </div>
                    <!-- <div class="product__details__thumb">
                        <div class="pt__item active">
                            <img data-imgbigurl="assets/img/shop/details/product-big-2.jpg" src="assets/img/shop/details/product-big-2.jpg" alt="" />
                        </div>
                        <div class="pt__item">
                            <img data-imgbigurl="assets/img/shop/details/product-big-1.jpg" src="assets/img/shop/details/product-big-1.jpg" alt="" />
                        </div>
                        <div class="pt__item">
                            <img data-imgbigurl="assets/img/shop/details/product-big-4.jpg" src="assets/img/shop/details/product-big-4.jpg" alt="" />
                        </div>
                        <div class="pt__item">
                            <img data-imgbigurl="assets/img/shop/details/product-big-3.jpg" src="assets/img/shop/details/product-big-3.jpg" alt="" />
                        </div>
                        <div class="pt__item">
                            <img data-imgbigurl="assets/img/shop/details/product-big-5.jpg" src="assets/img/shop/details/product-big-5.jpg" alt="" />
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product__details__text">
                    <div class="product__label"><?= $product['nama_kategori'] ?></div>
                    <h4><?= $product['nama_produk'] ?></h4>
                    <h5><?= "Rp " . format_rupiah($product['harga']) ?></h5>
                    <p><?= $product['deskripsi'] ?>
                    </p>
                    <ul>
                        <li>Stok: <span><?= $product['stok'] ?></span></li>
                        <li>Berat: <span><?= $product['berat'] ?></span></li>
                    </ul>
                    <div class="product__details__option">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="2" />
                            </div>
                        </div>
                        <a href="#" class="primary-btn">Add to cart</a>
                        <a href="#" class="heart__btn"><span class="icon_heart_alt"></span></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="product__details__tab">
            <div class="col-lg-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Additional information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Previews(1)</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-8">
                                <p>
                                    This delectable Strawberry Pie is an extraordinary treat
                                    filled with sweet and tasty chunks of delicious
                                    strawberries. Made with the freshest ingredients, one
                                    bite will send you to summertime. Each gift arrives in
                                    an elegant gift box and arrives with a greeting card of
                                    your choice that you can personalize online!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabs-2" role="tabpanel">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-8">
                                <p>
                                    This delectable Strawberry Pie is an extraordinary treat
                                    filled with sweet and tasty chunks of delicious
                                    strawberries. Made with the freshest ingredients, one
                                    bite will send you to summertime. Each gift arrives in
                                    an elegant gift box and arrives with a greeting card of
                                    your choice that you can personalize online!2
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</section>
<!-- Shop Details Section End -->

<!-- Related Products Section Begin -->
<section class="related-products spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="section-title">
                    <h2>Related Products</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="related__products__slider owl-carousel">
                <?php $i = 1;
                while ($item = mysqli_fetch_array($product_random_result)) : ?>
                    <div class="col-lg-3">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="assets/img/product/<?= $item['gambar'] ?>">
                                <div class="product__label">
                                    <a href="shop?category=<?= $item['kategori_seo'] ?>">
                                        <span><?= $item['nama_kategori'] ?></span>
                                    </a>
                                </div>
                            </div>
                            <div class="product__item__text">
                                <h6>
                                    <a href="produk-<?= $item['produk_seo'] ?>">
                                        <?= $item['nama_produk'] ?>
                                    </a>
                                </h6>
                                <div class="product__item__price" data-price="<?= $item['harga'] ?>"><?= "Rp " . format_rupiah($item['harga']) ?></div>
                                <div class="cart_add">
                                    <a href="#">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php $i++;
                endwhile; ?>
            </div>
        </div>
    </div>
</section>
<!-- Related Products Section End -->

<?php include './templates/footer.php' ?>