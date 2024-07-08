<div class="row">
  <div class="col-xs-12">
    <!-- /.box -->
    <div class="box">
      <div class="box-header">
        <div class="box-header">
          <h1 class="box-title">Data Anak</h1>
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
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; foreach ($siswa as $row): ?>
              <tr>
                <td><?= $no ?></td>
                <td>
                  <a style="color: #333 !important" href="<?= base_url('ortu/rekap_pelanggaran/').$row->id_user ?>">
                    <?= $row->nama_siswa ?>
                  </a>
                </td>
                <td><?= $row->email ?></td>
                <td><?= $row->nama_kelas ?></td>
                <td>
                  <button type="button" id="<?= $row->id_user ?>" class="btn btn-info btn-xs detail">
                    <i class="fa  fa-search-plus"></i>
                  </button>
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
<div id="detail" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Data Pelanggaran Hari Ini</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-info">
          <p>Untuk Hari Ini Belum Ada Peraturan Yang Dilanggar</p>
        </div>
        <table class="table table-bordered table-responsive table-striped pelanggaran">
          <tr>
            <th>#</th>
            <th >Jenis Pelanggaran</th>
            <th>Tata Tertib</th>
            <th>Keterangan</th>
          </tr>
          <tbody id="pelanggaran">
            
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<script>
  $(document).on('click', '.detail', function() {
    var id_siswa = $(this).attr('id');
    $.ajax({
        url:"<?= base_url('ortu/detail') ?>",
        method:"POST",
        data:{id_siswa:id_siswa},
        dataType:"json",
        success:function(data){
          $('#detail').modal("show");
          if (data.status == false) {
            $('.pelanggaran').addClass('hidden');
            $('.alert').removeClass('hidden');
          }else{
            $('.pelanggaran').removeClass('hidden');
            $('.alert').addClass('hidden');
            var baris = '';
            var no = 1;
            for (var i = 0; i < data.length; i++) {
              baris += '<tr>' +
                          '<td>' + no + '</td>' +
                          '<td>' + data[i].nama_kategori + '</td>' +
                          '<td>' + data[i].nama_tata_tertib + '</td>' +
                          '<td>' + data[i].deskripsi_pelanggaran + '</td>' +
                        '</tr>'; 
                        no++;
            }
            $('#pelanggaran').html(baris);
          }
        }
      })
  });
</script>