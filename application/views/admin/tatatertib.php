<div class="row">
  <div class="col-xs-12">
    <!-- /.box -->
    <div class="box">
      <div class="box-header">
        <div class="box-header">
          <h1 class="box-title">Kategori Pelanggaran <small>SMK CINTA KITA</small></h1>
          <!-- /.box-tools -->
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-sm btn-flat bg-green" id="tambah-kategori">
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
        <table id="example1" class="table table-bordered table-responsive table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th width="">Kategori</th>
              <th>Jenis</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no= 1; foreach ($kategori as $row): ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $row->nama_kategori ?></td>
                <td>
                  <?php if ($row->id_kelompok == 1): ?>
                    Peraturan Akademik
                  <?php elseif ( $row->id_kelompok == 2): ?>
                    Peraturan Non Akademik
                  <?php endif ?>
                </td>
                <td>
                  <div class="btn-group hidden-xs">
                    <button class="btn btn-xs btn-info edit-kategori" id="<?= $row->id_kategori ?>">
                      <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" data-toggle="modal" data-target="#hapus" id="<?= $row->id_kategori ?>" class="btn btn-xs btn-danger alert_notif hapus-kategori">
                      <i class="fa fa-remove"></i>
                    </button>
                  </div>
                  <div class="btn-group hidden-lg hidden-md hidden-sm">
                    <button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="glyphicon glyphicon-collapse-down"></span>
                    </button>
                    <ul class="dropdown-menu pull-right">
                      <li class="bg-info">
                        <button class="edit-kategori btn btn-link" id="<?= $row->id_kategori ?>" data-toggle="tooltip" data-placement="right" title="Edit Data">
                          <i class="fa fa-edit"></i>
                          Edit
                        </button>
                      </li>
                      <li class="bg-danger">
                        <a href="#hapus" class="hapus-kategori" data-toggle="modal" data-target="#hapus" id="<?= $row->id_kategori ?>">
                          <i class="fa fa-remove alert_notif"></i>
                          Hapus
                          </a>
                      </li>
                    </ul>
                  </div>
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

<div class="row">
  <div class="col-xs-12">
    <!-- /.box -->
    <div class="box">
      <div class="box-header">
        <div class="box-header">
          <h1 class="box-title">Tata Tertib <small>SMK CINTA KITA</small></h1>
          <!-- /.box-tools -->
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-sm btn-flat bg-green" id="tambah-tatatertib">
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
        <table id="example2" class="table table-bordered table-responsive table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th width="">Tata Tertib</th>
              <th>Kategori</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no= 1; foreach ($tatatertib as $row): ?>
              <tr>
                <td><?= $no ?></td>
                <td>
                  <a class="detail-tata-tertib" style="color: #333 !important" data-toggle="modal" data-target="#detail-tata-tertib" 
                  id_tata_tertib="<?= $row->id_tata_tertib ?>">
                    <?= $row->nama_tata_tertib ?>
                  </a>
                </td>
                <td><?= $row->nama_kategori ?></td>
                <td>
                  <div class="btn-group hidden-xs">
                    <button class="btn btn-xs btn-info edit-tata-tertib" id="<?= $row->id_tata_tertib ?>">
                      <i class="fa fa-edit"></i>
                    </button>
                    <button data-toggle="modal" data-target="#hapus" id="<?= $row->id_tata_tertib ?>" class="btn btn-xs btn-danger alert_notif hapus-tata-tertib">
                      <i class="fa fa-remove"></i>
                    </button>
                  </div>
                  <div class="btn-group hidden-lg hidden-md hidden-sm">
                    <button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="glyphicon glyphicon-collapse-down"></span>
                    </button>
                    <ul class="dropdown-menu pull-right">
                      <li class="bg-info">
                        <button class="edit-tata-tertib btn btn-link" id="<?= $row->id_tata_tertib ?>" data-toggle="tooltip" data-placement="right" title="Edit Data">
                          <i class="fa fa-edit"></i>
                          Edit
                        </button>
                      </li>
                      <li class="bg-danger">
                        <a href="#hapus" class="hapus-tata-tertib" data-toggle="modal" data-target="#hapus" id="<?= $row->id_tata_tertib ?>">
                          <i class="fa fa-remove alert_notif"></i>
                          Hapus
                        </a>
                      </li>
                    </ul>
                  </div>
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

