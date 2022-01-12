<?php

include "../lib/koneksi.php";
$username = $_POST['username'];
$password = md5($_POST['password']);

if (!ctype_alnum($password)) {
	include "login_reseller2.php";
} else {
	$login = mysqli_query($koneksi, "SELECT * FROM reseller WHERE email='$username' AND password='$password'");
	$match = mysqli_num_rows($login);
	$u = mysqli_fetch_array($login);

	if ($match > 0) {
		session_start();
		$_SESSION['id_reseller'] = $u['id_reseller'];
		$_SESSION['username'] = $u['email'];
		$_SESSION['password'] = $u['password'];
		$_SESSION['level'] = "reseller";
		header('location:main.php?module=home');
	} else {
		include "login_reseller2.php";
	}
}
