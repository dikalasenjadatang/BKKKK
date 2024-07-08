<div class="content">
  <div class="row">

    <div class="col-lg-6 col-xs-6">
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?= $pelanggaran ?></h3>
          <p>Jumlah Pelanggaran</p>
        </div>
        <div class="icon">
          <i class="fa fa-users"></i>
        </div>
        <a href="<?= base_url('siswa/rekap_pelanggaran') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    
    <div class="col-lg-6 col-xs-6">
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?= $panggilan ?></h3>
          <p>Jumlah Panggilan Ortu</p>
        </div>
        <div class="icon">
          <i class="fa fa-user"></i>
        </div>
        <a href="<?= base_url('siswa/panggilanortu') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="row">
    <?php if ($cekpass == TRUE): ?>
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title text-warning">Penting !</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Peringatan!</h4>
            Tampaknya Kamu menggunakan password default. <b>Ada Baiknya Kamu Menggantinya Sekarang !!</b>
            <a data-toggle="modal" data-target="#gantipassword">Ganti Sekarang</a>
          </div>
        </div>
      </div>
    </div>
    <?php endif ?>

    <?php if ($cekpanggilan >= 1): ?>
    <div class="col-md-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title text-danger">Panggilan Orang Tua Baru</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="box-body">
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i>Panggilan Orang Tua !</h4>
            Kamu memiliki satu panggilan Orang Tua Baru. <a href="<?= base_url('siswa/datapanggilan') ?>">Selengkapnya..</a>
          </div>
        </div>
      </div>
    </div>
    <?php endif ?>
  </div> 
</div>

<div id="gantipassword" class="modal fade">
  <div class="modal-dialog">
    <form action="<?= base_url('siswa/gantipassword') ?>" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            &times;
          </button>
          <h4>Form Ganti Password</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Password Baru</label>
            <input type="password" name="password" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="update">Kirim</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>