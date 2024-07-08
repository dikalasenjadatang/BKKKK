<div class="row">
  <div class="col-xs-12">
    <!-- /.box -->
    <div class="box">
      <div class="box-header">
        <div class="box-header">
          <h1 class="box-title">Data Panggilan Orang Tua</h1>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example1" class="table table-bordered table-responsive table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Tanggal Panggil</th>
              <th>Panggilan Ke-</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($panggilan as $row): ?>
              <tr>
                <td><?= $no ?></td>
                <td>
                  <a  class="detail-panggilan" style="color: #333 !important" data-toggle="modal" data-target="#detail-panggilan" id_panggilan="<?= $row->id_panggilan ?>">
                    <?= nice_date($row->tanggal_panggil, 'D, d M Y') ?>
                  </a>
                </td>
                <td><?= $row->no_panggilan ?></td>
                <td>
                  <?php if ($row->status == '1'): ?>
                    <span class="status label label-info">Menunggu</span>
                  <?php elseif ($row->status == '2'): ?>
                    <span class="status label label-success">Datang</span>
                  <?php elseif ($row->status == '3'): ?>
                    <span class="status label label-danger">Tidak Datang</span>
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
                <div class="timeline-body no-panggilan">
                  <span class="label"></span>
                </div>
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

<script>
  $(document).on('click', '.detail-panggilan', function() {
    var id_panggilan = $(this).attr('id_panggilan');
    $.ajax({
        url:"<?= base_url('siswa/detailpanggilan') ?>",
        method:"POST",
        data:{id_panggilan:id_panggilan},
        dataType:"json",
        success:function(data){
          $('.nama-siswa').text(data.nama_siswa);
          $('.tanggal-panggil').text(data.tanggal_panggil);
          $('.tanggal-hadir').text(data.tanggal_hadir);
          if (data.status == 1) {
            $('.status .label').addClass('label-info');
            $('.status .label').text('Menunggu');
          }else if (data.status == 2) {
            $('.status .label').addClass('label-success');
            $('.status .label').text('Datang');
          }else if (data.status == 3) {
            $('.status .label').addClass('label-danger');
            $('.status .label').text('Tidang Datang');
          }

          if (data.no_panggilan == 1) {
            $('.no-panggilan .label').addClass('label-info');
            $('.no-panggilan .label').text('Panggilan Pertama');
          }else if (data.no_panggilan == 2) {
            $('.no-panggilan .label').addClass('label-warning');
            $('.no-panggilan .label').text('Panggilan Kedua');
          }else if (data.no_panggilan == 3) {
            $('.no-panggilan .label').addClass('label-danger');
            $('.no-panggilan .label').text('Panggilan Ketiga');
          }
          $('.keterangan').text(data.keterangan);
        }
      })
  });
</script>