<?php
require 'connection.php';
session_start();

if(isset($_POST['simpan'])){
    $sn = $_POST['sn'];
    $nama = $_POST['nama'];
    $ip = $_POST['ip'];
    $comkey = $_POST['comkey'];

    if (empty($sn)) {
        $_SESSION['failed'] = ['msg' => 'Maaf, Serial Number tidak bolah kosong!'];
        header('location:'.$_SERVER['HTTP_REFERER']);
        return false;
    }

    if (empty($nama)) {
        $_SESSION['failed'] = ['msg' => 'Maaf, Nama Alat tidak bolah kosong!'];
        header('location:'.$_SERVER['HTTP_REFERER']);
        return false;
    }

    if (empty($ip)) {
        $_SESSION['failed'] = ['msg' => 'Maaf, Alamat IP tidak bolah kosong!'];
        header('location:'.$_SERVER['HTTP_REFERER']);
        return false;
    }

    if ($comkey) {
        $_SESSION['failed'] = ['msg' => 'Maaf, Comkey tidak bolah kosong!'];
        header('location:'.$_SERVER['HTTP_REFERER']);
        return false;
    }

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