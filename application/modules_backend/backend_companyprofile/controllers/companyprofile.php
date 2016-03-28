<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Companyprofile extends MY_Admin {
	private $_template 			= 'template_admin/main';
	private $_module_controller = 'backend_companyprofile/companyprofile/';
	private $_table_name 		= 'companyprofile';
	private $_table_field_pref 	= 'cpr_';
	private $_table_pk 			= 'cpr_id';
	private $_model_crud 		= 'crud_model';

	private $_page_title 		= 'Layanan : Admin Company Profile';
	private $_page_content_info	= array(
		'title' => 'Data Admin Company Profile',
		'desc' 	=> 'List Company Profile',
	);

	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('admin_id')) {
			redirect('backend_login/login');
			exit();
		}

		$this->_data['nav_active'] = "User Admin";
		$this->load->model($this->_model_crud,'crudmodel');
	}
	
	function index() {
		$this->lists();
	}

	function lists() {
		$this->_data['info_page'] = $this->_page_content_info;

		//using lib template
		$this->template->set('title', $this->_page_title);
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load($this->_template, 'lists', $this->_data);
	}
	
}

?>