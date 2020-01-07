<?php
require 'connection.php';
session_start();

if(isset($_POST['simpan'])){
    $sn = $_POST['sn'];
    $nama = $_POST['nama'];
    $ip = $_POST['ip'];
    $comkey = $_POST['comkey'];

    $addDevice = $conn->prepare("INSERT INTO `mesin`(`sn`, `nama_mesin`, `ip`, `comkey`) VALUES (?,?,?,?)");
    $addDevice->bind_param('ssss', $sn, $nama, $ip, $comkey);
    if($addDevice->execute()){
        $addDevice->close();
        $_SESSION['toast'] = ['msg' => 'Selamat!, Mesin berhasil di tambahkan'];
        header('location:'.$_SERVER['HTTP_REFERER']);
    }else{
        $addDevice->close();
        $_SESSION['failed'] = ['msg' => 'Maaf, Mesin gagal di tambahkan!'];
        header('location:'.$_SERVER['HTTP_REFERER']);
    }
}