<div id="kategori" class="modal fade">
  <div class="modal-dialog">
    <form method="post" action="<?= base_url('admin/aksikategori/tambah') ?>" id="form-kategori">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            &times;
          </button>
          <h4 class="modal-title form-data-title">Tambah Data Kategori Tata Tertib</h4>
        </div>
        <div class="modal-body">
         <div class="form-group">
           <label>Nama Kategori</label>
           <input type="text" id="nama_kategori" class="form-control" name="nama_kategori" placeholder="Nama Kategori..." required>
         </div>
         <div class="form-group">
           <label>Jenis Peraturan</label>
           <select class="form-control select2" required data-placeholder="Pilih Jenis Peraturan" name="kelompok" id="kelompok" style="width: 100%;">
            <option value=""></option>
             <option value="1">Peraturan Akademik</option>
             <option value="2">Peraturan Non Akademik</option>
           </select>
         </div>
         <div class="form-group">
           <label>Keterangan</label>
           <textarea name="deskripsi" class="form-control" id="deskripsi" required></textarea>
         </div>
        </div>
        <div class="modal-footer">
          <input type="submit" id="aksi" class="btn btn-success btn-sm" name="aksi" value="Tambah">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div id="detail-tata-tertib" class="modal fade">
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
                  <span class="bg-red">
                    Detail Tata Tertib
                  </span>
            </li>
            <!-- /.timeline-label -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-envelope bg-blue"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Nama Tata Tertib</a></h3>
                <div class="timeline-body nama"></div>
              </div>
            </li>
            <!-- END timeline item -->
            <!-- timeline item -->
            <li>
              <i class="fa fa-user bg-aqua"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Kategori Tata Tertib</a></h3>
                <div class="timeline-body kategori"></div>
              </div>
            </li>
            <li>
              <i class="fa fa-comments bg-yellow"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Level Tata Tertib</a></h3>
                <div class="timeline-body level"></div>
              </div>
            </li>
            <li>
              <i class="fa fa-comments bg-aqua"></i>

              <div class="timeline-item">
                <h3 class="timeline-header"><a href="#">Sanksi Tata Tertib</a></h3>
                <div class="timeline-body sanksi"></div>
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

