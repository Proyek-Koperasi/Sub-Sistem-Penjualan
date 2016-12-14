<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

function __construct()
 {
   parent::__construct();
 }
 
 public function index()
 {
     $this->load->view('landingPage/login');
 }

 public function login()
 {
   //This method will have the credentials validation
 
   $this->form_validation->set_rules('username', 'Username', 'trim|required');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');
 
   if($this->form_validation->run() == FALSE){
    	$this->load->view('landingPage/login');
   }
   else{
   		$level = $this->input->post('level');
    	redirect('home');
   }
 
 }
 
 function check_database($password)
 {
   $username = $this->input->post('username');
   $level = $this->input->post('level');
 
   $result = $this->login_model->login($username, $password, $level);
 echo var_dump($result);
   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'id' => $row->idUser,
         'username' => $row->username
       );
       $this->session->set_userdata('logged_in', $sess_array);
     }
     return TRUE;
   }
   else
   {
     $this->form_validation->set_message('check_database', 'Invalid username or password');
     return false;
   }
 }
}
/* End of file Home.php */
/* Location: ./application/controllers/Home.php */