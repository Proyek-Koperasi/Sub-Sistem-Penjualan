<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	// for pagination
	public function count_all()
		{
			return $this->db->count_all('t_anggota');
		}

	// for pagination
	public function getAll($start, $limit)
		{
			$this->db->select('*');
			$data = $this->db->get('t_anggota', $limit, $start);
			return $data->result();
		}
	// get by id for update
	public function getById($idAnggota)
		{
			$this->db->select('*');
			$this->db->where('id_anggota', $idAnggota);
			$data = $this->db->get('t_anggota');
			return $data->result();
		}	

	public function store($object)
		{
			$this->db->insert('t_anggota', $object);
		}

	public function update($idAnggota, $object)
		{
			$this->db->where('id_anggota', $idAnggota);
			$this->db->update('t_anggota', $object);
		}

	public function delete($idAnggota)
		{
			$this->db->where('id_anggota', $idAnggota);
			$this->db->delete('t_anggota');
		}

		public function cetak_pdf(){
		$query = $this->db->query("SELECT * FROM t_anggota")->result();
		return $query;
	}
}

/* End of file Anggota_model.php */
/* Location: ./application/models/Anggota_model.php */
