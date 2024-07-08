<div class="row">
  <div class="col-xs-12">
    <!-- /.box -->
    <div class="box">
      <div class="box-header">
        <div class="box-header">
          <h1 class="box-title">Data Siswa <small>SMK CINTA KITA</small></h1>
          <!-- /.box-tools -->
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-sm btn-flat bg-green" id="tambah-siswa">
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
              <th>Nama</th>
              <th>Email</th>
              <th>Kelas</th>
              <th>Orang Tua</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;foreach ($siswa as $row): ?>
              <tr>
                <td><?= $no ?></td>
                <td><a style="color: #333 !important" href="<?= base_url('admin/rekap_pelanggaran/').$row->id_user ?>"><?= $row->nama_siswa ?></a></td>
                <td><?= $row->email ?></td>
                <td><?= $row->nama_kelas ?></td>
                <td><?= $row->nama_ortu ?></td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-xs btn-info edit-siswa" id="<?= $row->id_user ?>">
                      <i class="fa fa-edit"></i>
                    </button>
                    <button data-toggle="modal" data-target="#hapus" id="<?= $row->id_user ?>" class="btn btn-xs btn-danger alert_notif hapus-siswa">
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
    <form method="post" action="<?= base_url('admin/aksisiwa/tambah') ?>" id="form-siswa">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            &times;
          </button>
          <h4 class="modal-title form-data-title">Tambah Data Siswa</h4>
        </div>
        <div class="modal-body">
          <div class="alert alert-info alert-dismissible password">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p>Password default untuk user baru adalah <b>smkn1@solok</b></p>
          </div>
          <div class="form-group">
            <label>ID User</label>
            <input type="text" name="id_user" class="form-control" id="id_user" value="<?= $kode ?>" readonly>
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input required="true" type="text" placeholder="Nama" name="nama" class="form-control" id="nama">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input required="true" type="email" placeholder="Email" name="email" class="form-control" id="email">
          </div>
          <div class="form-group">
            <label>Kelas</label>
            <select name="kelas" id="kelas" class="form-control select2" style="width: 100%" data-placeholder="Pilih Kelas">
              <?php foreach ($kelas as $row): ?>
                <option value=""></option>
                <option value="<?= $row->id_kelas ?>"><?= $row->nama_kelas ?></option>
              <?php endforeach ?>
            </select>
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

<div id="hapus" class="modal fade">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">
      <div class="modal-header">       
        <h4 class="modal-title">Kamu yakin? <i class="fa fa-exclamation-circle text-danger"></i></h4>  
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        <p>Kamu yakin akan menghapus Siswa ini? </p>
      </div>
      <form action="<?= base_url('admin/aksisiswa/hapus') ?>" method="post">
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <input type="hidden" value="" class="id_user" name="id_user">
            <input type="submit" class="btn btn-danger" value="Hapus">
        </div>
      </form>
    </div>
  </div>
</div>

<script>
    $(document).on('click', '#tambah-siswa', function() {
      $('#form-data').modal("show");
      $('.form-data-title').text("Tambah Data siswa");
      $('#form-siswa').attr('action', '<?= base_url('admin/aksisiswa/tambah') ?>');
      $('#form-siswa')[0].reset();
      $('#kelas').select2().val('').trigger('change');
   });

    $(document).on('click', '.edit-siswa', function() {
      var id_user = $(this).attr('id');
      $.ajax({
        url:"<?= base_url('admin/editsiswa') ?>",
        method:"POST",
        data:{id_user:id_user},
        dataType:"json",
        success:function(data){
          $('#form-data').modal("show");
          $('#id_user').val(data.id_user);
          $('#nama').val(data.nama);
          $('#email').val(data.email);
          $('#kelas').select2().val(data.id_kelas).trigger('change');
          $('.password').addClass('hidden');
          $('.form-data-title').text("Edit Data Siswa " + data.nama);
          $('#aksi').attr('value', 'Edit');
          $('#form-siswa').attr('action', '<?= base_url('admin/aksisiswa/edit') ?>');
        }
      })
   });

  $(document).on('click', '.hapus-siswa', function() {
      var id_user = $(this).attr('id');
      $('.id_user').val(id_user);
   });
  $('#form-data').on('hidden.bs.modal', function () {
    location.reload();
  })
</script>