<?php

include "../lib/koneksi.php";
$username = $_POST['username'];
$password = md5($_POST['password']);

if (!ctype_alnum($password)) {
	include "login2.php";
} else {
	$login = mysqli_query($koneksi, "SELECT * FROM kustomer WHERE email='$username' AND password='$password' AND status='reseller'");
	$match = mysqli_num_rows($login);
	$u = mysqli_fetch_array($login);

	if ($match > 0) {
		session_start();
		$_SESSION['id_kustomer'] = $u['id_kustomer'];
		$_SESSION['username'] = $u['email'];
		$_SESSION['password'] = $u['password'];
		$_SESSION['level'] = $u['status'];
		header('location:main.php?module=home');
	} else {
		include "login2.php";
	}
}
