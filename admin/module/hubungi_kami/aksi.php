<?php 
session_start();
include "../../../lib/config.php";
include "../../../lib/koneksi.php";
include "../../../lib/function.php";

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
      echo "<center>Untuk mengakses modul, Anda harus login dulu <br>";
      echo "<a href=../../index.php><b>LOGIN</b></a></center>";
    } else {   
        } if($_GET['aksi'] == 'hapus'){
            $id_hubungi=$_GET['id_hubungi'];
            $query = mysqli_query($koneksi, "DELETE FROM hubungi WHERE id_hubungi='$id_hubungi'");

            if($query){
                unlink("../../asset/images/foto_hubungi/" . $nama_file);
                echo "<script> alert('Pesan Berhasil Di hapus'); window.location = '$admin_url'+'main.php?module=hubungi';</script>";
            } else {
                echo "<script> alert('Pesan Gagal Di hapus'); window.location = '$admin_url'+'main.php?module=hubungi';</script>"; 
            }
        }
    }  
?>