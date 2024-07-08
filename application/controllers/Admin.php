<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->cekLogin();
		$this->load->library('template');
		$this->load->model('Admin_model');
		$this->model = $this->Admin_model;
		$this->load->helper('date');
		$this->load->helper('sms');
	}

	public function index(){
		$guru = $this->model->tampil('tb_guru',['status'=>'Y'])->num_rows();
		$kelas = $this->model->tampil('tb_kelas')->num_rows();
		$siswa = $this->model->tampil('tb_siswa')->num_rows();
		$pelanggaran = $this->model->tampil('tb_pelanggaran',['tanggal'=>date('Y-m-d')])->num_rows();
		$rekor = $this->model->rekor()->result();

		$data = ['guru'=>$guru,'kelas'=>$kelas,'siswa'=>$siswa,'pelanggaran'=>$pelanggaran,'rekor'=>$rekor];
		$this->template->admin('admin/home',$data);
	}

	// Admin Profil
	public function profil(){
		$id = $this->session->userdata('id_user');
		$join['1'] = $this->db->join('tb_guru', 'users.id_user = tb_guru.id_user', 'left');
		$join['2'] = $this->db->join('tb_kelas', 'users.id_user = tb_kelas.id_guru', 'left');
		$profil = $this->model->tampil('users',['users.id_user'=>$id],$join)->row();
		$data = ['profil'=>$profil];
		$this->template->admin('admin/profil', $data);
	}

	public function editprofil(){
		$where = ['id_user'=>$this->input->post('id_user')];
		$data = [
			'nama'		=> $this->input->post('nama'),
			'email'		=> $this->input->post('email')
		];
		if ($_POST['pass_baru'] != '') {
			$user = ['password'=>md5($this->input->post('pass_baru'))];
			$this->model->update('users',$user,$where);
		}
		$update = $this->model->update('tb_guru',$data,$where);
		if ($update == TRUE) {
			echo json_encode(['status'=>TRUE]);
		}else{
			echo json_encode(['status'=>FALSE]);
		}
	}

	public function konfirmasi(){
		$id_user = $this->input->post('id_user');
		$password =md5($this->input->post('konfirmasi'));
		$cek = $this->model->tampil('users',['id_user'=>$id_user]);
		if ($cek->num_rows() >= 1) {
			$data = $cek->row();
			if ($data->password == $password) {
				echo json_encode(['status'=>TRUE]);
			}else{
				echo json_encode(['status'=>FALSE]);
			}
		}	
	}

	private function cekLogin(){
		if (empty($this->session->userdata('id_user'))) {
			redirect('user');
		}elseif ($this->session->userdata('level') != 1) {
			redirect('user');
		}
	}

	public function akunNonaktif(){
		$kelas = $this->model->tampil('tb_kelas',['id_guru'=>''])->result();
		$this->db->order_by('nama', 'asc');
		$guru = $this->model->tampil('tb_guru',['status'=>'N'])->result();
		$join = $this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas', 'left');
		$siswa = $this->model->tampil('tb_siswa',['status'=>3], $join)->result();
		$jurusan = $this->model->tampil('tb_jurusan')->result();
		$data = ['guru'=>$guru, 'siswa'=>$siswa,'kelas'=>$kelas,'jurusan'=>$jurusan];
		$this->template->admin('admin/akunNonAktif',$data);
	}

	public function kelasAkunNonaktif(){
		if ($_POST['level'] == 2) {
			$kelas = $this->model->tampil('tb_kelas',['id_guru'=>'','id_jurusan'=>$_POST['id_jurusan']])->result();
		}elseif ($_POST['level'] == 4) {
			$kelas = $this->model->tampil('tb_kelas',['id_jurusan'=>$_POST['id_jurusan']])->result();
		}

		echo json_encode($kelas);
	}
	public function aktifkanAkun($level){
		if ($level == 'guru') {
			$this->model->update('tb_kelas',['id_guru'=>$_POST['id_user']],['id_kelas'=>$_POST['kelas']]);
			$this->model->update('tb_guru',['status'=>'Y','pa'=>'Y'],['id_user'=>$_POST['id_user']]);
		}elseif ($level == 'siswa') {
			$data = [
				'status'	=> $this->input->post('status'),
				'id_kelas'	=> $this->input->post('kelas')
			];
			if ($_POST['status'] == 3) {
				redirect('admin/akunNonaktif');
			}else{
				$this->model->update('tb_siswa', $data, ['id_user'=>$_POST['id_user']]);
			}		
		}
		redirect('admin/akunNonaktif');
	}
	//End Admin Profil

	// Admin Jurusan
	public function datajurusan(){
		$jurusan = $this->model->tampil('tb_jurusan')->result();
		$data = ['jurusan'=>$jurusan];
		$this->template->admin('admin/datajurusan', $data);
	}

	public function aksijurusan($aksi){
		$data = [
				'nama_jurusan'	=> $this->input->post('nama_jurusan'),
				'singkatan'		=> $this->input->post('singkatan')
			];
		if ($aksi == 'tambah') {
			$query = $this->model->tambah('tb_jurusan', $data);
			if ($query == TRUE) {
				redirect('admin/datajurusan');
			}else{
				redirect('admin/datajurusan');
			}
		}elseif ($aksi == 'edit') {
			$where = ['id_jurusan'=> $this->input->get_post('id_jurusan')];
			$query = $this->model->update('tb_jurusan', $data, $where);
			if ($query == TRUE) {
				redirect('admin/datajurusan');
			}else{
				redirect('admin/datajurusan');
			}
		}elseif ($aksi == 'hapus') {
			$where = ['id_jurusan'=> $this->input->get_post('id_jurusan')];
			$query = $this->model->hapus('tb_jurusan', $where);
			if ($query == TRUE) {
				redirect('admin/datajurusan');
			}else{
				redirect('admin/datajurusan');
			}	
		}	
	}

	public function editjurusan(){
		$id_jurusan = $_POST['id_jurusan'];
		$where = ['id_jurusan'=>$id_jurusan];
			$output = array();
			$data = $this->model->tampil('tb_jurusan',$where)->result();
			foreach ($data as $row) {
			$output['id_jurusan'] = $row->id_jurusan;
			$output['nama_jurusan'] = $row->nama_jurusan;
			$output['singkatan'] = $row->singkatan;
		}
		echo json_encode($output);
	}
	// End Admin Jurusan

	// Admin Kelas
	public function datakelas(){
		$join = array();
		$join['1'] = $this->db->join('tb_guru', 'tb_kelas.id_guru = tb_guru.id_user', 'left');
		$join['2'] = $this->db->join('tb_jurusan', 'tb_kelas.id_jurusan = tb_jurusan.id_jurusan', 'left');
		$kelas = $this->model->tampil('tb_kelas',NULL,$join)->result();
		$jurusan = $this->model->tampil('tb_jurusan')->result();
		$this->db->join('users', 'tb_guru.id_user = users.id_user', 'left');
		$guru = $this->model->tampil('tb_guru',['tb_guru.pa'=> 'N','users.level'=>2])->result();
		$data = ['kelas'=>$kelas,'jurusan'=>$jurusan,'guru'=>$guru];
		$this->template->admin('admin/datakelas', $data);
	}

	public function aksikelas($aksi){
		if ($this->input->post('pa') == NULL) {
			$pa = '';
		}else{
			$pa = $this->input->post('pa');
		}
		$data = [
			'nama_kelas'	=> $this->input->post('nama_kelas'),
			'id_jurusan'	=> $this->input->post('jurusan'),
			'id_guru'		=> $pa
		];

		if ($aksi == 'tambah') {
			$query = $this->model->tambah('tb_kelas', $data);
			if ($query == TRUE) {
				if ($data['id_guru'] != '') {
					$this->model->update('tb_guru',['pa'=> 'Y'], ['id_user'=>$data['id_guru']]);
				}
				redirect('admin/datakelas');
			}else{
				error_log();
			}
		}elseif ($aksi == 'edit') {
			$where = ['id_kelas'=> $this->input->get_post('id_kelas')];
			$cekpa = $this->cekpa($where);
			$query = $this->model->update('tb_kelas', $data, $where);
			if ($query == TRUE) {
				if ($cekpa->id_guru != $data['id_guru']) {
					$this->model->update('tb_guru', ['pa'=>'Y'], ['id_user'=>$data['id_guru']]);
					$this->model->update('tb_guru', ['pa'=>'N','status'=>'N'], ['id_user'=>$cekpa->id_guru]);
					redirect('admin/datakelas');
				}else{
					redirect('admin/datakelas');
				}
			}
		}elseif ($aksi == 'hapus') {
			$where = ['id_kelas'=> $this->input->get_post('id_kelas')];
			$cekpa = $this->cekpa($where);
			if ($cekpa->id_guru != '') {
				$this->model->update('tb_guru', ['pa'=>'N'], ['id_user'=>$cekpa->id_guru]);
			}
			$query = $this->model->hapus('tb_kelas', $where);
			if ($query == TRUE) {
				redirect('admin/datakelas');
			}else{
				redirect('admin/datakelas');
			}	
		}	
	}

	public function editkelas(){
		$id_kelas = $_POST['id_kelas'];
		$where = ['id_kelas'=>$id_kelas];
		$output = array();
		$join = array();
		$join['1'] = $this->db->join('tb_guru', 'tb_kelas.id_guru = tb_guru.id_user', 'left');
		$join['2'] = $this->db->join('tb_jurusan', 'tb_kelas.id_jurusan = tb_jurusan.id_jurusan', 'left');
		$kelas = $this->model->tampil('tb_kelas',$where,$join)->result();
			foreach ($kelas as $row) {
			$output['id_kelas'] = $row->id_kelas;
			$output['nama_kelas'] = $row->nama_kelas;
			$output['jurusan'] = $row->id_jurusan;
			$output['pa'] = $row->nama;
			$output['id_pa'] = $row->id_guru;
		}
		echo json_encode($output);
	}

	public function cekpa($where){
		$query = $this->model->tampil('tb_kelas',$where)->row();
		return $query;
	}
	// End Admin Kelas

	//Admin Guru
	public function dataguru(){
		$join = array();
		$join['1'] = $this->db->join('tb_kelas', 'tb_guru.id_user = tb_kelas.id_guru', 'left');
		$join['2'] = $this->db->join('users', 'tb_guru.id_user = users.id_user', 'left');
		$this->db->order_by('nama', 'asc');
		$guru = $this->model->tampil('tb_guru',['tb_guru.status'=>'Y','users.level'=>2],$join)->result();
		$kelas = $this->model->tampil('tb_kelas',['id_guru'=>''])->result();
		$kode = $this->model->buatid('guru');
		$data = ['kelas'=>$kelas,'guru'=>$guru, 'kode'=>$kode];
		$this->template->admin('admin/dataguru', $data);
	}

	public function aksiguru($aksi){
		$kelas = $this->input->post('kelas');
		$kelas_lama = isset($_POST['kelas_lama']);
		if ($aksi == 'tambah') {
			if ($kelas == '') {
				$pa = 'N';
				$status = 'N';
			}else{
				$this->model->update('tb_kelas',['id_guru'=>$_POST['id_user']],['id_kelas'=>$kelas]);
				$pa = 'Y';
				$status = 'Y';
			}
			$user = [
				'id_user'	=> $this->input->post('id_user'),
				'password'	=> md5('smkn1@solok'),
				'level'		=> $this->input->post('level')
			];
			$data = [
				'id_user'	=> $this->input->post('id_user'),
				'nama'		=> $this->input->post('nama'),
				'email'		=> $this->input->post('email'),
				'pa'		=> $pa,
				'status'	=> $status
			];
			if ($this->model->tambah('users', $user) == TRUE) {
				$this->model->tambah('tb_guru', $data);
				redirect('admin/dataguru');
			}else{}
		}elseif ($aksi == 'edit') {
			if ($kelas == 0) {
				$pa = 'N';
				$status = 'N';
				$kelas_lama = $this->input->post('kelas_lama');
				if ($kelas_lama != '') {
					$this->model->update('tb_kelas',['id_guru'=>''],['id_kelas'=>$kelas_lama]);
				}
			}else {
				$pa = 'Y';
				$status = 'Y';
			}

			$user = [
				'level'		=> $this->input->post('level')
			];

			$data = [
				'id_user'	=> $this->input->post('id_user'),
				'nama'		=> $this->input->post('nama'),
				'email'		=> $this->input->post('email'),
				'pa'		=> $pa,
				'status'	=> $status
			];
			$where = ['id_user'=>$this->input->post('id_user')];
			$update = $this->model->update('tb_guru',$data,$where);
			if ($update) {
				$this->model->update('users',$user,$where);
				redirect('admin/dataguru');
			}else{}
		}elseif ($aksi == 'hapus') {
			$id_user = $this->input->post('id_user');
			$cekpa = $this->cekpa(['id_guru'=>$id_user]);

			if ($cekpa->id_guru != '') {

				$this->model->update('tb_kelas',['id_guru'=>''],['id_kelas'=>$cekpa->id_kelas]);
			}
			$this->model->hapus('users',['id_user'=>$id_user]);
			redirect('admin/dataguru');
		}
	}

	public function editguru(){
		$id_user = $_POST['id_user'];
		$where = ['tb_guru.id_user'=>$id_user];
		$output = array();
		$join = array();
		$join['1'] = $this->db->join('tb_kelas', 'tb_guru.id_user = tb_kelas.id_guru', 'left');
		$join['2'] = $this->db->join('users', 'tb_guru.id_user = users.id_user', 'left');
		$guru = $this->model->tampil('tb_guru',$where,$join)->result();
			foreach ($guru as $row) {
			$output['id_user'] = $row->id_user;
			$output['nama'] = $row->nama;
			$output['id_kelas'] = $row->id_kelas;
			$output['nama_kelas'] = $row->nama_kelas;
			$output['email'] = $row->email;
			$output['level'] = $row->level;
			$output['status'] = $row->status;
		}
		echo json_encode($output);
	}
	// End Admin Guru

	//Admin Siswa
	public function datasiswa(){
		$join = array();
		$join['1'] = $this->db->join('tb_ortu', 'tb_siswa.id_ortu = tb_ortu.id_ortu', 'left');
		$join['2'] = $this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas', 'left');
		$siswa = $this->model->tampil('tb_siswa', ['status'=>1], $join)->result();
		$kelas = $this->model->tampil('tb_kelas')->result();
		$kode = $this->model->buatid('siswa');
		$data = ['siswa'=>$siswa,'kode'=>$kode,'kelas'=>$kelas];
		$this->template->admin('admin/datasiswa', $data);
	}

	public function aksisiswa($aksi){
		$data = [
			'id_user'		=>$this->input->post('id_user'),
			'nama_siswa'	=>$this->input->post('nama'),
			'email'			=>$this->input->post('email'),
			'id_kelas'		=>$this->input->post('kelas')
		];
		if ($aksi == 'tambah') {
			$user = [
				'id_user'	=>$this->input->post('id_user'),
				'password'	=>md5('smkn1@solok'),
				'level'		=>4
			];

			$query = $this->model->tambah('users',$user);
			if ($query) {
				$this->model->tambah('tb_siswa',$data);
				redirect('admin/datasiswa');
			}
		}elseif($aksi == 'edit'){
			$query = $this->model->update('tb_siswa',$data,['id_user'=>$data['id_user']]);
			if ($query) {
				redirect('admin/datasiswa');
			}else{}
		}elseif ($aksi == 'hapus') {
			$where = ['id_user'=>$this->input->post('id_user')];
			$query = $this->model->hapus('users', $where);
			if ($query) {
				redirect('admin/datasiswa');
			}else{}
		}
	}

	public function editsiswa(){
		$id_user = $_POST['id_user'];
		$where = ['id_user'=>$id_user];
		$output = array();
		$join = array();
		$join['1'] = $this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas', 'left');
		$siswa = $this->model->tampil('tb_siswa',$where,$join)->result();
			foreach ($siswa as $row) {
			$output['id_user'] = $row->id_user;
			$output['nama'] = $row->nama_siswa;
			$output['id_kelas'] = $row->id_kelas;
			$output['nama_kelas'] = $row->nama_kelas;
			$output['email'] = $row->email;
		}
		echo json_encode($output);
	}
	// End Admin Siswa 

	// Admin Kategori
	public function aksikategori($aksi){
		$data = [
				'id_kelompok'		=> $this->input->post('kelompok'),
				'nama_kategori'		=> $this->input->post('nama_kategori'),
				'keterangan'		=> $this->input->post('deskripsi')			];
		if ($aksi == 'tambah') {
			$query = $this->model->tambah('tb_kategori', $data);
			if ($query == TRUE) {
				redirect('admin/tatatertib');
			}else{
				redirect('admin/tatatertib');
			}
		}elseif ($aksi == 'edit') {
			$where = ['id_kategori'=> $this->input->get_post('id_kategori')];
			$query = $this->model->update('tb_kategori', $data, $where);
			if ($query == TRUE) {
				redirect('admin/tatatertib');
			}else{}
		}elseif ($aksi == 'hapus') {
			$where = ['id_kategori'=> $this->input->get_post('id')];
			$query = $this->model->hapus('tb_kategori', $where);
			if ($query == TRUE) {
				redirect('admin/tatatertib');
			}else{}	
		}	
	}

	public function editkategori(){
		$id_kategori = $_POST['id_kategori'];
		$where = ['id_kategori'=>$id_kategori];
		$output = array();
		$kategori = $this->model->tampil('tb_kategori',$where)->result();
			foreach ($kategori as $row) {
			$output['id_kategori'] = $row->id_kategori;
			$output['kelompok'] = $row->id_kelompok;
			$output['nama_kategori'] = $row->nama_kategori;
			$output['keterangan'] = $row->keterangan;
		}
		echo json_encode($output);
	}
	//End Admin Kategori

	// Admin Tata Tertib
	public function tatatertib(){
		$kategori = $this->model->tampil('tb_kategori')->result();
		$join =array();
		$join['1'] = $this->db->join('tb_kategori', 'tb_tata_tertib.id_kategori = tb_kategori.id_kategori', 'left');
		$tatatertib = $this->model->tampil('tb_tata_tertib',NULL,$join)->result();
		$data=['kategori'=>$kategori,'tatatertib'=>$tatatertib];
		$this->template->admin('admin/tatatertib',$data);
	}

	public function aksitatatertib($aksi){
		$data = [
				'nama_tata_tertib'		=> $this->input->post('nama_tata_tertib'),
				'deskripsi'				=> $this->input->post('deskripsi'),
				'id_kategori'			=>$this->input->post('kategori'),
				'hukuman'				=>$this->input->post('hukuman'),
				'level'					=>$this->input->post('level')
			];
		if ($aksi == 'tambah') {
			$query = $this->model->tambah('tb_tata_tertib', $data);
			if ($query == TRUE) {
				redirect('admin/tatatertib');
			}else{
				redirect('admin/tatatertib');
			}
		}elseif ($aksi == 'edit') {
			$where = ['id_tata_tertib'=> $this->input->get_post('id_tata_tertib')];
			$query = $this->model->update('tb_tata_tertib', $data, $where);
			if ($query == TRUE) {
				redirect('admin/tatatertib');
			}else{}
		}elseif ($aksi == 'hapus') {
			$where = ['id_tata_tertib'=> $this->input->get_post('id')];
			$query = $this->model->hapus('tb_tata_tertib', $where);
			if ($query == TRUE) {
				redirect('admin/tatatertib');
			}else{}	
		}	
	}

	public function edittatatertib(){
		$id_tata_tertib = $_POST['id_tata_tertib'];
		$where = ['id_tata_tertib'=>$id_tata_tertib];
		$output = array();
		$join =array();
		$join['1'] = $this->db->join('tb_kategori', 'tb_tata_tertib.id_kategori = tb_kategori.id_kategori', 'left');
		$tatatertib = $this->model->tampil('tb_tata_tertib',$where,$join)->result();
			foreach ($tatatertib as $row) {
			$output['id_tata_tertib'] = $row->id_tata_tertib;
			$output['nama_tata_tertib'] = $row->nama_tata_tertib;
			$output['deskripsi'] = $row->deskripsi;
			$output['id_kategori'] = $row->id_kategori;
			$output['kategori'] = $row->nama_kategori;
			$output['hukuman'] = $row->hukuman;
			$output['level'] = $row->level;
		}
		echo json_encode($output);
	}
	//End Admin Tata Tertib

	// Admin Pelanggaran
	public function pelanggaran(){
		$join =array();
		$join['1'] = $this->db->join('tb_tata_tertib', 'tb_pelanggaran.id_tata_tertib = tb_tata_tertib.id_tata_tertib', 'left');
		$join['2'] = $this->db->join('tb_siswa', 'tb_siswa.id_user = tb_pelanggaran.id_siswa', 'left');
		$join['3'] = $this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas', 'left');
		$join['4'] = $this->db->join('tb_kategori', 'tb_kategori.id_kategori=tb_tata_tertib.id_kategori', 'left');
		$this->db->order_by('tb_pelanggaran.tanggal', 'desc');
		$pelanggaran = $this->model->tampil('tb_pelanggaran',NULL,$join)->result();
		$kelas = array();
		$kelas['1'] = $this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas', 'left');
		$siswa = $this->model->tampil('tb_siswa',NULL,$kelas)->result();
		$kategori = $this->model->tampil('tb_kategori')->result();
		$data = ['pelanggaran'=>$pelanggaran,'siswa'=>$siswa,'kategori'=>$kategori];
		$this->template->admin('admin/pelanggaran',$data);
	}

	public function aksipelanggaran($aksi){
		if ($aksi == 'tambah') {
			$tanggal = nice_date($_POST['tanggal'], 'Y-m-d');
			$data = [
				'id_siswa'					=> $this->input->post('siswa'),
				'id_tata_tertib'			=> $this->input->post('pelanggaran'),
				'deskripsi_pelanggaran'		=> $this->input->post('keterangan'),
				'tindakan'					=> $this->input->post('tindakan'),
				'tanggal'					=> $tanggal,
				'status'					=> 2
			];
			$join['1'] = $this->db->join('tb_ortu', 'tb_siswa.id_ortu = tb_ortu.id_ortu', 'left');
			$ortu = $this->model->tampil('tb_siswa',['id_user'=>$_POST['siswa']],$join)->row();
			$query = $this->model->tambah('tb_pelanggaran', $data);
			if ($query == TRUE) {
				if ($ortu->email_ortu != '') {
					$email = array();
					$email['tujuan']	= $ortu->email_ortu;
					$email['isi']		= $this->load->view('init/email',['ortu'=>$ortu, 'data'=>$data], TRUE);
					$this->kirim_email($email);
					$pesan = "Hari ini ".$ortu->nama_siswa."melakukan pelanggaran Tata Tertib disekolah. ".$ortu->nama_siswa.' '
							.$data['deskripsi_pelanggaran']."
							Selengkapnya ".base_url();
						;
					kirim_sms($ortu->telepon, $pesan);
				}
				redirect('admin/pelanggaran');
			}else{}
		}
	}

	public function datapelanggaran(){
		$id_kategori = $this->input->post('id_kategori');
		$data = $this->model->tampil('tb_tata_tertib',['id_kategori'=>$id_kategori])->result();
		echo json_encode($data);
	}

	public function detailpelanggaran(){
    	$join =array();
		$join['1'] = $this->db->join('tb_tata_tertib', 'tb_pelanggaran.id_tata_tertib = tb_tata_tertib.id_tata_tertib', 'left');
		$join['2'] = $this->db->join('tb_siswa', 'tb_siswa.id_user = tb_pelanggaran.id_siswa', 'left');
		$join['3'] = $this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas', 'left');
		$join['4'] = $this->db->join('tb_kategori', 'tb_kategori.id_kategori=tb_tata_tertib.id_kategori', 'left');
		$where = ['tb_pelanggaran.id_pelanggaran'=>$_POST['id_pelanggaran']];
		$row = $this->model->tampil('tb_pelanggaran',$where,$join)->row();
		$output = array();
		if ($row) {
			$output['nama_siswa'] 			= $row->nama_siswa;
			$output['pelanggaran'] 			= $row->deskripsi_pelanggaran;
			$output['level']				= $row->level;
			$output['sekolah'] 				= $row->hukuman; 
			$output['tindakan'] 			= $row->tindakan; 
			$output['deskripsi'] 			= $row->deskripsi; 
		}

		echo json_encode($output);
    }

    public function rekap_pelanggaran($id_siswa){
    	$join = array();
    	$join['1'] = $this->db->join('tb_siswa', 'tb_siswa.id_user = tb_pelanggaran.id_siswa', 'left');
    	$join['2'] = $this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas', 'left');
    	$join['3'] = $this->db->join('tb_tata_tertib', 'tb_tata_tertib.id_tata_tertib = tb_pelanggaran.id_tata_tertib', 'left');
    	$join['4'] = $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_tata_tertib.id_kategori', 'left');
    	$where = ['tb_pelanggaran.id_siswa'=>$id_siswa];
    	$this->db->order_by('tb_tata_tertib.level', 'ASC');
    	$rekap = $this->model->tampil('tb_pelanggaran',$where,$join)->result();
    	$join1 = $this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas', 'left');
    	$siswa = $this->model->tampil('tb_siswa',['id_user'=>$id_siswa],$join1)->row();

    	$biasa = $this->model->hitung(['tb_tata_tertib.level'=>3,'tb_pelanggaran.id_siswa'=>$id_siswa]);
    	$menengah = $this->model->hitung(['tb_tata_tertib.level'=>2,'tb_pelanggaran.id_siswa'=>$id_siswa]);
    	$berat = $this->model->hitung(['tb_tata_tertib.level'=>1,'tb_pelanggaran.id_siswa'=>$id_siswa]);

    	$biasaX = $this->model->hitung(['tb_tata_tertib.level'=>3,'tb_pelanggaran.id_siswa'=>$id_siswa,'
    			  tb_pelanggaran.status'=>2]);
    	$menengahX = $this->model->hitung(['tb_tata_tertib.level'=>2,'tb_pelanggaran.id_siswa'=>$id_siswa,'
    			  tb_pelanggaran.status'=>2]);
    	$beratX = $this->model->hitung(['tb_tata_tertib.level'=>1,'tb_pelanggaran.id_siswa'=>$id_siswa,'
    			  tb_pelanggaran.status'=>2]);

    	$data = ['rekap'=>$rekap,'siswa'=>$siswa,'biasa'=>$biasa,'berat'=>$berat,'menengah'=>$menengah,
    			 'biasaX'=>$biasaX,'beratX'=>$beratX,'menengahX'=>$menengahX
    	];
    	$this->template->admin('admin/rekap-pelanggaran', $data);
    }
    // End Admin Pelanggaran

    // Admin Pemberitahuan Orang Tua
    public function datapanggilan(){
    	$this->model->cek_tanggal_panggilan();

    	$join = array();
    	$join['1'] = $this->db->join('tb_siswa', 'tb_siswa.id_user = tb_panggilan_ortu.id_siswa', 'left');
    	$join['2'] = $this->db->join('tb_ortu', 'tb_ortu.id_ortu = tb_panggilan_ortu.id_ortu', 'left');
    	$panggilan = $this->model->tampil('tb_panggilan_ortu',['aktif'=> 'Y'],$join)->result();
    	$data = ['panggilan'=>$panggilan];
    	$this->template->admin('admin/datapanggilan', $data);
    }

    public function detailpanggilan(){
    	$join =array();
		$join['1'] = $this->db->join('tb_ortu', 'tb_panggilan_ortu.id_ortu = tb_ortu.id_ortu', 'left');
		$join['2'] = $this->db->join('tb_siswa', 'tb_siswa.id_user = tb_panggilan_ortu.id_siswa', 'left');
		$where = ['tb_panggilan_ortu.id_panggilan'=>$_POST['id_panggilan']];
		$row = $this->model->tampil('tb_panggilan_ortu',$where,$join)->row();
		$output = array();
		if ($row) {
			$output['nama_siswa'] 			= $row->nama_siswa;
			$output['id_siswa'] 			= $row->id_siswa;
			$output['nama_ortu'] 			= $row->nama_ortu;
			$output['id_ortu'] 				= $row->id_ortu;
			$output['tanggal_panggil']		= nice_date($row->tanggal_panggil,'d M Y');
			$output['tanggal_hadir'] 		= nice_date($row->tanggal_hadir,'d M Y');
			$output['no_panggilan'] 		= $row->no_panggilan; 
			$output['keterangan'] 			= $row->keterangan; 
			$output['status'] 				= $row->status_panggilan; 
		}

		echo json_encode($output);
    }

    private function updatepanggilan($id_siswa){
    	$this->model->update('tb_pelanggaran',['status'=>1],['id_siswa'=>$id_siswa]);
    	$this->model->update('tb_panggilan_ortu',['aktif'=>'N'],['id_siswa'=>$id_siswa]);
    }

    public function updatestatuspanggilan(){
    	$where 	= ['id_panggilan'=>$this->input->post('id_panggilan')];
    	$data 	= ['aktif'=> 'N', 'status_panggilan'=> $this->input->post('status')];
    	$this->model->update('tb_panggilan_ortu',$data,$where);
    	redirect('admin/datapanggilan');
    }

    public function kirimpanggilanortu(){
    	$tanggal = nice_date($_POST['tanggal'], 'Y-m-d');
    	$data = [
    		'id_siswa'			=> $this->input->post('id_siswa'),
    		'id_ortu'			=> $this->input->post('id_ortu'),
    		'tanggal_panggil'	=> date('Y-m-d'),
    		'tanggal_hadir'		=> $tanggal,
    		'no_panggilan'		=> $this->input->post('no_panggilan'),
    		'keterangan'		=> $this->input->post('keterangan')
    	];
    	$this->updatepanggilan($_POST['id_siswa']);
    	$query = $this->model->tambah('tb_panggilan_ortu',$data);
    	if ($query == TRUE) {
    		$join = array();
    		$join['1'] = $this->db->join('tb_siswa', 'tb_siswa.id_ortu = tb_ortu.id_ortu', 'left');
    		$ortu = $this->model->tampil('tb_ortu',['tb_ortu.id_ortu'=>$data['id_ortu']], $join)->row();
    		$pesan = "Selamat Pagi, Hari ini Bapak Akan Mendapatkan Surat Panggilan Orang Tua dari BK SMK Negeri 1 Solok. Panggilan Dilakukan karena "
    				.$ortu->nama_siswa." mencapai batas pelanggaran wajar.".
    				"Selengkapnya ".base_url();
    		kirim_sms($ortu->telepon,$pesan);
    		echo json_encode(['status'=>TRUE]);
    		redirect('admin/datapanggilan');
    	}else{
    		echo json_encode(['status'=>FALSE]);
    	}
    } 

    private function kirim_email($email){
        // Konfigurasi email.
        $config = [
               'useragent' => 'CodeIgniter',
               'protocol'  => 'smtp',
               'mailpath'  => '/usr/sbin/sendmail',
               'smtp_host' => 'ssl://smtp.gmail.com',
               'smtp_user' => 'bkita.smkn1solok@gmail.com',   // Ganti dengan email gmail Anda.
               'smtp_pass' => 'guntal123',             // Password gmail Anda.
               'smtp_port' => 465,
               'smtp_keepalive' => TRUE,
               'smtp_crypto' => 'SSL',
               'wordwrap'  => TRUE,
               'wrapchars' => 80,
               'mailtype'  => 'html',
               'charset'   => 'utf-8',
               'validate'  => TRUE,
               'crlf'      => "\r\n",
               'newline'   => "\r\n",
           ];
 
        // Load library email dan konfigurasinya.
        $this->load->library('email', $config);
 
        // Pengirim dan penerima email.
        $this->email->from('bkita.smkn1solok@gmail.com', 'BK smkn 1 solok');    // Email dan nama pegirim.
        $this->email->to($email['tujuan']);                       // Penerima email.
 
        // Lampiran email. Isi dengan url/path file.
        //$this->email->attach(base_url('asset/adminlte/dist/img/logo.jpg'));
 
        // Subject email.
        $this->email->subject('Laporan Harian Siswa');
 
        // Isi email. Bisa dengan format html.
        $this->email->message($email['isi']);
        $this->email->send();
    }
    // End Admin Pemberitahuan Orang Tua

    //Admin Administrator
    public function dataadmin(){
    	$this->db->join('users', 'tb_guru.id_user = users.id_user', 'left');
    	$this->db->order_by('nama', 'asc');
    	$admin = $this->model->tampil('tb_guru',['users.level'=>1])->result();
    	$data = ['admin'=>$admin];
    	$this->template->admin('admin/dataadmin',$data);
    }
    //End Admin Administrator
}