<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Frontend {

	function __construct(){
		parent::__construct();

		if(!$this->session->userdata('login_id')) {
			redirect('login');
			exit();
		}

		$this->load->helper('main');
		$this->load->model('frontend_model', 'frontendmodel');
	}
	
	function index() {
		$this->_data['group_layanan'] = $this->frontendmodel->get_all_grouplayanan();
		$this->_data['layanan'] = $this->frontendmodel->get_all_layanan();

		$url_listdaftartamunonlayanan = site_url('daftar-tamu-non-layanan/lists');

		$this->template->set('url_listdaftartamunonlayanan', $url_listdaftartamunonlayanan);
		$this->template->set('title_listdaftartamunonlayanan', 'List Daftar Tamu Non Layanan');

		$this->template->set('title', 'Layanan | Home');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->set('home', true);
		$this->template->set('notification_ajax', true);
		$this->template->load('template_frontend/main', 'lists', $this->_data);
	}

	function get_json_layanan() {
		$data = array(
			'jumlah' => 0,
			'detail' => array()
		);

		$berkaslayanan = $this->frontendmodel->select('bly_noberkas, bly_pemohon')->where('bly_status = ' . BERKAS_LENGKAP)->order_by('bly_id', 'DESC')->get_all_berkaslayananjoininnernotif();
		if(!empty($berkaslayanan)) {
			$data['jumlah'] = count($berkaslayanan);
			$data['detail'] = $berkaslayanan;
		}

		echo json_encode($data);
	}

	function get_box_layanan($id) {
		$this->_data['group_layanan'] = $this->frontendmodel->select('*')->where('gly_id = ' . $id)->get_row_grouplayanan();
		$this->_data['layanan'] = $this->frontendmodel->select('*')->where('lyn_gly_id = ' . $id)->order_by('lyn_name')->get_all_layanan();
		$body = $this->load->view('modal_box/list_box', $this->_data, TRUE);
		echo $body;
	}
}

?>