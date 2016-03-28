<?php
if (!function_exists('get_formisian'))
{
	function get_formisian($id_layanan = '', $id_group_layanan = '', $default_data = '') {
		$CI =& get_instance();
		$CI->load->model('frontend_model', 'frontendmodel');
		$select_option_provinsi = $CI->frontendmodel->get_option_provinsi();

		$provinsi = !empty($default_data['frm_provinsi']) ? $default_data['frm_provinsi'] : 'xx';
		$kota = !empty($default_data['frm_kota']) ? $default_data['frm_kota'] : 'xx';
		$kecamatan = !empty($default_data['frm_kecamatan']) ? $default_data['frm_kecamatan'] : 'xx';

		$select_option_kota = $CI->frontendmodel->get_option_kabupaten($provinsi);
		$select_option_kecamatan = $CI->frontendmodel->get_option_kecamatan($kota);
		$select_option_kelurahan = $CI->frontendmodel->get_option_kelurahan($kecamatan);

		$CI->config->load('data_source');
		$general = $CI->config->item('general');

		$select_option_jeniskelamin = $general['jenis_kelamin'];
		$select_option_agama = $general['agama'];
		$select_tipe_kantor = $general['tipe_kantor'];

		if(in_array($id_layanan, array(ID_LAYANAN_N_1, ID_LAYANAN_N_2, ID_LAYANAN_N_4))) {
			$data = array(
			array('label' => 'NIK', 'name' => 'frm_nik', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_nik']) ? $default_data['frm_nik'] : '')),
			array('label' => 'Warga Negara', 'name' => 'frm_warga_negara', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_warga_negara']) ? $default_data['frm_warga_negara'] : '')),
			array('label' => 'Tempat Lahir', 'name' => 'frm_tempatlahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tempatlahir']) ? $default_data['frm_tempatlahir'] : '')),
			array('label' => 'Tanggal Lahir (yyyy-mm-dd)', 'name' => 'frm_tanggallahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tanggallahir']) ? $default_data['frm_tanggallahir'] : '')),
			array('label' => 'Jenis Kelamin', 'name' => 'frm_jeniskelamin', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_jeniskelamin, 'default' => (!empty($default_data['frm_jeniskelamin']) ? $default_data['frm_jeniskelamin'] : '')),
			array('label' => 'Agama', 'name' => 'frm_agama', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_agama, 'default' => (!empty($default_data['frm_agama']) ? $default_data['frm_agama'] : '')),
			array('label' => 'Alamat', 'name' => 'frm_alamat', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat']) ? $default_data['frm_alamat'] : '')),
			array('label' => 'Pekerjaan', 'name' => 'frm_pekerjaan', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_pekerjaan']) ? $default_data['frm_pekerjaan'] : '')),
			array('label' => 'Status Perkawinan', 'name' => 'frm_status_perkawinan', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_status_perkawinan']) ? $default_data['frm_status_perkawinan'] : '')),
			array('label' => 'Nama Istri / Suami Terdahulu', 'name' => 'frm_nama_pasangan_terdahulu', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_nama_pasangan_terdahulu']) ? $default_data['frm_nama_pasangan_terdahulu'] : '')),
			array('label' => 'Catatan', 'name' => 'frm_notes', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_notes']) ? $default_data['frm_notes'] : '')),
			array('label' => 'Nama Ayah', 'name' => 'frm_ortu_ayah_nama', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_ortu_ayah_nama']) ? $default_data['frm_ortu_ayah_nama'] : '')),
			array('label' => 'Tempat Lahir Ayah', 'name' => 'frm_ortu_ayah_tempat_lahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_ortu_ayah_tempat_lahir']) ? $default_data['frm_ortu_ayah_tempat_lahir'] : '')),
			array('label' => 'Tanggal Lahir Ayah (yyyy-mm-dd)', 'name' => 'frm_ortu_ayah_tanggal_lahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_ortu_ayah_tanggal_lahir']) ? $default_data['frm_ortu_ayah_tanggal_lahir'] : '')),
			array('label' => 'Warga Negara Ayah', 'name' => 'frm_ortu_ayah_warga_negara', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_ortu_ayah_warga_negara']) ? $default_data['frm_ortu_ayah_warga_negara'] : '')),
			array('label' => 'Agama Ayah', 'name' => 'frm_ortu_ayah_agama', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_agama, 'default' => (!empty($default_data['frm_ortu_ayah_agama']) ? $default_data['frm_ortu_ayah_agama'] : '')),
			array('label' => 'Pekerjaan Ayah', 'name' => 'frm_ortu_ayah_pekerjaan', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_ortu_ayah_pekerjaan']) ? $default_data['frm_ortu_ayah_pekerjaan'] : '')),
			array('label' => 'Tempat Tinggal Ayah', 'name' => 'frm_ortu_ayah_tempat_tinggal', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_ortu_ayah_tempat_tinggal']) ? $default_data['frm_ortu_ayah_tempat_tinggal'] : '')),
			array('label' => 'Nama Ibu', 'name' => 'frm_ortu_ibu_nama', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_ortu_ibu_nama']) ? $default_data['frm_ortu_ibu_nama'] : '')),
			array('label' => 'Tempat Lahir Ibu', 'name' => 'frm_ortu_ibu_tempat_lahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_ortu_ibu_tempat_lahir']) ? $default_data['frm_ortu_ibu_tempat_lahir'] : '')),
			array('label' => 'Tanggal Lahir Ibu (yyyy-mm-dd)', 'name' => 'frm_ortu_ibu_tanggal_lahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_ortu_ibu_tanggal_lahir']) ? $default_data['frm_ortu_ibu_tanggal_lahir'] : '')),
			array('label' => 'Warga Negara Ibu', 'name' => 'frm_ortu_ibu_warga_negara', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_ortu_ibu_warga_negara']) ? $default_data['frm_ortu_ibu_warga_negara'] : '')),
			array('label' => 'Agama Ibu', 'name' => 'frm_ortu_ibu_agama', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_agama, 'default' => (!empty($default_data['frm_ortu_ibu_agama']) ? $default_data['frm_ortu_ibu_agama'] : '')),
			array('label' => 'Pekerjaan Ibu', 'name' => 'frm_ortu_ibu_pekerjaan', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_ortu_ibu_pekerjaan']) ? $default_data['frm_ortu_ibu_pekerjaan'] : '')),
			array('label' => 'Tempat Tinggal Ibu', 'name' => 'frm_ortu_ibu_tempat_tinggal', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_ortu_ibu_tempat_tinggal']) ? $default_data['frm_ortu_ibu_tempat_tinggal'] : '')),
			);
		}
		elseif($id_layanan == ID_LAYANAN_N_6) {
			$data = array(
			array('label' => 'NIK', 'name' => 'frm_nik', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_nik']) ? $default_data['frm_nik'] : '')),
			array('label' => 'Bin Binti', 'name' => 'frm_bin_binti_pemohon', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_bin_binti_pemohon']) ? $default_data['frm_bin_binti_pemohon'] : '')),
			array('label' => 'Tempat Lahir', 'name' => 'frm_tempatlahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tempatlahir']) ? $default_data['frm_tempatlahir'] : '')),
			array('label' => 'Tanggal Lahir (yyyy-mm-dd)', 'name' => 'frm_tanggallahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tanggallahir']) ? $default_data['frm_tanggallahir'] : '')),
			array('label' => 'Jenis Kelamin', 'name' => 'frm_jeniskelamin', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_jeniskelamin, 'default' => (!empty($default_data['frm_jeniskelamin']) ? $default_data['frm_jeniskelamin'] : '')),
			array('label' => 'Agama', 'name' => 'frm_agama', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_agama, 'default' => (!empty($default_data['frm_agama']) ? $default_data['frm_agama'] : '')),
			array('label' => 'Alamat', 'name' => 'frm_alamat', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat']) ? $default_data['frm_alamat'] : '')),
			array('label' => 'Pekerjaan', 'name' => 'frm_pekerjaan', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_pekerjaan']) ? $default_data['frm_pekerjaan'] : '')),
			array('label' => 'Nama Mendiang', 'name' => 'frm_mendiang_nama', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_mendiang_nama']) ? $default_data['frm_mendiang_nama'] : '')),
			array('label' => 'NIK Mendiang', 'name' => 'frm_mendiang_nik', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_mendiang_nik']) ? $default_data['frm_mendiang_nik'] : '')),
			array('label' => 'Jenis Kelamin Mendiang', 'name' => 'frm_mendiang_jenis_kelamin', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_jeniskelamin, 'default' => (!empty($default_data['frm_mendiang_jenis_kelamin']) ? $default_data['frm_mendiang_jenis_kelamin'] : '')),
			array('label' => 'Bin / Binti Mendiang', 'name' => 'frm_mendiang_bin_binti', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_mendiang_bin_binti']) ? $default_data['frm_mendiang_bin_binti'] : '')),
			array('label' => 'Tempat Lahir Mendiang', 'name' => 'frm_mendiang_tempat_lahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_mendiang_tempat_lahir']) ? $default_data['frm_mendiang_tempat_lahir'] : '')),
			array('label' => 'Tanggal Lahir Mendiang (yyyy-mm-dd)', 'name' => 'frm_mendiang_tanggal_lahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_mendiang_tanggal_lahir']) ? $default_data['frm_mendiang_tanggal_lahir'] : '')),
			array('label' => 'Warga Negara Mendiang', 'name' => 'frm_mendiang_warga_negara', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_mendiang_warga_negara']) ? $default_data['frm_mendiang_warga_negara'] : '')),
			array('label' => 'Agama Mendiang', 'name' => 'frm_mendiang_agama', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_agama, 'default' => (!empty($default_data['frm_mendiang_agama']) ? $default_data['frm_mendiang_agama'] : '')),
			array('label' => 'Pekerjaan Mendiang', 'name' => 'frm_mendiang_pekerjaan', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_mendiang_pekerjaan']) ? $default_data['frm_mendiang_pekerjaan'] : '')),
			array('label' => 'Tempat Tinggal Mendiang', 'name' => 'frm_mendiang_tempat_tinggal', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_mendiang_tempat_tinggal']) ? $default_data['frm_mendiang_tempat_tinggal'] : '')),
			array('label' => 'Tanggal Meninggal Mendiang (yyyy-mm-dd)', 'name' => 'frm_mendiang_tanggal_meninggal', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_mendiang_tanggal_meninggal']) ? $default_data['frm_mendiang_tanggal_meninggal'] : '')),
			array('label' => 'Sebab Meninggal Mendiang', 'name' => 'frm_mendiang_sebab_meninggal', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_mendiang_sebab_meninggal']) ? $default_data['frm_mendiang_sebab_meninggal'] : '')),
			array('label' => 'Lokasi Meninggal Mendiang', 'name' => 'frm_mendiang_lokasi_meninggal', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_mendiang_lokasi_meninggal']) ? $default_data['frm_mendiang_lokasi_meninggal'] : '')),
			array('label' => 'Status Hubungan', 'name' => 'frm_mendiang_status_hubungan', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_mendiang_status_hubungan']) ? $default_data['frm_mendiang_status_hubungan'] : '')),
			);
		}
		elseif($id_layanan == ID_LAYANAN_RETRIBUSI) {
			$data = array(
			array('label' => 'Retribusi', 'name' => 'frm_retribusi', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_retribusi']) ? $default_data['frm_retribusi'] : '')),
			);
		}
		elseif($id_group_layanan == ID_GROUP_PELAYANAN_UMUM) {
			if($id_layanan == ID_LAYANAN_BADAN_USAHA) {
				$data = array(
					array('label' => 'KTP', 'name' => 'frm_nik', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_nik']) ? $default_data['frm_nik'] : '')),
					array('label' => 'Jenis Kelamin', 'name' => 'frm_jeniskelamin', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_jeniskelamin, 'default' => (!empty($default_data['frm_jeniskelamin']) ? $default_data['frm_jeniskelamin'] : '')),
					array('label' => 'Agama', 'name' => 'frm_agama', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_agama, 'default' => (!empty($default_data['frm_agama']) ? $default_data['frm_agama'] : '')),
					array('label' => 'Tipe Kantor', 'name' => 'frm_bu_tipe_kantor', 'type' => 'select', 'required' => 1, 'select_option' => $select_tipe_kantor, 'default' => (!empty($default_data['frm_bu_tipe_kantor']) ? $default_data['frm_bu_tipe_kantor'] : '')),
					array('label' => 'Tempat Lahir', 'name' => 'frm_tempatlahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tempatlahir']) ? $default_data['frm_tempatlahir'] : '')),
					array('label' => 'Tanggal Lahir (yyyy-mm-dd)', 'name' => 'frm_tanggallahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tanggallahir']) ? $default_data['frm_tanggallahir'] : '')),
					array('label' => 'Alamat', 'name' => 'frm_alamat', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat']) ? $default_data['frm_alamat'] : '')),
					array('label' => 'Nama Perusahaan', 'name' => 'frm_bu_nama_perusahaan', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_bu_nama_perusahaan']) ? $default_data['frm_bu_nama_perusahaan'] : '')),
					array('label' => 'Telepon', 'name' => 'frm_telp', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_telp']) ? $default_data['frm_telp'] : '')),
					array('label' => 'Jenis Usaha (KLBI)', 'name' => 'frm_bu_jenis_usaha', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_bu_jenis_usaha']) ? $default_data['frm_bu_jenis_usaha'] : '')),
					array('label' => 'Alamat Perusahaan (Jalan/Gedung, No)', 'name' => 'frm_bu_alamat_perusahaan', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_bu_alamat_perusahaan']) ? $default_data['frm_bu_alamat_perusahaan'] : '')),
					array('label' => 'Status Bangunan', 'name' => 'frm_bu_status_bangunan', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_bu_status_bangunan']) ? $default_data['frm_bu_status_bangunan'] : '')),
					array('label' => 'Peruntukan Bangunan (Sesuai Perda, Zona dan Sub Zona)', 'name' => 'frm_bu_peruntukan_bangunan', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_bu_peruntukan_bangunan']) ? $default_data['frm_bu_peruntukan_bangunan'] : '')),
					array('label' => 'Kegiatan Usaha', 'name' => 'frm_bu_kegiatan_usaha', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_bu_kegiatan_usaha']) ? $default_data['frm_bu_kegiatan_usaha'] : '')),
					array('label' => 'Kesesuaian Peruntukan', 'name' => 'frm_bu_kesesuaian_peruntukan', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_bu_kesesuaian_peruntukan']) ? $default_data['frm_bu_kesesuaian_peruntukan'] : '')),
					array('label' => 'No IMB', 'name' => 'frm_bu_no_imb', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_bu_no_imb']) ? $default_data['frm_bu_no_imb'] : '')),
					array('label' => 'Tanggal IMB (yyyy-mm-dd)', 'name' => 'frm_bu_tanggal_imb', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_bu_tanggal_imb']) ? $default_data['frm_bu_tanggal_imb'] : '')),
					array('label' => 'Nama Notaris', 'name' => 'frm_bu_nama_notaris', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_bu_nama_notaris']) ? $default_data['frm_bu_nama_notaris'] : '')),
					array('label' => 'No Notaris', 'name' => 'frm_bu_nomor_notaris', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_bu_nomor_notaris']) ? $default_data['frm_bu_nomor_notaris'] : '')),
					array('label' => 'Tanggal Notaris (yyyy-mm-dd)', 'name' => 'frm_bu_tanggal_notaris', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_bu_tanggal_notaris']) ? $default_data['frm_bu_tanggal_notaris'] : '')),
					array('label' => 'Jumlah Karyawan', 'name' => 'frm_bu_jumlah_karyawan', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_bu_jumlah_karyawan']) ? $default_data['frm_bu_jumlah_karyawan'] : '')),
					array('label' => 'Penanggung Jawab / Pimpinan', 'name' => 'frm_bu_pimpinan_perusahaan', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_bu_pimpinan_perusahaan']) ? $default_data['frm_bu_pimpinan_perusahaan'] : '')),
					//array('label' => 'Masa Berlaku', 'name' => 'frm_bu_masa_berlaku', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_bu_masa_berlaku']) ? $default_data['frm_bu_masa_berlaku'] : '')),
					array('label' => 'Tanggal dikeluarkan (yyyy-mm-dd)', 'name' => 'frm_bu_tanggal_dikeluarkan', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_bu_tanggal_dikeluarkan']) ? $default_data['frm_bu_tanggal_dikeluarkan'] : '')),
					array('label' => 'Catatan Tambahan', 'name' => 'frm_notes', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_notes']) ? $default_data['frm_notes'] : '')),
					
				);
			} else {
				$data = array(
					array('label' => 'NIK', 'name' => 'frm_nik', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_nik']) ? $default_data['frm_nik'] : '')),
					array('label' => 'Tempat Lahir', 'name' => 'frm_tempatlahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tempatlahir']) ? $default_data['frm_tempatlahir'] : '')),
					array('label' => 'Tanggal Lahir (yyyy-mm-dd)', 'name' => 'frm_tanggallahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tanggallahir']) ? $default_data['frm_tanggallahir'] : '')),
					array('label' => 'Jenis Kelamin', 'name' => 'frm_jeniskelamin', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_jeniskelamin, 'default' => (!empty($default_data['frm_jeniskelamin']) ? $default_data['frm_jeniskelamin'] : '')),
					array('label' => 'Agama', 'name' => 'frm_agama', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_agama, 'default' => (!empty($default_data['frm_agama']) ? $default_data['frm_agama'] : '')),
					array('label' => 'Alamat', 'name' => 'frm_alamat', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat']) ? $default_data['frm_alamat'] : '')),
					array('label' => 'RT', 'name' => 'frm_rt', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_rt']) ? $default_data['frm_rt'] : '')),
					array('label' => 'RW', 'name' => 'frm_rw', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_rw']) ? $default_data['frm_rw'] : '')),
					array('label' => 'No Surat Pengantar', 'name' => 'frm_no_surat_pengantar', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_no_surat_pengantar']) ? $default_data['frm_no_surat_pengantar'] : '')),
					array('label' => 'Pekerjaan', 'name' => 'frm_pekerjaan', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_pekerjaan']) ? $default_data['frm_pekerjaan'] : '')),
					array('label' => 'Maksud/Keperluan', 'name' => 'frm_keperluan', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_keperluan']) ? $default_data['frm_keperluan'] : '')),
				);
			}
		} else {
			switch ($id_layanan) {
				case 2:
					$data = array(
						array('label' => 'Tempat Lahir', 'name' => 'frm_tempatlahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tempatlahir']) ? $default_data['frm_tempatlahir'] : '')),
						array('label' => 'Tanggal Lahir (yyyy-mm-dd)', 'name' => 'frm_tanggallahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tanggallahir']) ? $default_data['frm_tanggallahir'] : '')),
						array('label' => 'Provinsi', 'name' => 'frm_provinsi', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_provinsi, 'default' => (!empty($default_data['frm_provinsi']) ? $default_data['frm_provinsi'] : '')),
						array('label' => 'Kota', 'name' => 'frm_kota', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kota, 'default' => (!empty($default_data['frm_kota']) ? $default_data['frm_kota'] : '')),
						array('label' => 'Kecamatan', 'name' => 'frm_kecamatan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kecamatan, 'default' => (!empty($default_data['frm_kecamatan']) ? $default_data['frm_kecamatan'] : '')),
						array('label' => 'Kelurahan', 'name' => 'frm_kelurahan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kelurahan, 'default' => (!empty($default_data['frm_kelurahan']) ? $default_data['frm_kelurahan'] : '')),
						array('label' => 'Alamat', 'name' => 'frm_alamat', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat']) ? $default_data['frm_alamat'] : '')),
						array('label' => 'Alamat Tempat Praktik', 'name' => 'frm_alamat_tempat_praktik', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat_tempat_praktik']) ? $default_data['frm_alamat_tempat_praktik'] : '')),
						array('label' => 'Kota Tempat Praktik', 'name' => 'frm_kota_tempat_praktik', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_kota_tempat_praktik']) ? $default_data['frm_kota_tempat_praktik'] : '')),
						array('label' => 'No. STR', 'name' => 'frm_no_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_no_str']) ? $default_data['frm_no_str'] : '')),
						array('label' => 'Masa Berlaku STR', 'name' => 'frm_masa_berlaku_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_masa_berlaku_str']) ? $default_data['frm_masa_berlaku_str'] : '')),
						
					);
					break;
				case 3:
					$data = array(
						array('label' => 'Tempat Lahir', 'name' => 'frm_tempatlahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tempatlahir']) ? $default_data['frm_tempatlahir'] : '')),
						array('label' => 'Tanggal Lahir (yyyy-mm-dd)', 'name' => 'frm_tanggallahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tanggallahir']) ? $default_data['frm_tanggallahir'] : '')),
						array('label' => 'Provinsi', 'name' => 'frm_provinsi', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_provinsi, 'default' => (!empty($default_data['frm_provinsi']) ? $default_data['frm_provinsi'] : '')),
						array('label' => 'Kota', 'name' => 'frm_kota', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kota, 'default' => (!empty($default_data['frm_kota']) ? $default_data['frm_kota'] : '')),
						array('label' => 'Kecamatan', 'name' => 'frm_kecamatan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kecamatan, 'default' => (!empty($default_data['frm_kecamatan']) ? $default_data['frm_kecamatan'] : '')),
						array('label' => 'Kelurahan', 'name' => 'frm_kelurahan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kelurahan, 'default' => (!empty($default_data['frm_kelurahan']) ? $default_data['frm_kelurahan'] : '')),
						array('label' => 'Alamat', 'name' => 'frm_alamat', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat']) ? $default_data['frm_alamat'] : '')),
						array('label' => 'Nama Fasyankes', 'name' => 'frm_nama_fasyankes', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_nama_fasyankes']) ? $default_data['frm_nama_fasyankes'] : '')),
						array('label' => 'Alamat Fasyankes', 'name' => 'frm_alamat_fasyankes', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat_fasyankes']) ? $default_data['frm_alamat_fasyankes'] : '')),
						array('label' => 'Kota Fasyankes', 'name' => 'frm_kota_fasyankes', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_kota_fasyankes']) ? $default_data['frm_kota_fasyankes'] : '')),
						array('label' => 'Jumlah Praktik', 'name' => 'frm_jumlah_praktik', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_jumlah_praktik']) ? $default_data['frm_jumlah_praktik'] : '')),
						array('label' => 'No. STR', 'name' => 'frm_no_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_no_str']) ? $default_data['frm_no_str'] : '')),
						array('label' => 'Masa Berlaku STR', 'name' => 'frm_masa_berlaku_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_masa_berlaku_str']) ? $default_data['frm_masa_berlaku_str'] : '')),
						array('label' => 'No Rekomendasi PDGI', 'name' => 'frm_no_rekomendasi_pdgi', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_no_rekomendasi_pdgi']) ? $default_data['frm_no_rekomendasi_pdgi'] : '')),
						
					);
					break;
				case 4:
					$data = array(
						array('label' => 'Tempat Lahir', 'name' => 'frm_tempatlahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tempatlahir']) ? $default_data['frm_tempatlahir'] : '')),
						array('label' => 'Tanggal Lahir (yyyy-mm-dd)', 'name' => 'frm_tanggallahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tanggallahir']) ? $default_data['frm_tanggallahir'] : '')),
						array('label' => 'Provinsi', 'name' => 'frm_provinsi', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_provinsi, 'default' => (!empty($default_data['frm_provinsi']) ? $default_data['frm_provinsi'] : '')),
						array('label' => 'Kota', 'name' => 'frm_kota', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kota, 'default' => (!empty($default_data['frm_kota']) ? $default_data['frm_kota'] : '')),
						array('label' => 'Kecamatan', 'name' => 'frm_kecamatan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kecamatan, 'default' => (!empty($default_data['frm_kecamatan']) ? $default_data['frm_kecamatan'] : '')),
						array('label' => 'Kelurahan', 'name' => 'frm_kelurahan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kelurahan, 'default' => (!empty($default_data['frm_kelurahan']) ? $default_data['frm_kelurahan'] : '')),
						array('label' => 'Alamat', 'name' => 'frm_alamat', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat']) ? $default_data['frm_alamat'] : '')),
						array('label' => 'Alamat Tempat Praktik', 'name' => 'frm_alamat_tempat_praktik', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat_tempat_praktik']) ? $default_data['frm_alamat_tempat_praktik'] : '')),
						array('label' => 'Kota Tempat Praktik', 'name' => 'frm_kota_tempat_praktik', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_kota_tempat_praktik']) ? $default_data['frm_kota_tempat_praktik'] : '')),
						array('label' => 'Jumlah Praktik', 'name' => 'frm_jumlah_praktik', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_jumlah_praktik']) ? $default_data['frm_jumlah_praktik'] : '')),
						array('label' => 'No. STR', 'name' => 'frm_no_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_no_str']) ? $default_data['frm_no_str'] : '')),
						array('label' => 'Masa Berlaku STR', 'name' => 'frm_masa_berlaku_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_masa_berlaku_str']) ? $default_data['frm_masa_berlaku_str'] : '')),
						array('label' => 'No Rekomendasi PDGI', 'name' => 'frm_no_rekomendasi_pdgi', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_no_rekomendasi_pdgi']) ? $default_data['frm_no_rekomendasi_pdgi'] : '')),
						
					);
					break;
				case 5:
					$data = array(
						array('label' => 'Tempat Lahir', 'name' => 'frm_tempatlahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tempatlahir']) ? $default_data['frm_tempatlahir'] : '')),
						array('label' => 'Tanggal Lahir (yyyy-mm-dd)', 'name' => 'frm_tanggallahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tanggallahir']) ? $default_data['frm_tanggallahir'] : '')),
						array('label' => 'Provinsi', 'name' => 'frm_provinsi', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_provinsi, 'default' => (!empty($default_data['frm_provinsi']) ? $default_data['frm_provinsi'] : '')),
						array('label' => 'Kota', 'name' => 'frm_kota', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kota, 'default' => (!empty($default_data['frm_kota']) ? $default_data['frm_kota'] : '')),
						array('label' => 'Kecamatan', 'name' => 'frm_kecamatan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kecamatan, 'default' => (!empty($default_data['frm_kecamatan']) ? $default_data['frm_kecamatan'] : '')),
						array('label' => 'Kelurahan', 'name' => 'frm_kelurahan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kelurahan, 'default' => (!empty($default_data['frm_kelurahan']) ? $default_data['frm_kelurahan'] : '')),
						array('label' => 'Alamat', 'name' => 'frm_alamat', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat']) ? $default_data['frm_alamat'] : '')),
						array('label' => 'Nama Fasyankes', 'name' => 'frm_nama_fasyankes', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_nama_fasyankes']) ? $default_data['frm_nama_fasyankes'] : '')),
						array('label' => 'Alamat Fasyankes', 'name' => 'frm_alamat_fasyankes', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat_fasyankes']) ? $default_data['frm_alamat_fasyankes'] : '')),
						array('label' => 'Kota Fasyankes', 'name' => 'frm_kota_fasyankes', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_kota_fasyankes']) ? $default_data['frm_kota_fasyankes'] : '')),
						array('label' => 'Jumlah Praktik', 'name' => 'frm_jumlah_praktik', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_jumlah_praktik']) ? $default_data['frm_jumlah_praktik'] : '')),
						array('label' => 'No. STR', 'name' => 'frm_no_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_no_str']) ? $default_data['frm_no_str'] : '')),
						array('label' => 'Masa Berlaku STR', 'name' => 'frm_masa_berlaku_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_masa_berlaku_str']) ? $default_data['frm_masa_berlaku_str'] : '')),
						array('label' => 'No Rekomendasi OP', 'name' => 'frm_no_rekomendasi_op', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_no_rekomendasi_op']) ? $default_data['frm_no_rekomendasi_op'] : '')),
						
					);
					break;
				case 6:
					$data = array(
						array('label' => 'Tempat Lahir', 'name' => 'frm_tempatlahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tempatlahir']) ? $default_data['frm_tempatlahir'] : '')),
						array('label' => 'Tanggal Lahir (yyyy-mm-dd)', 'name' => 'frm_tanggallahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tanggallahir']) ? $default_data['frm_tanggallahir'] : '')),
						array('label' => 'Provinsi', 'name' => 'frm_provinsi', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_provinsi, 'default' => (!empty($default_data['frm_provinsi']) ? $default_data['frm_provinsi'] : '')),
						array('label' => 'Kota', 'name' => 'frm_kota', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kota, 'default' => (!empty($default_data['frm_kota']) ? $default_data['frm_kota'] : '')),
						array('label' => 'Kecamatan', 'name' => 'frm_kecamatan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kecamatan, 'default' => (!empty($default_data['frm_kecamatan']) ? $default_data['frm_kecamatan'] : '')),
						array('label' => 'Kelurahan', 'name' => 'frm_kelurahan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kelurahan, 'default' => (!empty($default_data['frm_kelurahan']) ? $default_data['frm_kelurahan'] : '')),
						array('label' => 'Alamat', 'name' => 'frm_alamat', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat']) ? $default_data['frm_alamat'] : '')),
						array('label' => 'Alamat Tempat Praktik', 'name' => 'frm_alamat_tempat_praktik', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat_tempat_praktik']) ? $default_data['frm_alamat_tempat_praktik'] : '')),
						array('label' => 'Kota Tempat Praktik', 'name' => 'frm_kota_tempat_praktik', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_kota_tempat_praktik']) ? $default_data['frm_kota_tempat_praktik'] : '')),
						array('label' => 'Jumlah Praktik', 'name' => 'frm_jumlah_praktik', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_jumlah_praktik']) ? $default_data['frm_jumlah_praktik'] : '')),
						array('label' => 'No. STR', 'name' => 'frm_no_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_no_str']) ? $default_data['frm_no_str'] : '')),
						array('label' => 'Masa Berlaku STR', 'name' => 'frm_masa_berlaku_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_masa_berlaku_str']) ? $default_data['frm_masa_berlaku_str'] : '')),
						array('label' => 'No Rekomendasi OP', 'name' => 'frm_no_rekomendasi_op', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_no_rekomendasi_op']) ? $default_data['frm_no_rekomendasi_op'] : '')),
						
					);
					break;
				case 7:
					$data = array(
						array('label' => 'Tempat Lahir', 'name' => 'frm_tempatlahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tempatlahir']) ? $default_data['frm_tempatlahir'] : '')),
						array('label' => 'Tanggal Lahir (yyyy-mm-dd)', 'name' => 'frm_tanggallahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tanggallahir']) ? $default_data['frm_tanggallahir'] : '')),
						array('label' => 'Provinsi', 'name' => 'frm_provinsi', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_provinsi, 'default' => (!empty($default_data['frm_provinsi']) ? $default_data['frm_provinsi'] : '')),
						array('label' => 'Kota', 'name' => 'frm_kota', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kota, 'default' => (!empty($default_data['frm_kota']) ? $default_data['frm_kota'] : '')),
						array('label' => 'Kecamatan', 'name' => 'frm_kecamatan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kecamatan, 'default' => (!empty($default_data['frm_kecamatan']) ? $default_data['frm_kecamatan'] : '')),
						array('label' => 'Kelurahan', 'name' => 'frm_kelurahan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kelurahan, 'default' => (!empty($default_data['frm_kelurahan']) ? $default_data['frm_kelurahan'] : '')),
						array('label' => 'Alamat', 'name' => 'frm_alamat', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat']) ? $default_data['frm_alamat'] : '')),
						array('label' => 'Nama Fasyankes', 'name' => 'frm_nama_fasyankes', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_nama_fasyankes']) ? $default_data['frm_nama_fasyankes'] : '')),
						array('label' => 'Alamat Fasyankes', 'name' => 'frm_alamat_fasyankes', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat_fasyankes']) ? $default_data['frm_alamat_fasyankes'] : '')),
						array('label' => 'Kota Fasyankes', 'name' => 'frm_kota_fasyankes', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_kota_fasyankes']) ? $default_data['frm_kota_fasyankes'] : '')),
						array('label' => 'No. STR', 'name' => 'frm_no_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_no_str']) ? $default_data['frm_no_str'] : '')),
						array('label' => 'Masa Berlaku STR', 'name' => 'frm_masa_berlaku_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_masa_berlaku_str']) ? $default_data['frm_masa_berlaku_str'] : '')),
						
					);
					break;
				case 8:
					$data = array(
						array('label' => 'Tempat Lahir', 'name' => 'frm_tempatlahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tempatlahir']) ? $default_data['frm_tempatlahir'] : '')),
						array('label' => 'Tanggal Lahir (yyyy-mm-dd)', 'name' => 'frm_tanggallahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tanggallahir']) ? $default_data['frm_tanggallahir'] : '')),
						array('label' => 'Provinsi', 'name' => 'frm_provinsi', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_provinsi, 'default' => (!empty($default_data['frm_provinsi']) ? $default_data['frm_provinsi'] : '')),
						array('label' => 'Kota', 'name' => 'frm_kota', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kota, 'default' => (!empty($default_data['frm_kota']) ? $default_data['frm_kota'] : '')),
						array('label' => 'Kecamatan', 'name' => 'frm_kecamatan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kecamatan, 'default' => (!empty($default_data['frm_kecamatan']) ? $default_data['frm_kecamatan'] : '')),
						array('label' => 'Kelurahan', 'name' => 'frm_kelurahan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kelurahan, 'default' => (!empty($default_data['frm_kelurahan']) ? $default_data['frm_kelurahan'] : '')),
						array('label' => 'Alamat', 'name' => 'frm_alamat', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat']) ? $default_data['frm_alamat'] : '')),
						array('label' => 'Alamat Tempat Praktik', 'name' => 'frm_alamat_tempat_praktik', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat_tempat_praktik']) ? $default_data['frm_alamat_tempat_praktik'] : '')),
						array('label' => 'Kota Tempat Praktik', 'name' => 'frm_kota_tempat_praktik', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_kota_tempat_praktik']) ? $default_data['frm_kota_tempat_praktik'] : '')),
						array('label' => 'No. STR', 'name' => 'frm_no_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_no_str']) ? $default_data['frm_no_str'] : '')),
						array('label' => 'Masa Berlaku STR', 'name' => 'frm_masa_berlaku_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_masa_berlaku_str']) ? $default_data['frm_masa_berlaku_str'] : '')),
						
					);
					break;
				case 9:
					$data = array(
						array('label' => 'Tempat Lahir', 'name' => 'frm_tempatlahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tempatlahir']) ? $default_data['frm_tempatlahir'] : '')),
						array('label' => 'Tanggal Lahir (yyyy-mm-dd)', 'name' => 'frm_tanggallahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tanggallahir']) ? $default_data['frm_tanggallahir'] : '')),
						array('label' => 'Provinsi', 'name' => 'frm_provinsi', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_provinsi, 'default' => (!empty($default_data['frm_provinsi']) ? $default_data['frm_provinsi'] : '')),
						array('label' => 'Kota', 'name' => 'frm_kota', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kota, 'default' => (!empty($default_data['frm_kota']) ? $default_data['frm_kota'] : '')),
						array('label' => 'Kecamatan', 'name' => 'frm_kecamatan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kecamatan, 'default' => (!empty($default_data['frm_kecamatan']) ? $default_data['frm_kecamatan'] : '')),
						array('label' => 'Kelurahan', 'name' => 'frm_kelurahan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kelurahan, 'default' => (!empty($default_data['frm_kelurahan']) ? $default_data['frm_kelurahan'] : '')),
						array('label' => 'Alamat', 'name' => 'frm_alamat', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat']) ? $default_data['frm_alamat'] : '')),
						array('label' => 'Nama Fasyankes', 'name' => 'frm_nama_fasyankes', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_nama_fasyankes']) ? $default_data['frm_nama_fasyankes'] : '')),
						array('label' => 'Alamat Fasyankes', 'name' => 'frm_alamat_fasyankes', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat_fasyankes']) ? $default_data['frm_alamat_fasyankes'] : '')),
						array('label' => 'Kota Fasyankes', 'name' => 'frm_kota_fasyankes', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_kota_fasyankes']) ? $default_data['frm_kota_fasyankes'] : '')),
						array('label' => 'No. STR', 'name' => 'frm_no_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_no_str']) ? $default_data['frm_no_str'] : '')),
						array('label' => 'Masa Berlaku STR', 'name' => 'frm_masa_berlaku_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_masa_berlaku_str']) ? $default_data['frm_masa_berlaku_str'] : '')),
						
					);
					break;
				case 10:
					$data = array(
						array('label' => 'Tempat Lahir', 'name' => 'frm_tempatlahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tempatlahir']) ? $default_data['frm_tempatlahir'] : '')),
						array('label' => 'Tanggal Lahir (yyyy-mm-dd)', 'name' => 'frm_tanggallahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tanggallahir']) ? $default_data['frm_tanggallahir'] : '')),
						array('label' => 'Provinsi', 'name' => 'frm_provinsi', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_provinsi, 'default' => (!empty($default_data['frm_provinsi']) ? $default_data['frm_provinsi'] : '')),
						array('label' => 'Kota', 'name' => 'frm_kota', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kota, 'default' => (!empty($default_data['frm_kota']) ? $default_data['frm_kota'] : '')),
						array('label' => 'Kecamatan', 'name' => 'frm_kecamatan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kecamatan, 'default' => (!empty($default_data['frm_kecamatan']) ? $default_data['frm_kecamatan'] : '')),
						array('label' => 'Kelurahan', 'name' => 'frm_kelurahan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kelurahan, 'default' => (!empty($default_data['frm_kelurahan']) ? $default_data['frm_kelurahan'] : '')),
						array('label' => 'Alamat', 'name' => 'frm_alamat', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat']) ? $default_data['frm_alamat'] : '')),
						array('label' => 'Nama Sarana Kefarmasian', 'name' => 'frm_nama_sarana_kefarmasian', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_nama_sarana_kefarmasian']) ? $default_data['frm_nama_sarana_kefarmasian'] : '')),
						array('label' => 'Alamat Sarana Kefarmasian', 'name' => 'frm_alamat_sarana_kefarmasian', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_alamat_sarana_kefarmasian']) ? $default_data['frm_alamat_sarana_kefarmasian'] : '')),
						array('label' => 'Kota Sarana Kefarmasian', 'name' => 'frm_kota_sarana_kefarmasian', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_kota_sarana_kefarmasian']) ? $default_data['frm_kota_sarana_kefarmasian'] : '')),
						array('label' => 'No. STRTTK', 'name' => 'frm_no_strttk', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_no_strttk']) ? $default_data['frm_no_strttk'] : '')),
						array('label' => 'Masa Berlaku STR', 'name' => 'frm_masa_berlaku_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_masa_berlaku_str']) ? $default_data['frm_masa_berlaku_str'] : '')),
						array('label' => 'No Rekomendasi PAFI', 'name' => 'frm_no_rekomendasi_pafi', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_no_rekomendasi_pafi']) ? $default_data['frm_no_rekomendasi_pafi'] : '')),
						
					);
					break;
				default:
					$data = array(
						array('label' => 'Tempat Lahir', 'name' => 'frm_tempatlahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tempatlahir']) ? $default_data['frm_tempatlahir'] : '')),
						array('label' => 'Tanggal Lahir (yyyy-mm-dd)', 'name' => 'frm_tanggallahir', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_tanggallahir']) ? $default_data['frm_tanggallahir'] : '')),
						array('label' => 'Provinsi', 'name' => 'frm_provinsi', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_provinsi, 'default' => (!empty($default_data['frm_provinsi']) ? $default_data['frm_provinsi'] : '')),
						array('label' => 'Kota', 'name' => 'frm_kota', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kota, 'default' => (!empty($default_data['frm_kota']) ? $default_data['frm_kota'] : '')),
						array('label' => 'Kecamatan', 'name' => 'frm_kecamatan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kecamatan, 'default' => (!empty($default_data['frm_kecamatan']) ? $default_data['frm_kecamatan'] : '')),
						array('label' => 'Kelurahan', 'name' => 'frm_kelurahan', 'type' => 'select', 'required' => 1, 'select_option' => $select_option_kelurahan, 'default' => (!empty($default_data['frm_kelurahan']) ? $default_data['frm_kelurahan'] : '')),
						array('label' => 'Alamat', 'name' => 'frm_alamat', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat']) ? $default_data['frm_alamat'] : '')),
						array('label' => 'Nama Fasyankes', 'name' => 'frm_nama_fasyankes', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_nama_fasyankes']) ? $default_data['frm_nama_fasyankes'] : '')),
						array('label' => 'Alamat Fasyankes', 'name' => 'frm_alamat_fasyankes', 'type' => 'textarea', 'required' => 1, 'default' => (!empty($default_data['frm_alamat_fasyankes']) ? $default_data['frm_alamat_fasyankes'] : '')),
						array('label' => 'Kota Fasyankes', 'name' => 'frm_kota_fasyankes', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_kota_fasyankes']) ? $default_data['frm_kota_fasyankes'] : '')),
						array('label' => 'No. STR', 'name' => 'frm_no_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_no_str']) ? $default_data['frm_no_str'] : '')),
						array('label' => 'Masa Berlaku STR', 'name' => 'frm_masa_berlaku_str', 'type' => 'text', 'required' => 1, 'default' => (!empty($default_data['frm_masa_berlaku_str']) ? $default_data['frm_masa_berlaku_str'] : '')),
						
					);
					break;
			}
			
		}
		return $data;
	}
}