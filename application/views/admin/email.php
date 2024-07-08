<div class="container">
	<div class="row">
		<div class="box">
            <div class="box-header with-border">
              <h5 class="box-title">Laporan Pelanggaran Siswa</h5>
            </div>
            <!-- /.box-header -->
          <div class="box-body">
          	<p>Selamat Pagi <?= $isi->nama_ortu ?></p>
			<p>Hari ini <?= $isi->nama_siswa ?> melakukan pelanggaran Tata Tertib disekolah. Rinciannya sebagai berikut :</p>
			<br>
            <table class="table table-bordered">
            	<tr>
	       	     <th style="width: 45%">Deskripsi Pelanggaran</th>
	             <th style="width: 45%">Tindakan Sekolah</th>
	             <th><i class="fa fa-clock-o"></i></th>
	            </tr>
	            <tr>
	            	<td><?= $data['deskripsi_pelanggaran'] ?></td>
	            	<td><?= $data['tindakan'] ?></td>
	            	<td><?= $data['tanggal'] ?></td>
	            </tr>
	           </table><br>
			<p>Pantau terus kelakuan anak di aplikasi atau website <a href="<?= base_url() ?>">B-Kita</a>.</p>
			<p>Hormat Kami, BK SMK Negeri 1 Solok</p>
          </div>
	</div>
</div>