<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function tambah($table, $data){
		$query = $this->db->insert($table, $data);
		if ($query) {
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public function buatid($level){
		if ($level == 2) {
			$pref = 'G';
		}elseif($level == 4){
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

	public function cekAkun($data){
		$this->db->where($data);
		$query = $this->db->get('users');
		if ($query->num_rows() == 1) {
			$this->db->where($data);
			return $query->row();
		}else{
			return FALSE;
		}
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

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */
