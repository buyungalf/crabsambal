<?php 
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
  echo "<center>Untuk mengakses modul, Anda harus login dulu <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
	include "../../../lib/config.php";
	include "../../../lib/koneksi.php";

	$id_kategori = $_POST['id_kategori'];
	$nama = $_POST['nama_kategori'];
	$kategori_seo = $_POST['kategori_seo'];

	$querySimpan = mysqli_query($koneksi,"UPDATE kategori SET nama_kategori='$nama', kategori_seo='$kategori_seo' WHERE id_kategori='$id_kategori'");
	if($querySimpan) {
		echo"<script> alert('Data Kategori Produk Berhasil Di ubah'); window.location = '$admin_url'+'main.php?module=kategori'; </script>"; 
	} else {
		echo "<script> alert('Data Kategori Produk Gagal Di ubah'); window.location = '$admin_url'+'main.php?module=edit_kategori&id_kategori='+'$id_kategori';</script>";
	}
	}				
?>