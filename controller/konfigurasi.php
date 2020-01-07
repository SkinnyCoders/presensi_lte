<?php
require 'connection.php';
session_start();

if (isset($_POST['simpan'])) {
	$url = strtolower($_POST['url']);
	$url_val = explode(":", $url);
	$url_val = $url_val[0];

	$valid_url = ['http', 'https'];

	$key = htmlspecialchars($_POST['key']);

	if (empty($url)) {
		$_SESSION['failed'] = ['msg' => 'Maaf, Alamat url tidak bolah kosong!'];
        header('location:'.$_SERVER['HTTP_REFERER']);
        return false;
	}

	if (empty($key)) {
		$_SESSION['failed'] = ['msg' => 'Maaf, Key tidak boleh kosong!'];
        header('location:'.$_SERVER['HTTP_REFERER']);
        return false;
	}

	if (!in_array($url_val, $valid_url)) {
		$_SESSION['failed'] = ['msg' => 'Maaf, Url tidak valid!'];
        header('location:'.$_SERVER['HTTP_REFERER']);
        return false;
	}else{
		//insert table 
		$insertKonfig = mysqli_query($conn, "INSERT INTO `konfigurasi`(`url`, `api_key`) VALUES ('$url','$key')");
		if ($insertKonfig) {
			$_SESSION['toast'] = ['msg' => 'Selamat!, Konfigurasi Sistem berhasil'];
        	header('location:'.$_SERVER['HTTP_REFERER']);
		}else{
			$_SESSION['failed'] = ['msg' => 'Maaf, Konfigurasi sistem gagal!'];
        	header('location:'.$_SERVER['HTTP_REFERER']);
		}
	}
}

if (isset($_POST['update'])) {
	$url = strtolower($_POST['url']);
	$url_val = explode(":", $url);
	$url_val = $url_val[0];

	$valid_url = ['http', 'https'];

	$key = htmlspecialchars($_POST['key']);

	if (empty($url)) {
		$_SESSION['failed'] = ['msg' => 'Maaf, Alamat url tidak bolah kosong!'];
        header('location:'.$_SERVER['HTTP_REFERER']);
        return false;
	}

	if (empty($key)) {
		$_SESSION['failed'] = ['msg' => 'Maaf, Key tidak boleh kosong!'];
        header('location:'.$_SERVER['HTTP_REFERER']);
        return false;
	}

	if (!in_array($url_val, $valid_url)) {
		$_SESSION['failed'] = ['msg' => 'Maaf, Url tidak valid!'];
        header('location:'.$_SERVER['HTTP_REFERER']);
        return false;
	}else{
		//insert table 
		$insertKonfig = mysqli_query($conn, "UPDATE `konfigurasi` SET `url`='$url',`api_key`='$key' WHERE 1");
		if ($insertKonfig) {
			$_SESSION['toast'] = ['msg' => 'Selamat!, Konfigurasi Sistem berhasil'];
        	header('location:'.$_SERVER['HTTP_REFERER']);
		}else{
			$_SESSION['failed'] = ['msg' => 'Maaf, Konfigurasi sistem gagal!'];
        	header('location:'.$_SERVER['HTTP_REFERER']);
		}
	}
}