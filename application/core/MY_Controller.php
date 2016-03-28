<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends MX_Controller {
	var $_data;
	
	function __construct(){
		parent::__construct();

		$this->load->helper('main');
	}
}

class MY_Frontend extends MY_Controller {
	var $_data;
	
	function __construct(){
		parent::__construct();
		$this->config->load('assets');
		
		$path_web 				= $this->config->item('frontend');
		$this->_data['assets'] 	= site_url($path_web['assets']);

		$this->config->load('data_source');
    	$this->_data['general'] = $this->config->item('general');

		/* Url Home */
		$this->_data['url_home'] 		= site_url('/');

		$this->_data['url_login'] 		= site_url('login');
		$this->_data['url_logout'] 		= site_url('logout');

		$this->_data['login_username'] 		= $this->session->userdata('login_username');
		$this->_data['login_userlevel'] 	= $this->session->userdata('login_role');

		$this->_data['url_login'] 		= site_url('frontend_login/login');
	}
}

class MY_Admin extends MY_Controller {
	var $_data;
	
	function __construct(){
		parent::__construct();

		$this->config->load('assets');
		
		$path_web = $this->config->item('backstage');
		$this->_data['assets'] 	= site_url($path_web['assets']);
		
		/* Url Home */
		$this->_data['url_home'] 		= site_url('backend_adminusers/adminusers/lists');

		$this->_data['url_login'] 		= site_url('backend_login/login');
		$this->_data['url_logout'] 		= site_url('backend_logout/logout');

		$this->_data['admin_username'] 		= $this->session->userdata('admin_username');
		$this->_data['admin_userlevel'] 	= $this->session->userdata('admin_role');

		if($this->session->userdata('admin_role') == 'superadmin') {
			$this->_data['menu_sidebar'] 	= array(
				array(
					'label' => 'Setting',
					'child'	=> array(
						array(
							'label' => 'Company Profile',
							'url_link' => site_url('backend_companyprofile/companyprofile'),
						),
						array(
							'label' => 'User Admin',
							'url_link' => site_url('backend_adminusers/adminusers'),
						),
					),
				),
				array(
					'label' => 'Layanan',
					'child'	=> array(
						array(
							'label' => 'Grup layanan',
							'url_link' => site_url('backend_grouplayanan/grouplayanan'),
						),
						array(
							'label' => 'Daftar Layanan',
							'url_link' => site_url('backend_layanan/layanan'),
						),
						array(
							'label' => 'Persyaratan Layanan',
							'url_link' => site_url('backend_persyaratanlayanan/persyaratanlayanan'),
						),
						array(
							'label' => 'Sertifikat Layanan',
							'url_link' => site_url('backend_sertifikatlayanan/sertifikatlayanan'),
						),
						array(
							'label' => 'Template Sertifikat',
							'url_link' => site_url('backend_templatesertifikat/templatesertifikat'),
						),
						array(
							'label' => 'Group Nomor Sertifikat',
							'url_link' => site_url('backend_groupnomorsertifikat/groupnomorsertifikat'),
						),
						array(
							'label' => 'Daftar Tamu',
							'url_link' => site_url('backend_daftartamu/daftartamu'),
						),
						array(
							'label' => 'Daftar Tamu Non Layanan',
							'url_link' => site_url('backend_daftartamunonlayanan/daftartamunonlayanan'),
						),
					),
				),
				array(
					'label' => 'Report',
					'child'	=> array(
						array(
							'label' => 'Rekap Mingguan',
							'url_link' => site_url('backend_reportrekapmingguan/reportrekapmingguan'),
						),
						array(
							'label' => 'Log Izin',
							'url_link' => site_url('backend_reportizin/reportizin'),
						),
					),
				),
			);
		} else {
			$this->_data['menu_sidebar'] 	= array(
				array(
					'label' => 'Setting',
					'child'	=> array(
						array(
							'label' => 'Company Profile',
							'url_link' => site_url('backend_companyprofile/companyprofile'),
						),
						array(
							'label' => 'User Admin',
							'url_link' => site_url('backend_adminusers/adminusers'),
						),
					),
				),
			);
		}
	}
}

?>