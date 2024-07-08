<div class="row">
  <div class="col-xs-12">
    <!-- /.box -->
    <div class="box">
      <div class="box-header">
        <div class="box-header">
          <h1 class="box-title">Data Kelas <small>SMK CINTA KITA</small></h1>
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
              <th>Nama Kelas</th>
              <th>Jurusan</th>
              <th>PA</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;foreach ($kelas as $row): ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $row->nama_kelas ?></td>
                <td><?= $row->singkatan ?></td>
                <td><?= $row->nama ?></td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-xs btn-info edit-kelas" id="<?= $row->id_kelas ?>">
                      <i class="fa fa-edit"></i>
                    </button>
                    <button data-toggle="modal" data-target="#hapus" id="<?= $row->id_kelas ?>" class="btn btn-xs btn-danger alert_notif hapus-kelas">
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
    <form method="post" action="<?= base_url('admin/aksikelas/tambah') ?>" id="form-kelas">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            &times;
          </button>
          <h4 class="modal-title form-data-title">Tambah Data Kelas</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Kelas</label>
            <input type="text" placeholder="Nama Kelas" name="nama_kelas" class="form-control" id="nama_kelas">
          </div>
          <div class="form-group">
            <label>Jurusan</label>
            <select name="jurusan" id="jurusan" class="form-control select2" style="width: 100%" data-placeholder="Pilih Jurusan">
              <?php foreach ($jurusan as $row): ?>
                <option value=""></option>
                <option value="<?= $row->id_jurusan ?>"><?= $row->nama_jurusan ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>PA</label>
            <select name="pa" id="pa" class="form-control select2" style="width: 100%" data-placeholder="Pilih PA">
              <?php foreach ($guru as $row): ?>
                <option value=""></option>
                <option value="<?= $row->id_user ?>"><?= $row->nama ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" id="id_kelas" name="id_kelas" value="">
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
        <p>Kamu yakin akan menghapus data kelas ini? </p>
      </div>
      <form action="<?= base_url('admin/aksikelas/hapus') ?>" method="post">
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <input type="hidden" value="" class="id_kelas" name="id_kelas">
            <input type="submit" class="btn btn-danger" value="Hapus">
        </div>
      </form>
    </div>
  </div>
</div>

<script>
   $(document).on('click', '.edit-kelas', function() {
      var id_kelas = $(this).attr('id');
      $.ajax({
        url:"<?= base_url('admin/editkelas') ?>",
        method:"POST",
        data:{id_kelas:id_kelas},
        dataType:"json",
        success:function(data){
          $('#form-data').modal("show");
          $('#nama_kelas').val(data.nama_kelas);
          $('#id_kelas').val(data.id_kelas);
          $('#jurusan').select2("val", data.jurusan);
         if (data.id_pa != 'null') {
           $('#pa').append(new Option(data.pa, data.id_pa, true, true));
         }
          $('.form-data-title').text("Edit Kelas " + data.nama_kelas);
          $('#aksi').attr('value', 'Edit');
          $('#form-kelas').attr('action', '<?= base_url('admin/aksikelas/edit') ?>');
        }
      })
   });

  $(document).on('click', '.hapus-kelas', function() {
      var id_kelas = $(this).attr('id');
      $('.id_kelas').val(id_kelas);
   });

  $(document).on('click', '#tambah', function() {
      $('#form-data').modal("show");
      $('.form-data-title').text("Tambah Data Kelas");
      $('#form-kelas').attr('action', '<?= base_url('admin/aksikelas/tambah') ?>');
      $('#form-kelas')[0].reset();
      $('#pa').select2().val('').trigger('change');
      $('#jurusan').select2().val('').trigger('change');
   });

  $('#form-data').on('hidden.bs.modal', function () {
   location.reload();
  })
</script>