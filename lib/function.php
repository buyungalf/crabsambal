<?php

function seo_title($s)
{
  $c = array(' ');
  $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+');

  $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d

  $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
  return $s;
}

function slug($s)
{
  $c = array(' ');
  $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+');

  $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d

  $s = strtolower(str_replace($c, '_', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
  return $s;
}

function tgl_indo($tgl)
{
  $tanggal = substr($tgl, 8, 2);
  $bulan = getBulan(substr($tgl, 5, 2));
  $tahun = substr($tgl, 0, 4);
  return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function getBulan($bln)
{
  switch ($bln) {
    case 1:
      return "Januari";
      break;
    case 2:
      return "Februari";
      break;
    case 3:
      return "Maret";
      break;
    case 4:
      return "April";
      break;
    case 5:
      return "Mei";
      break;
    case 6:
      return "Juni";
      break;
    case 7:
      return "Juli";
      break;
    case 8:
      return "Agustus";
      break;
    case 9:
      return "September";
      break;
    case 10:
      return "Oktober";
      break;
    case 11:
      return "November";
      break;
    case 12:
      return "Desember";
      break;
  }
}

function format_rupiah($angka)
{
  $rupiah = number_format($angka, 0, ',', '.');
  return $rupiah;
}


function validValue($value): bool
{
  // mencegah XSS

  $value = stripslashes(strip_tags(htmlentities(htmlspecialchars($value), ENT_QUOTES)));

  return isset($value) && $value !== "" && !empty($value);
}

function UploadImage($fupload_name)
{
  //direktori gambar
  $vdir_upload = "../../../foto_produk/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);

  //identitas file asli
  $im_src = imagecreatefromjpeg($vfile_upload);
  $src_width = imageSX($im_src);
  $src_height = imageSY($im_src);

  //Simpan dalam versi small 110 pixel
  //Set ukuran gambar hasil perubahan
  $dst_width = 55;
  $dst_height = ($dst_width / $src_width) * $src_height;

  //proses perubahan ukuran
  $im = imagecreatetruecolor($dst_width, $dst_height);
  imagecopyresampled($im, $im_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

  //Simpan gambar
  imagejpeg($im, $vdir_upload . "small_" . $fupload_name);

  //Hapus gambar di memori komputer
  imagedestroy($im_src);
  imagedestroy($im);
}

function UploadBanner($fupload_name)
{
  //direktori banner
  $vdir_upload = "../../../assets/img/foto_banner/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["gambar"]["tmp_name"], $vfile_upload);
}

function UploadFile($fupload_name)
{
  //direktori file
  $vdir_upload = "../../../assets/files/";
  $vfile_upload = $vdir_upload . $fupload_name;

  //Simpan gambar dalam ukuran sebenarnya
  move_uploaded_file($_FILES["fupload"]["tmp_name"], $vfile_upload);
}

function rp($uang)
{
  $rp = "";
  $digit = strlen($uang);

  while ($digit > 3) {
    $rp = "." . substr($uang, -3) . $rp;
    $lebar = strlen($uang) - 3;
    $uang  = substr($uang, 0, $lebar);
    $digit = strlen($uang);
  }
  $rp = $uang . $rp . ",-";
  return $rp;
}
