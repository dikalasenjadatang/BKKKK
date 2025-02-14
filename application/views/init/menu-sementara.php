  <header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url('ortu') ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">
        <i class="fa fa-object-group"></i> 
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        B-Kita
      </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?= base_url('asset/adminlte/dist/img/people.png') ?>" class="user-image" alt="User Image">
              <span class="hidden-xs">Akun Nonaktif</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?= base_url('asset/adminlte/dist/img/people.png') ?>" class="img-circle" alt="User Image">

                <p>
                  Akun Nonaktif
                  <small>User ID : <b><?= $this->session->userdata('id_user') ?></b></small>
                  <small>Hubungi Administrator Agar Akun Diaktifkan</small>
                </p>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
           <img src="<?= base_url('asset/adminlte/dist/img/people.png') ?>" class="img-circle" width="60px" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><b>SMK CINTA KITA</b></p>
          <p class="text-yellow small">Peserta Didik</p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="active">
          <a href="">
            <i class="fa fa-home"></i> <span>Home</span>
            </span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>