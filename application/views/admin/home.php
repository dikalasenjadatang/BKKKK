<div class="content">
  <div class="row">

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?= $guru ?></h3>
          <p>Jumlah Guru</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
        <a href="<?= base_url('admin/dataguru') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    
    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?= $siswa ?></h3>
          <p>Jumlah Siswa</p>
        </div>
        <div class="icon">
          <i class="fa fa-user"></i>
        </div>
        <a href="<?= base_url('admin/datasiswa') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?= $kelas ?></h3>
          <p>Jumlah Kelas</p>
        </div>
        <div class="icon">
          <i class="fa fa-bank"></i>
        </div>
        <a href="<?= base_url('admin/datakelas') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?= $pelanggaran ?></h3>
          <p>Pelanggaran</p>
        </div>
        <div class="icon">
          <i class="fa fa-user-times"></i>
        </div>
        <a href="<?= base_url('admin/pelanggaran') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <!-- /.box -->
      <div class="box">
        <div class="box-header">
          <div class="box-header">
            <h1 class="box-title">10 Siswa Yang Paling Sering Melanggar</h1>
            <!-- /.box-tools -->
            <div class="box-tools pull-right">
              </button>
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
                <th>Jumlah</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;foreach ($rekor as $row): ?>
                <tr>
                  <td><?= $no ?></td>
                  <td><?= $row->nama_siswa ?></td>
                  <td><?= $row->nama_kelas ?></td>
                  <td><?= $row->jumlah ?></td>
                  <td>
                    <?php if ($row->jumlah <= 1): ?>
                      <a href="<?= base_url('admin/rekap_pelanggaran/').$row->id_user ?>" class="btn btn-xs btn-info">
                        <i class="fa fa-search-plus"></i>
                      </a>
                    <?php elseif ($row->jumlah == 2): ?>
                      <a href="<?= base_url('admin/rekap_pelanggaran/').$row->id_user ?>" class="btn btn-xs btn-warning">
                        <i class="fa fa-search-plus"></i>
                      </a>
                    <?php elseif ($row->jumlah >= 3): ?>
                      <a href="<?= base_url('admin/rekap_pelanggaran/').$row->id_user ?>" class="btn btn-xs btn-danger">
                        <i class="fa fa-search-plus"></i>
                      </a>
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
    </div>
          <!-- /.col -->
  </div>

</div>