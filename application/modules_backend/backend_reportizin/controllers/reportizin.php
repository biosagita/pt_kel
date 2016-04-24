<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportizin extends MY_Admin {
	private $_template 			= 'template_admin/main';
	private $_module_controller = 'backend_reportizin/reportizin/';
	private $_table_name 		= 'reportizin';
	private $_table_field_pref 	= 'gly_';
	private $_table_pk 			= 'gly_id';
	private $_model_crud 		= 'crud_model';

	private $_page_title 		= 'Layanan : Report Log Izin';
	private $_page_content_info	= array(
		'title' => 'Report Log Izin',
		'desc' 	=> 'Report Log Izin',
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
		if(!empty($_POST['periode'])) {
			$periode = !empty($_POST['periode']) ? $_POST['periode'] : '';
			list($date1, $date2) = explode(' - ', $periode);
		}

		if(!empty($_POST['show_waktu_finish'])) {
			$this->_data['show_waktu_finish'] = 1;
		}

		$this->db->select('daftartamu.*, layanan.*, gly_name, bly_entryuser, bly_status, frm_no_surat_sertifikat, TIME_TO_SEC(IF(TIMEDIFF(dftm_entry_cetak,dftm_entry_daftartamu) > 0, TIMEDIFF(dftm_entry_cetak,dftm_entry_daftartamu), 0)) as detik_layanan, dftm_entry_complete', FALSE);
		$this->db->join('layanan', 'dftm_lyn_id = lyn_id');
		$this->db->join('grouplayanan', 'lyn_gly_id = gly_id');
		$this->db->join('berkaslayanan', 'dftm_id = bly_dftm_id', 'left');
		$this->db->join('formisian', 'bly_id = frm_bly_id', 'left');
		if(!empty($date1) AND !empty($date2)) $this->db->where('DATE_FORMAT(dftm_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('YEAR(`dftm_entrydate`) = YEAR(CURDATE()) AND MONTH(`dftm_entrydate`) = MONTH(CURDATE())');
		$this->_data['daftartamu'] = $this->db->get('daftartamu')->result_array();

		$this->_data['info_page'] = $this->_page_content_info;
		$this->_data['periode'] = !empty($periode) ? $periode : '';

		//using lib template
		$this->template->set('title', $this->_page_title);
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load($this->_template, 'lists', $this->_data);
	}

	function page_content_ajax() {
		$this->db->select('daftartamu.*, layanan.*, gly_name, bly_entryuser, bly_status, frm_no_surat_sertifikat, TIME_TO_SEC(IF(TIMEDIFF(dftm_entry_cetak,dftm_entry_daftartamu) > 0, TIMEDIFF(dftm_entry_cetak,dftm_entry_daftartamu), 0)) as detik_layanan, dftm_entry_complete', FALSE);
		$this->db->join('layanan', 'dftm_lyn_id = lyn_id');
		$this->db->join('grouplayanan', 'lyn_gly_id = gly_id');
		$this->db->join('berkaslayanan', 'dftm_id = bly_dftm_id', 'left');
		$this->db->join('formisian', 'bly_id = frm_bly_id', 'left');
		$this->db->where('YEAR(`dftm_entrydate`) = YEAR(CURDATE()) AND MONTH(`dftm_entrydate`) = MONTH(CURDATE())');
		$this->_data['daftartamu'] = $this->db->get('daftartamu')->result_array();

		$this->_data['info_page'] = $this->_page_content_info;
		$this->load->view('lists', $this->_data);
	}

	function export_excel() {
		if(!empty($_GET['periode'])) {
			$periode = !empty($_GET['periode']) ? $_GET['periode'] : '';
			list($date1, $date2) = explode('_', $periode);
		}

		if(!empty($_GET['show_waktu_finish'])) {
			$this->_data['show_waktu_finish'] = 1;
		}

		$this->db->select('daftartamu.*, layanan.*, gly_name, bly_entryuser, bly_status, frm_no_surat_sertifikat, TIME_TO_SEC(IF(TIMEDIFF(dftm_entry_cetak,dftm_entry_daftartamu) > 0, TIMEDIFF(dftm_entry_cetak,dftm_entry_daftartamu), 0)) as detik_layanan, dftm_entry_complete', FALSE);
		$this->db->join('layanan', 'dftm_lyn_id = lyn_id');
		$this->db->join('grouplayanan', 'lyn_gly_id = gly_id');
		$this->db->join('berkaslayanan', 'dftm_id = bly_dftm_id', 'left');
		$this->db->join('formisian', 'bly_id = frm_bly_id', 'left');
		if(!empty($date1) AND !empty($date2)) $this->db->where('DATE_FORMAT(dftm_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('YEAR(`dftm_entrydate`) = YEAR(CURDATE()) AND MONTH(`dftm_entrydate`) = MONTH(CURDATE())');
		$this->_data['daftartamu'] = $this->db->get('daftartamu')->result_array();

		$this->_data['info_page'] = $this->_page_content_info;

		$this->_data['filename'] = 'report-izin-'. str_replace('-', '', date('Y-m-d'));

		//using lib template
		$this->template->set('title', $this->_page_title);
		$this->template->set('assets', $this->_data['assets']);
		$this->template->set('filename', $this->_data['filename']);
		$this->template->load('template_report/excel', 'lists_excel', $this->_data);
	}
}

?>