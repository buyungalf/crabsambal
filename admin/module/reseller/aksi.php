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
            $status = $_POST['status'];

            $query = mysqli_query($koneksi,"INSERT INTO reseller(nama_lengkap, email, password, alamat, telpon, id_kota, status) VALUES ('$nama_lengkap', '$email', '$password', '$alamat', '$telpon', '$id_kota', '$status')");
            if($query) {
                echo"<script> alert('Data Reseller Berhasil Masuk'); window.location = '$admin_url'+'main.php?module=reseller'; </script>"; 
            } else {
                echo "<script> alert('Data Reseller Gagal Masuk'); window.location = '$admin_url'+'main.php?module=tambah_reseller';</script>";
            }
        } else if(isset($_POST['edit'])){
            $id_reseller = $_POST['id_reseller'];
            $email = $_POST['email'];
            $nama_lengkap = $_POST['nama_lengkap'];
            $alamat = $_POST['alamat'];
            $telpon = $_POST['telpon'];
            $id_kota = $_POST['id_kota'];
            $status = $_POST['status'];

            $query = mysqli_query($koneksi,"UPDATE reseller SET nama_lengkap='$nama_lengkap', alamat='$alamat', telpon='$telpon', email='$email', id_kota='$id_kota', status='$status' WHERE id_reseller='$id_reseller'");
            if($query) {
                echo"<script> alert('Data Reseller Berhasil Diubah'); window.location = '$admin_url'+'main.php?module=reseller'; </script>"; 
            } else {
                echo "<script> alert('Data Reseller Gagal Diubah'); window.location = '$admin_url'+'main.php?module=edit_reseller&id_reseller='+'$id_reseller';</script>";
            }
        } else if($_GET['aksi'] == 'hapus'){
            $id_reseller=$_GET['id_reseller'];
            $query = mysqli_query($koneksi, "DELETE FROM reseller WHERE id_reseller='$id_reseller'");

            if($query) {
                echo"<script> alert('Data Reseller Berhasil dihapus'); window.location = '$admin_url'+'main.php?module=reseller'; </script>"; 
            } else {
                echo "<script> alert('Data Reseller Gagal dihapus'); window.location = '$admin_url'+'main.php?module=reseller';</script>";
            }
        }
    }  
?>