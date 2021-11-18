<?php 
session_start();
include "../../../lib/config.php";
include "../../../lib/koneksi.php";
include "../../../lib/function.php";

if (empty($_SESSION['username']) AND empty($_SESSION['password'])) {
      echo "<center>Untuk mengakses modul, Anda harus login dulu <br>";
      echo "<a href=../../index.php><b>LOGIN</b></a></center>";
    } else {
        if(isset($_POST['change'])){  
            $user = $_SESSION['username'];
            $old_password = md5($_POST['old_password']);
            $password = md5($_POST['password']);
            $cpassword = md5($_POST['cpassword']);

            if ($old_password != $_SESSION['password']) {
                $_SESSION['errors'] = "Password yang Anda masukkan tidak sesuai!";
                echo "<script>window.location = '$admin_url'+'main.php?module=password';</script>";          
            } else if (empty($_POST['password'])) {
                $_SESSION['errors2'] = "Silahkan isi password baru Anda!";
                echo "<script>window.location = '$admin_url'+'main.php?module=password';</script>";
            } else if ($password != $cpassword) {
                $_SESSION['errors3'] = "Password tidak cocok!";
                echo "<script>window.location = '$admin_url'+'main.php?module=password';</script>";
            } else {
                $query = mysqli_query($koneksi, "UPDATE admins SET username='$user', password = '$password' WHERE username='$user'");
                if($query) {
                    echo"<script> alert('Password Berhasil Diubah'); window.location = '$admin_url'+'main.php?module=password'; </script>";
                } else {
                    echo"<script> alert('Password Gagal Diubah'); window.location = '$admin_url'+'main.php?module=password'; </script>";
                }
            }
        }  
    }  
?>