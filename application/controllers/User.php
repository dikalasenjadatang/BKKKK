<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->model = $this->User_model;
	}
	public function index()
	{	
		if ($this->session->userdata('status')== 'masuk') {
			if ($this->session->userdata('level') == 1) {
				redirect('admin');
			}elseif ($this->session->userdata('level') == 2) {
				redirect('guru');
			}elseif ($this->session->userdata('level') == 3) {
				redirect('ortu');
			}elseif ($this->session->userdata('level') == 4) {
				redirect('siswa');
			}
		}else{
			$this->load->view('user/login');
		}
	}
	public function login(){
		$this->load->view('user/login');
	}
	public function keluar(){
		$this->session->sess_destroy();
		redirect('user');
	}

	public function cekuser(){
		$id_user = $this->input->get_post('id_user');
		$password = md5($this->input->get_post('password'));
		$userdata = ['id_user'=>$id_user,'password'=>$password];
		$data = $this->model->cekAkun($userdata);
		if ($data == FALSE) {
			redirect('user/login?gagal');
		}else{
			$userdata = [
							'id_user'=>$data->id_user,
							'level'=>$data->level,
							'status'=> 'masuk'
						];
			$this->session->set_userdata( $userdata );
			if ($this->session->userdata('level') == 1) {
				redirect('admin');
			}elseif ($this->session->userdata('level') == 2) {
				redirect('guru');
			}elseif ($this->session->userdata('level') == 3) {
				redirect('ortu');
			}elseif ($this->session->userdata('level') == 4) {
				redirect('siswa');
			}
		}
	}

	public function daftar(){
		if (isset($_POST['daftar'])) {
			$level = $this->input->post('level');
			$email = $this->input->post('email');
			$cek_email = $this->cek_email($level, $email);
			if ($cek_email >= 1) {
				redirect('user/daftar?gagal');
			}else{
				$user = [
					'id_user'		=> $this->input->post('id_user'),
					'password'		=> md5($this->input->post('password')),
					'level'			=> $level
				];
				if ($level == 2) {
					$data = [
						'id_user'		=> $this->input->post('id_user'),
						'nama'			=> $this->input->post('nama'),
						'email'			=> $email,
						'status'		=> 'N'
					];
					$table = 'tb_guru';
				}elseif ($level == 4) {
					$data = [
						'id_user'		=> $this->input->post('id_user'),
						'nama_siswa'	=> $this->input->post('nama'),
						'id_kelas'		=> $this->input->post('kelas'),
						'email'			=> $email,
						'status'		=> 2
					];
					$table = 'tb_siswa';
				}
				if ($this->model->tambah('users', $user) == TRUE) {
					$this->model->tambah($table, $data);
					$email = array();
					$email['tujuan']	= $_POST['email'];
					$email['isi']		= 'User Id Bkita Akun Kamu : '.$_POST['id_user'];
					$this->email_id($email);
					$redirect = 'user/login?berhasil='.$_POST['id_user'];
					redirect($redirect);
				}else{
					redirect('user/daftar?gagal');
				}
			}
		}else{
			$jurusan = $this->model->tampil('tb_jurusan')->result();
			$data = ['jurusan'=>$jurusan];
			$this->load->view('user/daftar',$data);
		}
	}

	private function cek_email($level, $email){
		if ($level == 2) {
			$table = 'tb_guru';
		}elseif ($level == 4) {
			$table = 'tb_siswa';
		}
		$query = $this->model->tampil($table, ['email'=>$email]);
		return $query->num_rows();
	}

	public function minta_id(){
		$level = $this->input->post('level');
		$kode = $this->model->buatid($level);
		echo json_encode(['id_user'=>$kode]);
	}

	public function datakelas(){
		$id_jurusan = $_POST['id_jurusan'];
		$where = ['id_jurusan'=>$id_jurusan];
		$data = $this->model->tampil('tb_kelas',$where)->result();
		echo json_encode($data);
	}

	public function email_id($email){
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
        return TRUE;
    }

}
