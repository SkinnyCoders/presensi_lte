<?php
$conn = mysqli_connect('localhost','root','','db_finger');

//ceking connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
?>