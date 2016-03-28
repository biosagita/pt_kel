<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftartamunonlayanan extends MY_Frontend {

	function __construct(){
		parent::__construct();

		if(!$this->session->userdata('login_id')) {
			redirect('login');
			exit();
		}

		$this->load->helper('main');
		$this->load->helper('formisian');
		$this->load->model('frontend_model', 'frontendmodel');
	}
	
	function index() {
		$input_post = $this->input->post(NULL, TRUE);
		if(!empty($input_post)) {
			if($this->do_new()) {
				redirect('daftar-tamu-non-layanan/lists');
				exit();
			}
		}

		$this->_data['action_form'] = site_url('daftar-tamu-non-layanan');
		$url_listdaftartamunonlayanan = site_url('daftar-tamu-non-layanan/lists');

		$this->template->set('url_listdaftartamunonlayanan', $url_listdaftartamunonlayanan);
		$this->template->set('title_listdaftartamunonlayanan', 'List Daftar Tamu Non Layanan');

		$this->template->set('title', 'Layanan | Form Daftar Tamu Non Layanan');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_frontend/main', 'form', $this->_data);
	}

	private function do_new() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('dfnl_nama', 'Nama', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('dfnl_instansi', 'Instansi', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('dfnl_nik', 'NIK', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('dfnl_jeniskelamin', 'Gender', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('dfnl_alamat', 'Alamat', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('dfnl_telp', 'No. HP', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('dfnl_keperluan', 'Instansi', 'trim|prep_for_form|required|xss_clean');

		if($this->form_validation->run()) {
			$data = array(
				'dfnl_nama' => $this->input->post('dfnl_nama'),
				'dfnl_instansi' => $this->input->post('dfnl_instansi'),
				'dfnl_nik' => $this->input->post('dfnl_nik'),
				'dfnl_jeniskelamin' => $this->input->post('dfnl_jeniskelamin'),
				'dfnl_alamat' => $this->input->post('dfnl_alamat'),
				'dfnl_telp' => $this->input->post('dfnl_telp'),
				'dfnl_keperluan' => $this->input->post('dfnl_keperluan'),
				'dfnl_entryuser' => $this->session->userdata('login_username'),
				'dfnl_entrydate' => date('Y-m-d H:i:s'),
			);

			$res = $this->frontendmodel->posts_daftartamunonlayanan($data);

			return true;
		} else {
			$this->_data['error_form'] = validation_errors();
			return false;
		}
	}

	function lists() {
		$this->_data['daftartamunonlayanan'] = $this->frontendmodel->get_all_daftartamunonlayanan();
		$url_listdaftartamunonlayanan = site_url('daftar-tamu-non-layanan');

		$this->template->set('url_listdaftartamunonlayanan', $url_listdaftartamunonlayanan);
		$this->template->set('title_listdaftartamunonlayanan', 'Form Daftar Tamu Non Layanan');

		$this->template->set('title', 'Layanan | Daftar Tamu Non Layanan');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->set('notification_ajax', true);
		$this->template->load('template_frontend/main', 'lists', $this->_data);
	}
}

?>