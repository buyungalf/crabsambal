<?php

include "../../../lib/config.php";
include "../../../lib/koneksi.php";
include "../../../lib/function.php";

$id_orders = $_GET['id_orders'];
$query = mysqli_query($koneksi, "SELECT * FROM orders a JOIN kustomer b ON a.id_kustomer = b.id_kustomer JOIN kota c ON b.id_kota = c.id_kota WHERE a.id_orders = $id_orders");
$i=1;
$item=mysqli_fetch_array($query);

?>
<html>
<head>
<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
	text-align: center;
	border: 0.1mm solid #000000;
	font-variant: small-caps;
}
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: "." center;
}
</style>
</head>
<body>

<htmlpageheader name="myheader">
<table width="100%"><tr>
<td width="50%" style="color:#0000BB; "><span style="font-weight: bold; font-size: 14pt;">Crabsambal</span><br />123 Anystreet<br />Your City<br />GD12 4LP<br /><span style="font-family:dejavusanscondensed;">&#9742;</span> 01777 123 567</td>
<td width="50%" style="text-align: right;">
	Invoice No.<br />
	<span style="font-weight: bold; font-size: 12pt;">000<?= $item['id_orders'] ?></span>
</td>
</tr></table>
</htmlpageheader>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />

<div style="text-align: right">Tanggal : <?= tgl_indo($item['tgl_order']) ?></div>

<table width="100%" style="font-family: serif;" cellpadding="10"><tr>
<td width="45%" style="border: 0.1mm solid #888888; "><span style="font-size: 7pt; color: #555555; font-family: sans;">SOLD TO:</span><br /><br />
	<?= $item['nama_lengkap'] ?><br />
	<?= $item['alamat'] ?><br />
	<?= $item['nama_kota'] ?><br />
	<?= $item['telpon'] ?>
</td>
</tr>
</table>

<br />

<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>
<td width="45%">Nama Produk</td>
<td width="10%">Berat</td>
<td width="10%">Jumlah</td>
<td width="15%">Harga Satuan</td>
<td width="20%">Sub Total</td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->
<?php
$query = mysqli_query($koneksi, "SELECT * FROM produk a JOIN orders_detail b ON a.id_produk = b.id_produk WHERE b.id_orders = $id_orders");
$i=1;
$total = 0;
$totalberat = 0;
while($item=mysqli_fetch_array($query)){
$disc        = ($item['diskon']/100)*$item['harga'];
$hargadisc   = number_format(($item['harga']-$disc),0,",","."); 
$subtotal    = ($item['harga']-$disc) * $item['jumlah'];

$total       = $total + $subtotal;
$subtotal_rp = format_rupiah($subtotal);    
$total_rp    = format_rupiah($total);    
$harga       = format_rupiah($item['harga']);

$subtotalberat = $item['berat'] * $item['jumlah']; // total berat per item produk 
$totalberat  = $totalberat + $subtotalberat; // grand total berat all produk yang dibeli                      
?>
<tr>
<td><?= $item['nama_produk'] ?></td>
<td align="center"><?= $item['berat'] ?></td>
<td><?= $item['jumlah'] ?></td>
<td class="cost">Rp<?= format_rupiah($item['harga']) ?></td>
<td class="cost">Rp <?= $subtotal_rp ?></td>
</tr>
<?php } ?>
<!-- END ITEMS HERE -->
<?php
$query = mysqli_query($koneksi, "SELECT * FROM kota a JOIN kustomer b ON a.id_kota = b.id_kota JOIN orders c ON b.id_kustomer = c.id_kustomer WHERE c.id_orders = $id_orders");
$item=mysqli_fetch_array($query);
$ongkoskirim1=$item['ongkos_kirim'];
$ongkoskirim=$ongkoskirim1 * $totalberat;

$grandtotal    = $total + $ongkoskirim; 

$ongkoskirim_rp = format_rupiah($ongkoskirim);
$ongkoskirim1_rp = format_rupiah($ongkoskirim1); 
$grandtotal_rp  = format_rupiah($grandtotal);
?>
<tr>
<td class="blanktotal" colspan="3" rowspan="6"></td>
<td class="totals">Subtotal:</td>
<td class="totals cost">Rp<?= $total_rp ?></td>
</tr>
<tr>
<td class="totals">Ongkos Kirim:</td>
<td class="totals cost">Rp<?= $ongkoskirim1_rp ?></td>
</tr>
<tr>
<td class="totals">Berat:</td>
<td class="totals cost"><?= $totalberat ?> kg</td>
</tr>
<tr>
<td class="totals">Total Ongkos Kirim:</td>
<td class="totals cost">Rp<?= $ongkoskirim_rp ?></td>
</tr>
<tr>
<td class="totals"><b>Grand Total :</b></td>
<td class="totals cost"><b>Rp<?= $grandtotal_rp ?></b></td>
</tr>
</tbody>
</table>
<br>
<div style="text-align: center">
	<a class="" href="../laporan/pdf_order.php?id_orders=<?= $id_orders ?>">Cetak</a>	
</div>

</body>
</html>