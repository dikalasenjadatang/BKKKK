<div class="row">
  <div class="col-xs-12">
    <!-- /.box -->
    <div class="box">
      <div class="box-header">
        <div class="box-header">
          <h1 class="box-title">Data Jurusan <small>SMK CINTA KITA</small></h1>
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
        <table id="example1" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Jurusan</th>
              <th>Singkatan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;foreach ($jurusan as $row): ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $row->nama_jurusan ?></td>
                <td><?= $row->singkatan ?></td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-xs btn-info edit-jurusan" id="<?= $row->id_jurusan ?>">
                      <i class="fa fa-edit"></i>
                    </button>
                    <button data-toggle="modal" data-target="#hapus" id="<?= $row->id_jurusan ?>" class="btn btn-xs btn-danger alert_notif hapus-jurusan">
                      <i class="fa fa-remove"></i>
                    </button>
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

<div id="form-data" class="modal fade">
  <div class="modal-dialog">
    <form method="post" action="<?= base_url('admin/aksijurusan/tambah') ?>" id="form-jurusan">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            &times;
          </button>
          <h4 class="modal-title form-data-title">Tambah Data Jurusan</h4>
        </div>
        <div class="modal-body">
          <label>Nama Jurusan</label>
          <input type="text" name="nama_jurusan" class="form-control" id="nama_jurusan">
          <br/>
          <label>Singkatan</label>
          <input type="text" name="singkatan" class="form-control" id="singkatan">
        </div>
        <div class="modal-footer">
          <input type="hidden" id="id_jurusan" name="id_jurusan" value="">
          <input type="submit" id="aksi" class="btn btn-success" name="aksi" value="Tambah">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
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
        <p>Kamu yakin akan menghapus data jurusan ini? <b>Ini akan menyebabkan data kelas ikut terhapus</b></p>
      </div>
      <form action="<?= base_url('admin/aksijurusan/hapus') ?>" method="post">
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <input type="hidden" value="" class="id_jurusan" name="id_jurusan">
            <input type="submit" class="btn btn-danger" value="Hapus">
        </div>
      </form>
    </div>
  </div>
</div>

<script>
   $(document).on('click', '.edit-jurusan', function() {
      var id_jurusan = $(this).attr('id');
      $.ajax({
        url:"<?= base_url('admin/editjurusan') ?>",
        method:"POST",
        data:{id_jurusan:id_jurusan},
        dataType:"json",
        success:function(data){
          $('#form-data').modal("show");
          $('#nama_jurusan').val(data.nama_jurusan);
          $('#singkatan').val(data.singkatan);
          $('#id_jurusan').val(data.id_jurusan);
          $('.form-data-title').text("Edit Jurusan " + data.nama_jurusan);
          $('#aksi').attr('value', 'Edit');
          $('#form-jurusan').attr('action', '<?= base_url('admin/aksijurusan/edit') ?>');
        }
      })
   });

  $(document).on('click', '.hapus-jurusan', function() {
      var id_jurusan = $(this).attr('id');
      $('.id_jurusan').val(id_jurusan);
   });

  $(document).on('click', '#tambah', function() {
      $('#form-data').modal('show');
      $('.form-data-title').text("Tambah Jurusan ");
      $('#form-jurusan').attr('action', '<?= base_url('admin/aksijurusan/tambah') ?>');
      $('#form-jurusan')[0].reset();
   });
</script>