<div id="tatatertib" class="modal fade">
  <div class="modal-dialog">
    <form method="post" action="<?= base_url('admin/aksitatatertib/tambah') ?>" id="form-tatatertib">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            &times;
          </button>
          <h4 class="modal-title form-data-title">Tambah Data Tata Tertib</h4>
        </div>
        <div class="modal-body">
         <div class="form-group">
           <label>Nama Tata Tertib</label>
           <input type="text" id="nama_tata_tertib" class="form-control" name="nama_tata_tertib" placeholder="Nama Tata Tertib..." required>
         </div>
         <div class="form-group">
           <label>Kategori</label>
           <select class="form-control select2" data-placeholder="Kategori Pelanggaran" name="kategori" id="kategori_pelanggaran" style="width: 100%;">
             <option value="">Kategori Pelanggaran</option>
             <?php foreach ($kategori as $row): ?>
               <option value="<?= $row->id_kategori ?>"><?= $row->nama_kategori ?></option>
             <?php endforeach ?>
           </select>
         </div>
         <div class="form-group">
           <label>Level</label>
           <select class="form-control select2" data-placeholder="Level Pelanggaran" name="level" id="level" style="width: 100%;">
             <option value="">Level Pelanggaran</option>
             <option value="1">Pelanggaran Berat</option>
             <option value="2">Pelanggaran Menengah</option>
             <option value="3">Pelanggaran Biasa</option>
           </select>
         </div>
         <div class="form-group">
           <label>Hukuman</label>
           <textarea name="hukuman" class="form-control" id="hukuman" required></textarea>
         </div>
         <div class="form-group">
           <label>Deskripsi</label>
           <textarea name="deskripsi" class="form-control" id="keterangan" required></textarea>
         </div>
        </div>
        <div class="modal-footer">
          <input type="submit" id="aksi-tt" class="btn btn-success btn-sm" name="aksi" value="Tambah">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div id="hapus" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">       
        <h4 class="modal-title">Kamu yakin? <i class="fa fa-exclamation-circle text-danger"></i></h4>  
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <p>Kamu yakin akan menghapus Record ini? Penghapusan ini akan mengakibatkan seluruh data Tata Tertib dan 
        Pelanggaran Siswa yang terkait akan terhapus</p>
      </div>
      <form action="<?= base_url('admin/aksikategori/hapus') ?>" class="form-hapus" method="post">
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Batal</button>
            <input type="hidden" value="" class="id" name="id">
            <input type="submit" class="btn btn-danger btn-sm" value="Hapus">
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).on('click', '#tambah-kategori', function() {
    $('#kategori').modal('show');
  });

  $(document).on('click', '.hapus-kategori', function() {
    var id = $(this).attr('id');
    $('.id').val(id);
  });

  $(document).on('click', '.hapus-tata-tertib', function() {
    var id = $(this).attr('id');
    $('.form-hapus').attr('action', '<?= base_url('admin/aksitatatertib/hapus') ?>');
    $('.id').val(id);
  });

  $(document).on('click', '.detail-tata-tertib', function() {
    var id_tata_tertib = $(this).attr('id_tata_tertib');
    $.ajax({
        url:"<?= base_url('admin/edittatatertib') ?>",
        method:"POST",
        data:{id_tata_tertib:id_tata_tertib},
        dataType:"json",
        success:function(data){
          var level;
          if (data.level == '3') {
            level = 'Pelanggaran Biasa';
          }else if(data.level == '2'){
            level = 'Pelanggaran Menengah';
          }else if(data.level == '1'){
            level = 'Pelanggaran Berat';
          }
          $('.nama').text(data.nama_tata_tertib);
          $('.kategori').text(data.kategori);
          $('.level').text(level);
          $('.sanksi').text(data.hukuman);
          $('.deskripsi').text(data.deskripsi);
        }
      })
  });

  $(document).on('click', '.hapus-kategori', function() {
    var id = $(this).attr('id');
    $('.id').val(id);
  });

  $(document).on('click', '.hapus-tata-tertib', function() {
    var id = $(this).attr('id');
    $('.form-hapus').attr('action', '<?= base_url('admin/aksitatatertib/hapus') ?>');
    $('.id').val(id);
  });

  $(document).on('click', '.edit-kategori', function() {
    var id_kategori = $(this).attr('id');
    $.ajax({
        url:"<?= base_url('admin/editkategori') ?>",
        method:"POST",
        data:{id_kategori:id_kategori},
        dataType:"json",
        success:function(data){
          $('#kategori').modal("show");
          $('#nama_kategori').val(data.nama_kategori);
          $('#deskripsi').val(data.keterangan);
          $('#kelompok').select2("val", data.kelompok);
          $('#aksi').val('Edit');
          $('#form-kategori').append('<input type="hidden" value="'+data.id_kategori+'" name="id_kategori"/>');
          $('#form-kategori').attr('action', '<?= base_url('admin/aksikategori/edit') ?>');
          $('.form-data-title').text('Edit Data Kategori Pelanggaran');
        }
      })
  });

  $(document).on('click', '#tambah-tatatertib', function() {
    $('#tatatertib').modal('show');
  });

    $(document).on('click', '.edit-tata-tertib', function() {
    var id_tata_tertib = $(this).attr('id');
    $.ajax({
        url:"<?= base_url('admin/edittatatertib') ?>",
        method:"POST",
        data:{id_tata_tertib:id_tata_tertib},
        dataType:"json",
        success:function(data){
          $('#tatatertib').modal("show");
          $('#nama_tata_tertib').val(data.nama_tata_tertib);
          $('#keterangan').text(data.deskripsi);
          $('#hukuman').text(data.hukuman);
          $('#kategori_pelanggaran').select2("val", data.id_kategori);
          $('#level').select2("val", data.level);
          $('#aksi-tt').val('Edit');
          $('#form-tatatertib').append('<input type="hidden" value="'+data.id_tata_tertib+'" name="id_tata_tertib"/>');
          $('#form-tatatertib').attr('action', '<?= base_url('admin/aksitatatertib/edit') ?>');
          $('.form-data-title').text('Edit Data Tata Tertib');
        }
      })
  });
  $('.modal').on('hidden.bs.modal', function () {
    location.reload();
  })
</script>