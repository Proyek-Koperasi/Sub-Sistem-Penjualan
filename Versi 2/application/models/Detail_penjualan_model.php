<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail_penjualan_model extends CI_Model {

	function __construct()
	{
		parent:: __construct();
	}

	public function store($object)
	{
		$this->db->insert('detail_penjualan', $object);
	}

	/**
	 * mengambi data detail penjualan
	 * berdasarkan id penjualan
	 */
	public function getByIdPenjualan($idPenjualan, $limit, $start)
	{
		$this->db->select('*');
		$this->db->where('id_penjualan', $idPenjualan);
		$data = $$this->db->get('detail_penjualan', $limit, $start);
		return $data->result();
	}

	public function update_stok($id_barang, $jumlah_barang){
		$query = $this->db->query("UPDATE t_barang
										SET jumlah_barang=jumlah_barang-$jumlah_barang
										WHERE id_barang='$id_barang'");
		return $query;
	}

	
}

/* End of file Detail_penjualan_model.php */
/* Location: ./application/models/Detail_penjualan_model.php */