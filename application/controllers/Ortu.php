<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ortu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cekLogin();
		$this->load->library('template');
		$this->load->model('Ortu_model');
		$this->model = $this->Ortu_model;
		$this->load->helper('date');
	}
	public function index(){
		$anak 			= $this->model->tampil('tb_siswa',['id_ortu'=>$this->session->userdata('id_user')])->num_rows();
		$pelanggaran 	= $this->hitungPelanggaran();
		$cekpass 		= $this->cek_password();
		$cekpanggilan 	= $this->cekpanggilan();
		$data 			= ['cekpass'=>$cekpass,'cekpanggilan'=>$cekpanggilan,'anak'=>$anak,'pelanggaran'=>$pelanggaran];
		$this->template->ortu('ortu/home',$data);
	}

	private function cekLogin(){
		if (empty($this->session->userdata('id_user'))) {
			redirect('user');
		}elseif ($this->session->userdata('level') != 3) {
			redirect('user');
		}
	}

	private function hitungPelanggaran(){
		$join = array();
		$join['1'] = $this->db->join('tb_siswa', 'tb_pelanggaran.id_siswa = tb_siswa.id_user', 'left');
		$where = ['tb_siswa.id_ortu'=>$this->session->userdata('id_user')];
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

	private function cekpanggilan(){
		$where = ['id_ortu'=>$this->session->userdata('id_user'),'status_panggilan'=> 1];
		$cek = $this->model->tampil('tb_panggilan_ortu',$where);
		return $cek->num_rows();
	}
	public function gantipassword(){
		$data = ['password'=>md5($this->input->post('password'))];
		$this->model->update('users',$data,['id_user'=>$this->session->userdata('id_user')]);
		redirect('ortu');
	}
	public function datasiswa(){
		$id_ortu = $this->session->userdata('id_user');
		$join = array();
		$join['1'] = $this->db->join('tb_kelas', 'tb_siswa.id_kelas = tb_kelas.id_kelas', 'left');
		$siswa = $this->model->tampil('tb_siswa',['id_ortu'=>$id_ortu],$join)->result();
		$data = ['siswa'=>$siswa];
		$this->template->ortu('ortu/dataanak',$data);
	}

	public function detail(){
		$id_siswa = $_POST['id_siswa'];
		$tgl = date('m/d/Y');
		$where = ['id_siswa'=>$id_siswa,'tanggal'=>$tgl];
		$join = '';
		$join['1'] = $this->db->join('tb_tata_tertib', 'tb_pelanggaran.id_tata_tertib = tb_tata_tertib.id_tata_tertib', 'left');
		$join['2'] = $this->db->join('tb_kategori', 'tb_tata_tertib.id_kategori = tb_kategori.id_kategori', 'left');
		$join['3'] = $this->db->join('tb_siswa', 'tb_siswa.id_user = tb_pelanggaran.id_siswa', 'left');
		$query = $this->model->tampil('tb_pelanggaran',$where,$join);
		if ($query->num_rows() == 0) {
			echo json_encode(['status'=>FALSE]);
		}else{
			echo json_encode($query->result());
		}
	}

	public function rekap_pelanggaran($id_siswa){
    	$join = array();
    	$join['1'] = $this->db->join('tb_siswa', 'tb_siswa.id_user = tb_pelanggaran.id_siswa', 'left');
    	$join['2'] = $this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas', 'left');
    	$join['3'] = $this->db->join('tb_tata_tertib', 'tb_tata_tertib.id_tata_tertib = tb_pelanggaran.id_tata_tertib', 'left');
    	$join['4'] = $this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_tata_tertib.id_kategori', 'left');
    	$where = ['tb_pelanggaran.id_siswa'=>$id_siswa];
    	$this->db->order_by('tb_pelanggaran.tanggal', 'desc');
    	$this->db->order_by('tb_tata_tertib.level', 'ASC');
    	$rekap = $this->model->tampil('tb_pelanggaran',$where,$join)->result();
    	$join1 = $this->db->join('tb_kelas', 'tb_kelas.id_kelas = tb_siswa.id_kelas', 'left');
    	$siswa = $this->model->tampil('tb_siswa',['id_user'=>$id_siswa],$join1)->row();

    	$biasa = $this->model->hitung(['tb_tata_tertib.level'=>3,'tb_pelanggaran.id_siswa'=>$id_siswa]);
    	$menengah = $this->model->hitung(['tb_tata_tertib.level'=>2,'tb_pelanggaran.id_siswa'=>$id_siswa]);
    	$berat = $this->model->hitung(['tb_tata_tertib.level'=>1,'tb_pelanggaran.id_siswa'=>$id_siswa]);

    	$data = ['rekap'=>$rekap,'siswa'=>$siswa,'biasa'=>$biasa,'berat'=>$berat,'menengah'=>$menengah
    	];
    	$this->template->ortu('ortu/rekap-pelanggaran', $data);
    }

	public function pelanggaran(){
		$id_ortu = $this->session->userdata('id_user');
		$siswa = $this->model->tampil('tb_siswa',['id_ortu'=>$id_ortu])->result();
		$data = ['siswa'=>$siswa];
		$this->template->ortu('ortu/datapelanggaran',$data);
	}

	public function datapanggilan(){
		$this->db->order_by('tanggal_panggil', 'desc');
		$this->db->join('tb_siswa', 'tb_panggilan_ortu.id_siswa = tb_siswa.id_user', 'left');
		$panggilan = $this->model->tampil('tb_panggilan_ortu',['tb_panggilan_ortu.id_ortu'=>$this->session->userdata('id_user')])->result();
		$data = ['panggilan'=>$panggilan];
		$this->template->ortu('ortu/datapanggilan', $data);
	}

	public function detailpanggilan(){
		$join = $this->db->join('tb_siswa', 'tb_siswa.id_user = tb_panggilan_ortu.id_siswa', 'left');
		$where = ['tb_panggilan_ortu.id_panggilan'=>$_POST['id_panggilan']];
		$row = $this->model->tampil('tb_panggilan_ortu',$where,$join)->row();
		$output = array();
		if ($row) {
			$output['nama_siswa'] 			= $row->nama_siswa;
			$output['tanggal_panggil']		= nice_date($row->tanggal_panggil,'d M Y');
			$output['tanggal_hadir'] 		= nice_date($row->tanggal_hadir,'d M Y');
			$output['no_panggilan'] 		= $row->no_panggilan; 
			$output['keterangan'] 			= $row->keterangan; 
			$output['status'] 				= $row->status; 
		}

		echo json_encode($output);
    }

    public function profil(){
		$id = $this->session->userdata('id_user');
		$join['1'] = $this->db->join('tb_ortu', 'users.id_user = tb_ortu.id_ortu', 'left');
		$profil = $this->model->tampil('users',['users.id_user'=>$id],$join)->row();
		$data = ['profil'=>$profil];
		$this->template->ortu('ortu/profil', $data);
	}

	public function editprofil(){
		$where = ['id_user'=>$this->input->post('id_user')];
		$data = [
			'nama_ortu'			=> $this->input->post('nama'),
			'email_ortu'		=> $this->input->post('email'),
			'telepon'			=> $this->input->post('telepon')
		];
		if ($_POST['pass_baru'] != '') {
			$user = ['password'=>md5($this->input->post('pass_baru'))];
			$this->model->update('users',$user,$where);
		}
		$update = $this->model->update('tb_ortu',$data,['id_ortu'=>$_POST['id_user']]);
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

/* End of file Ortu.php */
/* Location: ./application/controllers/Ortu.php */