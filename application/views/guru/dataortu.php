<div class="row">
  <div class="col-xs-12">
    <!-- /.box -->
    <div class="box">
      <div class="box-header">
        <div class="box-header">
          <h1 class="box-title">Data Orang Tua <small>SMKN 1 SOLOK</small></h1>
          <!-- /.box-tools -->
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-sm btn-flat bg-green" id="tambah-ortu">
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
              <th>Telepon</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;foreach ($ortu as $row): ?>
              <tr>
                <td>
                  <button type="button" id="<?= $row->id_ortu ?>" class="dataanak btn btn-info btn-xs">
                    <i class="fa fa-arrows"></i>
                  </button>
                </td>
                <td><?= $row->nama_ortu ?></td>
                <td><?= $row->email_ortu ?></td>
                <td><?= $row->telepon ?></td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-xs btn-info edit-ortu" id="<?= $row->id_ortu ?>">
                      <i class="fa fa-edit"></i>
                    </button>
                    <button data-toggle="modal" data-target="#hapus" id="<?= $row->id_ortu ?>" class="btn btn-xs btn-danger alert_notif hapus-ortu">
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
    <form method="post" action="<?= base_url('guru/aksiortu/tambah') ?>" id="form-ortu">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            &times;
          </button>
          <h4 class="modal-title form-data-title">Tambah Data ortu</h4>
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
            <input type="email" placeholder="Email" name="email" class="form-control" id="email">
          </div>
          <div class="form-group">
            <label>Telepon</label>
            <input type="text" data-mask="+6299999999999" class="form-control" id="phone" required name="telepon" placeholder="+6281234567890" >
          </div>
          <div class="form-group" id="anak">
            <label>Anak</label>
              <select class="form-control select2" name="anak[]" multiple="multiple" style="width: 100%;">
                <option value=""></option>
                  <?php foreach ($siswa as $row): ?>
                <option value="<?= $row->id_user ?>"><?= $row->nama_siswa ?></option>
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

<div id="dataanak" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Anak Bapak</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-responsive table-striped">
          <tr>
            <th >Nama</th>
            <th>Kelas</th>
            <th>Aksi</th>
          </tr>
          <tbody id="siswa">
            
          </tbody>
        </table>
        <form class="hidden" id="tambah-anak" method="post" action="<?= base_url('guru/aksiortu/tambah-anak') ?>">
          <div class="form-group">
            <label>Nama Siswa</label>
            <input type="hidden" name="id_ortu" id="id_ortu">
              <select class="form-control select2" name="siswa" style="width: 100%;">
                <option value=""></option>
                <?php foreach ($siswa as $row): ?>
                  <option value="<?= $row->id_user ?>"><?= $row->nama_siswa ?></option>
                <?php endforeach ?>
              </select>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-xs btn-success form-control" value="Tambah">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success btn-xs tambah-anak"><i class="fa fa-plus"></i></button>
      </div>
    </div>
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
        <p>Kamu yakin akan menghapus ortu ini? </p>
      </div>
      <form action="<?= base_url('guru/aksiortu/hapus-ortu') ?>" method="post">
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
            <input type="hidden" value="" class="id_user" name="id_user">
            <input type="submit" class="btn btn-sm btn-danger" value="Hapus">
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).on('click', '#tambah-ortu', function() {
      $('#form-data').modal("show");
      $('.form-data-title').text("Tambah Data ortu");
      $('#form-ortu').attr('action', '<?= base_url('guru/aksiortu/tambah') ?>');
      $('#form-ortu')[0].reset();
      $('#kelas').select2().val('').trigger('change');
   });

  $(document).on('click', '.edit-ortu', function() {
      var id_user = $(this).attr('id');
      $.ajax({
        url:"<?= base_url('guru/editortu') ?>",
        method:"POST",
        data:{id_user:id_user},
        dataType:"json",
        success:function(data){
          $('#form-data').modal("show");
          $('#id_user').val(data.id_ortu);
          $('#nama').val(data.nama_ortu);
          $('#email').val(data.email_ortu);
          $('#phone').val(data.telepon);
          $('#anak').addClass('hidden');
          $('.form-data-title').text("Edit Data ortu " + data.nama_ortu);
          $('#aksi').attr('value', 'Edit');
          $('#form-ortu').attr('action', '<?= base_url('guru/aksiortu/edit') ?>');
        }
      })
   });

  $(document).on('click', '.hapus-ortu', function() {
      var id_user = $(this).attr('id');
      $('.id_user').val(id_user);
   });

  $(document).on('click', '.dataanak', function() {
      var id_user = $(this).attr('id');
      $.ajax({
        url:"<?= base_url('guru/dataanak') ?>",
        method:"POST",
        data:{id_user:id_user},
        dataType:"json",
        success:function(data){
          $('#dataanak').modal("show");
          var baris = '';
          for (var i = 0; i < data.length; i++) {
            baris += '<tr>' +
                        '<td>' + data[i].nama_siswa + '</td>' +
                        '<td>' + data[i].nama_kelas + '</td>' +
                        '<td>' + 
                            '<button type="button" class="btn btn-xs btn-danger hapus-anak" id="'+ data[i].id_user + '">' +
                              '<i class="fa fa-remove">' +
                            '</button>'
                        '</td>' +
                      '</tr>'; 
          }
          $('#siswa').html(baris);
          $('#id_ortu').val(id_user);
        }
      })
   });

  $(document).on('click', '.hapus-anak', function() {
    var id_user = $(this).attr('id');
    $.ajax({
        url:"<?= base_url('guru/aksiortu/hapus-anak') ?>",
        method:"POST",
        data:{id_user:id_user},
        dataType:"json",
        success:function(data){
          if (data.status == true) {
            location.reload();
          }else{
            alert('gagal');
          }
        }
      })
  })

  $(document).on('click', '.tambah-anak', function() {
    $('#tambah-anak').removeClass('hidden');
    $(this).toggleClass('hidden');    
  })

  $('#form-data').on('hidden.bs.modal', function () {
    location.reload();
  })


</script>