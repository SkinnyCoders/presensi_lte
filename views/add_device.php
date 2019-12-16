

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
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="sn">Serial Number</label>
                    <input type="text" class="form-control" id="sn" placeholder="Masukkan SN Mesin">
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama Mesin</label>
                    <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Mesin">
                  </div>
                  <div class="form-group">
                    <label for="ip">Alamat IP Mesin</label>
                    <input type="text" class="form-control" id="ip" placeholder="Masukkan Alamat IP Mesin">
                  </div>
                  <div class="form-group">
                    <label for="comkey">Comkey Mesin</label>
                    <input type="number" class="form-control" id="comkey" placeholder="Masukkan Comkey Mesin">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Simpan</button>
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