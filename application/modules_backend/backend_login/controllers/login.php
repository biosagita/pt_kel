<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Admin {
	
	function __construct(){
		parent::__construct();
		if($this->session->userdata('admin_id')) {
			redirect('backend');
			exit();
		}
	}
	
	function index() {
		$this->login();
	}
	
	function login() {
		$this->_data['ajax_action_login'] 	= site_url('backend_login/login/login_ajax');

		if($this->input->post('hd_login')){
			if($this->do_login()){
				redirect('backend_login/login');
				exit();
			}	
		}

		//using lib template
		$this->template->set('title', 'Layanan : Admin Login');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_login/login', 'login', $this->_data);
	}

	function login_ajax() {
		$res = array(
			'err_msg' 	=> '',
			'url_home' 	=> site_url('backend/adminusers'),
		);

		if($this->input->post('hd_login')){
			if(!$this->do_login()) $res['err_msg'] = $this->_data['login_errmsg'];
		}

		echo json_encode($res);
	}
	
	function do_login(){
		$this->load->model('crud_model','crudmodel');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('txt_username', 'Username', 'trim|htmlspecialchars|encode_php_tags|prep_for_form|min_length[3]|required|xss_clean');
        $this->form_validation->set_rules('psw_password', 'Password', 'trim|htmlspecialchars|encode_php_tags|prep_for_form|min_length[3]|required|xss_clean');
		
		if($this->form_validation->run()) {
			$username = $this->input->post('txt_username');
			$password = $this->input->post('psw_password');

			$res = $this->crudmodel->where(array('admusr_username' => $username, 'admusr_userpasswd' => md5($password)))->get_row_adminusers();

			if(!empty($res)) {
				$res_userlevel = $this->crudmodel->where(array('aulv_id' => $res['admusr_aulv_id']))->get_row_adminuserlevels();
				$data = $this->session->set_userdata(
					array(
						'admin_id' 					=> $res['admusr_id'],
						'admin_username' 			=> $res['admusr_username'],
						'admin_role' 				=> !empty($res_userlevel['aulv_name']) ? $res_userlevel['aulv_name'] : '-',
					)
				);

				//----input userlog login----
				$vData = array(
					'usrlog_user_id'	=> $res['admusr_id'],
					'usrlog_login_date'	=> date('Y-m-d H:i:s'),					           
					'usrlog_login_ip'	=> get_client_ip(),
					'usrlog_login_type'	=> 'backend',
				);
				$res = $this->crudmodel->posts_userlog($vData);

				return true;
			} else {
				$this->_data['login_errmsg'] = "<p>Your info was incorrect. Try again.</p>";
				return FALSE;
			}

		} else {
			$this->_data['login_errmsg'] = validation_errors();
			return FALSE;
		}
	}

}

?>