<section class="content">
  <div class="row">
    <div class="col-md-6">
      <div class="box box-widget widget-user-2">
        <div class="widget-user-header bg-aqua-active">
          <div class="widget-user-image">
            <img class="img-circle" src="<?= base_url('asset/adminlte/dist/img/people.png') ?>" alt="User Avatar">
          </div>
          <h3 class="widget-user-username"><?= $profil->nama_siswa ?></h3>
          <h5 class="widget-user-desc">
            <?php if ($profil->level == 4): ?>
              Peserta Didik
            <?php endif ?>
          </h5>
        </div>
        <div class="box-footer no-padding">
          <ul class="nav nav-stacked">
            <li><a href="#">User ID <b class="pull-right"><?= $profil->id_user ?></b></a></li>
            <li><a href="#">Email <b class="pull-right"><?= $profil->email ?></b></a></li>
            <li><a href="#">Kelas <b class="pull-right"><?= $profil->nama_kelas ?></b></a></li>
            <li><a href="#">Password <b class="pull-right">*********</b></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#settings" data-toggle="tab">Pengaturan</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="settings">
            <form class="form-horizontal" id="form-profil">
              <div class="form-group">
                <label class="col-sm-2 control-label">User ID</label>
                <div class="col-sm-10">
                  <input type="text" name="id_user" class="form-control" readonly value="<?= $profil->id_user ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" name="nama" class="form-control" value="<?= $profil->nama_siswa ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" name="email"class="form-control" value="<?= $profil->email ?>">
                </div>
              </div>
              <div class="form-group hidden password">
                <label class="col-sm-2 control-label">Password Baru</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" name="pass_baru" placeholder="masukkan password baru">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Ganti Password</label>
                <div class="col-sm-10">
                  <input type="radio" class="ganti_pass" name="ganti_password" value="Y"> Ya
                  <input type="radio" class="ganti_pass" name="ganti_password" value="N"> Tidak
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="button" data-toggle="modal" data-target="#konfirmasi" class="btn btn-success btn-sm">Update</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<div id="konfirmasi" class="modal fade">
  <div class="modal-dialog">
    <form id="form-konfirmasi">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">
            &times;
          </button>
          <h4>Masukkan Password Untuk Melanjutkan</h4>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Password</label>
            <input type="hidden" name="id_user" value="<?= $profil->id_user ?>">
            <input type="password" name="konfirmasi" class="form-control">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="update">Konfirmasi</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </form>
  </div>
</div>
<script>

  $(document).on('click', '.ganti_pass', function() {
      var nilai= $(this).val();
      if (nilai == 'Y') {
        $('.password').removeClass('hidden');
      }else{
        $('.password').addClass('hidden');
        $('.password .form-control').val('');
      }
  });

  $(document).on('click', '#update', function() {
      $.ajax({
      url: "<?= base_url('siswa/konfirmasi') ?>",
      type: "POST",
      data: $('#form-konfirmasi').serialize(),
      dataType: "JSON",
      success: function(data){
        if (data.status == true) {
          update();
        }else if (data.status == false) {
          alert('password salah');
        }
      }
     })
  });

  function update(){
    $.ajax({
      url: "<?= base_url('siswa/editprofil') ?>",
      type: "POST",
      data: $('#form-profil').serialize(),
      dataType: "JSON",
      success: function(data){
        if (data.status == true) {
          window.location.reload();
        }else if (data.status == false) {
          alert('Profil Gagal Diupdate');
        }
      }
     })
  }
</script>