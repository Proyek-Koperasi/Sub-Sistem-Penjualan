<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {

	function __construct()
	{
		parent:: __construct();
	}

	public function count_all()
	{
		return $this->db->count_all();
	}

	public function getAll($limit,$start)
	{
		$this->db->select('*');	
		$data = $this->db->get('t_barang',$limit, $start);
		return $data->result();
	}

	public function getById($id)
	{
		$this->db->select('*');
		$this->db->where('id_barang', $id);
		$data = $this->db->get('t_barang');
		return $data->result();
	}

	public function store($object)
	{
		$this->db->insert('t_barang', $object);
	}

	public function update($id, $object)
	{
		$this->db->where('id_barang', $id);
		$this->db->update('t_barang', $object);
	}

	public function delete($id)
	{
		$this->db->where('id_barang', $id);
		$this->db->delete('t_barang');
	}

	public function cetak_pdf($dari_tanggal, $sampai_tanggal){
		$query = $this->db->query("SELECT * FROM t_barang 
									WHERE tanggal_pembuatan_barang
									BETWEEN '$dari_tanggal'
									AND '$sampai_tanggal'");
		return $query->result();
	}

}

/* End of file Barang_model.php */
/* Location: ./application/models/Barang_model.php */