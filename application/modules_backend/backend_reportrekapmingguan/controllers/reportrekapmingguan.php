<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reportrekapmingguan extends MY_Admin {
	private $_template 			= 'template_admin/main';
	private $_module_controller = 'backend_reportrekapmingguan/reportrekapmingguan/';
	private $_table_name 		= 'reportrekapmingguan';
	private $_table_field_pref 	= 'gly_';
	private $_table_pk 			= 'gly_id';
	private $_model_crud 		= 'crud_model';

	private $_page_title 		= 'Layanan : Report Rekap Mingguan';
	private $_page_content_info	= array(
		'title' => 'Report Rekap Mingguan',
		'desc' 	=> 'Report Rekap Mingguan',
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

		$this->db->select('COUNT(dftm_id) as total', true);
		if(!empty($date1) AND !empty($date2)) $this->db->where('DATE_FORMAT(dftm_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('YEARWEEK(dftm_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->_data['daftartamu'] = $this->db->get('daftartamu')->row_array();

		$this->db->select('COUNT(bly_id) as total', true);
		if(!empty($date1) AND !empty($date2)) $this->db->where('DATE_FORMAT(bly_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('YEARWEEK(bly_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->_data['berkaslayanan_total'] = $this->db->get('berkaslayanan')->row_array();

		$this->db->select('COUNT(bly_id) as total', true);
		if(!empty($date1) AND !empty($date2))  $this->db->where('bly_status = "'.BERKAS_APPROVED.'" AND DATE_FORMAT(bly_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('bly_status = "'.BERKAS_APPROVED.'" AND YEARWEEK(bly_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->_data['berkaslayanan_approved'] = $this->db->get('berkaslayanan')->row_array();

		$this->db->select('COUNT(bly_id) as total', true);
		if(!empty($date1) AND !empty($date2)) $this->db->where('bly_status = "'.BERKAS_REJECT.'" AND DATE_FORMAT(bly_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('bly_status = "'.BERKAS_REJECT.'" AND YEARWEEK(bly_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->_data['berkaslayanan_reject'] = $this->db->get('berkaslayanan')->row_array();

		$this->db->select('COUNT(bly_id) as total', true);
		if(!empty($date1) AND !empty($date2)) $this->db->where('bly_status <= "'.BERKAS_LENGKAP.'" AND DATE_FORMAT(bly_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('bly_status <= "'.BERKAS_LENGKAP.'" AND YEARWEEK(bly_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->_data['berkaslayanan_proses'] = $this->db->get('berkaslayanan')->row_array();

		$this->db->select('SUM(frm_retribusi) as total', true);
		if(!empty($date1) AND !empty($date2)) $this->db->where('DATE_FORMAT(bly_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('YEARWEEK(bly_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->db->join('formisian', 'bly_id = frm_bly_id', 'left');
		$this->_data['retribusi'] = $this->db->get('berkaslayanan')->row_array();

		$this->_data['info_page'] = $this->_page_content_info;
		$this->_data['periode'] = !empty($periode) ? $periode : '';

		//using lib template
		$this->template->set('title', $this->_page_title);
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load($this->_template, 'lists', $this->_data);
	}

	function page_content_ajax() {
		if(!empty($_POST['periode'])) {
			$periode = !empty($_POST['periode']) ? $_POST['periode'] : '';
			list($date1, $date2) = explode(' - ', $periode);
		}

		$this->db->select('COUNT(dftm_id) as total', true);
		if(!empty($date1) AND !empty($date2)) $this->db->where('DATE_FORMAT(dftm_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('YEARWEEK(dftm_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->_data['daftartamu'] = $this->db->get('daftartamu')->row_array();

		$this->db->select('COUNT(bly_id) as total', true);
		if(!empty($date1) AND !empty($date2)) $this->db->where('DATE_FORMAT(bly_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('YEARWEEK(bly_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->_data['berkaslayanan_total'] = $this->db->get('berkaslayanan')->row_array();

		$this->db->select('COUNT(bly_id) as total', true);
		if(!empty($date1) AND !empty($date2))  $this->db->where('bly_status = "'.BERKAS_APPROVED.'" AND DATE_FORMAT(bly_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('bly_status = "'.BERKAS_APPROVED.'" AND YEARWEEK(bly_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->_data['berkaslayanan_approved'] = $this->db->get('berkaslayanan')->row_array();

		$this->db->select('COUNT(bly_id) as total', true);
		if(!empty($date1) AND !empty($date2)) $this->db->where('bly_status = "'.BERKAS_REJECT.'" AND DATE_FORMAT(bly_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('bly_status = "'.BERKAS_REJECT.'" AND YEARWEEK(bly_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->_data['berkaslayanan_reject'] = $this->db->get('berkaslayanan')->row_array();

		$this->db->select('COUNT(bly_id) as total', true);
		if(!empty($date1) AND !empty($date2)) $this->db->where('bly_status <= "'.BERKAS_LENGKAP.'" AND DATE_FORMAT(bly_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('bly_status <= "'.BERKAS_LENGKAP.'" AND YEARWEEK(bly_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->_data['berkaslayanan_proses'] = $this->db->get('berkaslayanan')->row_array();

		$this->db->select('SUM(frm_retribusi) as total', true);
		if(!empty($date1) AND !empty($date2)) $this->db->where('DATE_FORMAT(bly_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('YEARWEEK(bly_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->db->join('formisian', 'bly_id = frm_bly_id', 'left');
		$this->_data['retribusi'] = $this->db->get('berkaslayanan')->row_array();

		$this->_data['info_page'] = $this->_page_content_info;
		$this->load->view('lists', $this->_data);
	}

	function export_excel() {
		if(!empty($_GET['periode'])) {
			$periode = !empty($_GET['periode']) ? $_GET['periode'] : '';
			list($date1, $date2) = explode('_', $periode);
		}

		$this->db->select('COUNT(dftm_id) as total', true);
		if(!empty($date1) AND !empty($date2)) $this->db->where('DATE_FORMAT(dftm_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('YEARWEEK(dftm_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->_data['daftartamu'] = $this->db->get('daftartamu')->row_array();

		$this->db->select('COUNT(bly_id) as total', true);
		if(!empty($date1) AND !empty($date2)) $this->db->where('DATE_FORMAT(bly_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('YEARWEEK(bly_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->_data['berkaslayanan_total'] = $this->db->get('berkaslayanan')->row_array();

		$this->db->select('COUNT(bly_id) as total', true);
		if(!empty($date1) AND !empty($date2))  $this->db->where('bly_status = "'.BERKAS_APPROVED.'" AND DATE_FORMAT(bly_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('bly_status = "'.BERKAS_APPROVED.'" AND YEARWEEK(bly_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->_data['berkaslayanan_approved'] = $this->db->get('berkaslayanan')->row_array();

		$this->db->select('COUNT(bly_id) as total', true);
		if(!empty($date1) AND !empty($date2)) $this->db->where('bly_status = "'.BERKAS_REJECT.'" AND DATE_FORMAT(bly_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('bly_status = "'.BERKAS_REJECT.'" AND YEARWEEK(bly_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->_data['berkaslayanan_reject'] = $this->db->get('berkaslayanan')->row_array();

		$this->db->select('COUNT(bly_id) as total', true);
		if(!empty($date1) AND !empty($date2)) $this->db->where('bly_status <= "'.BERKAS_LENGKAP.'" AND DATE_FORMAT(bly_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('bly_status <= "'.BERKAS_LENGKAP.'" AND YEARWEEK(bly_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->_data['berkaslayanan_proses'] = $this->db->get('berkaslayanan')->row_array();

		$this->db->select('SUM(frm_retribusi) as total', true);
		if(!empty($date1) AND !empty($date2)) $this->db->where('DATE_FORMAT(bly_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'"');
		else $this->db->where('YEARWEEK(bly_entrydate, 1) = YEARWEEK(CURDATE(), 1)');
		$this->db->join('formisian', 'bly_id = frm_bly_id', 'left');
		$this->_data['retribusi'] = $this->db->get('berkaslayanan')->row_array();

		$this->_data['info_page'] = $this->_page_content_info;

		$this->_data['filename'] = 'report-rekap-mingguan-'. str_replace('-', '', date('Y-m-d'));

		//using lib template
		$this->template->set('title', $this->_page_title);
		$this->template->set('assets', $this->_data['assets']);
		$this->template->set('filename', $this->_data['filename']);
		$this->template->load('template_report/excel', 'lists_excel', $this->_data);
	}
}

?>