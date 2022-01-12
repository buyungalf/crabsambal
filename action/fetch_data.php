<?php

session_start();

include "../lib/config.php";
include "../lib/koneksi.php";
include "../lib/function.php";

// handle sort by category and asd / dsc 
$category = strtolower(trim($_POST['category'] ?? ''));
$sort = strtolower(trim($_POST['sort'] ?? ''));
$action = strtolower(trim($_POST['action'] ?? ''));
$output = '';

// check valid sort
$sort = validValue($sort) && !in_array($sort, ['asc', 'desc']) ?  'asc' : $sort;

if (validValue($category) && validValue($sort) && $action === 'filter') {
    // echo "filter category sort";
    // jika ada kategori dan sort maka where category sort asc|desc
    $query_product = "SELECT produk.id_produk, produk.nama_produk, produk.produk_seo, produk.harga, produk.gambar, kategori.nama_kategori, kategori.kategori_seo
        FROM produk
        INNER JOIN kategori ON 
        produk.id_kategori=kategori.id_kategori 
        WHERE kategori.kategori_seo='{$category}'
        ORDER BY produk.nama_produk {$sort}";
} elseif (validValue($category) && $action === 'filter') {
    // echo "filter category sort";
    // jika ada kategori ganti query product where category 
    $query_product = "SELECT produk.id_produk, produk.nama_produk, produk.produk_seo, produk.harga, produk.gambar, kategori.nama_kategori, kategori.kategori_seo
        FROM produk
        INNER JOIN kategori ON 
        produk.id_kategori=kategori.id_kategori
        WHERE kategori.kategori_seo='{$category}'";
} elseif (validValue($sort) && $action === 'filter') {
    // echo "filter sort";
    // jika ada sort ganti query product ke sort asc | desc
    $query_product = "SELECT produk.id_produk, produk.nama_produk, produk.produk_seo, produk.harga, produk.gambar, kategori.nama_kategori, kategori.kategori_seo
        FROM produk
        INNER JOIN kategori ON produk.id_kategori=kategori.id_kategori
        ORDER BY produk.nama_produk {$sort}";
} else {
    // echo "filter default";
    $query_product = "SELECT produk.id_produk, produk.nama_produk, produk.produk_seo, produk.harga, produk.gambar, kategori.nama_kategori, kategori.kategori_seo
        FROM produk
        INNER JOIN kategori ON 
        produk.id_kategori=kategori.id_kategori";
}


$product_result = mysqli_query($koneksi, $query_product);

$row = mysqli_num_rows($product_result);

if ($row > 0) {
    $i = 1;
    if ($product_result && $product_result->num_rows) {
        while ($item = mysqli_fetch_array($product_result)) :
            $output .=  '<div class="col-lg-3 col-md-6 col-sm-6" id="item">
                <div class="product__item">
                    <div class="product__item__pic set-bg" onclick="location.href= ' .  $base_url . 'produk-' . $item['produk_seo'] . '" style="background-size: auto; cursor: pointer;" data-setbg="assets/img/product/' . $item['gambar'] . '">
                        <div class="product__label">
                            <a href="shop?category=' . $item['kategori_seo'] . '">
                                <span>' . $item['nama_kategori'] . '</span>
                            </a>
                        </div>
                    </div>
                    <div class="product__item__text">
                        <h6>
                            <a href="produk-' . $item['produk_seo'] . '">
                               ' . $item['nama_produk'] . '
                            </a>
                        </h6>
                        <div class="product__item__price" data-price="' . $item['harga'] . '"> Rp ' . format_rupiah($item['harga']) . ' </div>
                        <div class="cart_add">
                            <input type="hidden" name="act" value="add">
                            <input type="hidden" name="id_produk" value=" ' . $item['id_produk'] . '">
                            <a class="btn_add" style="cursor: pointer;">Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
            
           
            ';
            $i++;
        endwhile;
    } else {
        $output =  '<div class="col-lg-3 col-md-6 col-sm-6" id="item">
            <div class="product__item">
                produk tidak ditemukan
            </div>
        </div>';
    }

    echo $output . " <script>
    $('.set-bg').each(function() {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    var cartAdd = $('.cart_add')

    cartAdd.on('click', '.btn_add', function() {
        var button = $(this)

        const id_product = button.parent().find('input[name=id_produk]').val()
        const act = button.parent().find('input[name=act]').val()

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

                $('.alert').fadeTo(2000, 500).slideUp(500, function() {
                    $('.alert').slideUp(500);
                });
            }
        })
    })
    </script>";
}
