<?php

$mulai = $_GET['mulai'];
$selesai = $_GET['selesai'];
$status = $_GET['status'];

$path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
require_once $path . '/vendor/autoload.php';


$mpdf = new \Mpdf\Mpdf([
	'margin_left' => 20,
	'margin_right' => 15,
	'margin_top' => 48,
	'margin_bottom' => 25,
	'margin_header' => 10,
	'margin_footer' => 10
]);

$content = file_get_contents("http://localhost:8080/crabsambal/admin/module/laporan/content.php?mulai=".$mulai."&selesai=".$selesai."&status=".$status."");

$mpdf->WriteHTML($content);


$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Crabsambal - Invoice");
$mpdf->SetAuthor("Crabsambal");
$mpdf->SetWatermarkText("Crabsambal");
$mpdf->showWatermarkText = true;
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->watermarkTextAlpha = 0.1;
$mpdf->SetDisplayMode('fullpage');


$mpdf->Output();