<?php
include "../lib/config.php";
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    include "index.php";
} else {
        include "../lib/koneksi.php";
        include "../lib/function.php";
        include "template/header.php";
        include "template/sidebar.php";

        if (empty($_GET)) {
            include "module/home/home.php";
        } else if ($_GET['module'] == 'home') {
            include "module/home/home.php";    


        } else if ($_GET['module'] == 'produk') {
            include "module/produk/produk.php";
        } else if ($_GET['module'] == 'tambah_produk') {
            include "module/produk/form_tambah.php";
        } else if ($_GET['module'] == 'edit_produk') {
            include "module/produk/form_edit.php";   
                                
        } else if ($_GET['module'] == 'order') {
            include "module/order/order.php";   
        } else if ($_GET['module'] == 'detail_order') {
            include "module/order/detail_order.php";  
                                
        } else if ($_GET['module'] == 'modul') {
            include "module/manajemen_modul/modul.php";   
        } else if ($_GET['module'] == 'tambah_modul') {
            include "module/manajemen_modul/form_tambah.php";
        } else if ($_GET['module'] == 'edit_modul') {
            include "module/manajemen_modul/form_edit.php";  
        //kategori                  
        } else if ($_GET['module'] == 'kategori') {
            include "module/kategori_produk/kategori_produk.php";
        } else if ($_GET['module'] == 'tambah_kategori') {
            include "module/kategori_produk/form_tambah.php";
        } else if ($_GET['module'] == 'edit_kategori') {
            include "module/kategori_produk/form_edit.php";
                                
        } else if ($_GET['module'] == 'profil') {
            include "module/profil_toko_online/profil.php";    
                                
        } else if ($_GET['module'] == 'hubungi') {
            include "module/hubungi_kami/hubungi.php"; 
            } else if ($_GET['module'] == 'balas_pesan') {
            include "module/hubungi_kami/balas.php";     
                                
        } else if ($_GET['module'] == 'carabeli') {
            include "module/cara_pembelian/carabeli.php";    
                                
        } else if ($_GET['module'] == 'banner') {
            include "module/banner/banner.php";    
        } else if ($_GET['module'] == 'tambah_banner') {
            include "module/banner/form_tambah.php";
        } else if ($_GET['module'] == 'edit_banner') {
            include "module/banner/form_edit.php";  
                                
        } else if ($_GET['module'] == 'ongkoskirim') {
            include "module/ongkos_kirim/ongkoskirim.php"; 
        } else if ($_GET['module'] == 'tambah_ongkoskirim') {
            include "module/ongkos_kirim/form_tambah.php";
        } else if ($_GET['module'] == 'edit_ongkoskirim') {
            include "module/ongkos_kirim/form_edit.php";     
                                
        } else if ($_GET['module'] == 'password') {
            include "module/ganti_password/password.php";    
                                
        } else if ($_GET['module'] == 'ym') {
            include "module/modul_ym/ym.php";    
                                
        } else if ($_GET['module'] == 'laporan') {
            include "module/laporan/laporan1.php";    
                                
        } else if ($_GET['module'] == 'download') {
            include "module/download_katalog/download.php";
        } else if ($_GET['module'] == 'tambah_download') {
            include "module/download_katalog/form_tambah.php";
        } else if ($_GET['module'] == 'edit_download') {
            include "module/download_katalog/form_edit.php";
                                
        }  else {
            include "module/home/home.php";
        }

        include "template/footer.php";    
}