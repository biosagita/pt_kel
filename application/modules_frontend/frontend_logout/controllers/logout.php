<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends MY_Frontend {
	
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('login_id')) {
			redirect('login');
			exit();
		}
	}
	
	function index() {
		$this->logout();
	}
	
	function logout(){
		$this->load->model('frontend_model', 'frontendmodel');
		$this->frontendmodel->log_userlog_logout($this->session->userdata('login_id'));

		$data = array(
			'login_id' 					=> '',
			'login_username' 			=> '',
			'login_role' 				=> '',
		);
		
		$this->session->unset_userdata($data);
		//$this->session->sess_destroy();
		
		redirect('login');
		exit();
	}
	
}

?>