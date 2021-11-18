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
            $nama = $_POST['nama_kota'];
            $ongkos_kirim = $_POST['ongkos_kirim'];

            $query = mysqli_query($koneksi,"INSERT INTO kota(nama_kota, ongkos_kirim) VALUES ('$nama', '$ongkos_kirim')");
            if($query) {
                echo"<script> alert('Data Ongkos Kirim Berhasil Masuk'); window.location = '$admin_url'+'main.php?module=ongkoskirim'; </script>"; 
            } else {
                echo "<script> alert('Data Ongkos Kirim Gagal Masuk'); window.location = '$admin_url'+'main.php?module=tambah_ongkoskirim';</script>";
            }
        } else if(isset($_POST['edit'])){
            $id_kota = $_POST['id_kota'];
            $nama = $_POST['nama_kota'];
            $ongkos_kirim = $_POST['ongkos_kirim'];

            $query = mysqli_query($koneksi,"UPDATE kota SET nama_kota='$nama', ongkos_kirim='$ongkos_kirim' WHERE id_kota='$id_kota'");
            if($query) {
                echo"<script> alert('Data Ongkos Kirim Berhasil Di ubah'); window.location = '$admin_url'+'main.php?module=ongkoskirim'; </script>"; 
            } else {
                echo "<script> alert('Data Ongkos Kirim Gagal Di ubah'); window.location = '$admin_url'+'main.php?module=edit_ongkoskirim&id_kota='+'$id_kota';</script>";
            }
        } else if($_GET['aksi'] == 'hapus'){
            $id_kota=$_GET['id_kota'];
            $query = mysqli_query($koneksi, "DELETE FROM kota WHERE id_kota='$id_kota'");

            if($query){
               echo "<script> alert('Data Ongkos Kirim Berhasil Di hapus'); window.location = '$admin_url'+'main.php?module=ongkoskirim';</script>";
            } else {
               echo "<script> alert('Data Ongkos Kirim Gagal Di hapus'); window.location = '$admin_url'+'main.php?module=ongkoskirim';</script>"; 
            }
        }
    }  
?>