<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sertifikatlayanan extends MY_Admin {
	private $_template 			= 'template_admin/main';
	private $_module_controller = 'backend_sertifikatlayanan/sertifikatlayanan/';
	private $_table_name 		= 'layanan';
	private $_table_field_pref 	= 'lyn_';
	private $_table_pk 			= 'lyn_id';
	private $_model_crud 		= 'crud_model';

	private $_page_title 		= 'Layanan : List Sertifikat Layanan';
	private $_page_content_info	= array(
		'title' => 'Data Sertifikat Layanan',
		'desc' 	=> 'List Sertifikat Layanan',
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

	private function get_show_column() {
		$column_list = array(
			array(
				'title_header_column' 	=> 'No.',
				'field_name' 			=> $this->_table_field_pref . 'id',
				'show_no_static' 		=> true,
				'no_order'				=> 0,
			),
			array(
				'title_header_column' 	=> 'Nama',
				'field_name' 			=> $this->_table_field_pref . 'name',
				'no_order'				=> 1,
			),
			array(
				'title_header_column' 	=> 'Group Layanan',
				'field_name' 			=> 'gly_name',
				'result_format'			=> function( $d, $row ) {
			        	if(empty($d)) $d = '-';
			            return $d;
			        },
		        'no_order'				=> 2,
			),
			array(
				'title_header_column' 	=> 'Template Sertifikat',
				'field_name' 			=> 'tpsr_name',
				'result_format'			=> function( $d, $row ) {
			        	if(empty($d)) $d = '-';
			            return $d;
			        },
		        'no_order'				=> 3,
			),
			array(
				'title_header_column' 	=> 'Group Nomor',
				'field_name' 			=> 'grno_nama',
			    'no_order'				=> 4,
			),
			array(
				'title_header_column' 	=> 'Action',
				'field_name' 			=> $this->_table_field_pref . 'id',
				'result_format'			=> function( $d, $row ) {
			            return '<a onclick="doFormEdit('.$d.');return false;" href="#" class="btn btn-xs btn-success">EDIT</a>';
			        },
			    'no_order'				=> 5,
			),
		);

		return $column_list;
	}

	private function get_input_field_new($data_value = array()) {
		$source_group_layanan = $this->crudmodel->get_option_grouplayanan();
		$source_template_sertifikat = $this->crudmodel->get_option_templatesertifikat();
		$source_group_nomorsertifikat = $this->crudmodel->get_option_groupnomorsertifikat();

		$data_input = array(
			array(
				'db_field' 		=> $this->_table_field_pref . 'id',
				'db_pk' 		=> true,
				'db_process'	=> false,
				'data_edit'		=> array(
					'db_process'		=> false,
				),
			),
			array(
				'label' 		=> 'Nama',
				'db_field' 		=> $this->_table_field_pref . 'name',
				'db_process'	=> true,
				'input_type'	=> 'text',
				'input_attr'	=> 'type="text" data-parsley-minlength="1" class="form-control" placeholder="Nama sertifikatlayanan..."',
				'required'		=> 'required',
				'data_source'	=> '',
				'data_unique'	=> true,
				'data_edit'		=> array(
					'input_disabled'	=> 'disabled',
					'db_process'		=> false,
				),
			),
			array(
				'label' 		=> 'Group Layanan',
				'db_field' 		=> $this->_table_field_pref . 'gly_id',
				'db_process'	=> true,
				'input_type'	=> 'select',
				'input_attr'	=> 'class="form-control"',
				'required'		=> 'required',
				'data_source'	=> $source_group_layanan,
				'data_edit'		=> array(
					'input_disabled'	=> 'disabled',
					'db_process'		=> false,
				),
			),
			array(
				'label' 		=> 'Template Sertifikat',
				'db_field' 		=> $this->_table_field_pref . 'tpsr_id',
				'db_process'	=> true,
				'input_type'	=> 'select',
				'input_attr'	=> 'class="form-control"',
				'required'		=> 'required',
				'data_source'	=> $source_template_sertifikat,
				'data_edit'		=> array(
					'required'			=> 'required',
					'db_process'		=> true,
				),
			),
			array(
				'label' 		=> 'Group Nomor',
				'db_field' 		=> $this->_table_field_pref . 'grno_id',
				'db_process'	=> true,
				'input_type'	=> 'select',
				'input_attr'	=> 'class="form-control"',
				'required'		=> 'required',
				'data_source'	=> $source_group_nomorsertifikat,
				'data_edit'		=> array(
					'required'			=> 'required',
					'db_process'		=> true,
				),
			),
		);

		if(!empty($data_value)) {
			foreach ($data_input as $key => $value) {
				if(!empty($data_input[$key]['data_edit']['input_empty']) AND $data_input[$key]['data_edit']['input_empty']) {
					$data_input[$key]['data_edit']['input_value'] = '';
				} else {
					$data_input[$key]['data_edit']['input_value'] = !empty($data_value[$data_input[$key]['db_field']]) ? $data_value[$data_input[$key]['db_field']] : '';
				}
			}
		}

		return $data_input;
	}
	
	function index() {
		$this->lists();
	}

	function lists() {
		$this->_data['page_content_ajax'] 	= site_url($this->_module_controller . 'page_content_ajax');
		$this->_data['ajax_lists'] 			= site_url($this->_module_controller . 'lists_ajax');
		$this->_data['ajax_form_add'] 		= site_url($this->_module_controller . 'add_ajax');
		$this->_data['ajax_form_edit'] 		= site_url($this->_module_controller . 'edit_ajax');
		$this->_data['ajax_action_delete'] 	= site_url($this->_module_controller . 'do_delete_ajax');

		$this->_data['column_list'] = $this->get_show_column();

		$this->_data['info_page'] = $this->_page_content_info;

		//using lib template
		$this->template->set('title', $this->_page_title);
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load($this->_template, 'lists', $this->_data);
	}

	function page_content_ajax() {
		$this->_data['page_content_ajax'] 	= site_url($this->_module_controller . 'page_content_ajax');
		$this->_data['ajax_lists'] 			= site_url($this->_module_controller . 'lists_ajax');
		$this->_data['ajax_form_add'] 		= site_url($this->_module_controller . 'add_ajax');
		$this->_data['ajax_form_edit'] 		= site_url($this->_module_controller . 'edit_ajax');
		$this->_data['ajax_action_delete'] 	= site_url($this->_module_controller . 'do_delete_ajax');

		$this->_data['column_list'] = $this->get_show_column();

		$this->_data['info_page'] = $this->_page_content_info;

		$this->load->view('lists', $this->_data);
	}

	//--- used by datatable source data -------
	function lists_ajax() {
		$this->load->helper('mydatatable');
		$table 		= $this->db->dbprefix . $this->_table_name;
		$table .= ' LEFT JOIN ' . $this->db->dbprefix . 'grouplayanan ON (lyn_gly_id = gly_id)';
		$table .= ' LEFT JOIN ' . $this->db->dbprefix . 'templatesertifikat ON (lyn_tpsr_id = tpsr_id)';
		$table .= ' LEFT JOIN ' . $this->db->dbprefix . 'groupnomorsertifikat ON (lyn_grno_id = grno_id)';
		$primaryKey = $this->_table_pk;
		$column_list = $this->get_show_column();
		$columns = array();
		$cnt = 0;
		foreach ($column_list as $key => $value) {
			$columns[] = array(
				'db' 				=> $value['field_name'],
				'dt' 				=> !empty($value['no_order']) ? $value['no_order'] : $cnt,
				'formatter' 		=> !empty($value['result_format']) ? $value['result_format'] : '',
				'show_no_static' 	=> !empty($value['show_no_static']) ? $value['show_no_static'] : '',
			);
			$cnt++;
		}
		$whereResult 	= '';
		$whereAll 		= '';
		generateDataTable($table, $primaryKey, $columns, $whereResult, $whereAll);
	}

	function add_ajax() {
		$this->_data['ajax_action_add'] 	= site_url($this->_module_controller . 'do_add_ajax');
		$this->_data['input_list'] 			= $this->get_input_field_new();
		$this->load->view('form_add', $this->_data);
	}

	function do_add() {
		$this->load->library('form_validation');

		$table_name 		= $this->_table_name;
		$input_list = $this->get_input_field_new();
		$admin_data = array();

		foreach ($input_list as $key => $value) {
			if(!empty($value['db_process']) AND $value['db_process']) {
				if(!empty($value['required'])) {
					$this->form_validation->set_rules($value['db_field'], $value['label'], 'trim|htmlspecialchars|encode_php_tags|prep_for_form|required|xss_clean');

					if(!empty($value['data_unique']) AND $value['data_unique']) {
						$tmp_unique = $table_name . '.' . $value['db_field'];
						$this->form_validation->set_rules($value['db_field'], $value['label'], 'is_unique['.$tmp_unique.']');
					}
				}

				$admin_data[$value['db_field']] = $this->input->post($value['db_field']);
				if(!empty($value['data_md5']) AND $value['data_md5']) {
					$admin_data[$value['db_field']] = md5($this->input->post($value['db_field']));
				}
			}
		}
		
		if($this->form_validation->run()) {
			$res = false;
			if(!empty($admin_data)) {
				$admin_data['lyn_entryuser'] = $this->session->userdata('admin_username');
				$admin_data['lyn_entrydate'] = date('Y-m-d H:i:s');
				$res = $this->crudmodel->posts_layanan($admin_data);
				if($res) {
					$this->_data['success_msg'] = 'Insert data success.';
				} else {
					$this->_data['err_msg'] = 'Insert data failed. Please try again.';
				}
			} else {
				$this->_data['err_msg'] = 'Data is empty.';
			}
			return $res;
		} else {
			$this->_data['err_msg'] = validation_errors();
			return FALSE;
		}
	}

	function do_add_ajax() {
		$res = array(
			'err_msg' 		=> '',
			'success_msg' 	=> '',
		);

		if(!$this->do_add()) $res['err_msg'] = $this->_data['err_msg'];
		$res['success_msg'] = !empty($this->_data['success_msg']) ? $this->_data['success_msg'] : '';

		echo json_encode($res);
	}

	function edit_ajax() {
		$data_id = $this->input->post('data_id');
		$data = $this->crudmodel->where(array($this->_table_pk => $data_id ))->get_row_layanan();
		$this->_data['data_row'] = $data;

		$this->_data['input_list'] 			= $this->get_input_field_new($data);

		$this->_data['ajax_action_edit'] 	= site_url($this->_module_controller . 'do_edit_ajax');
		$this->load->view('form_edit', $this->_data);
	}

	function do_edit() {
		$this->load->library('form_validation');

		$input_list = $this->get_input_field_new();
		$admin_data = array();
		$user_id 	= '';
		$field_pk 	= '';

		foreach ($input_list as $key => $value) {
			if(!empty($value['same_related'])) {
				$tmp = $this->input->post($value['same_related']);
				if($tmp != $this->input->post($value['db_field'])) {
					$this->form_validation->set_rules($value['db_field'], $value['label'], 'trim|htmlspecialchars|encode_php_tags|prep_for_form|required|xss_clean');
				}
			}

			if(!empty($value['data_edit']['db_process']) AND $value['data_edit']['db_process']) {
				if(!empty($value['data_edit']['required'])) {
					$this->form_validation->set_rules($value['db_field'], $value['label'], 'trim|htmlspecialchars|encode_php_tags|prep_for_form|required|xss_clean');
				} else {
					$this->form_validation->set_rules($value['db_field'], $value['label'], 'trim|htmlspecialchars|encode_php_tags|prep_for_form|xss_clean');
				}

				if(!empty($value['data_edit']['input_disabled'])) continue;

				$post_value = $this->input->post($value['db_field']);
				if(empty($post_value) AND !empty($value['data_edit']['ignore_empty'])) continue;

				$admin_data[$value['db_field']] = $post_value;
				if(!empty($value['data_md5']) AND $value['data_md5']) {
					$admin_data[$value['db_field']] = md5($post_value);
				}
			}

			if(!empty($value['db_pk']) AND $value['db_pk']) {
				$user_id = $this->input->post($value['db_field']);
				$field_pk 	= $value['db_field'];
			}
		}
		
		if($this->form_validation->run()) {
			$res = false;
			if(empty($user_id) OR empty($field_pk)) {
				$this->_data['err_msg'] = 'user id or primary key is empty.';
				return $res;
			}

			if(!empty($admin_data)) {
				$admin_data['lyn_changeuser'] = $this->session->userdata('admin_username');
				$admin_data['lyn_changedate'] = date('Y-m-d H:i:s');
				$res = $this->crudmodel->where(array($field_pk => $user_id))->puts_layanan($admin_data);
				if($res) {
					$this->_data['success_msg'] = 'Update data success.';
				} else {
					$this->_data['err_msg'] = 'Update data failed. Please try again.';
				}
			} else {
				$this->_data['err_msg'] = 'Data is empty.';
			}
			return $res;
		} else {
			$this->_data['err_msg'] = validation_errors();
			return FALSE;
		}
	}

	function do_edit_ajax() {
		$res = array(
			'err_msg' 		=> '',
			'success_msg' 	=> '',
		);

		if(!$this->do_edit()) $res['err_msg'] = $this->_data['err_msg'];
		$res['success_msg'] = !empty($this->_data['success_msg']) ? $this->_data['success_msg'] : '';

		echo json_encode($res);
	}

	function do_delete() {
		if($this->input->post('data_id')) {
			$delete = $this->crudmodel->delete(array($this->_table_pk => $this->input->post_layanan('data_id')));
			if($delete) {
				$this->_data['success_msg'] = 'Delete data success.';
			} else {
				$this->_data['err_msg'] = 'Delete data failed. Please try again.';
			}
			return $delete;
		} else {
			$this->_data['err_msg'] = 'Data is empty.';
			return false;
		}
	}

	function do_delete_ajax() {
		$res = array(
			'err_msg' 		=> '',
			'success_msg' 	=> '',
		);

		if(!$this->do_delete()) $res['err_msg'] = $this->_data['err_msg'];
		$res['success_msg'] = !empty($this->_data['success_msg']) ? $this->_data['success_msg'] : '';

		echo json_encode($res);
	}
	
}

?>