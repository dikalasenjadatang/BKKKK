<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function buatid($user){
		if ($user == 'guru') {
			$pref = 'G';
		}elseif($user == 'ortu'){
			$pref = 'O';
		}elseif($user == 'siswa'){
			$pref = 'S';
		}

		$this->db->select('RIGHT(users.id_user,9) as kode', FALSE);
		$this->db->order_by('id_user', 'desc');
		$this->db->limit(1);
		$query = $this->db->get('users');
		if ($query->num_rows() == 1) {
			$data = $query->row();
			$acak = rand(0, 9);
			$kode = intval($data->kode)+$acak;
		}else{
			$kode = 1;
		}

		$kodemax = str_pad($kode, 9, "0", STR_PAD_LEFT);
		$id_user = $pref.$kodemax;
		return $id_user;
	}

	public function tampil($table, $where = NULL, $join = NULL){
		if ($where) {
			$this->db->where($where);
		}elseif ($join) {
			$no = 1;
			foreach ($join as $data) {
				$data;
			}
		}
		return $this->db->get($table);
	}

	public function rekor(){
		$query = "SELECT tb_siswa.nama_siswa,tb_siswa.id_user, tb_kelas.nama_kelas, 
				  COUNT(tb_pelanggaran.id_pelanggaran) AS jumlah FROM tb_pelanggaran 
				  LEFT JOIN tb_siswa ON tb_siswa.id_user = tb_pelanggaran.id_siswa 
				  LEFT JOIN tb_kelas ON tb_kelas.id_kelas = tb_siswa.id_kelas 
				  GROUP BY tb_pelanggaran.id_siswa ORDER BY tb_siswa.nama_siswa ASC ";
		return $this->db->query($query);
	}

	public function update($table, $data, $where){
		$this->db->where($where);
		$query = $this->db->update($table, $data);
		if ($query) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function hitung($where){
		$this->db->select('tb_tata_tertib.level');
		$this->db->join('tb_tata_tertib', 'tb_tata_tertib.id_tata_tertib = tb_pelanggaran.id_tata_tertib', 'left');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_tata_tertib.id_kategori', 'left');
		$this->db->where($where);
		return $this->db->get('tb_pelanggaran')->num_rows();
	}

	public function tambah($table, $data){
		$query = $this->db->insert($table, $data);
		if ($query) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function hapus($table, $where){
		$this->db->where($where);
		$query = $this->db->delete($table);
		if ($query) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
	public function cek_tanggal_panggilan(){
		$tanggal = date('Y-m-d');
    	$query = $this->db->query("SELECT * FROM tb_panggilan_ortu WHERE tanggal_hadir < '$tanggal'");
    	if ($query->num_rows() >= 1) {
    		foreach ($query->result() as $row) {
    			$this->db->where('id_panggilan',$row->id_panggilan);
    			$this->db->update('tb_panggilan_ortu', ['status_panggilan'=>3]);
    		}
    	}
    }
}

/* End of file Admin_model.php */
/* Location: ./application/models/Admin_model.php */