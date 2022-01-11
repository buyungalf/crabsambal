<?php

include '../lib/koneksi.php';
include '../lib/function.php';
include '../lib/flash.php';

session_start();
$sid = session_id();

// handle delete 
$act = strtolower(trim($_POST['act'] ?? ''));
$id_produk = strtolower(trim($_POST['id_product'] ?? ''));
$jumlah = strtolower(trim($_POST['jumlah'] ?? ''));


if (validValue($act) && validValue($id_produk)) {
    echo $act . $id_produk;
    switch ($act) {
        case 'add':
            $tgl_sekarang = date("Ymd");
            $jam_sekarang = date("H:i:s");

            $query_product_detail = mysqli_query($koneksi, "SELECT stok FROM produk WHERE id_produk='{$id_produk}'");
            $result = mysqli_fetch_array($query_product_detail);
            $stok = $result['stok'];
            $kemarin = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')));

            if ($stok == 0) {
                create_flash('maaf produk habis', 'danger');
            } else {
                // check if the product is already
                // in cart table for this session
                $query_check_product = mysqli_query($koneksi, "SELECT id_produk, jumlah FROM orders_temp WHERE id_produk='{$id_produk}' AND id_session='$sid'");
                $check_product = mysqli_fetch_array($query_check_product);
                // check product tidak lebih dari stock 


                $result_check_product = mysqli_num_rows($query_check_product);

                // Delete all cart entries older than one day
                mysqli_query($koneksi, "DELETE FROM orders_temp WHERE tgl_order_temp < '{$kemarin}'");

                if ($result_check_product == 0) {
                    // put the product in cart table
                    mysqli_query($koneksi, "INSERT INTO orders_temp (id_produk, jumlah, id_session, tgl_order_temp, jam_order_temp, stok_temp) VALUES ('$id_produk', 1, '$sid', '$tgl_sekarang', '$jam_sekarang', '$stok')");
                    create_flash('berhasil menambahkan produk ke keranjang');
                } else {
                    if ($check_product['jumlah'] >= $stok) {
                        create_flash('Jumlah yang dibeli melebihi stok yang ada', 'danger');
                        if ($check_product['jumlah'] > $stok) {
                            mysqli_query($koneksi, "UPDATE orders_temp SET jumlah = {$stok} WHERE id_session ='$sid' AND id_produk='$id_produk'");
                        }
                    } else {
                        // update product quantity in cart table
                        mysqli_query($koneksi, "UPDATE orders_temp SET jumlah = jumlah + 1 WHERE id_session ='$sid' AND id_produk='$id_produk'");
                        create_flash('berhasil menambahkan produk ke keranjang');
                    }
                }
            }
            break;
        case 'delete':
            mysqli_query($koneksi, "DELETE FROM orders_temp WHERE id_orders_temp='{$id_produk}'");
            create_flash('Berhasil Menghapus produk dari keranjang', 'danger');
            break;
        case 'update':
            // get order temp by id
            $cart_update_result = mysqli_query($koneksi, "SELECT stok_temp FROM orders_temp WHERE id_orders_temp='{$id_produk}'");
            // check if jumlah > stock 
            if ($cart_update = mysqli_fetch_array($cart_update_result)) {
                if ($jumlah > $cart_update['stok_temp']) { {
                        create_flash('Jumlah yang dibeli melebihi stok yang ada', 'danger');
                    }
                } elseif ($jumlah == 0) {
                    create_flash('Jumlah harus di isi', 'danger');
                } else {
                    mysqli_query($koneksi, "UPDATE orders_temp SET jumlah = '{$jumlah}' WHERE id_orders_temp = '{$id_produk}'");
                    create_flash('Jumlah produk berhasil di ubah');
                }
            }

            break;
        default:
            break;
    }
}
