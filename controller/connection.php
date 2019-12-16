<?php
$conn = mysqli_connect('localhost','root','','crud');

//ceking connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
?>