    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Device</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="controller/addDevice.php" method="POST" role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="sn">Serial Number</label>
                    <input type="text" class="form-control" name="sn" id="sn" placeholder="Masukkan SN Mesin" require> 
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama Mesin</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan Nama Mesin" require>
                  </div>
                  <div class="form-group">
                    <label for="ip">Alamat IP Mesin</label>
                    <input type="text" class="form-control" name="ip" id="ip" placeholder="Masukkan Alamat IP Mesin" require>
                  </div>
                  <div class="form-group">
                    <label for="comkey">Comkey Mesin</label>
                    <input type="number" class="form-control" name="comkey" id="comkey" placeholder="Masukkan Comkey Mesin" require>
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