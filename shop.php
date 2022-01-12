<?php include './templates/head.php' ?>


<meta name="description" content="Cake Template">
<meta name="keywords" content="Cake, unica, creative, html">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>Semua Produk | Crabsambal</title>

<?php include './templates/header.php';


$query_category = "SELECT kategori.kategori_seo, kategori.nama_kategori FROM kategori";

// handle sort by category and asd / dsc 
$category = strtolower(trim($_POST['category'] ?? ''));
$sort = strtolower(trim($_POST['sort'] ?? ''));

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
                        <form action="shop" method="GET">
                            <input type="text" name="search" id="search" placeholder="Search" value="<?= validValue($search) ? $search : '' ?>" />
                        </form>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7">
                    <div class="row">

                        <div class="shop__option__right container-fluid d-flex justify-content-around justify-content-md-end ">

                            <select id="category">
                                <option value="">kategori</option>
                                <?php while ($categoryItem = mysqli_fetch_array($category_result)) : ?>
                                    <option value="<?= $categoryItem['kategori_seo'] ?>" <?= isset($category) && $category === $categoryItem['kategori_seo'] ? 'selected' : '' ?>>
                                        <?= $categoryItem['nama_kategori'] ?>
                                    </option>
                                <?php endwhile ?>
                            </select>
                            <select id="sort">
                                <option value="">urutan</option>
                                <option value="asc" <?= isset($sort) && $sort === 'asc' ? 'selected' : '' ?>>A - Z</option>
                                <option value="desc" <?= isset($sort) && $sort === 'desc' ? 'selected' : '' ?>>Z - A</option>
                            </select>

                        </div>
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
                        <?php require './templates/productItem.php'; ?>
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

    var cartAdd = $(".cart_add")

    cartAdd.on("click", ".btn_add", function() {
        var $button = $(this)

        const id_product = $button.parent().find("input[name='id_produk']").val()
        const act = $button.parent().find("input[name='act']").val()

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

                $('.breadcrumb-option').append(data)

                $(".alert").fadeTo(2000, 500).slideUp(500, function() {
                    $(".alert").slideUp(500);
                });
            }
        })
    })

    $("#search").keyup(function() {

        // Retrieve the input field text and reset the count to zero
        var search = $(this).val()

        var regex = new RegExp(search, "i"); // Create a regex variable outside the loop statement

        // Loop through the comment list
        $("#row #item").each(function() {

            var produk = $(this)

            console.log(produk.text().search(regex))
            // If the list item does not contain the text phrase fade it out
            if (produk.text().trim().search(regex) < 0) { // use the variable here
                produk.fadeOut();
            } else {
                produk.show();
            }
        });


    });

    $("select").on("change", function() {
        const category = $("#category").val()
        const sort = $("#sort").val()

        let name = this.name
        let value = this.value

        let action = "default"
        const row = $("#row")

        let data = {
            action: name !== null ? "filter" : action.toLowerCase().trim(),
            category: category.toLowerCase().trim(),
            sort: sort.toLowerCase().trim(),
        }

        $.ajax({
            url: "action/fetch_data.php",
            method: "POST",
            data,
            success: function(data) {
                row.html(data)
            },

        })
    })
</script>