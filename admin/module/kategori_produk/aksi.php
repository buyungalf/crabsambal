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
            $nama = $_POST['nama_kategori'];
            $kategori_seo = seo_title($nama);

            $query = mysqli_query($koneksi,"INSERT INTO kategori(nama_kategori, kategori_seo) VALUES ('$nama', '$kategori_seo')");
            if($query) {
                echo"<script> alert('Data Kategori Produk Berhasil Masuk'); window.location = '$admin_url'+'main.php?module=kategori'; </script>"; 
            } else {
                echo "<script> alert('Data Kategori Produk Gagal Masuk'); window.location = '$admin_url'+'main.php?module=tambah_kategori';</script>";
            }
        } else if(isset($_POST['edit'])){
            $id_kategori = $_POST['id_kategori'];
            $nama = $_POST['nama_kategori'];
            $kategori_seo = seo_title($nama);

            $query = mysqli_query($koneksi,"UPDATE kategori SET nama_kategori='$nama', kategori_seo='$kategori_seo' WHERE id_kategori='$id_kategori'");
            if($query) {
                echo"<script> alert('Data Kategori Produk Berhasil Di ubah'); window.location = '$admin_url'+'main.php?module=kategori'; </script>"; 
            } else {
                echo "<script> alert('Data Kategori Produk Gagal Di ubah'); window.location = '$admin_url'+'main.php?module=edit_kategori&id_kategori='+'$id_kategori';</script>";
            }
        } else if($_GET['aksi'] == 'hapus'){
            $id_kategori=$_GET['id_kategori'];
            $query = mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori='$id_kategori'");

            if($query){
               echo "<script> alert('Data Kategori Produk Berhasil Di hapus'); window.location = '$admin_url'+'main.php?module=kategori';</script>";
            } else {
               echo "<script> alert('Data Kategori Produk Gagal Di hapus'); window.location = '$admin_url'+'main.php?module=kategori';</script>"; 
            }
        }
    }  
?>