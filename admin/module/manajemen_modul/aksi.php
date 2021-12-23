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
        	$nama_modul = $_POST['nama_modul'];
        	$link = $_POST['link'];
        	$status = $_POST['status'];
        	$aktif = $_POST['aktif'];

            $query = mysqli_query($koneksi,"INSERT INTO modul(nama_modul, link, status, aktif) VALUES ('$nama_modul', '$link', '$status', '$aktif')");
            if($query) {
                echo"<script> alert('Data Modul Berhasil Masuk'); window.location = '$admin_url'+'main.php?module=modul'; </script>"; 
            } else {
                echo "<script> alert('Data Modul Gagal Masuk'); window.location = '$admin_url'+'main.php?module=tambah_modul';</script>";
            }
        } else if(isset($_POST['edit'])){
        	$id_modul=$_POST['id_modul'];
            $nama_modul = $_POST['nama_modul'];
        	$link = $_POST['link'];
        	$status = $_POST['status'];
        	$aktif = $_POST['aktif'];
            $slug = slug($nama_modul);

            $query = mysqli_query($koneksi,"UPDATE modul SET nama_modul='$nama_modul', link='$link', status='$status', aktif='$aktif' WHERE id_modul='$id_modul'");
            if($query) {
                echo"<script> alert('Data Modul Berhasil Diubah'); window.location = '$admin_url'+'main.php?module=modul'; </script>"; 
            } else {
                echo "<script> alert('Data Modul Gagal Diubah'); window.location = '$admin_url'+'main.php?module=tambah_modul';</script>";
            }
        } else if($_GET['aksi'] == 'hapus'){
            $id_modul=$_GET['id_modul'];
            $query = mysqli_query($koneksi, "DELETE FROM modul WHERE id_modul='$id_modul'");

            if($query){
               echo "<script> alert('Data Modul Berhasil Di hapus'); window.location = '$admin_url'+'main.php?module=modul';</script>";
            } else {
               echo "<script> alert('Data Modul Gagal Di hapus'); window.location = '$admin_url'+'main.php?module=modul';</script>"; 
            }
        }
    }  
?>