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

	
}

/* End of file Detail_penjualan_model.php */
/* Location: ./application/models/Detail_penjualan_model.php */