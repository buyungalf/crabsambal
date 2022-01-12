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
            $nama_lengkap = $_POST['nama_lengkap'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $alamat = $_POST['alamat'];
            $telpon = $_POST['telpon'];
            $id_kota = $_POST['id_kota'];
            if (isset($_SESSION['id_reseller'])) {
                $id_reseller = $_SESSION['id_reseller'];
            } else {
                $id_reseller = "NULL";
            }

            $query = mysqli_query($koneksi,"INSERT INTO kustomer(nama_lengkap, email, password, alamat, telpon, id_kota, id_reseller) VALUES ('$nama_lengkap', '$email', '$password', '$alamat', '$telpon', '$id_kota', '$id_reseller')");
            if($query) {
                echo"<script> alert('Data Kustomer Berhasil Masuk'); window.location = '$reseller_url'+'main.php?module=kustomer'; </script>"; 
            } else {
                echo "<script> alert('Data Kustomer Gagal Masuk'); window.location = '$reseller_url'+'main.php?module=tambah_kustomer';</script>";
            }
        } else if(isset($_POST['edit'])){
            $id_kustomer = $_POST['id_kustomer'];
            $email = $_POST['email'];
            $nama_lengkap = $_POST['nama_lengkap'];
            $alamat = $_POST['alamat'];
            $telpon = $_POST['telpon'];
            $id_kota = $_POST['id_kota'];

            $query = mysqli_query($koneksi,"UPDATE kustomer SET nama_lengkap='$nama_lengkap', alamat='$alamat', telpon='$telpon', email='$email', id_kota='$id_kota' WHERE id_kustomer='$id_kustomer'");
            if($query) {
                echo"<script> alert('Data Kustomer Berhasil Diubah'); window.location = '$reseller_url'+'main.php?module=kustomer'; </script>"; 
            } else {
                echo "<script> alert('Data Kustomer Gagal Diubah'); window.location = '$reseller_url'+'main.php?module=edit_kustomer&id_kustomer='+'$id_kustomer';</script>";
            }
        } else if($_GET['aksi'] == 'hapus'){
            $id_kustomer=$_GET['id_kustomer'];
            $query = mysqli_query($koneksi, "DELETE FROM kustomer WHERE id_kustomer='$id_kustomer'");

            if($query) {
                echo"<script> alert('Data Kustomer Berhasil dihapus'); window.location = '$reseller_url'+'main.php?module=kustomer'; </script>"; 
            } else {
                echo "<script> alert('Data Kustomer Gagal dihapus'); window.location = '$reseller_url'+'main.php?module=kustomer';</script>";
            }
        }
    }  
?>