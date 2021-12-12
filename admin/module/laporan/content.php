<?php
include "../../../lib/config.php";
include "../../../lib/koneksi.php";
include "../../../lib/function.php";

if (!empty($_GET['mulai']) && !empty($_GET['selesai']) && !empty($_GET['status'])) {
	$mulai = $_GET['mulai'];
	$selesai = $_GET['selesai'];
	$status = $_GET['status'];
}


$query = mysqli_query($koneksi, "SELECT c.id_orders as faktur,DATE_FORMAT(c.tgl_order, '%Y-%m-%d') as tanggal, nama_produk,jumlah,harga FROM produk a JOIN orders_detail b ON a.id_produk=b.id_produk JOIN orders c ON b.id_orders=c.id_orders WHERE c.status_order='$status' AND c.tgl_order BETWEEN '$mulai' AND '$selesai'");

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
<td width="50%" style="color:#0000BB; "><span style="font-weight: bold; font-size: 14pt;">Crabsambal</span><br />Bulaksumur H5, Blimbing Sari, Caturtunggal, Depok, Sleman<br />Yogyakarta<br /><span style="font-family:dejavusanscondensed;">&#9742;</span> (0274) 123 456</td>
</tr></table><br>
</htmlpageheader>

<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
</div>
</htmlpagefooter>

<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />

<div style="text-align: left;">Laporan penjualan produk periode <?= tgl_indo($mulai) ?> - <?= tgl_indo($selesai) ?></div>
<div style="text-align: left;">Status : <?= $status ?></div>

<br />

<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>
<td width="10%">Faktur</td>
<td width="15%">Tanggal</td>
<td width="45%">Nama Produk</td>
<td width="15%">Jumlah</td>
<td width="15%">Harga Total</td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->
<?php
$total = 0;
while($item = mysqli_fetch_array($query)) {
	$harga = $item['harga']*$item['jumlah'];
	?>
<tr>
<td align='center'><?= $item['faktur'] ?></td>
<td align='center'><?= tgl_indo($item['tanggal']) ?></td>
<td><?= $item['nama_produk'] ?></td>
<td class='cost'><?= $item['jumlah'] ?></td>
<td class='cost'><?= rp($harga) ?></td>
</tr>
<?php
$total += $harga;
}
?>
<!-- END ITEMS HERE -->
<tr>
<td class="blanktotal" colspan="3" rowspan="6"></td>
<td class="totals">Total:</td>
<td class="totals cost"><?= rp($total) ?></td>
</tr>
</tbody>
</table>
<br>
<div style="text-align: center">
	<a class="" href="pdf.php?mulai=<?= $mulai ?>&selesai=<?= $selesai ?>&status=<?= $status ?>">Cetak</a>	
</div>

</body>
</html>