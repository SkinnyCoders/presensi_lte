<?php
require 'connection.php';
require '../lib/functions.php';
require '../lib/class.Presensi.php';
require 'session.php';

$ip = isset($_GET['ip'])?$_GET['ip']:"";
$token = $_SESSION['token'];

$presensi = new Presensi();
$comkey = getData("SELECT comkey FROM mesin WHERE ip = '$ip'")['comkey'];
$id_mesin = getData("SELECT id FROM mesin WHERE ip = '$ip'")['id'];
if (cekMesin($ip) == TRUE) {
    $server = cekDataSiswa($token, $ip);
    if ($server == FALSE) {
        $presensi->ip = $ip;
        $presensi->key = $comkey;
        $url = "http://sims.imersa.co.id/api/presensi?token=" . $token . "&siswa";
        $url = file_get_contents($url);
        $siswa = json_decode($url, true);

        foreach ($siswa as $s) {
            $id_siswa = $s['id_siswa'];
            $nama = $s['nama_lengkap'];
            $rombel = $s['rombel'];
            $sql = $conn->prepare("INSERT INTO siswa (`id_siswa`,`nama_siswa`,`rombel`,`id_mesin`) VALUES (?,?,?,?)");
            $sql->bind_param('ssss', $id_siswa, $nama, $rombel,$id_mesin);
            if($sql->execute()){
                $sql->close();
                $exe = $presensi->UploadNama($id_siswa, $nama);
            }else{
                $sql->close();
                echo mysqli_error($conn);
            }
            //echo $exe['msg'];
        }
        $_SESSION['toast'] = ['msg' => 'Selamat, Data berhasil disinkronkan!'];
        header('location:'.$_SERVER['HTTP_REFERER']);
    }
} else {
    $_SESSION['failed'] = ['msg' => 'Maaf, Anda kurang beruntung!'];
    header('location:'.$_SERVER['HTTP_REFERER']);
}
