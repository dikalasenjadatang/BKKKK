<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>B-Kita SMK Negeri 1 Solok | Pendaftaran</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url('asset/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('asset/adminlte/bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url('asset/adminlte/bower_components/Ionicons/css/ionicons.min.css') ?>">

  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/bower_components/select2/dist/css/select2.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('asset/adminlte/dist/css/AdminLTE.min.css') ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('asset/adminlte/plugins/iCheck/square/blue.css') ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?= base_url() ?>"><b>BK</b><small>ita</small></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Pendaftaran Akun Baru B-Kita</p>
    <div class="alert alert-danger">
      <b>Saat Mendaftar Harap Catat ID User Yang Tertera Untuk Digunakan Saat Login</b>
    </div>
    <form id="form_login" action="<?= base_url('user/daftar') ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" id="id_user" name="id_user" class="form-control" placeholder="ID User" readonly required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" id="email" name="email" class="form-control" placeholder="email" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <select name="level" id="level" class="form-control select2" data-placeholder="Pilih Level" style="width: 100%">
          <option value=""></option>
          <option value="2">Guru</option>
          <option value="4">Siswa</option>
        </select>
      </div>
      <div class="form-group has-feedback hidden siswa">
        <select name="jurusan" id="jurusan" class="form-control select2" data-placeholder="Pilih Jurusan" style="width: 100%">
          <option value=""></option>
          <?php foreach ($jurusan as $row): ?>
            <option value="<?= $row->id_jurusan ?>"><?= $row->nama_jurusan ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="form-group has-feedback hidden siswa">
        <select name="kelas" id="kelas" class="form-control select2" data-placeholder="Pilih Kelas" style="width: 100%">
          <option value=""></option>
        </select>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-offset-8 col-xs-4">
          <input type="submit" name="daftar" class="btn btn-primary btn-block btn-flat" value="Daftar">
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?= base_url('asset/adminlte/bower_components/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url('asset/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
<!-- Select2 -->
<script src="<?= base_url(); ?>asset/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<script>
  $('.select2').select2();
  $(document).on('change', '#level', function() {
      var level = $(this).val();
      $.ajax({
        url:"<?= base_url('user/minta_id') ?>",
        method:"POST",
        data:{level:level},
        dataType:"json",
        success:function(data){
          $('#id_user').val(data.id_user);
        }
      })
      if (level == 4) {
        $('.siswa').removeClass('hidden');
      }else {
        $('.siswa').addClass('hidden');
      }
   });

  $(document).on('change', '#jurusan', function() {
      var id_jurusan = $(this).val();
      $.ajax({
        url:"<?= base_url('user/datakelas') ?>",
        method:"POST",
        data:{id_jurusan:id_jurusan},
        dataType:"json",
        success:function(data){
          var html = '';
          var i;
          for (i=0; i<data.length; i++) {
            html = '<option value="'+data[i].id_kelas+'">'+data[i].nama_kelas+'</option>';
          }
          $('#kelas').html(html);
        }
      })
   });
</script>
</body>
</html>
