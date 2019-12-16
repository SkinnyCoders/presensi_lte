<?php
session_start();
//koneksi database
include_once "connection.php";
include_once "../lib/function.php";

$token = $_SESSION['token'];

require '../lib/class.Presensi.php';
$presensi  = new Presensi();
$presensi->ip = $_GET['ip'];

$comkey = getData("SELECT * from mesin where ip = '$presensi->ip'")['comkey'];
$presensi->key = $comkey;

$data = $presensi->getDataPresensi();

function postData($url, $ampas){
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $ampas);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

if (isset($_POST['rekap'])) {
    if ($data) {
        $no = 0;
        foreach ($data as $da) {
            $no++;
            $id = $da['id'];
            $waktu = $da['waktu'];
            $status = $da['status'];
            $sql = "INSERT INTO rekap_presensi (id_siswa,waktu,status) VALUES ($id,'$waktu',$status)";
            mysqli_query($koneksi, $sql);
            if ($no == count($data) - 1) {
                echo $presensi->ClearData();
            }
        }
    }

    //matching data
    date_default_timezone_set('Asia/Jakarta');
    $date_now = date('Y-m-d');
    $sqlSiswa = mysqli_query($koneksi, "SELECT * FROM `siswa` WHERE NOT EXISTS (SELECT id_siswa FROM rekap_presensi WHERE rekap_presensi.id_siswa = siswa.id_siswa AND rekap_presensi.status = 0 AND DATE(rekap_presensi.waktu) = '$date_now' GROUP BY siswa.id_siswa)");
    if (mysqli_num_rows($sqlSiswa) > 0) {
        while ($dataSiswa = mysqli_fetch_assoc($sqlSiswa)) {
            $id_siswa = $dataSiswa['id_siswa'];
            $id_rombel = $dataSiswa['rombel'];
            $presensi = "bolos";
            $data = [   'id_siswa' => $id_siswa,
                        'id_rombel'=> $id_rombel,
                        'presensi' => $presensi ];
            
            $url = 'http://sims.imersa.co.id/api/presensi?token=' . $token . '&store';
            postData($url, $data);
        }

    }else{
        $_SESSION['failed'] = ['msg' => 'Maaf, Tidak ada data untuk direkap!'];
        header('location:'.$_SERVER['HTTP_REFERER']);
    }
    $_SESSION['toast'] = ['msg' => 'Selamat, Data Berhasil direkap!'];
    header('location:'.$_SERVER['HTTP_REFERER']);
}

//echo '</br>
//<a href="?page=presensi&ip='.$_GET['ip'].'" class="btn btn-primary" style="margin-top:30px;">Lihat Presensi</a>';

