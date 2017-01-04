<?php
/**
 *
 * home pnejualan untuk toko online
 *
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$data = $this->session->userdata('logged_in');
		if (empty($data)) {
			redirect('/');
		}
	}
	public function index()
	{
		/**
		 * header : menampuilkan sesion data user, username 
		 * shoping cart
		 */
		$headerData['user_session'] = $this->session->userdata('logged_in');
		//header view
		

		/**
		 * body : untuk menampilkandata yang terdapat di bagian utama
		 * aplikasi ini
		 */
		$config['base_url'] = 'url';
		$config['total_rows'] = $this->barang_model->count_all();
		$config['per_page'] = 16;
		$config['uri_segment'] = 3;
		$config['num_links'] = 3;
		$config['full_tag_open'] = '<p>';
		$config['full_tag_close'] = '</p>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<div>';
		$config['first_tag_close'] = '</div>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<div>';
		$config['last_tag_close'] = '</div>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<div>';
		$config['next_tag_close'] = '</div>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<div>';
		$config['prev_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<b>';
		$config['cur_tag_close'] = '</b>';
		
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$bodyData['product_list'] = $this->barang_model->getAll($config['per_page'], $page);
		$bodyData['pagination_link'] = $this->pagination->create_links();
		$this->load->view('home', $bodyData);
	}

	public function logout()
	{
		session_destroy();
		redirect('landing');
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */