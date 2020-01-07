<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="index3.html" class="brand-link">
      <img src="vendor/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="vendor/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php
          if(isset($_GET['ip']) && !empty($_GET['ip'])){ 
              $ip = $_GET['ip'];?>
          <li class="nav-item">
            <a href="?page=beranda" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Beranda
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=siswa&ip=<?=$ip?>" class="nav-link">
              <i class="fa fa-user-circle nav-icon"></i>
              <p>
                Daftar Siswa
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=presensi&ip=<?=$ip?>" class="nav-link">
              <i class="fa fa-address-book nav-icon"></i>
              <p>
                Presensi Siswa
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=rekap&ip=<?=$ip?>" class="nav-link">
              <i class="fa fa-database nav-icon"></i>
              <p>
                Rekap Presensi Siswa
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=edit-mesin&ip=<?=$ip?>" class="nav-link">
              <i class="fa fa-cog nav-icon"></i>
              <p>
                Setting Device
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
        <?php
          }else{
          ?>
          <li class="nav-item">
            <a href="?page=beranda" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Beranda
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="?page=tambah-mesin" class="nav-link">
            <i class="fa fa-plus nav-icon"></i>
              <p>
                Tambah Device
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>
          <?php 
          }
          ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>