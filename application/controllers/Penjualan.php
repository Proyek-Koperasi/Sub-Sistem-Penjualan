<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan extends CI_Controller {

	function __construct()
	{
		parent:: __construct();
		$this->load->library('fpdf');
	}
	public function index()
	{
		$this->load->view('penjualan');
	}

	/**
	 * search item :
	 * digunakan untuk mencari barang secara real time 
	 * pada saat kasir melakukan pencarian 
	 * berhubungan dengan ajax
	 *
	 * funsi in juga dikgunakan sebgai cek stok barang
	 */
	public function searchItem()
	{
		$idItem = $_POST['idItemSearch'];
		//load model search like berdasarkan id barang
		$data = $this->barang_model->searchBarang($idItem);
		echo json_encode($data);
	}

	/**
	 * menambahkan item pada list pembayaran
	 * barang yang akan dibeli 
	 */
	public function addToCart()
	{
		$idItem = $this->input->post('itemId');
		$items = $this->barang_model->getById($idItem);
		foreach ($items as $item) {
			$dataToCart = array(
				'id' => $item->id_barang,
				'name' => $item->nama_barang,
				'price' => $item->harga_jual,
				'qty' => $this->input->post('itemJumlah')
			);
			$this->cart->insert($dataToCart);
		}

		redirect('penjualan');
	}

	/**
	 * mengupdate data pada list pembayarn
	 * barang yang akan dibeli
	 * pengupdate-an berupa jumlah item yang dibeli 
	 */
	public function updateCart()
	{
		$i = 1;
		foreach ($this->cart->contents() as $items) {
				
			$data = array(
				'rowid' => $items['rowid'],
				'qty'   => $_POST[$i.'qty']
			);
			$i++;
			$this->cart->update($data);
		}
		redirect('penjualan');

	}
	/**
	 * menghapus item dari list pembayaran
	 * barang yang akan dibeli
	 */
	public function removeItemFromCart()
	{
		$rowId = $this->uri->segment(3);
		$this->cart->remove($rowId);
		redirect('penjualan');
	}
	/**
	 * load vie pembayaran
	 */
	public function pembayaran()
	{
		$this->load->view('penjualan/pembayaran');
	}

	public function proses_pembayaran()
	{
		/**
		 *
		 * prose penyimpana kedalam table penjualan
		 *
		 */
		$idPenjualan = "PJL-".date("Ymd")."-".rand(5, 9999);
		$dataPenjualan = array(
			'id_penjualan' => $idPenjualan,
			'tanggal_penjualan' => date('Y-m-d H:m:s'),
			'total_harga_penjualan' => $this->input->post('totalBayar'),
			'id_anggota' => $this->input->post('idAnggota'),
			'id_admin' => $this->session->userdata('logged_in')['id']
		);
		$this->penjualan_model->store($dataPenjualan);
		/**
		 * prose penyimpanan kedalam 
		 * table detile penjualan
		 */
		foreach ($this->cart->contents() as $item ) {
			$dataDetailPenjualan = array(
				'id_detail_penjualan' => $id = "DJL-".date("Ymd")."-".rand(5, 9999), 
				'id_barang' => $item['id'],
				'jumlah_barang' => $item['qty'],
				'harga_satuan' => $item['price'],
				'subtotal' => $item['subtotal'],
				'id_penjualan' => $idPenjualan
			);
			// echo var_dump($dataDetailPenjualan);
			$this->detail_penjualan_model->store($dataDetailPenjualan);
		}
		$this->cart->destroy();
		//total bayar
		$jumlah_bayar = $this->input->post('jumlahBayar');

		//cetak nota
		$this->cetak_nota_pdf($dataDetailPenjualan['id_penjualan'], $jumlah_bayar);
		
	}

//tambahan
	//cetak nota
	public function cetak_nota($id_penjualan, $jumlah_bayar){
		$data['jumlah_bayar'] = $jumlah_bayar;
		$data['nota'] = $this->penjualan_model->cetak_nota($id_penjualan);
		$this->load->view('penjualan/penjualan_nota', $data);
	}

	public function cetak_nota_pdf($id_penjualan, $jumlah_bayar){
		$this->load->helper('dompdf');

		$data['jumlah_bayar'] = $jumlah_bayar;
		$data['nota'] = $this->penjualan_model->cetak_nota($id_penjualan);

		$html = $this->load->view('penjualan/penjualan_nota_pdf', $data, true);

		$filename = 'Nota Pembelian Barang';
		$paper = 'A7';
		$orientation = 'portrait';
		$cetak = pdf_create($html, $filename, $paper, $orientation);	

		if ($cetak){
			redirect('penjualan');		
		}
		
	}

	public function data_penjualan(){
		$offset = $this->uri->segment(4, 0);
		$total = 8;
		$result = $this->penjualan_model->getAll($offset, $total);
		$pagination['base_url'] = base_url().'penjualan/index/';
		$pagination['total_rows'] = $this->penjualan_model->count_all();
		$pagination['full_tag_open'] = "<ul class='pagination pagination-sm' style='position:relative; top:-25px;'>";
		$pagination['full_tag_close'] ="</ul>";
		$pagination['num_tag_open'] = '<li>';
		$pagination['num_tag_close'] = '</li>';
		$pagination['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$pagination['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$pagination['next_tag_open'] = "<li>";
		$pagination['next_tagl_close'] = "</li>";
		$pagination['prev_tag_open'] = "<li>";
		$pagination['prev_tagl_close'] = "</li>";
		$pagination['first_tag_open'] = "<li>";
		$pagination['first_tagl_close'] = "</li>";
		$pagination['last_tag_open'] = "<li>";
		$pagination['last_tagl_close'] = "</li>";
		$pagination['per_page'] = $total;
		$pagination['uri_segment'] = 4;
		$pagination['num_links'] = 3;

		$this->pagination->initialize($pagination);

		$data['penjualan_list'] = $result['data'];
		$data['halaman'] = $this->pagination->create_links();
		
		$this->load->view('penjualan/penjualan_view', $data);
	}

	public function cetak_pdf(){
		$tanggal_dari = $this->input->post('tanggal_dari');
		$tanggal_sampai = $this->input->post('tanggal_sampai');

		$data['barang'] = $this->penjualan_model->cetak_pdf($tanggal_dari, $tanggal_sampai);
		$this->load->view('penjualan/laporan_penjualan', $data);
	}

}

/* End of file Penjualan.php */
/* Location: ./application/controllers/Penjualan.php */