<?php
session_start();
if(!$_SESSION['token']){
  session_destroy();
  header('location:login.php');
}else{

include_once 'views/templates/header.php';
include_once 'views/templates/navbar.php';
include_once 'views/templates/sidebar.php';
include_once 'controller/connection.php';
include_once 'lib/functions.php';
$devices = mysqli_query($conn, "SELECT * FROM mesin");
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php
    if(isset($_GET['ip']) && !empty($_GET['ip'])){

      $status = cekMesin($_GET['ip']);
    ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-md-12">
            <?php
            $cekData = cekDataSiswa($_SESSION['token'], $_GET['ip']);
            if($cekData == FALSE){
                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Data Server dan lokal belum sinkron</h5>
                Silahkan klik tombol sync untuk melakukan sinkronasi data server dengan lokal. <a href="controller/sinkronData.php?ip='.$_GET['ip'].'" class="ml-2 btn btn-xs btn-info">Sync</a>
            </div>';
            }
            ?>
            </div>
          <div class="col-sm-6">
              
            <h1 class="m-0 text-dark"><?=$_GET['ip']?></h1>
            <?php
            if ($status) {
              echo "<span class='btn btn-xs btn-success'>ONLINE</span>";
            } else {
                echo "<span class='btn btn-xs btn-danger'>OFFLINE</span>";
            }
            ?>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php
    }else{
    ?>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Beranda</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php } ?>

  <?php
  if(isset($_GET['page']) && !empty($_GET['page'])){
    $page = $_GET['page'];
    switch($page){
      case 'beranda':
        require __DIR__ . '/views/beranda.php';
      break;
      case 'tambah-mesin':
        require __DIR__ . '/views/add_device.php';
      break;
      case 'edit-mesin':
        require __DIR__ . '/views/edit_device.php';
      break;
      case 'presensi':
        require __DIR__ . '/views/presensi.php';
      break;
      case 'siswa':
        require __DIR__ . '/views/siswa.php';
      break;
      case 'rekap':
        require __DIR__ . '/views/rekap.php';
      break;
      case 'konfigurasi':
        require __DIR__ .'/views/setting_sistem.php';
        break;
      default:
        require __DIR__ . '/views/error.php';
      break;
    }
  }else{
    require __DIR__ . '/views/beranda.php';
  }
  ?>
  <!-- /.content-wrapper -->

<?php
  include_once 'views/templates/footer.php';

} // end else cek session
?>

<script type="text/javascript">    
    //fungsi untuk menampilkan jam saat ini    
        function tampilkanwaktu(){   
            var waktu = new Date();
            var sh = waktu.getHours() + "";    //memunculkan nilai jam, //tambahan script + "" supaya variable sh bertipe string sehingga bisa dihitung panjangnya : sh.length    //ambil nilai menit
            var sm = waktu.getMinutes() + "";  //memunculkan nilai detik    
            var ss = waktu.getSeconds() + "";  //memunculkan jam:menit:detik dengan menambahkan angka 0 jika angkanya cuma satu digit (0-9)
            document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
        }
    </script>