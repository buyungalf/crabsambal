<?php 
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
  echo "<center>Untuk mengakses modul, Anda harus login dulu <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
	include "../../../lib/config.php";
	include "../../../lib/koneksi.php";

	$nama = $_POST['nama_kategori'];
	$kategori_seo = $_POST['kategori_seo'];

	$querySimpan = mysqli_query($koneksi,"INSERT INTO kategori(nama_kategori, kategori_seo) VALUES ('$nama', '$kategori_seo')");
	if($querySimpan) {
		echo"<script> alert('Data Kategori Produk Berhasil Masuk'); window.location = '$admin_url'+'main.php?module=kategori'; </script>"; 
	} else {
		echo "<script> alert('Data Kategori Produk Gagal Masuk'); window.location = '$admin_url'+'main.php?module=tambah_kategori';</script>";
	}
	}				
?>