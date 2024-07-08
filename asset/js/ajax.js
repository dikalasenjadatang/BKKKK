  $(document).ready(function() {
     $(function () {
      $('#example1').DataTable()
      $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : true,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : false
      });

      $('.select2').select2()
    });
   });

   $(document).on('click', '.tambah-pa', function() {
      var id_kelas = $(this).attr("id");
      $('#id_kelas').attr('value', id_kelas)
   });

   $(document).on('click', '.edit-guru', function() {
      var id_user = $(this).attr('id');
      $.ajax({
        url:"<?= base_url('admin/ambilUser') ?>",
        method:"POST",
        data:{id_user:id_user},
        dataType:"json",
        success:function(data){
          $('#edit-data').modal("show");
          $('#id_user').val(data.id_user);
          $('#nama').val(data.nama);
        }
      })
   });

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
          $('.modal-title').text("Edit Jurusan " + data.nama_jurusan);
          $('#simpan').attr('name', 'edit');
        }
      })
   });