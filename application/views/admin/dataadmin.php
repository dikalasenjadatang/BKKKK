<div class="row">
  <div class="col-xs-12">
    <!-- /.box -->
    <div class="box">
      <div class="box-header">
        <div class="box-header">
          <h1 class="box-title">Administrator Aplikasi B-Kita</h1>
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
        <table class="table table-bordered table-responsive table-striped">
          <thead>
            <tr>
              <th width="5%">#</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1;foreach ($admin as $row): ?>
              <tr>
                <td width="5%"><?= $no ?></td>
                <td><?= $row->nama ?></td>
                <td><?= $row->email ?></td>
                <td>
                  <?php if ($row->status == 'Y'): ?>
                    <span class="label label-success">Aktif</span>
                  <?php else: ?>
                    <span class="label label-danger">NonAktif</span>
                  <?php endif ?>
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

