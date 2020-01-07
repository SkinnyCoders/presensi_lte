 <?php 
 $sqlKonfigurasi = mysqli_query($conn, "SELECT * FROM `konfigurasi` WHERE 1");
 if (mysqli_num_rows($sqlKonfigurasi) > 0) {
  $data = mysqli_fetch_assoc($sqlKonfigurasi);
  ?>  
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">konfigurasi Sistem</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="controller/konfigurasi.php" method="POST" role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="sn">Alamat url Sims</label>
                    <input type="text" class="form-control" name="url" id="sn" placeholder="Masukkan Alamat url Sims Anda!" value="<?=$data['url']?>" require> 
                  </div>
                  <div class="form-group">
                    <label for="nama">Key</label>
                    <input type="text" class="form-control" name="key" value="<?=$data['api_key']?>" id="nama" placeholder="Masukkan Key" require>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="update" class="btn btn-primary">Simpan</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
<?php 
}else{ 
?>
<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">konfigurasi Sistem</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="controller/konfigurasi.php" method="POST" role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="sn">Alamat url Sims</label>
                    <input type="text" class="form-control" name="url" id="sn" placeholder="Masukkan Alamat url Sims Anda!" require> 
                  </div>
                  <div class="form-group">
                    <label for="nama">Key</label>
                    <input type="text" class="form-control" name="key" id="nama" placeholder="Masukkan Key" require>
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
<?php
}
?>
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