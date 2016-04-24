<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Layanan extends MY_Frontend {

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

		if($this->_data['layanan']['lyn_gly_id'] == ID_GROUP_PELAYANAN_DULCAPIL) {
			redirect('daftar-tamu/lists');
			exit();
		}

		$input_post = $this->input->post(NULL, TRUE);
		if(!empty($input_post)) {
			if($this->do_new()) {
				redirect('berkas-layanan/form/'.$this->_data['berkaslayanan_id']);
				exit();
			}
		}
		
		$this->_data['persyaratanlayanan'] = $this->frontendmodel->where('ply_lyn_id = ' . $this->_data['layanan']['lyn_id'])->get_all_persyaratanlayanan();
		$this->_data['daftartamu'] = $this->frontendmodel->where('dftm_id = ' . $this->session->userdata('session_daftartamu_id'))->get_row_daftartamu();
		$this->_data['hd_lyn_id'] = $this->_data['layanan']['lyn_id'];
		$this->_data['url_param'] = $param;
		$this->_data['action_form'] = site_url('layanan/' . $this->_data['url_param']);
		$url_listberkaslayanan = site_url('list-berkas-layanan/' . $this->_data['url_param']);

		$this->template->set('title', 'Layanan | Berkas Layanan');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->set('url_backlayanan', $url_listberkaslayanan);
		$this->template->set('title_backlayanan', 'List Berkas Layanan');
		$this->template->load('template_frontend/main', 'form', $this->_data);
	}

	private function do_new() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('noberkas', 'No Berkas', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('pemohon', 'Nama', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim|prep_for_form|xss_clean');

		if($this->form_validation->run()) {
			$persyaratanlayanan = $this->frontendmodel->where('ply_lyn_id = ' . $this->input->post('hd_lyn_id'))->get_all_persyaratanlayanan();

			$data = array(
				'bly_lyn_id' => $this->input->post('hd_lyn_id'),
				'bly_noberkas' => $this->input->post('noberkas'),
				'bly_pemohon' => $this->input->post('pemohon'),
				'bly_notes' => $this->input->post('notes'),
				'bly_status' => 0,
				'bly_dftm_id' => $this->session->userdata('session_daftartamu_id'),
				'bly_entryuser' => $this->session->userdata('login_username'),
				'bly_entrydate' => date('Y-m-d H:i:s'),
			);

			$jml_datapersyaratan = count($persyaratanlayanan);

			$jml_isipersyaratan = 0;
			$checklist_layanan = $this->input->post('plyid');
			if(!empty($checklist_layanan)) $jml_isipersyaratan = count($checklist_layanan);
			$data['bly_persyaratan'] = serialize($checklist_layanan);

			//bila persyaratan diisi semua, maka setatus menjadi berkas lengkap
			if(!empty($jml_isipersyaratan) AND ($jml_datapersyaratan == $jml_isipersyaratan)) $data['bly_status'] = BERKAS_LENGKAP;

			$res = $this->frontendmodel->posts_berkaslayanan($data);

			$this->_data['berkaslayanan_id'] = $this->db->insert_id();

			$data = array(
				'dftm_status' => STATUS_BERKASLAYANAN,
				'dftm_changeuser' => $this->session->userdata('login_username'),
				'dftm_changedate' => date('Y-m-d H:i:s'),
				'dftm_entry_berkas' => date('Y-m-d H:i:s'),
			);

			$res = $this->frontendmodel->where('dftm_id = ' . $this->session->userdata('session_daftartamu_id'))->puts_daftartamu($data);

			return true;
		} else {
			$this->_data['error_form'] = validation_errors();
			return false;
		}
	}

	function listberkaslayanan($param) {
		$tmp = explode(URL_DELIMITER, $param);
		$lyn_id = end($tmp);
		$this->_data['berkaslayanan'] = $this->frontendmodel->select('lyn_gly_id, bly_lyn_id, bly_id, bly_noberkas, bly_pemohon, bly_notes, bly_status, bly_entrydate, frm_id, dftm_complete')->where('bly_lyn_id = ' . $lyn_id)->get_all_berkaslayananjoininner();
		$this->_data['layanan'] = $this->frontendmodel->where('lyn_id = ' . $lyn_id)->get_row_layanan();
		$this->_data['url_param'] = $param;
		$url_formberkaslayanan = site_url('daftar-tamu/' . $param);

		$this->template->set('title', 'Layanan | List Berkas Layanan');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->set('url_backlayanan', $url_formberkaslayanan);
		$this->template->set('title_backlayanan', 'Berkas Layanan Baru');
		$this->template->load('template_frontend/main', 'lists', $this->_data);
	}

	function edit($param) {
		$this->_data['berkaslayanan'] = $this->frontendmodel->where('bly_id = ' . $param)->get_row_berkaslayanan();
		if(empty($this->_data['berkaslayanan']['bly_lyn_id'])) {
			die('Maaf, data ini tidak ditemukan!'); exit();
		}

		$this->_data['persyaratanlayanan'] = $this->frontendmodel->where('ply_lyn_id = ' . $this->_data['berkaslayanan']['bly_lyn_id'])->get_all_persyaratanlayanan();
		$this->_data['layanan'] = $this->frontendmodel->where('lyn_id = ' . $this->_data['berkaslayanan']['bly_lyn_id'])->get_row_layanan();
		$this->_data['hd_bly_id'] = $this->_data['berkaslayanan']['bly_id'];
		$this->_data['hd_lyn_id'] = $this->_data['berkaslayanan']['bly_lyn_id'];
		$this->_data['url_param'] = sanitize_title_with_dashes($this->_data['layanan']['lyn_name']) . URL_DELIMITER . $this->_data['layanan']['lyn_id'];
		$this->_data['url_listberkaslayanan'] = site_url('list-berkas-layanan/' . $this->_data['url_param']);

		$input_post = $this->input->post(NULL, TRUE);
		if(!empty($input_post)) {
			if($this->do_edit()) {
				redirect($this->_data['url_listberkaslayanan']);
				exit();
			}
		}

		$this->template->set('title', 'Layanan | Edit Berkas Layanan');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->set('url_backlayanan', $this->_data['url_listberkaslayanan']);
		$this->template->set('title_backlayanan', 'List Berkas Layanan');
		$this->template->load('template_frontend/main', 'form_edit', $this->_data);
	}

	private function do_edit() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('noberkas', 'No Berkas', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('pemohon', 'Nama', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('notes', 'Keterangan', 'trim|prep_for_form|xss_clean');

		if($this->form_validation->run()) {
			$persyaratanlayanan = $this->frontendmodel->where('ply_lyn_id = ' . $this->input->post('hd_lyn_id'))->get_all_persyaratanlayanan();

			$data = array(
				'bly_noberkas' => $this->input->post('noberkas'),
				'bly_pemohon' => $this->input->post('pemohon'),
				'bly_notes' => $this->input->post('notes'),
				'bly_status' => 0,
				'bly_changeuser' => $this->session->userdata('login_username'),
				'bly_changedate' => date('Y-m-d H:i:s'),
			);

			$jml_datapersyaratan = count($persyaratanlayanan);

			$jml_isipersyaratan = 0;
			$checklist_layanan = $this->input->post('plyid');
			if(!empty($checklist_layanan)) $jml_isipersyaratan = count($checklist_layanan);
			$data['bly_persyaratan'] = serialize($checklist_layanan);

			//bila persyaratan diisi semua, maka setatus menjadi berkas lengkap
			if(!empty($jml_isipersyaratan) AND ($jml_datapersyaratan == $jml_isipersyaratan)) $data['bly_status'] = BERKAS_LENGKAP;

			$res = $this->frontendmodel->where('bly_id = ' . $this->input->post('hd_bly_id'))->puts_berkaslayanan($data);

			return true;
		} else {
			$this->_data['error_form'] = validation_errors();
			return false;
		}
	}

	function formisian($param) {
		$this->_data['berkaslayanan'] = $this->frontendmodel->where('bly_id = ' . $param)->get_row_berkaslayanan();
		$this->_data['layanan'] = $this->frontendmodel->where('lyn_id = ' . $this->_data['berkaslayanan']['bly_lyn_id'])->get_row_layanan();

		if(empty($this->_data['berkaslayanan']) OR $this->_data['berkaslayanan']['bly_status'] < BERKAS_LENGKAP) {
			$slug_url = sanitize_title_with_dashes($this->_data['layanan']['lyn_name']) . URL_DELIMITER . $this->_data['layanan']['lyn_id'];
			redirect('list-berkas-layanan/' . $slug_url);
			exit();
		}

		$this->_data['formisian'] = $this->frontendmodel->where('frm_bly_id = ' . $param)->get_row_formisian();
		if(!empty($this->_data['formisian']['frm_id'])) {
			redirect('berkas-layanan/form-edit/' . $this->_data['formisian']['frm_id']);
			exit();
		}
		
		$this->_data['hd_bly_id'] = $this->_data['berkaslayanan']['bly_id'];
		$this->_data['hd_lyn_id'] = $this->_data['berkaslayanan']['bly_lyn_id'];
		$this->_data['action_form'] = site_url('berkas-layanan/form/' . $this->_data['hd_bly_id']);
		$this->_data['url_param'] = sanitize_title_with_dashes($this->_data['layanan']['lyn_name']) . URL_DELIMITER . $this->_data['layanan']['lyn_id'];
		$this->_data['url_listberkaslayanan'] = site_url('list-berkas-layanan/' . $this->_data['url_param']);

		if(!empty($this->_data['layanan']['lyn_gly_id']) AND $this->_data['layanan']['lyn_gly_id'] == ID_GROUP_PELAYANAN_KESEHATAN) {
			$arr_layanan_dokter = array(ID_LAYANAN_DOKTER_GIGI_FASILITAS, ID_LAYANAN_DOKTER_GIGI_PERORANGAN, ID_LAYANAN_DOKTER_UMUM_FASILITAS, ID_LAYANAN_DOKTER_UMUM_PERORANGAN);
			if(!in_array($this->_data['layanan']['lyn_id'], $arr_layanan_dokter)) {
				$this->_data['form_input'] = array(
					array('label' => 'No. Surat', 'name' => 'frm_no', 'type' => 'text', 'disabled' => 1, 'default' => $this->_data['berkaslayanan']['bly_noberkas']),
					array('label' => 'Nama', 'name' => 'frm_nama', 'type' => 'text', 'disabled' => 1, 'default' => $this->_data['berkaslayanan']['bly_pemohon']),
					array('label' => 'Perpanjang?', 'name' => 'frm_perpanjang_layanan', 'type' => 'checkbox', 'default' => (!empty($default_data['frm_perpanjang_layanan']) ? $default_data['frm_perpanjang_layanan'] : '')),
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
			if($this->do_new_isian()) {
				redirect($this->_data['url_listberkaslayanan']);
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

	private function do_new_isian() {
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

			$res = $this->frontendmodel->where('dftm_id = ' . $this->_data['berkaslayanan']['bly_dftm_id'])->puts_daftartamu($data);

			return true;
		} else {
			$this->_data['error_form'] = validation_errors();
			return false;
		}
	}

	function formisianedit($param) {
		$this->_data['formisian'] = $this->frontendmodel->where('frm_id = ' . $param)->get_row_formisian();
		if(empty($this->_data['formisian']['frm_bly_id'])) {
			die('Maaf, data ini tidak ditemukan!'); exit();
		}

		$this->_data['berkaslayanan'] = $this->frontendmodel->where('bly_id = ' . $this->_data['formisian']['frm_bly_id'])->get_row_berkaslayanan();
		$this->_data['layanan'] = $this->frontendmodel->where('lyn_id = ' . $this->_data['berkaslayanan']['bly_lyn_id'])->get_row_layanan();
		$this->_data['hd_frm_id'] = $this->_data['formisian']['frm_id'];
		$this->_data['hd_bly_id'] = $this->_data['berkaslayanan']['bly_id'];
		$this->_data['hd_lyn_id'] = $this->_data['berkaslayanan']['bly_lyn_id'];
		$this->_data['url_param'] = sanitize_title_with_dashes($this->_data['layanan']['lyn_name']) . URL_DELIMITER . $this->_data['layanan']['lyn_id'];
		$this->_data['url_listberkaslayanan'] = site_url('list-berkas-layanan/' . $this->_data['url_param']);

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

		$this->_data['form_input'] = array_merge($this->_data['form_input'], get_formisian($this->_data['layanan']['lyn_id'], $this->_data['layanan']['lyn_gly_id'], $this->_data['formisian']));

		if(!empty($this->_data['layanan']['lyn_gly_id']) AND $this->_data['layanan']['lyn_gly_id'] != ID_GROUP_PELAYANAN_KESEHATAN AND $this->_data['layanan']['lyn_id'] != ID_LAYANAN_BADAN_USAHA) {
			$extra_form = array(
				array('label' => 'Tanggal Dikeluarkan (yyyy-mm-dd)', 'name' => 'frm_tanggal_dikeluarkan', 'type' => 'text', 'required' => 1, 'default' => (!empty($this->_data['formisian']['frm_tanggal_dikeluarkan']) ? $this->_data['formisian']['frm_tanggal_dikeluarkan'] : '')),
			);
			$this->_data['form_input'] = array_merge($this->_data['form_input'], $extra_form);
		}

		$input_post = $this->input->post(NULL, TRUE);
		if(!empty($input_post)) {
			if($this->do_edit_isian()) {
				redirect($this->_data['url_listberkaslayanan']);
				exit();
			}
		}

		$this->template->set('title', 'Layanan | Form Edit Isian Layanan');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->set('url_backlayanan', $this->_data['url_listberkaslayanan']);
		$this->template->set('title_backlayanan', 'List Berkas Layanan');

		if($this->_data['layanan']['lyn_id'] == ID_LAYANAN_KARTU_KUNING) {
			$this->template->load('template_frontend/main', 'form_isian_kartu_kuning_edit', $this->_data);
		} else {
			$this->template->load('template_frontend/main', 'form_isian_edit', $this->_data);
		}
	}

	private function do_edit_isian() {
		$this->load->library('form_validation');

		$this->form_validation->set_rules('hd_bly_id', 'Berkas Layanan', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('hd_lyn_id', 'Layanan', 'trim|prep_for_form|required|xss_clean');
		$this->form_validation->set_rules('hd_frm_id', 'Formisian', 'trim|prep_for_form|required|xss_clean');

		$lyn_id = $this->input->post('hd_lyn_id');

		if($lyn_id == ID_LAYANAN_KARTU_KUNING) $this->_data['form_input'] = array();

		foreach ($this->_data['form_input'] as $value) {
			if(!empty($value['disabled']) OR empty($value['required'])) continue;
			$this->form_validation->set_rules($value['name'], $value['label'], 'trim|prep_for_form|required|xss_clean');
		}

		if($this->form_validation->run()) {
			$berkaslayanan = $this->frontendmodel->where('bly_id = ' . $this->input->post('hd_bly_id'))->get_row_berkaslayanan();

			$data = array(
				'frm_changeuser' => $this->session->userdata('login_username'),
				'frm_changedate' => date('Y-m-d H:i:s'),
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

			$res = $this->frontendmodel->where('frm_id = ' . $this->input->post('hd_frm_id'))->puts_formisian($data);

			return true;
		} else {
			$this->_data['error_form'] = validation_errors();
			return false;
		}
	}

	function approved($param) {
		$this->_data['berkaslayanan'] = $this->frontendmodel->where('bly_id = ' . $param)->get_row_berkaslayanan();
		if(empty($this->_data['berkaslayanan']['bly_lyn_id'])) {
			die('Maaf, data ini tidak ditemukan!'); exit();
		}

		$this->_data['layanan'] = $this->frontendmodel->where('lyn_id = ' . $this->_data['berkaslayanan']['bly_lyn_id'])->get_row_layanan();
		$this->_data['url_param'] = sanitize_title_with_dashes($this->_data['layanan']['lyn_name']) . URL_DELIMITER . $this->_data['layanan']['lyn_id'];
		$this->_data['url_listberkaslayanan'] = site_url('list-berkas-layanan/' . $this->_data['url_param']);

		$data = array(
			'bly_status' => BERKAS_APPROVED,
			'bly_changeuser' => $this->session->userdata('login_username'),
			'bly_changedate' => date('Y-m-d H:i:s'),
		);

		$res = $this->frontendmodel->where('bly_id = ' . $this->_data['berkaslayanan']['bly_id'])->puts_berkaslayanan($data);

		$data = array(
			'dftm_status' => STATUS_APPROVAL,
			'dftm_complete' => 0,
			'dftm_changeuser' => $this->session->userdata('login_username'),
			'dftm_changedate' => date('Y-m-d H:i:s'),
			'dftm_entry_approval' => date('Y-m-d H:i:s'),
		);

		$res = $this->frontendmodel->where('dftm_id = ' . $this->_data['berkaslayanan']['bly_dftm_id'])->puts_daftartamu($data);

		$referer = $_SERVER['HTTP_REFERER'];
		if(strpos($referer, 'list-notif-layanan') !== false) {
			redirect('list-notif-layanan');
		} else {
			redirect($this->_data['url_listberkaslayanan']);	
		}
		exit();
	}

	function reject($param) {
		$this->_data['berkaslayanan'] = $this->frontendmodel->where('bly_id = ' . $param)->get_row_berkaslayanan();
		if(empty($this->_data['berkaslayanan']['bly_lyn_id'])) {
			die('Maaf, data ini tidak ditemukan!'); exit();
		}

		$this->_data['layanan'] = $this->frontendmodel->where('lyn_id = ' . $this->_data['berkaslayanan']['bly_lyn_id'])->get_row_layanan();
		$this->_data['url_param'] = sanitize_title_with_dashes($this->_data['layanan']['lyn_name']) . URL_DELIMITER . $this->_data['layanan']['lyn_id'];
		$this->_data['url_listberkaslayanan'] = site_url('list-berkas-layanan/' . $this->_data['url_param']);

		$data = array(
			'bly_status' => BERKAS_REJECT,
			'bly_changeuser' => $this->session->userdata('login_username'),
			'bly_changedate' => date('Y-m-d H:i:s'),
		);

		$res = $this->frontendmodel->where('bly_id = ' . $this->_data['berkaslayanan']['bly_id'])->puts_berkaslayanan($data);

		$data = array(
			'dftm_status' => STATUS_APPROVAL,
			'dftm_complete' => 0,
			'dftm_changeuser' => $this->session->userdata('login_username'),
			'dftm_changedate' => date('Y-m-d H:i:s'),
			'dftm_entry_approval' => date('Y-m-d H:i:s'),
		);

		$res = $this->frontendmodel->where('dftm_id = ' . $this->_data['berkaslayanan']['bly_dftm_id'])->puts_daftartamu($data);

		$referer = $_SERVER['HTTP_REFERER'];
		if(strpos($referer, 'list-notif-layanan') !== false) {
			redirect('list-notif-layanan');
		} else {
			redirect($this->_data['url_listberkaslayanan']);	
		}
		exit();
	}

	function unapproved($param) {
		$this->_data['berkaslayanan'] = $this->frontendmodel->where('bly_id = ' . $param)->get_row_berkaslayanan();
		if(empty($this->_data['berkaslayanan']['bly_lyn_id'])) {
			die('Maaf, data ini tidak ditemukan!'); exit();
		}

		$this->_data['layanan'] = $this->frontendmodel->where('lyn_id = ' . $this->_data['berkaslayanan']['bly_lyn_id'])->get_row_layanan();
		$this->_data['url_param'] = sanitize_title_with_dashes($this->_data['layanan']['lyn_name']) . URL_DELIMITER . $this->_data['layanan']['lyn_id'];
		$this->_data['url_listberkaslayanan'] = site_url('list-berkas-layanan/' . $this->_data['url_param']);

		$data = array(
			'bly_status' => BERKAS_LENGKAP,
			'bly_changeuser' => $this->session->userdata('login_username'),
			'bly_changedate' => date('Y-m-d H:i:s'),
		);

		$res = $this->frontendmodel->where('bly_id = ' . $this->_data['berkaslayanan']['bly_id'])->puts_berkaslayanan($data);

		$data = array(
			'dftm_status' => STATUS_APPROVAL,
			'dftm_complete' => 0,
			'dftm_changeuser' => $this->session->userdata('login_username'),
			'dftm_changedate' => date('Y-m-d H:i:s'),
			'dftm_entry_approval' => date('Y-m-d H:i:s'),
		);

		$res = $this->frontendmodel->where('dftm_id = ' . $this->_data['berkaslayanan']['bly_dftm_id'])->puts_daftartamu($data);

		$referer = $_SERVER['HTTP_REFERER'];
		if(strpos($referer, 'list-notif-layanan') !== false) {
			redirect('list-notif-layanan');
		} else {
			redirect($this->_data['url_listberkaslayanan']);	
		}
		exit();
	}

	function sertifikat($param) {
		$this->_data['berkaslayanan'] = $this->frontendmodel->where('bly_id = ' . $param)->get_row_berkaslayanan();
		if(empty($this->_data['berkaslayanan']['bly_lyn_id'])) {
			die('Maaf, data ini tidak ditemukan!'); exit();
		}

		$this->_data['layanan'] = $this->frontendmodel->where('lyn_id = ' . $this->_data['berkaslayanan']['bly_lyn_id'])->get_sertifikat_layanan();

		$this->_data['formisian'] = $this->frontendmodel->where('frm_bly_id = ' . $this->_data['berkaslayanan']['bly_id'])->get_row_formisian();
		if(empty($this->_data['formisian']['frm_id'])) {
			die('Maaf, data ini tidak ditemukan!'); exit();
		}

		$res = $this->frontendmodel->where('frm_id = ' . $this->_data['formisian']['frm_id'])->get_nomorsertifikat_layanan();
		if(!empty($res['frm_no_surat_sertifikat'])) {
			$this->_data['nomorsertifikatlayanan'] = $res['frm_no_surat_sertifikat'];
		} else {
			$frm_id = $res['frm_id'];
			$grno_id = $res['grno_id'];
			$nourut = $res['grno_nourut'] + 1;

			$arr_data = array(
		        'noser_urut' => ($nourut < 10 ? ('00'.$nourut) : ($nourut < 100 ? ('0'.$nourut) : $nourut)),
		        'noser_tahun' => date('Y'),
		        'jumlah_praktik' => (!empty($res['frm_jumlah_praktik']) ? $res['frm_jumlah_praktik'] : 0),
		        'status_perpanjang' => (!empty($res['frm_perpanjang_layanan']) ? $res['frm_perpanjang_layanan'] : 0),
		    );

    		$this->_data['nomorsertifikatlayanan'] = parse_stringphp($res['grno_nomor'], $arr_data);

    		$data = array(
				'frm_no_surat_sertifikat' => $this->_data['nomorsertifikatlayanan'],
				'frm_changeuser' => $this->session->userdata('login_username'),
				'frm_changedate' => date('Y-m-d H:i:s'),
			);

			$res = $this->frontendmodel->where('frm_id = ' . $frm_id)->puts_formisian($data);

			$data = array(
				'grno_nourut' => $nourut,
				'grno_changeuser' => $this->session->userdata('login_username'),
				'grno_changedate' => date('Y-m-d H:i:s'),
			);

			$res = $this->frontendmodel->where('grno_id = ' . $grno_id)->puts_groupnomorsertifikat($data);
		}

		$data = array(
			'dftm_status' => STATUS_CETAK,
			'dftm_changeuser' => $this->session->userdata('login_username'),
			'dftm_changedate' => date('Y-m-d H:i:s'),
			'dftm_entry_cetak' => date('Y-m-d H:i:s'),
		);

		$res = $this->frontendmodel->where('dftm_id = ' . $this->_data['berkaslayanan']['bly_dftm_id'])->puts_daftartamu($data);

		$this->_data['formisian']['frm_alamat'] = nl2br($this->_data['formisian']['frm_alamat']);

		$this->template->set('title', 'Layanan | Sertifikat Layanan');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_print/main_portrait', 'sertifikat', $this->_data);
	}

	function listnotiflayanan() {
		$this->_data['berkaslayanan'] = $this->frontendmodel->select('lyn_gly_id, bly_lyn_id, bly_id, bly_noberkas, bly_pemohon, bly_notes, bly_status, bly_entrydate, frm_id, dftm_complete, lyn_name, lyn_id')->where('bly_status >= ' . BERKAS_LENGKAP)->order_by_multi('bly_status ASC, dftm_id DESC')->get_all_berkaslayananjoininnernotif();

		//print_r($this->_data['berkaslayanan']); exit();

		$this->template->set('title', 'Layanan | List Notifikasi Layanan');
		$this->template->set('assets', $this->_data['assets']);
		$this->template->load('template_frontend/main', 'lists_notif', $this->_data);
	}

	function finish($param) {
		$this->_data['berkaslayanan'] = $this->frontendmodel->where('bly_id = ' . $param)->get_row_berkaslayanan();
		if(empty($this->_data['berkaslayanan']['bly_lyn_id'])) {
			die('Maaf, data ini tidak ditemukan!'); exit();
		}

		$this->_data['layanan'] = $this->frontendmodel->where('lyn_id = ' . $this->_data['berkaslayanan']['bly_lyn_id'])->get_row_layanan();
		$this->_data['url_param'] = sanitize_title_with_dashes($this->_data['layanan']['lyn_name']) . URL_DELIMITER . $this->_data['layanan']['lyn_id'];
		$this->_data['url_listberkaslayanan'] = site_url('list-berkas-layanan/' . $this->_data['url_param']);

		$data = array(
			'dftm_complete' => LAYANAN_COMPLETE,
			'dftm_entry_complete' => date('Y-m-d H:i:s'),
			'dftm_changeuser' => $this->session->userdata('login_username'),
			'dftm_changedate' => date('Y-m-d H:i:s'),
		);

		$res = $this->frontendmodel->where('dftm_id = ' . $this->_data['berkaslayanan']['bly_dftm_id'])->puts_daftartamu($data);

		$referer = $_SERVER['HTTP_REFERER'];
		if(strpos($referer, 'list-notif-layanan') !== false) {
			redirect('list-notif-layanan');
		} else {
			redirect($this->_data['url_listberkaslayanan']);	
		}
		exit();
	}

	function get_data_kota($param) {
		$this->_data['kota'] = $this->frontendmodel->get_option_kabupaten($param);
		$res = $this->load->view('option_wilayah/kota', $this->_data, TRUE);
		echo $res;
	}

	function get_data_kecamatan($param) {
		$this->_data['kecamatan'] = $this->frontendmodel->get_option_kecamatan($param);
		$res = $this->load->view('option_wilayah/kecamatan', $this->_data, TRUE);
		echo $res;
	}

	function get_data_kelurahan($param) {
		$this->_data['kelurahan'] = $this->frontendmodel->get_option_kelurahan($param);
		$res = $this->load->view('option_wilayah/kelurahan', $this->_data, TRUE);
		echo $res;
	}

	function delete($id) {
		$rfr = $_SERVER['HTTP_REFERER'];
		if(!empty($id)) {
			$data_berkaslayanan = $this->frontendmodel->where(array('bly_id' => $id))->get_row_berkaslayanan();
			$dftm_id = $data_berkaslayanan['bly_dftm_id'];

			$data = array(
				'dftm_status' => STATUS_DAFTARTAMU,
				'dftm_waiting' => '',
				'dftm_complete' => '',
				'dftm_entry_berkas' => '',
				'dftm_entry_formisian' => '',
				'dftm_entry_approval' => '',
				'dftm_entry_cetak' => '',
				'dftm_changeuser' => $this->session->userdata('login_username'),
				'dftm_changedate' => date('Y-m-d H:i:s'),
			);
			$res = $this->frontendmodel->where('dftm_id = ' . $dftm_id)->puts_daftartamu($data);

			$this->frontendmodel->delete_formisian(array('frm_bly_id' => $id));
			$this->frontendmodel->delete_berkaslayanan(array('bly_id' => $id));
		}
		redirect($rfr);
		exit();
	}
}

?>