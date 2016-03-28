<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Frontend {

	function __construct(){
		parent::__construct();
		$this->load->helper('main');
		$this->load->helper('formisian');
		$this->load->model('frontend_model', 'frontendmodel');
	}

	function index() {
		if($this->session->userdata('session_noberkas')) {
			redirect('user-layanan/form');
			exit();
		}

		$this->_data['ajax_action_noberkas'] 	= site_url('frontend_user/user/noberkas_ajax');

		$this->template->set('title', 'Layanan | Isian No Berkas Layanan');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->set('ajax_action_login', $this->_data['ajax_action_noberkas']);
		$this->template->load('template_login/login', 'form_noberkas', $this->_data);
	}

	function noberkas_ajax() {
		$res = array(
			'err_msg' 	=> '',
			'url_home' 	=> site_url('user-layanan/form'),
		);

		$input_post = $this->input->post(NULL, TRUE);
		if(!empty($input_post)) {
			if(!$this->do_noberkas()) $res['err_msg'] = $this->_data['error_form'];
		}

		echo json_encode($res);
	}

	private function do_noberkas() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('user_noberkas', 'USER ID', 'trim|prep_for_form|required|xss_clean');

		if($this->form_validation->run()) {
			$berkaslayanan = $this->frontendmodel->where('bly_noberkas = "' . $this->input->post('user_noberkas') . '" AND bly_status = ' . BERKAS_LENGKAP)->get_row_berkaslayanan();
			if(empty($berkaslayanan)) {
				$this->_data['error_form'] = "<p>Maaf, data tidak ditemukan.</p>";
				return false;
			}

			$formisian = $this->frontendmodel->where('frm_bly_id = ' . $berkaslayanan['bly_id'])->get_row_formisian();
			if(!empty($formisian)) {
				$this->_data['error_form'] = "<p>Maaf, data sudah digunakan.</p>";
				return false;
			}

			$this->session->set_userdata(
				array(
					'session_noberkas' 	=> $berkaslayanan['bly_noberkas'],
				)
			);

			return true;
		} else {
			$this->_data['error_form'] = validation_errors();
			return false;
		}
	}

	function form() {
		if(!$this->session->userdata('session_noberkas')) {
			redirect('user-layanan');
			exit();
		}

		$this->_data['berkaslayanan'] = $this->frontendmodel->where('bly_noberkas = "' . $this->session->userdata('session_noberkas') . '" AND bly_status = ' . BERKAS_LENGKAP)->get_row_berkaslayanan();
		if(empty($this->_data['berkaslayanan']['bly_lyn_id'])) {
			die('Maaf, data ini tidak ditemukan!'); exit();
		}

		$this->_data['formisian'] = $this->frontendmodel->where('frm_bly_id = ' . $this->_data['berkaslayanan']['bly_id'])->get_row_formisian();
		if(!empty($this->_data['formisian']['frm_id'])) {
			die('Maaf, no ini sudah digunakan!'); exit();
		}

		$this->_data['layanan'] = $this->frontendmodel->where('lyn_id = ' . $this->_data['berkaslayanan']['bly_lyn_id'])->get_row_layanan();
		$this->_data['hd_bly_id'] = $this->_data['berkaslayanan']['bly_id'];
		$this->_data['hd_lyn_id'] = $this->_data['berkaslayanan']['bly_lyn_id'];

		$this->_data['form_input'] = array(
			array('label' => 'No. Surat', 'name' => 'frm_no', 'type' => 'text', 'disabled' => 1, 'default' => $this->_data['berkaslayanan']['bly_noberkas']),
			array('label' => 'Nama', 'name' => 'frm_nama', 'type' => 'text', 'disabled' => 1, 'default' => $this->_data['berkaslayanan']['bly_pemohon']),
		);

		$this->_data['form_input'] = array_merge($this->_data['form_input'], get_formisian($this->_data['layanan']['lyn_id'], $this->_data['layanan']['lyn_gly_id']));

		$input_post = $this->input->post(NULL, TRUE);
		if(!empty($input_post)) {
			if($this->do_new_isian()) {
				redirect('user-layanan/success');
				exit();
			}
		}

		$this->template->set('title', 'Layanan | Form User Isian Layanan');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_user/main', 'form_isian', $this->_data);
	}

	private function do_new_isian() {
		$this->load->library('form_validation');

		foreach ($this->_data['form_input'] as $value) {
			if(!empty($value['disabled']) OR empty($value['required'])) continue;
			$this->form_validation->set_rules($value['name'], $value['label'], 'trim|prep_for_form|required|xss_clean');
		}

		if($this->form_validation->run()) {
			$berkaslayanan = $this->frontendmodel->where('bly_id = ' . $this->input->post('hd_bly_id'))->get_row_berkaslayanan();

			$data = array(
				'frm_bly_id' => $this->input->post('hd_bly_id'),
				'frm_lyn_id' => $this->input->post('hd_lyn_id'),
				'frm_no' => $berkaslayanan['bly_noberkas'],
				'frm_nama' => $berkaslayanan['bly_pemohon'],
				'frm_entryuser' => 'guest',
				'frm_entrydate' => date('Y-m-d H:i:s'),
			);

			foreach ($this->_data['form_input'] as $value) {
				if(!empty($value['disabled'])) continue;
				$name_input = $value['name'];
				$data[$name_input] = $this->input->post($name_input);
			}

			$res = $this->frontendmodel->posts_formisian($data);

			$data = array(
				'session_noberkas'	=> '',
			);
			
			$this->session->unset_userdata($data);

			return true;
		} else {
			$this->_data['error_form'] = validation_errors();
			return false;
		}
	}

	function success() {
		$this->template->set('title', 'Layanan | Success User Isian Layanan');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_user/main', 'success', $this->_data);
	}
}

?>