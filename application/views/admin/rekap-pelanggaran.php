<div class="content">
  <div class="row">
    <div class="col-md-12">
      <?php if ($beratX >= 1): ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-info"></i> Peringatan !</h4>
          <?= $siswa->nama_siswa.' Sudah <b>'. $beratX. 'x</b> Melakukan Pelanggaran Berat Yang Belum Diproses' ?>,
          <b>Pertimbangkan Agar Dilakukan Pemanggilan Orang Tua Segera</b><br><br>
          <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#form-panggil">Panggil Orang Tua</button>
        </div>
      <?php elseif ($menengahX >= 3): ?>
        <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-info"></i> Peringatan !</h4>
          <?= $siswa->nama_siswa.' Sudah <b>'. $menengahX. 'x</b> Melakukan Pelanggaran Sedang' ?>,
          <b>Pertimbangkan Agar Dilakukan Pemanggilan Orang Tua Segera</b><br><br>
          <button class="btn btn-primary " data-toggle="modal" data-target="#form-panggil">Panggil Orang Tua</button>
        </div>
      <?php endif ?>
      <div class="box box-widget widget-user">
        <div class="widget-user-header bg-aqua-active">
          <h3 class="widget-user-username"><?= $siswa->nama_siswa ?></h3>
          <h5 class="widget-user-desc"><?= $siswa->nama_kelas ?></h5>
        </div>
        <div class="widget-user-image">
          <img class="img-circle" src="<?= base_url('asset/adminlte/dist/img/people.png') ?>" alt="User Avatar">
        </div>
        <div class="box-footer">
          <div class="row">
            </div>
            <div class="col-sm-4 border-right">
              <div class="description-block">
                <h5 class="description-header"><?= $biasa ?></h5>
                <span class="description-text">Pelanggaran Biasa</span>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="description-block">
                <h5 class="description-header"><?= $menengah ?></h5>
                <span class="description-text">Pelanggaran Menengah</span>
              </div>
            </div>
            <div class="col-sm-4 border-left">
              <div class="description-block">
                <h5 class="description-header"><?= $berat ?></h5>
                <span class="description-text">Pelanggaran Berat</span>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <?php $no = 1; foreach ($rekap as $row): ?>
        <ul class="timeline">
          <li class="time-label">
            <span class="bg-purple">
              <?= nice_date($row->tanggal,'D,d M Y') ?>
            </span>
          </li>
          <li>
            <b class="fa bg-blue text-primary"><?= $no ?></b>

            <div class="timeline-item">
              <h3 class="timeline-header"><a style="text-transform: capitalize;" href="#"><?= $row->deskripsi_pelanggaran ?> </a> 
                <?php if ($row->level == 3): ?>
                  <span class="label label-info">Biasa</span>
                <?php elseif ($row->level == 2): ?>
                  <span class="label label-warning">Menengah</span>
                <?php elseif ($row->level == 1): ?>
                  <span class="label label-danger">Berat</span>
                <?php endif ?>
              </h3>

              <div class="timeline-body">
                <?= $row->deskripsi_pelanggaran ?>
              </div>
            </div>
          </li>      
          <li>
            <i class="fa fa-comments bg-aqua"></i>
              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Deskripsi Tata Tertib</a></h3>
                <div class="timeline-body">
                   <?= $row->deskripsi ?>
                </div>
              </div>
          </li>
          <li>
            <i class="fa fa-comments bg-yellow"></i>
            <div class="timeline-item">
             <h3 class="timeline-header"><a href="#">Sanksi Tata Tertib</a></h3>
              <div class="timeline-body sanksi">
                <p>
                  <b>Dalam Peraturan : </b> <?= $row->hukuman ?>
                </p>
                <p>
                  <b>Sanksi Yang Diberikan : </b><?= $row->tindakan ?>
                </p>
              </div>
            </div>
          </li>
          <li>
            <i class="fa fa-comments bg-aqua"></i>
            <div class="timeline-item">
             <h3 class="timeline-header"><a href="#">Status</a></h3>
              <div class="timeline-body sanksi">
                <?php if ($row->status == 1): ?>
                  <span class="label label-success">Selesai</span>
                <?php else: ?>
                  <span class="label label-danger">Belum Selesai</span>
                <?php endif ?>
              </div>
            </div>
          </li>
          <li>
            <i class="fa fa-clock-o bg-gray"></i>
          </li>
        </ul>
      <?php $no++;endforeach ?>
    </div>
  </div>
</div>

<div id="form-panggil" class="modal fade">
  <div class="modal-dialog">
    <form method="post" action="" id="">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            &times;
          </button>
          <h4 class="modal-title form-data-title">Panggilan Orang Tua</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>ID Siswa</label>
            <input type="text" class="form-control" readonly value="<?= $siswa->id_user ?>" name="id_siswa">
          </div>
          <div class="form-group">
            <label>ID Orang Tua</label>
            <input type="text" class="form-control" readonly id="id_ortu" value="<?= $siswa->id_ortu ?>" name="id_ortu">
          </div>
          <div class="form-group">
            <label>Tanggal Hadir</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" name="tanggal" class="form-control pull-right" required id="tanggal">
            </div>
          </div>
          <div class="form-group">
            <label>Panggilan Yang Ke-</label>
            <input type="number" class="form-control" max="3" min="1" required name="no_panggilan">
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" required placeholder="Mengapa Dilakukan Pemanggilan Orang Tua ?"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" data-toggle="modal" data-target="#konfirmasi" class="btn btn-success btn-sm">Kirim</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div id="konfirmasi" class="modal fade">
  <div class="modal-dialog">
    <form id="form-konfirmasi">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            &times;
          </button>
          <h4>Masukkan Password Untuk Melanjutkan</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Password</label>
            <input type="hidden" name="id_user" value="<?= $this->session->userdata('id_user'); ?>">
            <input type="password" name="konfirmasi" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="kirim">Konfirmasi</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>
  $(document).on('click', '#kirim', function() {
      $.ajax({
      url: "<?= base_url('admin/konfirmasi') ?>",
      type: "POST",
      data: $('#form-konfirmasi').serialize(),
      dataType: "JSON",
      success: function(data){
        if (data.status == true) {
          panggilOrtu();
        }else if (data.status == false) {
          alert('password salah');
        }
      }
     });

    function panggilOrtu(){
    $.ajax({
      url: "<?= base_url('admin/kirimpanggilanortu') ?>",
      type: "POST",
      data: $('#form-panggil form').serialize(),
      dataType: "JSON",
      success: function(data){
        if (data.status == true) {
          window.location.reload();
        }else if (data.status == false) {
          alert('Panggilan Gagal Di Input');
        }
      }
     });
  }
});
</script>