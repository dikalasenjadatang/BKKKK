<div class="row">
  <div class="col-xs-12">
    <!-- /.box -->
    <div class="box">
      <div class="box-header">
        <div class="box-header">
          <h1 class="box-title">Data Pelanggaran <small>SMK CINTA KITA</small></h1>
          <!-- /.box-tools -->
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-sm btn-flat bg-green" id="tambah-pelanggaran">
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
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama</th>
              <th>Kelas</th>
              <th>Pelanggaran</th>
              <th><i class="fa fa-clock-o"></i></th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;foreach ($pelanggaran as $row): ?>
              <tr>
                <td><?= $no ?></td>
                <td>
                  <a  class="detail-pelanggaran" style="color: #333 !important" data-toggle="modal" data-target="#detail-pelanggaran" id_pelanggaran="<?= $row->id_pelanggaran ?>">
                    <?= $row->nama_siswa ?>
                  </a>
                </td>
                <td><?= $row->nama_kelas ?></td>
                <td><?= $row->deskripsi_pelanggaran ?></td>
                <td><?= nice_date($row->tanggal,'d M Y') ?></td>
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

<div id="form-data" class="modal fade">
  <div class="modal-dialog">
    <form method="post" action="<?= base_url('admin/aksipelanggaran/tambah') ?>" id="form-pelanggaran">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            &times;
          </button>
          <h4 class="modal-title form-data-title">Tambah Data Pelanggaran</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Siswa</label>
            <select name="siswa" id="siswa" class="form-control select2" style="width: 100%" data-placeholder="Nama Siswa">
              <?php foreach ($siswa as $row): ?>
                <option value=""></option>
                <option value="<?= $row->id_user ?>"><?= $row->nama_siswa.' | '.$row->nama_kelas ?></option>
               <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Jenis Pelanggaran Pelanggaran</label>
            <select name="kategori" id="kategori" class="form-control select2" style="width: 100%" data-placeholder="Pilih Kategori">
              <?php foreach ($kategori as $row): ?>
                <option value=""></option>
                <option value="<?= $row->id_kategori ?>"><?= $row->nama_kategori ?></option>
               <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Pelanggaran</label>
            <select name="pelanggaran" id="pelanggaran1" class="form-control select2" style="width: 100%" data-placeholder="Pilih Pelanggaran">
              <option value=""></option>
            </select>
          </div>
          <div class="form-group">
            <label>Tanggal</label>
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              <input type="text" name="tanggal" class="form-control pull-right" id="tanggal">
            </div>
          </div>
          <div class="form-group">
            <label>Deskripsi</label>
            <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
          </div>
          <div class="form-group">
            <label>Tindakan</label>
            <input type="text" name="tindakan" class="form-control" id="tindakan">
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" id="aksi" class="btn btn-success" name="aksi" value="Tambah">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div id="detail-pelanggaran" class="modal fade">
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
                  <span class="bg-purple">
                    Detail Pelanggaran
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Nama Siswa</a></h3>
                <div class="timeline-body nama"></div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-aqua"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Pelanggaran</a></h3>
                <div class="timeline-body pelanggaran1"></div>
              </div>
            </li>
            <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Level Tata Tertib</a></h3>
                <div class="timeline-body level"><span class="label"></span></div>
              </div>
            </li>
            <li>
              <i class="fa fa-comments bg-aqua"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Sanksi Tata Tertib</a></h3>
                <div class="timeline-body sanksi">
                  <p>
                    <b>Dalam Peraturan : </b><span class="sekolah"></span>
                  </p>
                  <p>
                    <b>Sanksi Yang Diberikan : </b><span class="tindakan"></span>
                  </p>
                </div>
              </div>
            </li>
            <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Deskripsi Tata Tertib</a></h3>
                <div class="timeline-body deskripsi"></div>
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
  $(document).on('click', '#tambah-pelanggaran', function() {
      $('#form-data').modal("show");
   });

  $(document).on('click', '.detail-pelanggaran', function() {
    var id_pelanggaran = $(this).attr('id_pelanggaran');
    $.ajax({
        url:"<?= base_url('admin/detailpelanggaran') ?>",
        method:"POST",
        data:{id_pelanggaran:id_pelanggaran},
        dataType:"json",
        success:function(data){
          var level;
          if (data.level == '3') {
            $('.level .label').addClass('label-info');
            level = 'Pelanggaran Biasa';
          }else if(data.level == '2'){
            $('.level .label').addClass('label-warning');
            level = 'Pelanggaran Menengah';
          }else if(data.level == '1'){
            $('.level .label').addClass('label-danger');
            level = 'Pelanggaran Berat';
          }
          $('.nama').text(data.nama_siswa);
          $('.pelanggaran1').text(data.pelanggaran);
          $('.level .label').text(level);
          $('.sanksi .sekolah').text(data.sekolah);
          $('.sanksi .tindakan').text(data.tindakan);
          $('.deskripsi').text(data.deskripsi);
        }
      })
  });
  $(document).on('change', '#kategori', function() {
      var id_kategori = $(this).val();
      $.ajax({
        url:"<?= base_url('admin/datapelanggaran') ?>",
        method:"POST",
        data:{id_kategori:id_kategori},
        dataType:"json",
        success:function(data){
          var html = '';
          var i;
          for (i=0; i<data.length; i++) {
            html += '<option value="'+data[i].id_tata_tertib+'">'+data[i].nama_tata_tertib+'</option>';
          }
          $('#pelanggaran1').html(html);
        }
      })
   });

  $('#form-data').on('hidden.bs.modal', function () {
    location.reload();
  })
</script>