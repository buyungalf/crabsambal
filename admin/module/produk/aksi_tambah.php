<?php 
session_start();
if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
  echo "<center>Untuk mengakses modul, Anda harus login dulu <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
} else {
	include "../../../lib/config.php";
	include "../../../lib/koneksi.php";

	$nama_file = $_FILES['Gambar']['name'];
	$ukuran_file = $_FILES['Gambar']['size'];
	$tipe_file = $_FILES['Gambar']['type'];
	$tmp_file = $_FILES['Gambar']['tmp_name'];

	$nama_produk = $_POST['nama_produk'];
	$produk_seo = $_POST['produk_seo'];
	$deskripsi = $_POST['deskripsi'];
	$harga = $_POST['harga'];
	$stok = $_POST['stok'];
	$berat = $_POST['berat'];
	$tgl_masuk = $_POST['tgl_masuk'];
	$dibeli = $_POST['dibeli'];	
	$diskon = $_POST['diskon'];
	$id_kategori = $_POST['id_kategori'];
	$path = "../../asset/images/foto_produk/" . $nama_file;

	
	if($tipe_file == "image/jpeg" || $tipe_file == "image/png")
	{
		if($ukuran_file <= 10000000)
		{
			if(move_uploaded_file($tmp_file, $path))
			{
				if ($nama_produk=="") {
					echo "<script> alert('Nama produk tidak boleh kosong!'); window.location = '$admin_url'+'main.php?module=form_produk';</script>";
				} else {
					$querySimpan = mysqli_query($koneksi,"INSERT INTO produk(id_kategori, nama_produk, produk_seo, deskripsi, harga, stok, berat, tgl_masuk, gambar, dibeli, diskon) VALUES (
					'$id_kategori','$nama_produk','$produk_seo','$deskripsi','$harga','$stok', '$berat', '$tgl_masuk', '$nama_file', '$dibeli', '$diskon')");
					if($querySimpan)
					{
						echo"<script> alert('Data Produk Berhasil Masuk'); window.location = '$admin_url'+'main.php?module=produk'; </script>"; 
					} else {
						echo "<script> alert('Data Produk Gagal Masuk'); window.location = '$admin_url'+'main.php?module=tambah_produk';</script>";
					}
				}			
				
			} 
			else 
			{
				echo "<script> alert('Data Gambar Produk Gagal Dimasukkan');  window.location = '$admin_url'+'main.php?module=tambah_produk'; </script>";
			}
		} 
		else 
		{
			echo "<script> alert('Data Gambar Produk Gagal Dimasukkan Karena Ukuran Melebihi 1 MB'); window.location = '$admin_url'+'main.php?module=form_produk'; </script>";
		}
	} 
	else 
	{
		echo "<script> alert('Data Gambar Produk Gagal Dimasukkan Karena Tidak Berektensi JPG/JPEG/PNG');</script>";
	}
}
		

?>
