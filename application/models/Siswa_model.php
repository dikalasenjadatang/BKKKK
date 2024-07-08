<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa_model extends CI_Model {

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

}

/* End of file Siswa_model.php */
/* Location: ./application/models/Siswa_model.php */