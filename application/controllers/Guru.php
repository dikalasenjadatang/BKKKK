<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cekLogin();
		$this->load->library('template');
		$this->load->model('Guru_model');
		$this->model = $this->Guru_model;
		$this->load->helper('date');
	}

	public function index(){
		$id_guru = $this->session->userdata('id_user');
		$cek_status 	= $this->cek_status();
		if ($cek_status->status == 'Y') {
			$kelas = $this->model->tampil('tb_kelas',['id_guru'=>$id_guru])->row();
		$siswa 			= $this->model->tampil('tb_siswa',['id_kelas'=>$kelas->id_kelas,'status'=>1])->num_rows();
		$pelanggaran 	= $this->hitungPelanggaran($kelas->id_kelas);
		$cekpass 		= $this->cek_password();
			$data 			= ['cekpass'=>$cekpass,'siswa'=>$siswa,'pelanggaran'=>$pelanggaran];
			$this->template->guru('guru/home',$data);
		}else{
			$this->load->view('init/nonaktif');
		}
	}

	private function cek_status(){
		$id_guru = $this->session->userdata('id_user');
		$this->db->select('status');
		$cek = $this->model->tampil('tb_guru', ['id_user'=>$id_guru])->row();
		return $cek;
	}

	private function hitungPelanggaran($kelas){
		$join = array();
		$join['1'] = $this->db->join('tb_siswa', 'tb_pelanggaran.id_siswa = tb_siswa.id_user', 'left');
		$where = ['tb_siswa.id_kelas'=>$kelas];
		return $this->model->tampil('tb_pelanggaran',$where, $join)->num_rows();
	}

	private function cek_password(){
		$where = ['id_user'=>$this->session->userdata('id_user')];
		$cek = $this->model->tampil('users',$where)->row();
		if ($cek->password == md5('smkn1@solok')) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	private function cekLogin(){
		if (empty($this->session->userdata('id_user'))) {
			redirect('user');
		}elseif ($this->session->userdata('level') != 2) {
			redirect('user');
		}
	}

	public function gantipassword(){
		$data = ['password'=>md5($this->input->post('password'))];
		$this->model->update('users',$data,['id_user'=>$this->session->userdata('id_user')]);
		redirect('guru');
	}

	public function datasiswa(){
		$join = array();
		$kelas = $this->model->tampil('tb_kelas',['id_guru'=>$this->session->userdata('id_user')])->row();
		$join['1'] = $this->db->join('tb_ortu', 'tb_siswa.id_ortu = tb_ortu.id_ortu', 'left');
		$siswa = $this->model->tampil('tb_siswa', ['id_kelas'=>$kelas->id_kelas,'status'=>1], $join)->result();
		$this->db->order_by('nama_ortu', 'asc');
		$ortu = $this->model->tampil('tb_ortu')->result();
		$kode = $this->model->buatid('siswa');
		$data = ['siswa'=>$siswa,'ortu'=>$ortu,'kode'=>$kode,'kelas'=>$kelas];
		$this->template->guru('guru/datasiswa', $data);
	}

	public function akunNonaktif(){
		if (isset($_POST['aktifkan'])) {
			$where = ['id_user'=>$this->input->post('id_user')];
			$data = ['status'=>$this->input->post('status')];
			$query = $this->model->update('tb_siswa', $data, $where);
			if ($query == TRUE) {
				redirect('guru/akunNonaktif?sukses');
			}else{
				redirect('guru/akunNonaktif?gagal');
			}
		}else{
			$join = array();
			$kelas = $this->model->tampil('tb_kelas',['id_guru'=>$this->session->userdata('id_user')])->row();
			$siswa = $this->model->tampil('tb_siswa', ['id_kelas'=>$kelas->id_kelas,'status'=>2], $join)->result();
			$data = ['siswa'=>$siswa,'kelas'=>$kelas];
			$this->template->guru('guru/akunNonaktif', $data);
		}
	}

	public function aksisiswa($aksi){
		if ($_POST['ortu'] == 'false') {
			$ortu = '';
		}else{
			$ortu = $this->input->post('ortu');
		}
		$data = [
			'id_user'		=>$this->input->post('id_user'),
			'nama_siswa'	=>$this->input->post('nama'),
			'email'			=>$this->input->post('email'),
			'id_kelas'		=>$this->input->post('kelas'),
			'id_ortu'		=>$ortu
		];
		if ($aksi == 'tambah') {
			$user = [
				'id_user'	=> $this->input->post('id_user'),
				'password'	=> md5('smkn1@solok'),
				'level'		=> 4
			];
			if ($this->model->tambah('users', $user) == TRUE) {
				$this->model->tambah('tb_siswa', $data);
				redirect('guru/datasiswa');
			}else{}
		}elseif ($aksi == 'edit') {
			$query = $this->model->update('tb_siswa',$data,['id_user'=> $_POST['id_user']]);
			if ($query == TRUE) {
				redirect('guru/datasiswa');
			}else{}
		}elseif ($aksi == 'hapus') {
			$query = $this->model->hapus('users',['id_user'=> $_POST['id_user']]);
			if ($query == TRUE) {
				redirect('guru/datasiswa');
			}else{}
		}
	}

	public function editsiswa(){
		$id_user = $_POST['id_user'];
		$where = ['id_user'=>$id_user];
		$output = array();
		$join = array();
		$join['1'] = $this->db->join('tb_ortu', 'tb_siswa.id_ortu = tb_ortu.id_ortu', 'left');
		$siswa = $this->model->tampil('tb_siswa',$where,$join)->result();
			foreach ($siswa as $row) {
			$output['id_user'] = $row->id_user;
			$output['nama'] = $row->nama_siswa;
			$output['email'] = $row->email;
			$output['nama_ortu'] = $row->nama_ortu;
			$output['id_ortu'] = $row->id_ortu;
		}
		echo json_encode($output);
	}

	public function aksiortu($aksi){
		$data = [
			'id_ortu'			=>$this->input->post('id_user'),
			'nama_ortu'			=>$this->input->post('nama'),
			'email_ortu'		=>$this->input->post('email'),
			'telepon'			=>$this->input->post('telepon')
		];

		if ($aksi == 'tambah') {
			$user = [
				'id_user'		=> $this->input->post('id_user'),
				'password'		=> md5('smkn1@solok'),
				'level'			=> 3
			];
			$cek = $this->model->tampil('tb_ortu',['telepon'=>$_POST['telepon']])->num_rows();
			if ($cek >= 1) {
				redirect('guru/dataortu?gagal');
			}else{
				$query = $this->model->tambah('users', $user);
				if ($query == TRUE) {
					$this->model->tambah('tb_ortu', $data);
					$anak = $_POST['anak'];
					foreach ($anak as $row) {
						$this->model->update('tb_siswa',['id_ortu'=>$data['id_ortu']],['id_user'=>$row]);
					}
					redirect('guru/dataortu');
				}else{}
			}
		}elseif ($aksi == 'edit') {
			$query = $this->model->update('tb_ortu',$data,['id_ortu'=>$data['id_ortu']]);
			if ($query == TRUE) {
				redirect('guru/dataortu');
			}else{}
		}elseif ($aksi == 'hapus-ortu') {
			$id_ortu = $this->input->post('id_user');
			$query = $this->model->update('tb_siswa',['id_ortu'=>''],['id_ortu'=>$id_ortu]);
			if ($query == TRUE) {
				$this->model->hapus('users',['id_user'=>$id_ortu]);
				redirect('guru/dataortu');
			}else{}
		}elseif ($aksi == 'hapus-anak') {
			$where = ['id_user'=>$this->input->post('id_user')];
			$query = $this->model->update('tb_siswa',['id_ortu'=>''],$where);
			if ($query == TRUE) {
				echo json_encode(['status'=>TRUE]);
			}else{}
		}elseif ($aksi == 'tambah-anak') {
			$id_ortu = $this->input->post('id_ortu');
			$id_siswa = $this->input->post('siswa');
			$query = $this->model->update('tb_siswa',['id_ortu'=>$id_ortu],['id_user'=> $id_siswa]);
			if ($query == TRUE) {
				redirect('guru/dataortu');
			}else{}
		}
	}

	public function dataortu(){
		$ortu = $this->model->tampil('tb_ortu')->result();
		$kode = $this->model->buatid('ortu');
		$kelas = $this->model->tampil('tb_kelas',['id_guru'=>$this->session->userdata('id_user')])->row();
		$siswa = $this->model->tampil('tb_siswa', ['id_kelas'=>$kelas->id_kelas])->result();
		$data = ['ortu'=>$ortu,'kode'=>$kode,'siswa'=>$siswa];
		$this->template->guru('guru/dataortu', $data);
	}

	public function editortu(){
		$id_user = $_POST['id_user'];
		$where = ['id_ortu'=>$id_user];
		$output = array();
		$join = array();
		$ortu = $this->model->tampil('tb_ortu',$where)->result();
			foreach ($ortu as $row) {
			$output['id_ortu'] = $row->id_ortu;
			$output['nama_ortu'] = $row->nama_ortu;
			$output['email_ortu'] = $row->email_ortu;
			$output['telepon'] = $row->telepon;
		}
		echo json_encode($output);
	}

	public function dataanak(){
		$id_ortu = $_POST['id_user'];
		$where = ['id_ortu'=>$id_ortu];
		$join = '';
		$join['1'] = $this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas', 'left');
		$query = $this->model->tampil('tb_siswa',$where,$join)->result();
		echo json_encode($query);
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

    	$data = ['rekap'=>$rekap,'siswa'=>$siswa,'biasa'=>$biasa,'berat'=>$berat,'menengah'=>$menengah
    	];
    	$this->template->guru('guru/rekap-pelanggaran', $data);
    }

	public function pelanggaran(){
		$id_guru = $this->session->userdata('id_user');
		$kelas = $this->model->tampil('tb_kelas',['id_guru'=>$id_guru])->row();
		$this->db->order_by('nama_siswa', 'asc');
		$siswa = $this->model->tampil('tb_siswa',['tb_siswa.id_kelas'=>$kelas->id_kelas])->result();
		$data = ['siswa'=>$siswa];
		$this->template->guru('guru/datapelanggaran',$data);
	}


	public function profil(){
		$id = $this->session->userdata('id_user');
		$join['1'] = $this->db->join('tb_guru', 'users.id_user = tb_guru.id_user', 'left');
		$join['2'] = $this->db->join('tb_kelas', 'users.id_user = tb_kelas.id_guru', 'left');
		$profil = $this->model->tampil('users',['users.id_user'=>$id],$join)->row();
		$data = ['profil'=>$profil];
		$this->template->guru('guru/profil', $data);
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
		$id_user 		= $this->input->post('id_user');
		$password 		=md5($this->input->post('konfirmasi'));
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
}