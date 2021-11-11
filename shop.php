<?php include './templates/head.php' ?>


<meta name="description" content="Cake Template">
<meta name="keywords" content="Cake, unica, creative, html">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>Semua Produk | Crabsambal</title>

<?php include './templates/header.php';


$query_category = "SELECT kategori.kategori_seo, kategori.nama_kategori FROM kategori";

// handle sort by category and asd / dsc 
$category = strtolower(trim($_GET['category'] ?? ''));
$sort = strtolower(trim($_GET['sort'] ?? ''));

// check valid sort
$sort = validValue($sort) && !in_array($sort, ['asc', 'desc']) ?  'asc' : $sort;

if (validValue($category) && validValue($sort)) {
    // jika ada kategori dan sort maka where category sort asc|desc
    $query_product = "SELECT produk.id_produk, produk.nama_produk, produk.produk_seo, produk.harga, produk.gambar, kategori.nama_kategori, kategori.kategori_seo
        FROM produk
        INNER JOIN kategori ON 
        produk.id_kategori=kategori.id_kategori 
        WHERE kategori.kategori_seo='{$category}'
        ORDER BY produk.nama_produk {$sort}";
} elseif (validValue($category)) {
    // jika ada kategori ganti query product where category 
    $query_product = "SELECT produk.id_produk, produk.nama_produk, produk.produk_seo, produk.harga, produk.gambar, kategori.nama_kategori, kategori.kategori_seo
        FROM produk
        INNER JOIN kategori ON 
        produk.id_kategori=kategori.id_kategori
        WHERE kategori.kategori_seo='{$category}'";
} elseif (validValue($sort)) {
    // jika ada sort ganti query product ke sort asc | desc
    $query_product = "SELECT produk.id_produk, produk.nama_produk, produk.produk_seo, produk.harga, produk.gambar, kategori.nama_kategori, kategori.kategori_seo
        FROM produk
        INNER JOIN kategori ON produk.id_kategori=kategori.id_kategori
        ORDER BY produk.nama_produk {$sort}";
} else {

    $query_product = "SELECT produk.id_produk, produk.nama_produk, produk.produk_seo, produk.harga, produk.gambar, kategori.nama_kategori, kategori.kategori_seo
        FROM produk
        INNER JOIN kategori ON 
        produk.id_kategori=kategori.id_kategori";
}

// handle sort search 
$search = strtolower(trim($_GET['search'] ?? ''));

if (validValue($search)) {
    $query_product = "SELECT produk.id_produk, produk.nama_produk, produk.produk_seo, produk.harga, produk.gambar, kategori.nama_kategori, kategori.kategori_seo
        FROM produk
        INNER JOIN kategori ON 
        produk.id_kategori=kategori.id_kategori WHERE produk.nama_produk LIKE '%{$search}%'";
}


// query result
$category_result =  mysqli_query($koneksi, $query_category);
$product_result = mysqli_query($koneksi, $query_product);

?>



<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <?php show_flash() ?>
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
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
                            <input type="text" name="search" placeholder="Search" value="<?= validValue($search) ? $search : '' ?>" />
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="row">

                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
                            <div class="shop__option__right" style="display: flex;align-items: stretch; justify-content: end;">

                                <select name="category">
                                    <option value="">Categories</option>
                                    <?php
                                    $i = 1;
                                    while ($categoryItem = mysqli_fetch_array($category_result)) : ?>
                                        <option value="<?= $categoryItem['kategori_seo'] ?>" <?= isset($category) && $category === $categoryItem['kategori_seo'] ? 'selected' : '' ?>>
                                            <?= $categoryItem['nama_kategori'] ?>
                                        </option>
                                    <?php $i++;
                                    endwhile ?>
                                </select>
                                <select name="sort">
                                    <option value="">Default sorting</option>
                                    <option value="asc" <?= isset($sort) && $sort === 'asc' ? 'selected' : '' ?>>A to Z</option>
                                    <option value="desc" <?= isset($sort) && $sort === 'desc' ? 'selected' : '' ?>>Z to A</option>
                                </select>
                                <button class="site-btn primary-btn" style="padding: 11px 18px ; margin: 0 4px" type="submit">Filter</button>
                                <span class="site-btn primary-btn" id="reset" style="padding: 11px 18px; margin: 0 4px; cursor: pointer;">Reset</span>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="row" id="row">
            <?php
            $i = 1;
            if ($product_result && $product_result->num_rows) {
                while ($item = mysqli_fetch_array($product_result)) :

            ?>
                    <div class="col-lg-3 col-md-6 col-sm-6" id="item">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" onclick="location.href='<?= $base_url ?>produk-<?= $item['produk_seo'] ?>'" style="background-size: auto; cursor: pointer;" data-setbg="assets/img/product/<?= $item['gambar'] ?>">
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
                                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                                    <div class="cart_add">
                                        <input type="hidden" name="id_produk" value="<?= $item['id_produk'] ?>">
                                        <button style="background: none;color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;color: #111111;font-size: 16px;font-weight: 600;display: inline-block;border-bottom: 2px solid #8ECA36;padding-bottom: 4px;
                                        " class="btn_add" type="submit">Add to cart</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php $i++;
                endwhile;
            } else { ?>
                <div class="col-lg-3 col-md-6 col-sm-6" id="item">
                    <div class="product__item">
                        produk tidak ditemukan
                    </div>
                </div>
            <?php }
            ?>
        </div>
        <!-- <div class="shop__last__option">
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
        </div> -->
    </div>
</section>
<!-- Shop Section End -->

<?php include './templates/footer.php' ?>


<script>
    if (location.href !== '<?= $base_url ?>shop') {

        $("#reset").click(function() {
            location.replace('<?= $base_url ?>shop')
        })
    }

    /*------------------
        remove session when click flash alert
    --------------------*/
    $(".alert").on("click", function() {
        sessionStorage.removeItem('flash')
        $(this).alert('close')
    })
</script>