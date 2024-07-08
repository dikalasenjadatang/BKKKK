<div class="content">
  <div class="row">
    <div class="col-md-12">
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
        </ul><br>
      <?php $no++;endforeach ?>
    </div>
  </div>
</div>