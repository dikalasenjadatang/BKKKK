<div class="row">
  <div class="col-xs-12">
    <!-- /.box -->
    <div class="box">
      <div class="box-header">
        <div class="box-header">
          <h1 class="box-title">Data Akun Guru NonAktif <small>SMK CINTA KITA</small></h1>
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
            <?php $no = 1;foreach ($guru as $row): ?>
              <tr>
                <td><?= $no ?></td>
                <td><?= $row->nama ?></td>
                <td><?= $row->email ?></td>
                <td>
                  <span class="label label-danger">NonAktif</span>
                </td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-xs btn-info edit-guru" id="<?= $row->id_user ?>" nama="<?= $row->nama ?>" email="<?= $row->email ?>">
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

<div id="update-guru" class="modal fade">
  <div class="modal-dialog">
    <form method="post" action="<?= base_url('admin/aktifkanAkun/guru') ?>" id="form-guru">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            &times;
          </button>
          <h4 class="modal-title form-data-title">Update Status Akun Guru NonAktif  </h4>
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
            <label>Jurusan</label>
            <select name="jurusan" class="form-control select2 jurusan" style="width: 100%" data-placeholder="Pilih Jurusan" required>
              <?php foreach ($jurusan as $row): ?>
                <option value=""></option>
                <option value="<?= $row->id_jurusan ?>"><?= $row->nama_jurusan ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Kelas</label>
            <select name="kelas" class="form-control select2 kelas" style="width: 100%" data-placeholder="Pilih Kelas" required>
              <option value=""></option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Update">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <!-- /.box -->
    <div class="box">
      <div class="box-header">
        <div class="box-header">
          <h1 class="box-title">Data Akun Siswa NonAktif <small>SMK Cinta Kita</small></h1>
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
        <table id="example2" class="table table-bordered table-responsive table-striped">
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
    <form method="post" action="<?= base_url('admin/aktifkanAkun/siswa') ?>" id="form-siswa">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            &times;
          </button>
          <h4 class="modal-title form-data-title">Update Status Akun Siswa NonAktif  </h4>
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
            <label class="control-label">Status</label>
            <div>
              <input type="radio" class="status" name="status" value="1" required> Aktifkan
              <input type="radio" class="status" name="status" value="3" required> NonAktif
            </div>
          </div>
          <div class="form-group hidden sembunyi">
            <label>Jurusan</label>
            <select name="jurusan" class="form-control select2 jurusan" style="width: 100%" data-placeholder="Pilih Jurusan" required>
              <?php foreach ($jurusan as $row): ?>
                <option value=""></option>
                <option value="<?= $row->id_jurusan ?>"><?= $row->nama_jurusan ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group hidden sembunyi">
            <label>Kelas</label>
            <select name="kelas" class="form-control select2 kelas" style="width: 100%" data-placeholder="Pilih Kelas" required>
              <option value=""></option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-success" value="Update">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>

  $(document).on('click', '#form-siswa .status', function() {
      var nilai= $(this).val();
      if (nilai == '1') {
        $('.sembunyi').removeClass('hidden');
        $('#form-siswa .kelas').attr('required', 'true');
        $('#form-siswa .jurusan').attr('required', 'true');
      }else{
        $('.sembunyi').addClass('hidden');
        $('#form-siswa .kelas').removeAttr('required');
        $('#form-siswa .jurusan').removeAttr('required');
      }
  });

  $(document).on('click', '.edit-guru', function() {
    var id_user = $(this).attr('id');
    var nama = $(this).attr('nama');
    var email = $(this).attr('email');
    $('#update-guru').modal('show');
    $('#form-guru .id_user').val(id_user);
    $('#form-guru .nama').val(nama);
    $('#form-guru .email').val(email);
  });

    $(document).on('click', '.edit-siswa', function() {
    var id_user = $(this).attr('id');
    var nama = $(this).attr('nama');
    var email = $(this).attr('email');
    $('#update-siswa').modal('show');
    $('#form-siswa .id_user').val(id_user);
    $('#form-siswa .nama').val(nama);
    $('#form-siswa .email').val(email);
  });

  $(document).on('change', '#form-guru .jurusan', function() {
    var id_jurusan = $(this).val();
      $.ajax({
        url:"<?= base_url('admin/kelasAkunNonaktif') ?>",
        method:"POST",
        data:{id_jurusan:id_jurusan,level:2},
        dataType:"json",
        success:function(data){
          var html = '';
          var i;
          for (i=0; i<data.length; i++) {
            html += '<option value="'+data[i].id_kelas+'">'+data[i].nama_kelas+'</option>';
          }
          $('#form-guru .kelas').html(html);
        }
      })
  });

  $(document).on('change', '#form-siswa .jurusan', function() {
    var id_jurusan = $(this).val();
      $.ajax({
        url:"<?= base_url('admin/kelasAkunNonaktif') ?>",
        method:"POST",
        data:{id_jurusan:id_jurusan,level:4},
        dataType:"json",
        success:function(data){
          var html = '';
          var i;
          for (i=0; i<data.length; i++) {
            html += '<option value="'+data[i].id_kelas+'">'+data[i].nama_kelas+'</option>';
          }
          $('#form-siswa .kelas').html(html);
        }
      })
  });

</script>