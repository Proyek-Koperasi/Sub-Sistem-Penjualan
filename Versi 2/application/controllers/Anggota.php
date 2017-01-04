<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

	function __construct()
	{
		parent:: __construct();
		$this->load->library('fpdf');
	}
	public function index()
	{
		$this->load->library('pagination');
		
		$config['base_url']        = base_url()."anggota/index";
		$config['total_rows']      = $this->db->count_all();
		$config['per_page']        = 10;
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

		$dataBody['anggota_list'] = $this->anggota_model->getAll($config['per_page'], $page);
		$dataBody['link']         = $this->pagination->create_links();

		$this->load->view('anggota/anggota_list', $dataBody);
	}

	public function tambah()
	{
		$this->load->view('anggota/form_tambah_anggota');
	}

	public function validField()
	{
		$this->form_validation->set_rules('namaAnggota', 'Nama Anggota', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[8]|max_length[20]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[20]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
		$this->form_validation->set_rules('noTelp', 'nomor Telpon', 'trim|required|numeric');
		$this->form_validation->set_rules('hakAkses', 'Hak Akses', 'trim|required');
	}

	public function store()
	{
		$this->validField();
		if ($this->form_validation->run() == TRUE) {
			$dataAnggota = array(
					'id_anggota'=> "AGT-".date("Ymd")."-".rand(5, 99999),
					'nama_anggota' => $this->input->post('namaAnggota'),
					'username_anggota' => $this->input->post('username'),
					'password_anggota' => $this->input->post('password'),
					'alamat_anggota' => $this->input->post('alamat'),
					'telp_anggota' => $this->input->post('noTelp'),
					'hak_akses' => $this->input->post('hakAkses'),
				);

			$this->anggota_model->store($dataAnggota);
			redirect('anggota');
		} else {
			$this->load->view('anggota/form_tambah_anggota');
		}
	}

	public function ubah()
	{
		$id = $this->uri->segment(3);
		$dataBody['editAnggota'] = $this->anggota_model->getById($id);
		$this->load->view('anggota/form_edit_anggota', $dataBody);
	}

	public function update()
	{
		$this->validField();
		if ($this->form_validation->run() == TRUE) {
			$idAnggota = $this->input->post('idAnggota');
			$dataAnggota = array(
					'nama_anggota' => $this->input->post('namaAnggota'),
					'username_anggota' => $this->input->post('username'),
					'password_anggota' => $this->input->post('password'),
					'alamat_anggota' => $this->input->post('alamat'),
					'telp_anggota' => $this->input->post('noTelp'),
					'hak_akses' => $this->input->post('hakAkses'),
				);

			$this->anggota_model->update($idAnggota,$dataAnggota);
			redirect('anggota');
		} else {
			$this->load->view('anggota/form_edit_anggota');
		}
	}

	public function hapus()
	{
		$idAnggota = $this->uri->segment(3);
		$this->anggota_model->delete($idAnggota);
		redirect('anggota');
	}

	public function cetak_pdf(){
		$data['anggota'] = $this->anggota_model->cetak_pdf();
		$this->load->view('anggota/laporan_anggota', $data);
	}

}

/* End of file Anggota.php */
/* Location: ./application/controllers/Anggota.php */