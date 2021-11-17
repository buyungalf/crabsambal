<?php 
session_start();
include "../../../lib/config.php";
include "../../../lib/koneksi.php";
include "../../../lib/function.php";

if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
      echo "<center>Untuk mengakses modul, Anda harus login dulu <br>";
      echo "<a href=../../index.php><b>LOGIN</b></a></center>";
    } else {
        if(isset($_POST['edit'])){         
            $static_content = $_POST['static_content'];

            $query = mysqli_query($koneksi, "UPDATE modul SET static_content = '$static_content' WHERE id_modul = '45'");      
            if ($query) {
                echo"<script> alert('Cara Pembelian Berhasil Diubah'); window.location = '$admin_url'+'main.php?module=carabeli'; </script>"; 
            } else {
                echo"<script> alert('Cara Pembelian Berhasil Diubah'); window.location = '$admin_url'+'main.php?module=carabeli'; </script>"; 
            }
        }
    }
?>