<?php 
session_start();
include "../../../lib/config.php";
include "../../../lib/koneksi.php";
include "../../../lib/function.php";

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
      echo "<center>Untuk mengakses modul, Anda harus login dulu <br>";
      echo "<a href=../../index.php><b>LOGIN</b></a></center>";
    } else {
        if(isset($_POST['tambah'])){            
            
        } else if($_GET['aksi'] == 'lunas'){
            $id_orders = $_GET['id_orders'];

            $query = mysqli_query($koneksi, "SELECT * FROM orders WHERE id_orders = $id_orders");
            $item=mysqli_fetch_array($query);

            if ($item['status_order'] !== 'Lunas') {
            	mysqli_query($koneksi, "UPDATE produk,orders_detail SET produk.stok=produk.stok-orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk and orders_detail.id_orders='$id_orders'");
	  
			  	// Update untuk menambahkan produk yang dibeli (best seller = produk yang paling laris)
		      	mysqli_query($koneksi, "UPDATE produk,orders_detail SET produk.dibeli=produk.dibeli+orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk and orders_detail.id_orders='$id_orders'");
            }

			$query = mysqli_query($koneksi, "UPDATE orders SET status_order='Lunas' WHERE id_orders='$id_orders'");
			if ($query) {
				header('location:../../main.php?module=order');
			} else {
				echo "<script> alert('Ubah Status gagal'); window.location = '$admin_url'+'main.php?module=order';</script>";
			}
        } else if($_GET['aksi'] == 'batal'){
            $id_orders = $_GET['id_orders'];

            $query = mysqli_query($koneksi, "SELECT * FROM orders WHERE id_orders = $id_orders");
            $item=mysqli_fetch_array($query);

            if ($item['status_order'] !== 'Batal') {
            	mysqli_query($koneksi, "UPDATE produk,orders_detail SET produk.stok=produk.stok+orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk and orders_detail.id_orders='$id_orders'");
	  
			  	// Update untuk menambahkan produk yang dibeli (best seller = produk yang paling laris)
		      	mysqli_query($koneksi, "UPDATE produk,orders_detail SET produk.dibeli=produk.dibeli-orders_detail.jumlah WHERE produk.id_produk=orders_detail.id_produk and orders_detail.id_orders='$id_orders'");
            }

			$query = mysqli_query($koneksi, "UPDATE orders SET status_order='Batal' WHERE id_orders='$id_orders'");
			if ($query) {
				header('location:../../main.php?module=order');
			} else {
				echo "<script> alert('Ubah Status gagal'); window.location = '$admin_url'+'main.php?module=order';</script>";
			}
        }
    }  
?>