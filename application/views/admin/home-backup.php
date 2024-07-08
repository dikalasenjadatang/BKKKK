    <!-- Header -->
    <section class="content-header">
      <h1>
        Statistik
        <small>Aplikasi BKita</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Statistik</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Guru</span>
              <span class="info-box-number"><?= $guru ?></span>
              <!-- The progress section is optional -->
              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
              <span class="progress-description">
                Data Tahun <?= date('Y') ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-university"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Kelas</span>
              <span class="info-box-number"><?= $kelas ?></span>
              <!-- The progress section is optional -->
              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
              <span class="progress-description">
                Data Tahun <?= date('Y') ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-graduation-cap"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Siswa</span>
              <span class="info-box-number"><?= $siswa ?></span>
              <!-- The progress section is optional -->
              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
              <span class="progress-description">
                Data Tahun <?= date('Y') ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-user-times"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Pelanggaran</span>
              <span class="info-box-number"><?= $pelanggaran ?></span>
              <!-- The progress section is optional -->
              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
              <span class="progress-description">
                Data Tanggal <?= date('d M Y') ?>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="box">
      <div class="box-header">
        <div class="box-header">
          <h1 class="box-title">10 Siswa Yang Paling Sering Melanggar <small>SMKN 1 SOLOK</small></h1>
          <!-- /.box-tools -->
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-plus"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered table-responsive table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th>Jumlah Pelanggaran</th>
              <th>Saran</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($rekor as $row): ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $row->nama_siswa ?></td>
                <td><?= $row->nama_kelas ?></td>
                <td><?= $row->jumlah ?></td>
                <td>
                  <?php if ($row->jumlah == 1): ?>
                    Beri Peringatan
                  <?php elseif ($row->jumlah == 2): ?>
                    Panggil PA
                  <?php elseif ($row->jumlah >= 3): ?>
                    Panggil Orang Tua
                  <?php endif ?>
                </td>
              </tr>
            <?php $no++;endforeach ?>
          </tbody>
        </table>
      </div>
            <!-- /.box-body -->
    </div>
    <!-- /.box -->
    </section>
    <!-- /.content -->