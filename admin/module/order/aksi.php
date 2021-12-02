<?php 
session_start();
include "../../../lib/config.php";
include "../../../lib/koneksi.php";
include "../../../lib/function.php";

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
      echo "<center>Untuk mengakses modul, Anda harus login dulu <br>";
      echo "<a href=../../index.php><b>LOGIN</b></a></center>";
    } else {
        if(isset($_POST['tambah_item'])){   
            $id_orders = $_POST['id_orders'];
            $id_produk = $_POST['id_produk'];
            $jumlah = $_POST['jumlah'];

            $query = mysqli_query($koneksi, "INSERT INTO orders_detail(id_orders, id_produk, jumlah) VALUES ($id_orders, $id_produk, $jumlah)");
            if($query) {
                echo"<script>alert('Item ditambahkan'); window.location = '$admin_url'+'main.php?module=order_manual'; </script>"; 
            } else {
                echo "<script> alert('gagal'); window.location = '$admin_url'+'main.php?module=tambah_item';</script>";
            }
        } else if(isset($_POST['order'])) {
            $id_kustomer = $_SESSION['id_kustomer'];
            $id_orders = $_POST['id_orders'];
            $tgl_order = $_POST['tgl_order'];
            $jam_order = $_POST['jam_order'];

            $query = mysqli_query($koneksi, "INSERT INTO orders (id_orders, status_order, tgl_order, jam_order, id_kustomer) VALUES ('$id_orders', 'Baru', '$tgl_order', '$jam_order', $id_kustomer)");
            if($query) {
                unset($_SESSION['id_kustomer']);
                echo"<script> alert('Order berhasil!'); window.location = '$admin_url'+'main.php?module=order'; </script>"; 
            } else {
                echo "<script> alert('Order gagal'); window.location = '$admin_url'+'main.php?module=order_manual';</script>";
            }
        }  else if($_GET['aksi'] == 'hapus_item') {
           $id_produk = $_GET['id_produk'];
           $jumlah = $_GET['jumlah'];
            $query = mysqli_query($koneksi, "DELETE FROM orders_detail WHERE id_produk='$id_produk' AND jumlah='$jumlah'");

            if($query){
               echo "<script> window.location = '$admin_url'+'main.php?module=order_manual';</script>";
            } else {
               echo "<script> window.location = '$admin_url'+'main.php?module=order_manual';</script>"; 
            }
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