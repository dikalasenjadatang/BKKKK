<div class="row">
  <div class="col-xs-12">
    <!-- /.box -->
    <div class="box">
      <div class="box-header">
        <div class="box-header">
          <h1 class="box-title">Data Akun Siswa NonAktif Kelas <?= $kelas->nama_kelas ?> <small>SMK CINTA KITA</small></h1>
          <!-- /.box-tools -->
          <div class="box-tools pull-right">
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
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;foreach ($siswa as $row): ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $row->nama_siswa ?></td>
                <td><?= $row->email ?></td>
                <td>
                  <span class="label label-danger">NonAktif</span>
                </td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-xs btn-info edit-siswa" id="<?= $row->id_user ?>" nama="<?= $row->nama_siswa ?>" email="<?= $row->email ?>">
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

<div id="update-siswa" class="modal fade">
  <div class="modal-dialog">
    <form method="post" action="<?= base_url('guru/akunNonAktif') ?>" id="form-siswa">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            &times;
          </button>
          <h4 class="modal-title form-data-title">Tambah Data Kelas</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>ID User</label>
            <input type="text" name="id_user" class="form-control id_user" value="" readonly>
          </div>
          <div class="form-group">
            <label>Nama</label>
            <input type="text" value="" class="form-control nama" readonly>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" value="" class="form-control email" readonly>
          </div>
          <div class="form-group">
            <label>Status Akun</label>
            <select name="status" class="form-control select2" style="width: 100%" data-placeholder="Pilih Status" required>
              <option value=""></option>
              <option value="1">Aktifkan</option>
              <option value="3">NonAktif</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" name="aktifkan" value="Aktifkan">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).on('click', '.edit-siswa', function() {
    var id_user = $(this).attr('id');
    var nama = $(this).attr('nama');
    var email = $(this).attr('email');
    $('#update-siswa').modal('show');
    $('#form-siswa .id_user').val(id_user);
    $('#form-siswa .nama').val(nama);
    $('#form-siswa .email').val(email);
  });
</script>