<div class="row">
  <div class="col-xs-12">
    <!-- /.box -->
    <div class="box">
      <div class="box-header">
        <div class="box-header">
          <h1 class="box-title">Arsip Pelanggaran Siswa</h1>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <div class="box-tools pull-left">
          <form action="" class="">
            <div class="form-group">
              <select id="id_siswa" data-placeholder="Pilih Data Yang Akan Dilihat" class="form-control input-xs select2" style="width: 100%;">
                <option value=""></option>
                <?php foreach ($siswa as $row): ?>
                  <option value="<?= $row->id_user ?>"><?= $row->nama_siswa ?></option>
                <?php endforeach ?>
              </select>
            </div>
          </form>
        </div>
      </div>
            <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
        <!-- /.col -->
</div>

<script>
  $(document).on('change', '#id_siswa', function() {
    var id_siswa = $(this).val();
    window.location.href ='<?= base_url('ortu/rekap_pelanggaran/') ?>'+id_siswa ;
  });
</script>