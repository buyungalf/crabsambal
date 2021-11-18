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
            $nama_toko = $_POST['nama_toko'];
            $meta_deskripsi = $_POST['meta_deskripsi'];
            $meta_keyword = $_POST['meta_keyword'];
            $nomor_rekening = $_POST['nomor_rekening'];
            $nomor_hp = $_POST['nomor_hp'];
            $static_content = $_POST['static_content'];
            $email_pengelola = $_POST['email_pengelola'];

            $lokasi_file = $_FILES['gambar']['tmp_name'];
            $nama_file   = $_FILES['gambar']['name'];


            if (!empty($lokasi_file)){
                UploadBanner($nama_file);
                move_uploaded_file($lokasi_file,"../../../assets/img/foto_banner/" . $nama_file);  

                $query = mysqli_query($koneksi, "UPDATE modul SET nama_toko = '$nama_toko', meta_deskripsi = '$meta_deskripsi', meta_keyword = '$meta_keyword', email_pengelola= '$email_pengelola', nomor_rekening = '$nomor_rekening', nomor_hp = '$nomor_hp', static_content = '$static_content', gambar = '$nama_file' WHERE id_modul= '43'");
                if ($query) {
                    echo"<script> alert('Profil Berhasil Diubah'); window.location = '$admin_url'+'main.php?module=profil'; </script>"; 
                } else {
                    echo"<script> alert('Profil Gagal Diubah'); window.location = '$admin_url'+'main.php?module=profil'; </script>";
                }
              }
              else{
                $query = mysqli_query($koneksi, "UPDATE modul SET nama_toko = '$nama_toko', meta_deskripsi = '$meta_deskripsi', meta_keyword = '$meta_keyword', email_pengelola= '$email_pengelola', nomor_rekening = '$nomor_rekening', nomor_hp = '$nomor_hp', static_content = '$static_content' WHERE id_modul= '43'");
                if ($query) {
                    echo"<script> alert('Profil Berhasil Diubah'); window.location = '$admin_url'+'main.php?module=profil'; </script>"; 
                } else {
                    echo"<script> alert('Profil Gagal Diubah'); window.location = '$admin_url'+'main.php?module=profil'; </script>";
                }
              }
        }
    }
?>