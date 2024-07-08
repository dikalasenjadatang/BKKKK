<div class="row">
  <div class="col-xs-12">
    <!-- /.box -->
    <div class="box">
      <div class="box-header">
        <div class="box-header">
          <h1 class="box-title">Data Panggilan Orang Tua</h1>
          <!-- /.box-tools -->
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-sm btn-flat bg-green" id="tambah">
              Tambah
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
              <i class="fa fa-plus"></i>
            </button>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="tabel-panggilan" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Siswa</th>
              <th>Ortu</th>
              <th>Tanggal</th>
              <th>Panggilan Ke -</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;foreach ($panggilan as $row): ?>
              <tr>
                <td><?= $no ?></td>
                <td>
                  <a  class="detail-panggilan" style="color: #333 !important" data-toggle="modal" data-target="#detail-panggilan" id_panggilan="<?= $row->id_panggilan ?>">
                    <?= $row->nama_siswa ?>
                  </a>
                </td>
                <td><?= $row->nama_ortu ?></td>
                <td><?= nice_date($row->tanggal_hadir,'d M Y') ?></td>
                <th><?= $row->no_panggilan ?></th>
                <td>
                  <?php if ($row->status_panggilan == 1): ?>
                    <span id-panggilan="<?= $row->id_panggilan ?>" nama-siswa="<?= $row->nama_siswa ?>" class="status label label-info">Menunggu</span>
                  <?php elseif ($row->status_panggilan == 2): ?>
                    <span id-panggilan="<?= $row->id_panggilan ?>" nama-siswa="<?= $row->nama_siswa ?>" class="status label label-success">Datang</span>
                  <?php elseif ($row->status_panggilan == 3): ?>
                    <span id-panggilan="<?= $row->id_panggilan ?>" nama-siswa="<?= $row->nama_siswa ?>" class="status label label-danger">Tidak Datang</span>
                  <?php endif ?>
                </td>
              </tr>
            <?php $no++;endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div id="detail-panggilan" class="modal fade" >
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button class="close" type="button" data-dismiss="modal">
          &times;
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-md-12">
          <div class="alert alert-warning alert-dismissible hidden">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p>Panggilan ini tidak dihadiri.
                <button type="button" class="btn-link" style="color: #fff !important;" id-siswa="" id-ortu="" no-panggilan=""><b>Kirim Panggilan Lain</b></button>
              </p>
          </div>
          <!-- The time line -->
          <ul class="timeline">
            <!-- timeline time label -->
            <li class="time-label">
                  <span class="bg-aqua">
                    Detail Panggilan
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-green"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Nama Orang Tua</a></h3>
                <div class="timeline-body nama-ortu"></div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-blue"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Nama Siswa</a></h3>
                <div class="timeline-body nama-siswa"></div>
              </div>
            </li>
            <li>
              <i class="fa fa-comments bg-aqua"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Tanggal Panggil</a></h3>
                <div class="timeline-body tanggal-panggil"></div>
              </div>
            </li>
            <li>
              <i class="fa fa-comments bg-red"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Tanggal Hadir</a></h3>
                <div class="timeline-body tanggal-hadir"></div>
              </div>
            </li>
            <li>
              <i class="fa fa-comments bg-green"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Panggilan Ke -</a></h3>
                <div class="timeline-body no-panggilan"></div>
              </div>
            </li>
            <li>
              <i class="fa fa-comments bg-blue"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Status</a></h3>
                <div class="timeline-body status">
                  <span class="label"></span>
                </div>
              </div>
            </li>
            <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Mengapa Panggilan Dilakukan</a></h3>
                <div class="timeline-body keterangan"></div>
              </div>
            </li>
            <li>
              <i class="fa fa-clock-o bg-gray"></i>
            </li>
          </ul>
        </div>
        <!-- /.col -->
      </div>
      </div>
    </div>
  </div>
</div>

<div id="form-panggil" class="modal fade">
  <div class="modal-dialog">
    <form method="post" action="">
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
            <input type="text" class="form-control" name="id_siswa" id="id_siswa" readonly>
          </div>
          <div class="form-group">
            <label>ID Orang Tua</label>
            <input type="text" class="form-control" id="id_ortu" name="id_ortu" readonly>
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
            <input type="text" class="form-control" name="no_panggilan" id="no-panggilan" readonly>
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control" required placeholder="Mengapa Dilakukan Pemanggilan Orang Tua ?" required></textarea>
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

<div id="updatestatus" class="modal fade">
  <div class="modal-dialog">
    <form id="form-update" action="<?= base_url('admin/updatestatuspanggilan') ?>" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            &times;
          </button>
          <h4>Update Status Panggilan Orang Tua <span class="siswa"></span></h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Status Kehadiran</label>
            <input type="hidden" name="id_panggilan" id="id_panggilan" value="">
            <select name="status" class="form-control">
              <option value="2">Datang</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Update</button>
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
  $(document).on('click', '.detail-panggilan', function() {
    var id_panggilan = $(this).attr('id_panggilan');
    $.ajax({
        url:"<?= base_url('admin/detailpanggilan') ?>",
        method:"POST",
        data:{id_panggilan:id_panggilan},
        dataType:"json",
        success:function(data){
          $('.nama-siswa').text(data.nama_siswa);
          $('.nama-ortu').text(data.nama_ortu);
          $('.tanggal-panggil').text(data.tanggal_panggil);
          $('.tanggal-hadir').text(data.tanggal_hadir);
          $('.no-panggilan').text(data.no_panggilan);
          if (data.status == 1) {
            $('.status .label').addClass('label-info');
            $('.status .label').text('Menunggu');
          }else if (data.status == 3) {
            $('.status .label').addClass('label-danger');
            $('.status .label').text('Tidang Datang');
          }
          $('.keterangan').text(data.keterangan);
          if (data.no_panggilan <= 2 && data.status == 3) {
            $('.alert').removeClass('hidden');
            $('.btn-link').attr('id-siswa', data.id_siswa);
            $('.btn-link').attr('id-ortu', data.id_ortu);
            $('.btn-link').attr('no-panggilan', data.no_panggilan);
          }else if(data.no_panggilan == 3 && data.status == 3){
            $('.alert').removeClass('alert-warning hidden');
            $('.alert').addClass('alert-danger');
            $('.alert p').html('Tidak Mungkin Melakukan Panggilan Orang Tua Lagi. <b>Lakukan Kunjungan Rumah !</b>');
          }
        }
      })
  });
  $(document).on('click', '#kirim', function() {
      $('#form-panggil form').serialize();
      $('#form-konfirmasi').serialize();
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
  });
  $(document).on('click', 'td .status', function() {
      var id_panggilan = $(this).attr('id-panggilan');
      var nama_siswa = $(this).attr('nama-siswa');
      $('#updatestatus').modal('show');
      $('#updatestatus .siswa').text(nama_siswa);
      $('#id_panggilan').val(id_panggilan);
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
  $(document).on('click', '.alert .btn-link', function() {
    var id_siswa = $(this).attr('id-siswa');
    var id_ortu = $(this).attr('id-ortu');
    var no = $(this).attr('no-panggilan');
    $('#form-panggil').modal('show');
    $('#id_siswa').val(id_siswa);
    $('#id_ortu').val(id_ortu);
    $('#no-panggilan').val(parseInt(no)+1);
  });
</script>