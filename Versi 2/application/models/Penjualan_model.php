<?php
/**
 * pada penjualan tidak dapa dilakukan penghapusan data
 * update data hanya dapat dilakukan oleh admin dalam situai tertentu
 * karena data yang telah masuk adlah dta yang bersifat penting tiap recordnya
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_model extends CI_Model {

	function __construct()
	{
		parent:: __construct();
	}

	public function count_all()
	{
		return $this->db->count_all();
	}

	public function getAll($offset, $total)	
	{
		$this->db->select('*');
		$this->db->from('t_penjualan');
		$this->db->join('userlogin', 't_penjualan.id_admin=userlogin.idUser');

		$this->db->order_by('tanggal_penjualan', 'desc');

		$query = $this->db->get('', $total, $offset);
		$result['data'] = $query->result();
		return $result;
	}

	public function getById($id)
	{
		$this->db->select('*');
		$this->db->where('id_penjualan', $id);
		$data = $this->db->get('t_penjualan');
		return $data->result();
	}
	
	public function store($object)
	{
		$this->db->insert('t_penjualan', $object);
	}

	public function update($id, $object)
	{
		$this->db->where('id_penjualan', $id);
		$this->db->update('t_penjualan', $object);
	}

	public function cetak_nota($id_penjualan){
		$nota = $this->db->query("SELECT * FROM t_penjualan a, detail_penjualan b, t_barang c
									WHERE a.id_penjualan = b.id_penjualan
									AND b.id_barang = c.id_barang
									AND a.id_penjualan = '$id_penjualan'
								");
		return $nota->result();
	}

	public function cetak_pdf($tanggal_dari, $tanggal_sampai){
		$query = $this->db->query("SELECT * FROM t_penjualan
									WHERE tanggal_penjualan
									BETWEEN '$tanggal_dari'
									AND '$tanggal_sampai'");
		return $query->result();
	}
}


/* End of file Penjualan_model.php */
/* Location: ./application/models/Penjualan_model.php */