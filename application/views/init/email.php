<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BKita - SMKN 1 SOLOK</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/dist/css/AdminLTE.min.css">
  <!-- Datatables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- jQuery 3 -->
  <script src="<?= base_url(); ?>asset/adminlte/bower_components/jquery/dist/jquery.min.js"></script>

</head>
<body>
<div class="wrapper">
  <div class="container">
    <div class="row">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Laporan Harian Pelanggaran Siswa</h3>
        </div>
        <div class="box-body">
          <p>Selamat Pagi, <?= $ortu->nama_ortu ?></p>
          <p>Hari ini <?= $ortu->nama_siswa ?> melakukan pelanggaran Tata Tertib disekolah. Rinciannya sebagai berikut</p><br>

          <table class="table table-bordered">
            <tr>
              <th>Deskripsi Pelanggaran</th>
              <th>Tindakan Sekolah</th>
              <th>Tanggal</th>
            </tr>
            <tr>
              <td><?= $data['deskripsi_pelanggaran'] ?></td>
              <td><?= $data['tindakan'] ?></td>
              <td><?= $data['tanggal'] ?></td>
            </tr>
          </table>
        </div>
        <div class="box-footer">
          <p>Hormat Kami, Tim <b>B-Kita</b> SMK Negeri 1 Solok</p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>