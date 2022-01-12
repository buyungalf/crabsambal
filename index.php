<?php include './templates/head.php' ?>

<meta name="description" content="Cake Template">
<meta name="keywords" content="Cake, unica, creative, html">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>Home | Crabsambal</title>

<?php include './templates/header.php';


$product_result = mysqli_query(
    $koneksi,
    "SELECT produk.id_produk, produk.nama_produk, produk.produk_seo, produk.harga, produk.gambar, kategori.nama_kategori, kategori.kategori_seo
        FROM produk
        INNER JOIN kategori ON 
        produk.id_kategori=kategori.id_kategori"
);

$category_result =  mysqli_query(
    $koneksi,
    "SELECT kategori.kategori_seo, kategori.nama_kategori FROM kategori"
);

$banner_result = mysqli_query(
    $koneksi,
    "SELECT banner.judul, banner.gambar FROM banner"
);

$profile_result = mysqli_query(
    $koneksi,
    "SELECT * FROM modul WHERE nama_modul = 'Profil Toko Online'"
);
?>

<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        <?php while ($banner = mysqli_fetch_array($banner_result)) :
        ?>
            <div class="hero__item set-bg" data-setbg="assets/img/banner/<?= $banner['gambar'] ?>">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col-lg-8">
                            <div class="hero__text">
                                <h2><?= $banner['judul'] ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</section>
<!-- Hero Section End -->

<!-- About Section Begin -->
<section class="about spad">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="about__text">
                    <div class="section-title">
                        <span>Profile Crabsambal</span>
                        <!-- <h2>Cakes and bakes from the house of Queens!</h2> -->
                    </div>
                    <?= mysqli_fetch_array($profile_result)['static_content'] ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section Begin -->
<div class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                <?php while ($categoryItem = mysqli_fetch_array($category_result)) : ?>
                    <a href="shop?category=<?= $categoryItem['kategori_seo'] ?>">
                        <div class="categories__item" style="padding: 4px; height: 120px; width: 120px;">
                            <div class="categories__item__icon" style="display: flex; align-items: center; justify-content: center; align-content: center; height: 100%;">
                                <h5><?= $categoryItem['nama_kategori'] ?></h5>
                            </div>
                        </div>
                    </a>
                <?php endwhile ?>
            </div>
        </div>
    </div>
</div>
<!-- Categories Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <?php
            if ($product_result && $product_result->num_rows) {
                while ($item = mysqli_fetch_array($product_result)) :
            ?>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <?php require './templates/productItem.php'; ?>
                    </div>
                <?php
                endwhile;
            } else { ?>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="product__item">
                        produk tidak ditemukan
                    </div>
                </div>
            <?php }
            ?>

        </div>
    </div>
    </div>
</section>
<?php include './templates/footer.php' ?>

<script>
    var cartAdd = $(".cart_add")

    cartAdd.on("click", ".btn_add", function() {
        var $button = $(this)

        const id_product = $button.parent().find("input[name='id_produk']").val()
        const act = $button.parent().find("input[name='act']").val()

        console.log(id_product, act)

        $.ajax({
            type: 'POST',
            url: 'action/cart.php',
            data: {
                act,
                id_product,
            },
            success: function(data) {
                $('span#cartTotal').text(function(i, oldText) {
                    return parseInt(oldText.trim()) + 1
                });

                $('.about').append(data)

                $(".alert").fadeTo(2000, 500).slideUp(500, function() {
                    $(".alert").slideUp(500);
                });
            }
        })
    })
</script>