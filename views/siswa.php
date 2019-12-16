<?php
include_once 'controller/connection.php';
include_once 'lib/functions.php';
$devices = mysqli_query($conn, "SELECT * FROM mesin");
?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Table Presensi Siswa</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <table id="example1" class="table table-striped">
                    <thead>
                    <tr>
                    <th class="text-nowrap" style="width: 5%">No</th>
                    <th class="text-nowrap">ID Siswa</th>
                    <th class="text-nowrap">Waktu</th>
                    <th class="text-nowrap">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(mysqli_num_rows($devices)){
                        while($dataDevice = mysqli_fetch_assoc($devices)):
                    ?>
                    <tr>
                    <td><?=$dataDevice['sn']?></td>
                    <td><?=ucwords($dataDevice['nama_mesin'])?></td>
                    <td><?=$dataDevice['ip']?></td>
                    <td><?php $cek = cekMesin($dataDevice['ip']);  
                    if($cek){
                        echo "<span class='btn btn-success'>ONLINE</span>";
                    }else{
                        echo "<span class='btn btn-danger'>OFFLINE</span>";
                    }
                    ?>
                    </td>
                    </tr>
                    <?php
                        endwhile;
                    }
                    ?>
                    </tbody>
                </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>

  <!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="vendor/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vendor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="vendor/dist/js/adminlte.min.js"></script>

<!-- DataTables -->
<script src="vendor/plugins/datatables/jquery.dataTables.js"></script>
<script src="vendor/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<!-- SweetAlert2 -->
<script src="vendor/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="vendor/plugins/toastr/toastr.min.js"></script>

<script>
$(function() {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 4000
    });
    <?php 
    if(isset($_SESSION['toast'])){
    ?>
      Toast.fire({
        type: 'success',
        title: '<?=$_SESSION['toast']['msg']?>'
      });
    <?php 
    unset($_SESSION['toast']);
    }elseif(isset($_SESSION['failed'])){ ?>
        Toast.fire({
            type: 'error',
            title: '<?=$_SESSION['failed']['msg']?>'
          });
    <?php
    unset($_SESSION['failed']);
    }
?>
});
</script>

<script>
  $(function () {
    // $("#example1").DataTable();
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true,
    });
  });
</script>