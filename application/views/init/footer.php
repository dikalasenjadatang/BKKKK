  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>B</b>K<small>ita</small> 
    </div>
    Copyright &copy; <?= date('Y') ?> <a href="http://github.com/dikalasenjadatang">Mas Lian</a>
    
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url(); ?>asset/adminlte/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url(); ?>asset/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url(); ?>asset/adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>asset/adminlte/dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url(); ?>asset/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>asset/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script src="<?= base_url(); ?>asset/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Data Mask -->
<script src="<?= base_url('asset/js/jquery.mask.min.js') ?>"> </script>
<script>
   $(document).ready(function() {
     $(function () {
      $('#example1').DataTable({
        "scrollX": true,  
        lengthChange: false
      });
      $('.pelanggaran').DataTable({
        "scrollX": true,  
        lengthChange: false
      });

      $('.pagination').addClass('btn-xs');
      $('#example2').DataTable({
        lengthChange: false
      });
      $('#tabel-pelanggaran, #tabel-panggilan').DataTable({
        lengthChange: false,
        searching: false,
        "scrollX": true,
      });
      $('.select2').select2();
      $('.phone').mask();
    });
   });
   $('#tanggal').datepicker({
      autoclose: true,
    });

   //$(document).ajaxStart(function() { Pace.restart(); });
</script>
