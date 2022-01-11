<?php include './templates/head.php' ?>

<meta name="description" content="Cake Template" />
<meta name="keywords" content="Cake, unica, creative, html" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />

<title>dashboard | Crabsambal</title>

<?php include './templates/header.php';

if (empty($user)) {
    echo "<script> window.location=" . parse_url($base_url)['path'] . "</script>\n";
}

$orders_results = mysqli_query(
    $koneksi,
    "SELECT orders.id_orders, orders.status_order, orders.tgl_order, COUNT(orders_detail.jumlah) AS jumlah
    FROM orders
    JOIN orders_detail
        ON orders.id_orders = orders_detail.id_orders
    JOIN kustomer
        ON kustomer.id_kustomer = orders.id_kustomer
    WHERE kustomer.email = '{$user['email']}'
    GROUP BY orders.id_orders "
);




?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>Orders</h2>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- Wishlist Section Begin -->
<section class="wishlist spad">
    <div class="container">
        <h6 class="checkout__title">Semua Orders</h6>
        <div class="row">
            <div class="col-lg-12">
                <div class="wishlist__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Status</th>
                                <th>Jumlah Item</th>
                                <th>Tanggal Order</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($order_items = mysqli_fetch_array($orders_results)) : ?>
                                <tr>

                                    <td class="cart__stock">
                                        <b>#<?= $order_items['id_orders'] ?></b>
                                    </td>
                                    <td class="cart__stock"><?= $order_items['status_order'] ?></td>
                                    <td class="cart__stock"><?= $order_items['jumlah'] ?></td>
                                    <td class="cart__stock"><?= $order_items['tgl_order'] ?></td>
                                    <td class="cart__btn">
                                        <a href="transaksi?id_order=<?= $order_items['id_orders'] ?>" class="primary-btn">Detail</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Wishlist Section End -->

<!-- Checkout Section End -->
<?php include './templates/footer.php' ?>