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
            $judul = $_POST['judul'];
            $url = $_POST['url'];
            $tgl_sekarang = date("Ymd");

            $lokasi_file = $_FILES['gambar']['tmp_name'];
            $nama_file   = $_FILES['gambar']['name'];


            if (!empty($lokasi_file)){
                UploadBanner($nama_file);
                move_uploaded_file($lokasi_file,"../../../assets/img/foto_banner/" . $nama_file);  

                $query = mysqli_query($koneksi, "INSERT INTO banner (judul, url, gambar, tgl_posting) VALUES ('$judul', '$url', '$nama_file', $tgl_sekarang) ");
                if ($query) {
                    echo"<script> alert('Banner Berhasil Diubah'); window.location = '$admin_url'+'main.php?module=banner'; </script>"; 
                } else {
                    echo"<script> alert('Banner Gagal Diubah'); window.location = '$admin_url'+'main.php?module=tambah_banner'; </script>";
                }
            } else {                
                echo"<script> alert('Masukkan Foto Banner terlebih dahulu!'); window.location = '$admin_url'+'main.php?module=tambah_banner'; </script>";
            }
        } else if(isset($_POST['edit'])) {
            $id_banner = $_POST['id_banner'];
            $judul = $_POST['judul'];
            $url = $_POST['url'];
            $old_file = $_POST['old_gambar'];
            $tgl_sekarang = date("Ymd");

            $lokasi_file = $_FILES['gambar']['tmp_name'];
            $nama_file   = $_FILES['gambar']['name'];

            if (!empty($lokasi_file)){
                UploadBanner($nama_file);
                move_uploaded_file($lokasi_file,"../../../assets/img/foto_banner/" . $nama_file);
                unlink("../../../assets/img/foto_banner/" . $old_file);

                $query = mysqli_query($koneksi, "UPDATE banner SET judul='$judul', url='$url', gambar='$nama_file', tgl_posting=$tgl_sekarang WHERE id_banner = $id_banner");
                if ($query) {
                    echo"<script> alert('Banner Berhasil Diubah'); window.location = '$admin_url'+'main.php?module=banner'; </script>"; 
                } else {
                    echo"<script> alert('Banner Gagal Diubah'); window.location = '$admin_url'+'main.php?module=tambah_banner'; </script>";
                }
            } else {                
                $query = mysqli_query($koneksi, "UPDATE banner SET judul='$judul', url='$url', tgl_posting=$tgl_sekarang WHERE id_banner = '$id_banner'");
                if ($query) {
                    echo"<script> alert('Banner Berhasil Diubah'); window.location = '$admin_url'+'main.php?module=banner'; </script>"; 
                } else {
                    echo"<script> alert('Banner Gagal Diubah'); window.location = '$admin_url'+'main.php?module=edit_banner&id_banner='+'$id_banner'; </script>";
                }
            }
        }
    }
?>