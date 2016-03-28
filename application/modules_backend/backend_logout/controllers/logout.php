<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends MY_Admin {
	
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('admin_id')) {
			redirect('backend/login');
			exit();
		}
	}
	
	function index() {
		$this->logout();
	}
	
	function logout(){
		$this->load->model('crud_model', 'crudmodel');
		$this->crudmodel->log_userlog_logout($this->session->userdata('admin_id'));

		$data = array(
			'admin_id' 					=> '',
			'admin_username' 			=> '',
			'admin_role' 				=> '',
		);
		
		$this->session->unset_userdata($data);
		//$this->session->sess_destroy();
		
		redirect('backend/login');
		exit();
	}
	
}

?>