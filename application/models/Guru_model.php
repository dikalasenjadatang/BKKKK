<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guru_model extends CI_Model {

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

	public function tambah($table, $data){
		$query = $this->db->insert($table, $data);
		if ($query) {
			return TRUE;
		}else{
			return FALSE;
		}
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

	public function hapus($table, $where){
		$this->db->where($where);
		$query = $this->db->delete($table);
		if ($query) {
			return TRUE;
		}else{
			return FALSE;
		}
	}

	
	public function buatid($user){
		if($user == 'ortu'){
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

	public function hitung($where){
		$this->db->select('tb_tata_tertib.level');
		$this->db->join('tb_tata_tertib', 'tb_tata_tertib.id_tata_tertib = tb_pelanggaran.id_tata_tertib', 'left');
		$this->db->join('tb_kategori', 'tb_kategori.id_kategori = tb_tata_tertib.id_kategori', 'left');
		$this->db->where($where);
		return $this->db->get('tb_pelanggaran')->num_rows();
	}
}

/* End of file Guru_model.php */
/* Location: ./application/models/Guru_model.php */