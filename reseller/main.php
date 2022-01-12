<?php
include "../lib/config.php";
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    include "index.php";
} else {
    include "../lib/koneksi.php";
    include "../lib/function.php";
    include "template/header.php";
    include "template/sidebar_reseller.php";

    if (empty($_GET)) {
        include "module/home/home.php";
    } else if ($_GET['module'] == 'home') {
        include "module/home/home.php"; 
                            
    } else if ($_GET['module'] == 'order') {
        include "module/order_reseller/order.php";   
    } else if ($_GET['module'] == 'detail_order') {
        include "module/order_reseller/detail_order.php";  
    } else if ($_GET['module'] == 'tambah_order') {
        include "module/order_reseller/tambah_order.php";
    } else if ($_GET['module'] == 'order_manual') {
        include "module/order_reseller/order_manual.php";
    } else if ($_GET['module'] == 'tambah_item') {
        include "module/order_reseller/tambah_item.php";

    } else if ($_GET['module'] == 'kustomer') {
        include "module/kustomer/kustomer_reseller.php";
    } else if ($_GET['module'] == 'tambah_kustomer') {
        include "module/kustomer/form_tambah.php";
    } else if ($_GET['module'] == 'edit_kustomer') {
        include "module/kustomer/form_edit.php";
                            
    } else if ($_GET['module'] == 'password') {
        include "module/ganti_password/password.php";

    } else if ($_GET['module'] == 'laporan') {
        include "module/laporan/laporan1.php";   
    } else if ($_GET['module'] == 'cetak_laporan') {
        include "module/laporan/content.php"; 

    }  else {
        include "module/home/home.php";
    }

    include "template/footer.php"; 
}
