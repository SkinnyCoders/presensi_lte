<?php
require 'connection.php';
session_start();
if(isset($_POST['simpan'])){
    $id = $_POST['id'];
    $sn = $_POST['serial_number'];
    $name = $_POST['nama_mesin'];
    $ip = $_POST['ip'];
    $comkey = $_POST['comkey'];

    $update = $conn->prepare("UPDATE mesin SET sn = ?, nama_mesin = ?, ip = ?, comkey = ? WHERE id = ?");
    $update->bind_param('sssss', $sn, $name, $ip, $comkey, $id);
    if($update->execute()){
        $update->close();
        $_SESSION['toast'] = ['msg' => 'Selamat!, Mesin berhasil di ubah'];
        header('location:'.$_SERVER['HTTP_REFERER']);
    }else{
        $update->close();
        $_SESSION['failed'] = ['msg' => 'Maaf, Mesin gagal diubah!'];
        header('location:'.$_SERVER['HTTP_REFERER']);
    }
}

?>