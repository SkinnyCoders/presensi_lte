<?php
$mesin = getData("SELECT * FROM mesin WHERE ip = '".$_GET['ip']."'");

?>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Setting Device</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="controller/updateDevice.php" method="post" role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="sn">Serial Number</label>
                    <input type="text" class="form-control" id="sn" value="<?= $mesin['sn'] ?>" name="serial_number" placeholder="Masukkan SN Mesin">
                    <input type="hidden" name="id" value="<?= $mesin['id'] ?>">
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama Mesin</label>
                    <input type="text" class="form-control" id="nama" value="<?= $mesin['nama_mesin'] ?>" name="nama_mesin" placeholder="Masukkan Nama Mesin">
                  </div>
                  <div class="form-group">
                    <label for="ip">Alamat IP Mesin</label>
                    <input type="text" class="form-control" id="ip" value="<?= $mesin['ip'] ?>" name="ip" placeholder="Masukkan Alamat IP Mesin">
                  </div>
                  <div class="form-group">
                    <label for="comkey">Comkey Mesin</label>
                    <input type="number" class="form-control" id="comkey" value="<?= $mesin['comkey'] ?>" name="comkey" placeholder="Masukkan Comkey Mesin">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
</div>

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="vendor/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vendor/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="vendor/dist/js/adminlte.min.js"></script>

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