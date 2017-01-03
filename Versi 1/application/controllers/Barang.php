<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	function __construct()
	{
		parent:: __construct();
		$this->load->helper('form');
		$this->load->library('fpdf');
		$data = $this->session->userdata('logged_in');
		if (empty($data)) {
			redirect('/');
		}
	}

	public function generatorid($table)
	{
		return $table."-".date("Ymd")."-".rand(5,99999);
	}
	public function index()
	{
		$header['user_session'] = $this->session->userdata('logged_in');
		

		$config['base_url']        = base_url()."barang/index";
		$config['total_rows']      = $this->barang_model->count_all();
		$config['per_page']        = 5;
		$config['uri_segment']     = 3;
		$config['num_links']       = 3;
		$config['full_tag_open']   = '<p>';
		$config['full_tag_close']  = '</p>';
		$config['first_link']      = 'First';
		$config['first_tag_open']  = '<div>';
		$config['first_tag_close'] = '</div>';
		$config['last_link']       = 'Last';
		$config['last_tag_open']   = '<div>';
		$config['last_tag_close']  = '</div>';
		$config['next_link']       = '&gt;';
		$config['next_tag_open']   = '<div>';
		$config['next_tag_close']  = '</div>';
		$config['prev_link']       = '&lt;';
		$config['prev_tag_open']   = '<div>';
		$config['prev_tag_close']  = '</div>';
		$config['cur_tag_open']    = '<b>';
		$config['cur_tag_close']   = '</b>';
		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['barang_list']     = $this->barang_model->getAll($config['per_page'],$page);
		$data['link'] = $this->pagination->create_links();
		// echo var_dump($data['barang_list'],$data['link'], $config['base_url'] );die();

		// $this->load->helper('common_helper');
  //       $data['cbBulan'] = getMonthNames();
  //       $data['cbTahun'] = get5LastYears();
  //       $data['lap'] = 'lapPenjualanPerBulan';
         
  //       $this->validation->namaBulan = date('m');
  //       $this->validation->tahun = date('Y');

		$this->load->view('barang/barang_list', $data);
	}

	public function tambah()
	{
		$header['user_session'] = $this->session->userdata('logged_in');

		$this->load->view('barang/form_tambah_barang');
	}

	public function validField()
	{
		$this->form_validation->set_rules('namaBarang', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('jumlahBarang', 'Jumlah Barang', 'trim|required|numeric');
		$this->form_validation->set_rules('tglPembuatan', 'Tanggal Pembuatan', 'trim|required|date');
		$this->form_validation->set_rules('tglKadaluarsa', 'Tanggal Kadaluarsa', 'trim|required|date');
		$this->form_validation->set_rules('maxPersediaan', 'Maksimal Persediaan', 'trim|required|numeric');
		$this->form_validation->set_rules('minPersediaan', 'Minimal Persediaan', 'trim|required|numeric');
		$this->form_validation->set_rules('isiSatuan', 'Isi Satuan', 'trim|required|numeric');
		$this->form_validation->set_rules('hargaBeli', 'Haag Beli', 'trim|required|numeric');
		$this->form_validation->set_rules('hargaJual', 'Haag Jual', 'trim|required|numeric');

	}

	public function store()
	{
		$this->validField();
		if ($this->form_validation->run() == TRUE) {
			$newBarang = array(
				'id_barang'                 => $this->generatorid("BRG"),
				'nama_barang'               => $this->input->post('namaBarang'),
				'jumlah_barang'             => $this->input->post('jumlahBarang'),
				'tanggal_pembuatan_barang'  => $this->input->post('tglPembuatan'),
				'tanggal_kadaluarsa_barang' => $this->input->post('tglKadaluarsa'),
				'max_persediaan_barang'      => $this->input->post('maxPersediaan'),
				'min_persediaan_barang'      => $this->input->post('minPersediaan'),
				'isi_satuan'                => $this->input->post('isiSatuan'),
				'harga_beli'                => $this->input->post('hargaBeli'),
				'harga_jual'                => $this->input->post('hargaJual')
			);

		$this->barang_model->store($newBarang);
		redirect('barang');

		} else {
			$header['user_session'] = $this->session->userdata('logged_in');
			$this->load->view('header', $header);
			$this->load->view('barang/form_tambah_barang');
		}
		
	}

	public function ubah()
	{

		$header['user_session'] = $this->session->userdata('logged_in');
		$this->load->view('header', $header);
		
		$idBarang = $this->uri->segment(3);
		$data['barangEdit'] = $this->barang_model->getById($idBarang);
		$this->load->view('barang/form_edit_barang', $data);
	}

	public function update()
	{
		$this->validField();
		if ($this->form_validation->run() == TRUE) {
			$idBarang  = 	$this->input->post('idBarang');
			$newBarang = array(
				'nama_barang'               => $this->input->post('namaBarang'),
				'jumlah_barang'             => $this->input->post('jumlahBarang'),
				'tanggal_pembuatan_barang'  => $this->input->post('tglPembuatan'),
				'tanggal_kadaluarsa_barang' => $this->input->post('tglKadaluarsa'),
				'max_persediaan_barang'     => $this->input->post('maxPersediaan'),
				'min_persediaan_barang'     => $this->input->post('minPersediaan'),
				'isi_satuan'                => $this->input->post('isiSatuan'),
				'harga_beli'                => $this->input->post('hargaBeli'),
				'harga_jual'                => $this->input->post('hargaJual')
			);
		$this->barang_model->update($idBarang, $newBarang);
		redirect('barang');

		} else {
			$header['user_session'] = $this->session->userdata('logged_in');
			$this->load->view('header', $header);
			$this->load->view('barang/form_tambah_barang');
		}
	}

	public function hapus()
	{
		$idBarang = $this->uri->segment(3);
		$this->barang_model->delete($idBarang);
		redirect('barang'); 
	}

	public function cetak_pdf(){
		$dari_tanggal =$this->input->post('tanggal_dari');
		$sampai_tanggal = $this->input->post('tanggal_sampai');


		$data['barang'] = $this->barang_model->cetak_pdf($dari_tanggal, $sampai_tanggal);
		$this->load->view('barang/laporan_barang', $data);
	}

}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */