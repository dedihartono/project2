<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kategori_obat extends CI_Model {

	public function __construct() {

		parent::__construct();

			$this->load->database();
	}

	public function get($id = null)
	{
		if (!is_null($id)) {

			$query = $this->db->select('*')->from('tb_kategori')->where('id_kategori', $id)->get();
		
			if ($query->num_rows() === 1) {

				return $query->result_array();
			
			}

			return false;
		}

		$query = $this->db->select('*')->from('tb_kategori')->get();


		if ($query->num_rows() > 0) {

			return $query->result_array();

		}

			return false;

	}

	public function save($kategori)
	{
		
		$this->db->set($this->_setKategori($kategori))->insert('tb_kategori');

		if ($this->db->affected_rows() === 1) {
			
			return true; //$this->db->insert_id();
		
		}

		return false;

	}

	public function update($id, $kategori)
	{
		
		$this->db->set($this->_setKategori($kategori))->where('id_kategori', $id)->update('tb_kategori');

		if ($this->db->affected_rows() === 1) {
			
			return true;
		
		}

		return false;

	}

	public function delete($id)
	{

		$this->db->where('id_kategori', $id)->delete('tb_kategori');
	
		if ($this->db->affected_rows() === 1) {
			
			return true;
		
		}

		return false;

	}

	private function _setKategori($kategori)
	{
		return array(

			'id_kategori' 	=> $kategori['id_kategori'],
			'kategori' 		=> $kategori['kategori'],
		
		);
	}	

}
