<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftartamu extends MY_Frontend {

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
	
	function index($param) {
		$tmp = explode(URL_DELIMITER, $param);
		$lyn_id = end($tmp);
		$this->_data['layanan'] = $this->frontendmodel->where('lyn_id = ' . $lyn_id)->get_row_layanan();
		if(empty($this->_data['layanan']['lyn_id'])) {
			die('Maaf, data ini tidak ditemukan!'); exit();
		}

		$input_post = $this->input->post(NULL, TRUE);
		if(!empty($input_post)) {
			if($this->do_new()) {
				redirect('layanan/'.$param);
				exit();
			}
		}

		$this->_data['action_form'] = site_url('daftar-tamu/' . $param);
		$url_listdaftartamu = site_url('daftar-tamu');

		$this->template->set('url_listdaftartamu', $url_listdaftartamu);
		$this->template->set('title_listdaftartamu', 'List Daftar Tamu');

		$this->_data['url_backlayanan'] = site_url('list-berkas-layanan/' .  $param);

		$this->template->set('url_backlayanan', $this->_data['url_backlayanan']);
		$this->template->set('title_backlayanan', 'List Berkas Layanan');

		$this->template->set('title', 'Layanan | Form Daftar Tamu');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_frontend/main', 'form', $this->_data);
	}

	private function do_new() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('dftm_nama', 'Nama', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('dftm_instansi', 'Instansi', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('dftm_nik', 'NIK', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('dftm_jeniskelamin', 'Gender', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('dftm_alamat', 'Alamat', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('dftm_telp', 'No. HP', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('dftm_keperluan', 'Instansi', 'trim|prep_for_form|required|xss_clean');

		if($this->form_validation->run()) {
			$data = array(
				'dftm_lyn_id' => $this->_data['layanan']['lyn_id'],
				'dftm_nama' => $this->input->post('dftm_nama'),
				'dftm_instansi' => $this->input->post('dftm_instansi'),
				'dftm_nik' => $this->input->post('dftm_nik'),
				'dftm_jeniskelamin' => $this->input->post('dftm_jeniskelamin'),
				'dftm_alamat' => $this->input->post('dftm_alamat'),
				'dftm_telp' => $this->input->post('dftm_telp'),
				'dftm_keperluan' => $this->input->post('dftm_keperluan'),
				'dftm_status' => STATUS_DAFTARTAMU,
				'dftm_entryuser' => $this->session->userdata('login_username'),
				'dftm_entrydate' => date('Y-m-d H:i:s'),
				'dftm_entry_daftartamu' => date('Y-m-d H:i:s'),
			);

			$res = $this->frontendmodel->posts_daftartamu($data);

			$daftartamu_id = $this->db->insert_id();

			$this->session->set_userdata(
				array(
					'session_daftartamu_id' => $daftartamu_id,
					'session_daftartamu_name' => $this->input->post('dftm_nama'),
				)
			);

			return true;
		} else {
			$this->_data['error_form'] = validation_errors();
			return false;
		}
	}

	function lists() {
		if(!empty($_POST['periode'])) {
			$periode = !empty($_POST['periode']) ? $_POST['periode'] : '';
			//echo $periode;
			list($date1, $date2) = explode(' - ', $periode);

			$this->_data['daftartamu'] = $this->frontendmodel->where('dftm_waiting != ' . LAYANAN_SKIP . ' AND (DATE_FORMAT(dftm_entrydate, "%Y-%m-%d") BETWEEN "'.$date1.'" AND "'.$date2.'")')->order_by('dftm_id', 'DESC')->get_daftartamu_layanan();
			//echo $this->db->last_query(); exit();
		} else {
			$this->_data['daftartamu'] = $this->frontendmodel->where('dftm_waiting != ' . LAYANAN_SKIP)->order_by('dftm_id', 'DESC')->get_daftartamu_layanan();
		}

		
		$url_formulirdaftartamu = site_url('daftar-tamu/form');
		$this->_data['periode'] = !empty($periode) ? $periode : '';

		$this->template->set('title', 'Layanan | Daftar Tamu');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->set('url_formulirdaftartamu', $url_formulirdaftartamu);
		$this->template->set('title_formulirdaftartamu', 'Formulir Daftar Tamu');
		$this->template->set('notification_ajax', true);
		$this->template->set('lists_daftartamu', true);
		$this->template->load('template_frontend/main', 'lists', $this->_data);
	}

	function lists_skip() {
		$this->_data['daftartamu'] = $this->frontendmodel->where('dftm_waiting = ' . LAYANAN_SKIP)->order_by('dftm_id', 'DESC')->get_daftartamu_layanan();
		$url_formulirdaftartamu = site_url('daftar-tamu/form');

		$this->template->set('title', 'Layanan | Daftar Tamu');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->set('url_formulirdaftartamu', $url_formulirdaftartamu);
		$this->template->set('title_formulirdaftartamu', 'Formulir Daftar Tamu');
		$this->template->set('notification_ajax', true);
		$this->template->load('template_frontend/main', 'lists_skip', $this->_data);
	}

	function state_daftartamu($param) {
		$this->_data['daftartamu'] = $this->frontendmodel->where('dftm_id = ' . $param)->get_row_daftartamu();
		/*
		if(empty($this->_data['daftartamu']) OR $this->_data['daftartamu']['dftm_status'] != STATUS_DAFTARTAMU) {
			die('Maaf, state tidak sesuai!'); exit();
		}
		*/

		$this->_data['url_param'] = $param;

		$input_post = $this->input->post(NULL, TRUE);
		if(!empty($input_post)) {
			if($this->do_state_daftartamu()) {
				redirect('state-berkas-layanan/'.$param);
				exit();
			}
		}
		
		$this->_data['layanan'] = $this->frontendmodel->where('lyn_id = ' . $this->_data['daftartamu']['dftm_lyn_id'])->get_row_layanan();
		$this->_data['berkaslayanan'] = $this->frontendmodel->where('bly_dftm_id = ' . $param)->get_row_berkaslayanan();
		$this->_data['persyaratanlayanan'] = $this->frontendmodel->where('ply_lyn_id = ' . $this->_data['layanan']['lyn_id'])->get_all_persyaratanlayanan();

		$this->_data['hd_lyn_id'] = $this->_data['daftartamu']['dftm_lyn_id'];
		$this->_data['hd_bly_id'] = !empty($this->_data['berkaslayanan']['bly_id']) ? $this->_data['berkaslayanan']['bly_id'] : '';
		
		$this->_data['action_form'] = site_url('state-daftar-tamu/' . $this->_data['url_param']);
		$this->_data['url_listberkaslayanan'] = site_url('list-berkas-layanan/' . sanitize_title_with_dashes($this->_data['layanan']['lyn_name']) . URL_DELIMITER . $this->_data['layanan']['lyn_id']);

		$this->template->set('title', 'Layanan | Berkas Layanan');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->set('url_backlayanan', $this->_data['url_listberkaslayanan']);
		$this->template->set('title_backlayanan', 'List Berkas Layanan');
		$this->template->load('template_frontend/main', 'form_berkaslayanan', $this->_data);
	}

	private function do_state_daftartamu() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('noberkas', 'No Berkas', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('pemohon', 'Nama', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim|prep_for_form|xss_clean');

		if($this->form_validation->run()) {
			$persyaratanlayanan = $this->frontendmodel->where('ply_lyn_id = ' . $this->input->post('hd_lyn_id'))->get_all_persyaratanlayanan();

			$hd_bly_id = $this->input->post('hd_bly_id');

			if(!empty($hd_bly_id)) {
				$data = array(
					'bly_noberkas' => $this->input->post('noberkas'),
					'bly_pemohon' => $this->input->post('pemohon'),
					'bly_notes' => $this->input->post('notes'),
					'bly_status' => 0,
					'bly_changeuser' => $this->session->userdata('login_username'),
					'bly_changedate' => date('Y-m-d H:i:s'),
				);
			} else {
				$data = array(
					'bly_lyn_id' => $this->input->post('hd_lyn_id'),
					'bly_noberkas' => $this->input->post('noberkas'),
					'bly_pemohon' => $this->input->post('pemohon'),
					'bly_notes' => $this->input->post('notes'),
					'bly_status' => 0,
					'bly_dftm_id' => $this->_data['url_param'],
					'bly_entryuser' => $this->session->userdata('login_username'),
					'bly_entrydate' => date('Y-m-d H:i:s'),
				);
			}

			$jml_datapersyaratan = count($persyaratanlayanan);

			$jml_isipersyaratan = 0;
			$checklist_layanan = $this->input->post('plyid');
			if(!empty($checklist_layanan)) $jml_isipersyaratan = count($checklist_layanan);
			$data['bly_persyaratan'] = serialize($checklist_layanan);

			//bila persyaratan diisi semua, maka setatus menjadi berkas lengkap
			if(!empty($jml_isipersyaratan) AND ($jml_datapersyaratan == $jml_isipersyaratan)) $data['bly_status'] = BERKAS_LENGKAP;

			if(!empty($hd_bly_id)) {
				$res = $this->frontendmodel->where('bly_id = ' . $hd_bly_id)->puts_berkaslayanan($data);
				$this->_data['berkaslayanan_id'] = $hd_bly_id;
			} else {
				$res = $this->frontendmodel->posts_berkaslayanan($data);
				$this->_data['berkaslayanan_id'] = $this->db->insert_id();
			}

			$data_update = array(
				'dftm_status' => STATUS_BERKASLAYANAN,
				'dftm_changeuser' => $this->session->userdata('login_username'),
				'dftm_changedate' => date('Y-m-d H:i:s'),
				'dftm_entry_berkas' => date('Y-m-d H:i:s'),
			);

			$res = $this->frontendmodel->where('dftm_id = ' . $this->_data['url_param'])->puts_daftartamu($data_update);

			if($data['bly_status'] != BERKAS_LENGKAP) {
				redirect('daftar-tamu/lists');
				exit();
			}

			return true;
		} else {
			$this->_data['error_form'] = validation_errors();
			return false;
		}
	}

	function state_berkaslayanan($param) {
		$this->_data['daftartamu'] = $this->frontendmodel->where('dftm_id = ' . $param)->get_row_daftartamu();
		/*
		if(empty($this->_data['daftartamu']) OR $this->_data['daftartamu']['dftm_status'] != STATUS_BERKASLAYANAN) {
			die('Maaf, state tidak sesuai!'); exit();
		}
		*/

		$this->_data['berkaslayanan'] = $this->frontendmodel->where('bly_dftm_id = ' . $this->_data['daftartamu']['dftm_id'])->get_row_berkaslayanan();
		$persyaratanlayanan = $this->frontendmodel->where('ply_lyn_id = ' . $this->_data['berkaslayanan']['bly_lyn_id'])->get_all_persyaratanlayanan();
		$jml_datapersyaratan = count($persyaratanlayanan);
		$tmp = unserialize($this->_data['berkaslayanan']['bly_persyaratan']);
		$jml_terisi = !empty($tmp) ? count($tmp) : 0;

		if($jml_datapersyaratan != $jml_terisi) {
			redirect('state-daftar-tamu/'.$param);
			exit();
		}

		$this->_data['layanan'] = $this->frontendmodel->where('lyn_id = ' . $this->_data['berkaslayanan']['bly_lyn_id'])->get_row_layanan();

		$this->_data['formisian'] = $this->frontendmodel->where('frm_bly_id = ' . $this->_data['berkaslayanan']['bly_id'])->get_row_formisian();
		if(!empty($this->_data['formisian']['frm_id'])) {
			redirect('berkas-layanan/form-edit/' . $this->_data['formisian']['frm_id']);
			exit();
		}
		
		$this->_data['hd_bly_id'] = $this->_data['berkaslayanan']['bly_id'];
		$this->_data['hd_lyn_id'] = $this->_data['berkaslayanan']['bly_lyn_id'];
		$this->_data['url_param'] = $param;
		$this->_data['action_form'] = site_url('state-berkas-layanan/' . $this->_data['url_param']);
		$this->_data['url_listberkaslayanan'] = site_url('list-berkas-layanan/' . sanitize_title_with_dashes($this->_data['layanan']['lyn_name']) . URL_DELIMITER . $this->_data['layanan']['lyn_id']);

		if(!empty($this->_data['layanan']['lyn_gly_id']) AND $this->_data['layanan']['lyn_gly_id'] == ID_GROUP_PELAYANAN_KESEHATAN) {
			$arr_layanan_dokter = array(ID_LAYANAN_DOKTER_GIGI_FASILITAS, ID_LAYANAN_DOKTER_GIGI_PERORANGAN, ID_LAYANAN_DOKTER_UMUM_FASILITAS, ID_LAYANAN_DOKTER_UMUM_PERORANGAN);
			if(!in_array($this->_data['layanan']['lyn_id'], $arr_layanan_dokter)) {
				$this->_data['form_input'] = array(
					array('label' => 'No. Surat', 'name' => 'frm_no', 'type' => 'text', 'disabled' => 1, 'default' => $this->_data['berkaslayanan']['bly_noberkas']),
					array('label' => 'Nama', 'name' => 'frm_nama', 'type' => 'text', 'disabled' => 1, 'default' => $this->_data['berkaslayanan']['bly_pemohon']),
					array('label' => 'Perpanjang?', 'name' => 'frm_perpanjang_layanan', 'type' => 'checkbox', 'default' => (!empty($this->_data['formisian']['frm_perpanjang_layanan']) ? $this->_data['formisian']['frm_perpanjang_layanan'] : '')),
				);
			} else {
				$this->_data['form_input'] = array(
					array('label' => 'No. Surat', 'name' => 'frm_no', 'type' => 'text', 'disabled' => 1, 'default' => $this->_data['berkaslayanan']['bly_noberkas']),
					array('label' => 'Nama', 'name' => 'frm_nama', 'type' => 'text', 'disabled' => 1, 'default' => $this->_data['berkaslayanan']['bly_pemohon']),
				);
			}
		} else {
			$this->_data['form_input'] = array(
				array('label' => 'No. Surat', 'name' => 'frm_no', 'type' => 'text', 'disabled' => 1, 'default' => $this->_data['berkaslayanan']['bly_noberkas']),
				array('label' => 'Nama', 'name' => 'frm_nama', 'type' => 'text', 'disabled' => 1, 'default' => $this->_data['berkaslayanan']['bly_pemohon']),
			);
		}

		$this->_data['form_input'] = array_merge($this->_data['form_input'], get_formisian($this->_data['layanan']['lyn_id'], $this->_data['layanan']['lyn_gly_id']));

		if(!empty($this->_data['layanan']['lyn_gly_id']) AND $this->_data['layanan']['lyn_gly_id'] != ID_GROUP_PELAYANAN_KESEHATAN AND $this->_data['layanan']['lyn_id'] != ID_LAYANAN_BADAN_USAHA) {
			$extra_form = array(
				array('label' => 'Tanggal Dikeluarkan (yyyy-mm-dd)', 'name' => 'frm_tanggal_dikeluarkan', 'type' => 'text', 'required' => 1, 'default' => (!empty($this->_data['formisian']['frm_tanggal_dikeluarkan']) ? $this->_data['formisian']['frm_tanggal_dikeluarkan'] : '')),
			);
			$this->_data['form_input'] = array_merge($this->_data['form_input'], $extra_form);
		}

		$input_post = $this->input->post(NULL, TRUE);
		if(!empty($input_post)) {
			if($this->do_state_berkaslayanan()) {
				redirect('daftar-tamu/lists');
				exit();
			}
		}

		$this->template->set('title', 'Layanan | Form New Isian Layanan');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->set('url_backlayanan', $this->_data['url_listberkaslayanan']);
		$this->template->set('title_backlayanan', 'List Berkas Layanan');
		
		if($this->_data['layanan']['lyn_id'] == ID_LAYANAN_KARTU_KUNING) {
			$this->template->load('template_frontend/main', 'form_isian_kartu_kuning', $this->_data);
		} else {
			$this->template->load('template_frontend/main', 'form_isian', $this->_data);
		}
	}

	private function do_state_berkaslayanan() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('hd_bly_id', 'Berkas Layanan', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('hd_lyn_id', 'Layanan', 'trim|prep_for_form|required|xss_clean');

		$lyn_id = $this->input->post('hd_lyn_id');

		if($lyn_id == ID_LAYANAN_KARTU_KUNING) $this->_data['form_input'] = array();

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
				'frm_entryuser' => $this->session->userdata('login_username'),
				'frm_entrydate' => date('Y-m-d H:i:s'),
			);

			if($lyn_id == ID_LAYANAN_KARTU_KUNING) {
				$data['frm_tempatlahir'] = $this->input->post('frm_tempatlahir');
				$data['frm_tanggallahir'] = $this->input->post('frm_tanggallahir');
				$data['frm_jeniskelamin'] = $this->input->post('frm_jeniskelamin');
				$data['frm_status_perkawinan'] = $this->input->post('frm_status_perkawinan');
				$data['frm_agama'] = $this->input->post('frm_agama');
				$data['frm_alamat'] = $this->input->post('frm_alamat');
				$data['frm_tanggal_dikeluarkan'] = $this->input->post('frm_tanggal_dikeluarkan');
				$data['frm_nik'] = $this->input->post('frm_nik');

				$data['frm_karkun_sd'] = $this->input->post('frm_karkun_sd');
				$data['frm_karkun_sd_tahun'] = $this->input->post('frm_karkun_sd_tahun');
				$data['frm_karkun_smtp'] = $this->input->post('frm_karkun_smtp');
				$data['frm_karkun_smtp_tahun'] = $this->input->post('frm_karkun_smtp_tahun');
				$data['frm_karkun_smta'] = $this->input->post('frm_karkun_smta');
				$data['frm_karkun_smta_tahun'] = $this->input->post('frm_karkun_smta_tahun');
				$data['frm_karkun_sm'] = $this->input->post('frm_karkun_sm');
				$data['frm_karkun_sm_tahun'] = $this->input->post('frm_karkun_sm_tahun');
				$data['frm_karkun_akta2'] = $this->input->post('frm_karkun_akta2');
				$data['frm_karkun_akta2_tahun'] = $this->input->post('frm_karkun_akta2_tahun');
				$data['frm_karkun_akta3'] = $this->input->post('frm_karkun_akta3');
				$data['frm_karkun_akta3_tahun'] = $this->input->post('frm_karkun_akta3_tahun');
				$data['frm_karkun_s'] = $this->input->post('frm_karkun_s');
				$data['frm_karkun_s_tahun'] = $this->input->post('frm_karkun_s_tahun');
				$data['frm_karkun_doktor'] = $this->input->post('frm_karkun_doktor');
				$data['frm_karkun_doktor_tahun'] = $this->input->post('frm_karkun_doktor_tahun');

				$keterampilan = array();
				$input_keterampilan = $this->input->post('keterampilan');
				$input_keterampilan_tahun = $this->input->post('keterampilan_tahun');
				for($i=0;$i<3;$i++){
					$keterampilan[$i] = array(
						'nama' => !empty($input_keterampilan[$i]) ? $input_keterampilan[$i] : '',
						'tahun' => !empty($input_keterampilan_tahun[$i]) ? $input_keterampilan_tahun[$i] : '',
					);
				}

				$data['frm_karkun_keterampilan'] = serialize($keterampilan);

			} else {
				foreach ($this->_data['form_input'] as $value) {
					if(!empty($value['disabled'])) continue;
					$name_input = $value['name'];
					$data[$name_input] = $this->input->post($name_input);
				}
			}			

			if($this->input->post('hd_lyn_id') == ID_LAYANAN_BADAN_USAHA AND !empty($data['frm_bu_tanggal_dikeluarkan'])) {
				list($year, $month, $day) = explode('-', $data['frm_bu_tanggal_dikeluarkan']);
				$data['frm_bu_masa_berlaku'] = date('Y-m-d', mktime(0,0,0,$month,$day,($year+1)));
			}

			$res = $this->frontendmodel->posts_formisian($data);

			$data = array(
				'dftm_status' => STATUS_FORMISIAN,
				'dftm_changeuser' => $this->session->userdata('login_username'),
				'dftm_changedate' => date('Y-m-d H:i:s'),
				'dftm_entry_formisian' => date('Y-m-d H:i:s'),
			);

			$res = $this->frontendmodel->where('dftm_id = ' . $this->_data['url_param'])->puts_daftartamu($data);

			return true;
		} else {
			$this->_data['error_form'] = validation_errors();
			return false;
		}
	}

	function skip($param) {
		$this->_data['daftartamu'] = $this->frontendmodel->where('dftm_id = ' . $param . ' AND dftm_waiting = ' . LAYANAN_UNSKIP)->get_row_daftartamu();
		if(empty($this->_data['daftartamu']['dftm_id'])) {
			die('Maaf, data ini tidak ditemukan!'); exit();
		}

		$data = array(
			'dftm_waiting' => LAYANAN_SKIP,
			'dftm_changeuser' => $this->session->userdata('login_username'),
			'dftm_changedate' => date('Y-m-d H:i:s'),
		);

		$res = $this->frontendmodel->where('dftm_id = ' . $this->_data['daftartamu']['dftm_id'])->puts_daftartamu($data);

		redirect('daftar-tamu/lists');
		exit();
	}

	function unskip($param) {
		$this->_data['daftartamu'] = $this->frontendmodel->where('dftm_id = ' . $param . ' AND dftm_waiting = ' . LAYANAN_SKIP)->get_row_daftartamu();
		if(empty($this->_data['daftartamu']['dftm_id'])) {
			die('Maaf, data ini tidak ditemukan!'); exit();
		}

		$data = array(
			'dftm_waiting' => LAYANAN_UNSKIP,
			'dftm_changeuser' => $this->session->userdata('login_username'),
			'dftm_changedate' => date('Y-m-d H:i:s'),
		);

		$res = $this->frontendmodel->where('dftm_id = ' . $this->_data['daftartamu']['dftm_id'])->puts_daftartamu($data);

		redirect('daftar-tamu/lists_skip');
		exit();
	}
}

?>