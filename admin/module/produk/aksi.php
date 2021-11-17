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
            $nama_file = $_FILES['Gambar']['name'];
            $ukuran_file = $_FILES['Gambar']['size'];
            $tipe_file = $_FILES['Gambar']['type'];
            $tmp_file = $_FILES['Gambar']['tmp_name'];

            $nama_produk = $_POST['nama_produk'];
            $produk_seo = seo_title($nama_produk);
            $deskripsi = $_POST['deskripsi'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $berat = $_POST['berat'];
            $tgl_masuk = $_POST['tgl_masuk'];
            $dibeli = $_POST['dibeli']; 
            $diskon = $_POST['diskon'];
            $id_kategori = $_POST['id_kategori'];
            $path = "../../asset/images/foto_produk/" . $nama_file;

            
            if($tipe_file == "image/jpeg" || $tipe_file == "image/png")
            {
                if($ukuran_file <= 10000000)
                {
                    if(move_uploaded_file($tmp_file, $path))
                    {
                        if ($nama_produk=="") {
                            echo "<script> alert('Nama produk tidak boleh kosong!'); window.location = '$admin_url'+'main.php?module=form_produk';</script>";
                        } else {
                            $query = mysqli_query($koneksi,"INSERT INTO produk(id_kategori, nama_produk, produk_seo, deskripsi, harga, stok, berat, tgl_masuk, gambar, dibeli, diskon) VALUES (
                            '$id_kategori','$nama_produk','$produk_seo','$deskripsi','$harga','$stok', '$berat', '$tgl_masuk', '$nama_file', '$dibeli', '$diskon')");
                            if($query)
                            {
                                echo"<script> alert('Data Produk Berhasil Masuk'); window.location = '$admin_url'+'main.php?module=produk'; </script>"; 
                            } else {
                                echo "<script> alert('Data Produk Gagal Masuk'); window.location = '$admin_url'+'main.php?module=tambah_produk';</script>";
                            }
                        }           
                        
                    } 
                    else 
                    {
                        echo "<script> alert('Data Gambar Produk Gagal Dimasukkan');  window.location = '$admin_url'+'main.php?module=tambah_produk'; </script>";
                    }
                } 
                else 
                {
                    echo "<script> alert('Data Gambar Produk Gagal Dimasukkan Karena Ukuran Melebihi 1 MB'); window.location = '$admin_url'+'main.php?module=form_produk'; </script>";
                }
            } 
            else 
            {
                echo "<script> alert('Data Gambar Produk Gagal Dimasukkan Karena Tidak Berektensi JPG/JPEG/PNG');</script>";
            }

        } else if(isset($_POST['edit'])){
            
            $old_gambar = $_POST['old_gambar'];
            $nama_file = $_FILES['Gambar']['name'];
            $ukuran_file = $_FILES['Gambar']['size'];
            $tipe_file = $_FILES['Gambar']['type'];
            $tmp_file = $_FILES['Gambar']['tmp_name'];

            $id_produk = $_POST['id_produk'];
            $nama_produk = $_POST['nama_produk'];
            $produk_seo = seo_title($nama_produk);
            $deskripsi = $_POST['deskripsi'];
            $harga = $_POST['harga'];
            $stok = $_POST['stok'];
            $berat = $_POST['berat'];
            $tgl_masuk = $_POST['tgl_masuk'];
            $dibeli = $_POST['dibeli']; 
            $diskon = $_POST['diskon'];
            $id_kategori = $_POST['id_kategori'];
            $path = "../../asset/images/foto_produk/" . $nama_file;
            if (empty($_FILES['Gambar']['name'])) {
                $query = mysqli_query($koneksi,"UPDATE produk SET id_kategori='$id_kategori', nama_produk='$nama_produk', produk_seo='$produk_seo', deskripsi='$deskripsi', harga='$harga', stok='$stok', berat='$berat', tgl_masuk='$tgl_masuk', dibeli='$dibeli', diskon='$diskon' WHERE id_produk='$id_produk'");
                if($query) {
                    echo"<script> alert('Data Produk Berhasil Diubah'); window.location = '$admin_url'+'main.php?module=produk'; </script>"; 
                } else {
                    echo "<script> alert('Data Produk Gagal Diubah'); window.location = '$admin_url'+'main.php?module=edit_produk&id_produk=$id_produk';</script>";
                }
            } else {
                if($tipe_file == "image/jpeg" || $tipe_file == "image/png")
                {
                    if($ukuran_file <= 10000000)
                    {
                        if(move_uploaded_file($tmp_file, $path))
                        {
                            if ($nama_produk=="") {
                                echo "<script> alert('Nama produk tidak boleh kosong!'); window.location = '$admin_url'+'main.php?module=form_produk';</script>";
                            } else {
                                $query = mysqli_query($koneksi,"UPDATE produk SET id_kategori='$id_kategori', nama_produk='$nama_produk', produk_seo='$produk_seo', deskripsi='$deskripsi', harga='$harga', stok='$stok', berat='$berat', tgl_masuk='$tgl_masuk', gambar='$nama_file', dibeli='$dibeli', diskon='$diskon' WHERE id_produk='$id_produk'");
                                if($query)
                                {
                                    unlink("../../asset/images/foto_produk/" . $old_gambar);
                                    echo"<script> alert('Data Produk Berhasil Diubah'); window.location = '$admin_url'+'main.php?module=produk'; </script>"; 
                                } else {
                                    echo "<script> alert('Data Produk Gagal Diubah'); window.location = '$admin_url'+'main.php?module=edit_produk&id_produk=$id_produk';</script>";
                                }
                            }           
                            
                        } 
                        else 
                        {
                            echo "<script> alert('Data Gambar Produk Gagal Dimasukkan');  window.location = '$admin_url'+'main.php?module=edit_produk&id_produk=$id_produk'; </script>";
                        }
                    } 
                    else 
                    {
                        echo "<script> alert('Data Gambar Produk Gagal Dimasukkan Karena Ukuran Melebihi 1 MB'); window.location = '$admin_url'+'main.php?module=edit_produk&id_produk=$id_produk'; </script>";
                    }
                } 
                else 
                {
                    echo "<script> alert('Data Gambar Produk Gagal Dimasukkan Karena Tidak Berektensi JPG/JPEG/PNG'); window.location = '$admin_url'+'main.php?module=edit_produk&id_produk=$id_produk';</script> ";
                }
            }            
        } else if($_GET['aksi'] == 'hapus'){
            $id_produk=$_GET['id_produk'];
            $nama_file=$_GET['gambar'];
            $query = mysqli_query($koneksi, "DELETE FROM produk WHERE id_produk='$id_produk'");

            if($query){
                unlink("../../asset/images/foto_produk/" . $nama_file);
                echo "<script> alert('Data Produk Berhasil Di hapus'); window.location = '$admin_url'+'main.php?module=produk';</script>";
            } else {
                echo "<script> alert('Data Produk Gagal Di hapus'); window.location = '$admin_url'+'main.php?module=produk';</script>"; 
            }
        }
    }  
?>