<?php include './templates/head.php' ?>


<meta name="description" content="Cake Template">
<meta name="keywords" content="Cake, unica, creative, html">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>Home | Crabsambal</title>

<?php include './templates/header.php' ?>

<?php



$query_category = "SELECT kategori.kategori_seo, kategori.nama_kategori FROM kategori";

$category_result =  mysqli_query($koneksi, $query_category);

// handle get request

$category = strtolower($_GET['category']);
$sort = strtolower($_GET['sort']);


$query_product = "  SELECT produk.nama_produk, produk.produk_seo, produk.harga, produk.gambar, kategori.nama_kategori, kategori.kategori_seo
        FROM produk
        INNER JOIN kategori ON 
        produk.id_kategori=kategori.id_kategori ";


function validValue($value): bool
{
    return isset($value) && !empty($value);
}

// var_dump(validValue($category));

if (validValue($category) && validValue($sort)) {
    // jika ada kategori dan sort maka where category sort asc|desc
} elseif (validValue($category)) {
    // jika ada kategori ganti query product where category 
} elseif (validValue($sort)) {
    // jika ada sort ganti query product ke sort asc | desc
} else {
}

$product_result = mysqli_query($koneksi, $query_product);
?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>Shop</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__links">
                    <a href="<?= $base_url ?>">Home</a>
                    <span>Shop</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="shop__option">
            <div class="row">
                <div class="col-lg-5 col-md-5">
                    <div class="shop__option__search">
                        <form action="#">

                            <input type="text" placeholder="Search" />
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <form action="" method="GET">
                        <div class="shop__option__right" style="display: flex;align-items: stretch; justify-content: end;">
                            <select name="category">
                                <option value="">Categories</option>
                                <?php
                                $i = 1;
                                while ($categoryItem = mysqli_fetch_array($category_result)) : ?>
                                    <option value="<?= $categoryItem['kategori_seo'] ?>" <?= isset($category) && $category === $categoryItem['kategori_seo'] ? 'selected' : '' ?>>
                                        <?= $categoryItem['nama_kategori'] ?>
                                    </option>
                                <? $i++;
                                endwhile ?>
                            </select>
                            <select name="sort">
                                <option value="">Default sorting</option>
                                <option value="asc" <?= isset($sort) && $sort === 'asc' ? 'selected' : '' ?>>A to Z</option>
                                <option value="desc" <?= isset($sort) && $sort === 'desc' ? 'selected' : '' ?>>Z to A</option>
                            </select>
                            <button class="site-btn primary-btn" style="padding: 11px 18px" type="submit">Filter</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="row" id="row">
            <?php
            $i = 1;
            while ($item = mysqli_fetch_array($product_result)) : ?>
                <div class="col-lg-3 col-md-6 col-sm-6" id="item">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="<?= $base_url ?>assets/img/product/<?= $item['gambar'] ?>">
                            <div class="product__label">
                                <a href="<?= $base_url ?>shop.php?category=<?= $item['kategori_seo'] ?>">
                                    <span><?= $item['nama_kategori'] ?></span>
                                </a>
                            </div>
                        </div>
                        <div class="product__item__text">
                            <h6>
                                <a href="<?= $base_url ?>shop-details.php?slug=<?= $item['produk_seo'] ?>">
                                    <?= $item['nama_produk'] ?>
                                </a>
                            </h6>
                            <div class="product__item__price" data-price="<?= $item['harga'] ?>"><?= "Rp " . number_format($item['harga'], 0, ',', '.'); ?></div>
                            <div class="cart_add">
                                <a href="#">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php $i++;
            endwhile ?>
        </div>
        <div class="shop__last__option">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="shop__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><span class="arrow_carrot-right"></span></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="shop__last__text">
                        <p>Showing 1-9 of 10 results</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->

<?php include './templates/footer.php' ?>