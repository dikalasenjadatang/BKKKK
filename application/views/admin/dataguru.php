<div class="row">
  <div class="col-xs-12">
    <!-- /.box -->
    <div class="box">
      <div class="box-header">
        <div class="box-header">
          <h1 class="box-title">Data Guru <small>SMK CINTA KITA</small></h1>
          <!-- /.box-tools -->
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-sm btn-flat bg-green" id="tambah-guru">
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
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;foreach ($guru as $row): ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $row->nama ?></td>
                <td><?= $row->email ?></td>
                <td><?= $row->nama_kelas ?></td>
                <td>
                  <span class="label label-success">Aktif</span>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-xs btn-info edit-guru" id="<?= $row->id_user ?>">
                      <i class="fa fa-edit"></i>
                    </button>
                    <button data-toggle="modal" data-target="#hapus" id="<?= $row->id_user ?>" class="btn btn-xs btn-danger alert_notif hapus-guru">
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
    <form method="post" action="<?= base_url('admin/aksiguru/tambah') ?>" id="form-guru">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            &times;
          </button>
          <h4 class="modal-title form-data-title">Tambah Data Kelas</h4>
        </div>
        <div class="modal-body">
          <div class="alert alert-info alert-dismissible password">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p>Password default untuk user baru adalah <b>smkn1@solok</b></p>
          </div>
          <div class="alert alert-danger alert-dismissible hidden status">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <p>Ketika Kelas Guru Di Set <b>Kosong</b> atau <b>Bukan PA</b> Otomatis Status Guru Akan <b>Non Aktif</b></p>
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
            <label>Level</label>
            <select name="level" id="level" class="form-control" required="true">
              <option value="">Pilih Level</option>
              <option value="1">Administrator</option>
              <option value="2">Guru Biasa</option>
            </select>
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
        <p>Kamu yakin akan menghapus Guru ini? </p>
      </div>
      <form action="<?= base_url('admin/aksiguru/hapus') ?>" method="post">
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
  $(document).on('change', '#kelas', function() {
      var kelas = $(this).val();
      if (kelas == '' || kelas == 0) {
        $('.modal-body .status').removeClass('hidden');
      }else{
        $('.modal-body .status').addClass('hidden');
      }
   });

   $(document).on('click', '.edit-guru', function() {
      var id_user = $(this).attr('id');
      $.ajax({
        url:"<?= base_url('admin/editguru') ?>",
        method:"POST",
        data:{id_user:id_user},
        dataType:"json",
        success:function(data){
          $('#form-data').modal("show");
          $('#id_user').val(data.id_user);
          $('#nama').val(data.nama);
          $('#email').val(data.email);
          $('#level').val(data.level);
          $('#kelas').find('option').remove();
          $('#kelas').append(new Option('Bukan PA', 0, false, false));
          if (data.id_kelas != null) {
            $('#kelas').append(new Option(data.nama_kelas, data.id_kelas, true, true));
          }
          $('.password').addClass('hidden');
          $('.form-data-title').text("Edit Data Guru " + data.nama);
          $('#aksi').attr('value', 'Edit');
          $('#form-guru').attr('action', '<?= base_url('admin/aksiguru/edit') ?>');
          $('#form-guru').append('<input type="hidden" id="kelas_lama" name="kelas_lama"/>');
          $('#kelas_lama').val(data.id_kelas);
        }
      })
   });

  $(document).on('click', '.hapus-guru', function() {
      var id_user = $(this).attr('id');
      $('.id_user').val(id_user);
   });

  $(document).on('click', '#tambah-guru', function() {
      $('#form-data').modal("show");
      $('.form-data-title').text("Tambah Data Guru");
      $('#form-guru').attr('action', '<?= base_url('admin/aksiguru/tambah') ?>');
      $('#form-guru')[0].reset();
      $('#kelas').select2().val('').trigger('change');
      $('#kelas').select2().val('').trigger('change');
   });

  $('#form-data').on('hidden.bs.modal', function () {
    location.reload();
  });
</script>