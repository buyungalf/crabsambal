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
            $lokasi_file = $_FILES['fupload']['tmp_name'];
            $nama_file   = $_FILES['fupload']['name'];

            // Apabila ada gambar yang diupload
            if (!empty($lokasi_file)){          
            $file_extension = strtolower(substr(strrchr($nama_file,"."),1));

            switch($file_extension){
                case "pdf": $ctype="application/pdf"; break;
                case "exe": $ctype="application/octet-stream"; break;
                case "zip": $ctype="application/zip"; break;
                case "rar": $ctype="application/rar"; break;
                case "doc": $ctype="application/msword"; break;
                case "xls": $ctype="application/vnd.ms-excel"; break;
                case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
                case "gif": $ctype="image/gif"; break;
                case "png": $ctype="image/png"; break;
                case "jpeg":
                case "jpg": $ctype="image/jpg"; break;
                default: $ctype="application/proses";
            }

            if ($file_extension=='php'){
            echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload tidak bertipe *.PHP');
                window.location = '$admin_url'+'main.php?module=tambah_download'; </script>";
            } else {
                UploadFile($nama_file);
                $query = mysqli_query($koneksi, "INSERT INTO download(judul, nama_file) VALUES ('$judul','$nama_file')");
                if ($query) {
                    echo"<script> alert('File berhasil ditambahkan!'); window.location = '$admin_url'+'main.php?module=download'; </script>";
                } else {
                    echo"<script> alert('File gagal ditambahkan!'); window.location = '$admin_url'+'main.php?module=tambah_download'; </script>";
                }
            }
          } else {
            echo"<script> alert('Masukkan file terlebih dahulu!'); window.location = '$admin_url'+'main.php?module=tambah_download'; </script>";
          }
        } else if(isset($_POST['edit'])){
            $id_download = $_POST['id_download'];
            $judul = $_POST['judul'];
            $lokasi_file = $_FILES['fupload']['tmp_name'];
            $nama_file   = $_FILES['fupload']['name'];

            // Apabila file tidak diganti
            if (empty($lokasi_file)){
                $query = mysqli_query($koneksi, "UPDATE download SET judul='$judul' WHERE id_download='$id_download'");
                
                if($query){
                    echo "<script> alert('File Berhasil Di ubah'); window.location = '$admin_url'+'main.php?module=download';</script>";
                } else {
                    echo "<script> alert('File Gagal Di ubah'); window.location = '$admin_url'+'main.php?module=edit_download&id_download='+'$id_download';</script>"; 
                }
            } else {
                $file_extension = strtolower(substr(strrchr($nama_file,"."),1));

                switch($file_extension){
                    case "pdf": $ctype="application/pdf"; break;
                    case "exe": $ctype="application/octet-stream"; break;
                    case "zip": $ctype="application/zip"; break;
                    case "rar": $ctype="application/rar"; break;
                    case "doc": $ctype="application/msword"; break;
                    case "xls": $ctype="application/vnd.ms-excel"; break;
                    case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
                    case "gif": $ctype="image/gif"; break;
                    case "png": $ctype="image/png"; break;
                    case "jpeg":
                    case "jpg": $ctype="image/jpg"; break;
                    default: $ctype="application/proses";
                }

                if ($file_extension=='php'){
                    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload tidak bertipe *.PHP');
                    window.location = '$admin_url'+'main.php?module=edit_download&id_download='+'$id_download'; </script>";
                } else {
                    UploadFile($nama_file);
                    $query = mysqli_query($koneksi, "UPDATE download SET judul='$judul', nama_file='$nama_file' WHERE id_download='$id_download'");
                    if ($query) {
                        echo"<script> alert('File berhasil diubah!'); window.location = '$admin_url'+'main.php?module=download'; </script>";
                    } else {
                        echo"<script> alert('File gagal diubah!'); window.location = '$admin_url'+'main.php?module=edit_download&id_download='+'$id_download'; </script>";
                    }
                }
            }
        } else if($_GET['aksi'] == 'hapus'){
           $id_download=$_GET['id_download'];
           $query = mysqli_query($koneksi, "DELETE FROM download WHERE id_download='$id_download'");

           if($query){
                echo "<script> alert('File Berhasil Di hapus'); window.location = '$admin_url'+'main.php?module=download';</script>";
            } else {
                echo "<script> alert('File Gagal Di hapus'); window.location = '$admin_url'+'main.php?module=download';</script>"; 
            }
        }
    }  
?>