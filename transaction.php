<?php include './templates/head.php'


?>

<meta name="description" content="Cake Template">
<meta name="keywords" content="Cake, unica, creative, html">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<title> Transaction | Crabsambal</title>

<?php include './templates/header.php';

$id_order = strtolower(trim($_GET['id_order'] ?? ''));

if (empty($id_order)) {
    echo "<script> window.location='shop'</script>\n";
} else {
    $product_result = mysqli_query(
        $koneksi,
        "SELECT
            orders.tgl_order, produk.nama_produk, produk.harga, produk.berat, produk.gambar, orders_detail.jumlah, produk.diskon, orders.id_kustomer
            FROM orders
            JOIN orders_detail
                ON orders.id_orders = orders_detail.id_orders
            JOIN produk
                ON produk.id_produk = orders_detail.id_produk
            WHERE orders.id_orders = '{$id_order}'
  "
    );

    $orders_result = mysqli_query(
        $koneksi,
        "SELECT kustomer.nama_lengkap, kustomer.alamat, kustomer.email, kustomer.telpon, orders.status_order
        FROM kustomer
        JOIN orders
            ON orders.id_kustomer = kustomer.id_kustomer
        WHERE orders.id_orders = {$id_order}"
    );

    $kustomer_order = mysqli_fetch_array($orders_result);
    $nama = $kustomer_order['nama_lengkap'] ?? '';
    $alamat = $kustomer_order['alamat'] ?? '';
    $telpon = $kustomer_order['telpon'] ?? '';
    $email = $kustomer_order['email'] ?? '';
    $status = $kustomer_order['status_order'] ?? '';
}

// var_dump();nama_lengkap


?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb__text">
                    <h2>Proses Transaksi Selesai</h2>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<!-- About Section Begin -->
<section class="about spad" style="padding-top: 40px">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="about__text">
                    <div class="section-title">
                        <span>Prosess Transaksi Selesai</span>

                    </div>
                    <div class="blog__details__text" style="margin-bottom: 38px;">
                        <h6>Data pemesan beserta ordernya adalah sebagai berikut:</h6>

                        <style>
                            .table-borderless td,
                            .table-borderless th {
                                border: 0;
                            }
                        </style>
                        <table class="table table-borderless">
                            <tr>
                                <td>Nama </td>
                                <td> : <b><?= $nama ?? '' ?></b> </td>
                            </tr>
                            <tr>
                                <td>Alamat Lengkap </td>
                                <td> : <?= $alamat ?? '' ?> </td>
                            </tr>
                            <tr>
                                <td>Telpon </td>
                                <td> : <?= $telpon ?? '' ?> </td>
                            </tr>
                            <tr>
                                <td>E-mail </td>
                                <td> : <?= $email ?? '' ?> </td>
                            </tr>
                            <tr>
                                <td>Status </td>
                                <td> : <?= $status ?? '' ?> </td>
                            </tr>
                        </table>

                        <div class="spad" style="padding-top: 40px;">
                            <p>Nomor Order : <?= $id_order ?></p>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="wishlist__cart__table">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Nama Produk</th>
                                                    <th>Berat (kg)</th>
                                                    <th>Jumlah</th>
                                                    <th>Harga</th>
                                                    <th>Sub Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $total = 0;
                                                $totalberat = 0;
                                                $ongkoskirim = 0;
                                                $grandtotal = 0;

                                                if (mysqli_num_rows($product_result) > 0) :

                                                    while ($product_list_item = mysqli_fetch_array($product_result)) :


                                                        $disc        = ($product_list_item['diskon'] / 100) * $product_list_item['harga'];
                                                        $hargadisc   = number_format(($product_list_item['harga'] - $disc), 0, ",", ".");
                                                        $subtotal    = ($product_list_item['harga'] - $disc) * $product_list_item['jumlah'];

                                                        $total       = $total + $subtotal;
                                                        $grandtotal    = $total + $ongkoskirim;

                                                        $subtotalberat = $product_list_item['berat'] * $product_list_item['jumlah']; // total berat per item produk 
                                                        $totalberat  = $totalberat + $subtotalberat;

                                                ?>

                                                        <tr>
                                                            <td class="product__cart__item">
                                                                <div class="product__cart__item__pic">
                                                                    <img src="assets/img/product/<?= $product_list_item['gambar'] ?>" alt="<?= $product_list_item['nama_produk'] ?>" />
                                                                </div>
                                                                <div class="product__cart__item__text">
                                                                    <h6><?= $product_list_item['nama_produk'] ?></h6>
                                                                </div>
                                                            </td>
                                                            <td class="cart__stock"><?= $product_list_item['berat'] ?></td>
                                                            <td class="cart__stock"><?= $product_list_item['jumlah'] ?></td>
                                                            <td class="cart__stock"><?= $hargadisc ?></td>
                                                            <td class="cart__stock"><?= $subtotal ?></td>
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
                                </div>
                                <div class="col-lg-4">
                                    <div class="cart__total">
                                        <ul>
                                            <li>Total <span><?= 'Rp. ' . format_rupiah($total) ?></span></li>
                                            <li>Ongkos Kirim <span><?= $ongkoskirim == 0 ? $ongkoskirim : 'Rp. ' . format_rupiah($ongkoskirim) ?></span></li>
                                            <li>Total Berat <span><?= $totalberat . ' kg' ?></span></li>
                                            <li>Grand Total <span><?= 'Rp. ' . format_rupiah($grandtotal) ?></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-5">Data order dan nomor rekening transfer sudah terkirim ke email Anda. <br />
                                Apabila Anda tidak melakukan pembayaran dalam 3 hari, maka transaksi dianggap batal.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Section End -->


<?php include './templates/footer.php' ?>