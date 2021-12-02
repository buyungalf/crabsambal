<?php include './templates/head.php' ?>

<meta name="description" content="Cake Template">
<meta name="keywords" content="Cake, unica, creative, html">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title>Cart | Crabsambal</title>

<?php include './templates/header.php';

// Tampilkan produk-produk yang telah dimasukkan ke keranjang belanja
$cart_list_result = mysqli_query(
    $koneksi,
    "SELECT * FROM orders_temp, produk 
        WHERE id_session='$sid' AND orders_temp.id_produk=produk.id_produk"
);

?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>Shopping cart</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__links">
                    <a href="<?= $base_url ?>">Home</a>
                    <span>Shopping cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = 0;
                            if (mysqli_num_rows($cart_list_result) > 0) :

                                while ($product_list_item = mysqli_fetch_array($cart_list_result)) :

                                    $disc        = ($product_list_item['diskon'] / 100) * $product_list_item['harga'];
                                    $hargadisc   = number_format(($product_list_item['harga'] - $disc), 0, ",", ".");

                                    $subtotal    = ($product_list_item['harga'] - $disc) * $product_list_item['jumlah'];

                                    $total       = $total + $subtotal;

                            ?>
                                    <tr>

                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <img src="assets/img/product/<?= $product_list_item['gambar'] ?>" alt="<?= $product_list_item['nama_produk'] ?>" />
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6><?= $product_list_item['nama_produk'] ?></h6>
                                                <h5><?= 'Rp. ' .  format_rupiah($product_list_item['harga']) ?></h5>
                                            </div>
                                        </td>
                                        <td class="quantity__item">
                                            <div class="quantity">
                                                <form action="cart" method="GET">
                                                    <input type="hidden" name="act" value="update">
                                                    <input type="hidden" name="id_product" value="<?= $product_list_item['id_orders_temp'] ?>">
                                                    <input type="number" name="jumlah" min="1" max="<?= $product_list_item['stok_temp'] ?>" value="<?= $product_list_item['jumlah'] ?>" onchange="this.form.submit()">
                                                </form>
                                            </div>
                                        </td>
                                        <td class="cart__price"><?= 'Rp. ' .  format_rupiah($subtotal) ?></td>
                                        <td class="cart__close">
                                            <form action="cart" method="GET">
                                                <input type="hidden" name="act" value="delete">
                                                <input type="hidden" name="id_product" value="<?= $product_list_item['id_orders_temp'] ?>">
                                                <button class="btn btn-danger icon_close" style="padding: 5px; border-radius: 100%;" type="submit"></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endwhile;
                            else : ?>
                                <tr>
                                    <td colspan="3" align="center">
                                        Keranjang Masih Kosong
                                    </td>
                                </tr>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="shop">Lanjutkan Belanja</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Total <span><?= 'Rp. ' . format_rupiah($total) ?></span></li>
                    </ul>
                    <a href="checkout" class="primary-btn">Checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->

<?php include './templates/footer.php' ?>