<?php
	session_start();
	$token = $_SESSION['token'];
    $url = 'http://sims.imersa.co.id/api/presensi?logout='.$token;
    $ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);
	unset($_SESSION['token']);
	session_unset();
	session_destroy();
	header('location:../login.php');
 ?>