<?php 

if(!empty($layanan['tpsr_template'])) {
    $select_option_jeniskelamin = $general['jenis_kelamin'];
    $select_option_agama = $general['agama'];
    $select_tipe_kantor = $general['tipe_kantor'];
    $status_perkawinan = $general['status_perkawinan'];

    $no_rekomendasi = '';
    if(!empty($formisian['frm_no_rekomendasi_pdgi'])) $no_rekomendasi = $formisian['frm_no_rekomendasi_pdgi'];
    if(!empty($formisian['frm_no_rekomendasi_op'])) $no_rekomendasi = $formisian['frm_no_rekomendasi_op'];
    if(!empty($formisian['frm_no_rekomendasi_pafi'])) $no_rekomendasi = $formisian['frm_no_rekomendasi_pafi'];

    $frm_karkun_keterampilan = array();
    if(!empty($formisian['frm_karkun_keterampilan'])) {
        $frm_karkun_keterampilan = unserialize($formisian['frm_karkun_keterampilan']);
    }

    $arr_data = array(
        'nama_layanan' => strtoupper($layanan['lyn_name']),
        'nama_pemohon' => $formisian['frm_nama'],
        'nik_pemohon' => $formisian['frm_nik'],
        'tempat_lahir_pemohon' => $formisian['frm_tempatlahir'],
        'tanggal_lahir_pemohon' => (!empty($formisian['frm_tanggallahir']) AND $formisian['frm_tanggallahir'] != '0000-00-00') ? mysql_to_date($formisian['frm_tanggallahir']) : '',
        'alamat_pemohon' => $formisian['frm_alamat'],
        'no_str' => $formisian['frm_no_str'],
        'pekerjaan_pemohon' => $formisian['frm_pekerjaan'],
        'jenis_kelamin_pemohon' => (!empty($select_option_jeniskelamin[$formisian['frm_jeniskelamin']]) ? $select_option_jeniskelamin[$formisian['frm_jeniskelamin']] : ''),
        'jenis_kelamin' => (!empty($select_option_jeniskelamin[$formisian['frm_jeniskelamin']]) ? $select_option_jeniskelamin[$formisian['frm_jeniskelamin']] : ''),
        'agama_pemohon' => (!empty($select_option_agama[$formisian['frm_agama']]) ? $select_option_agama[$formisian['frm_agama']] : ''),
        'nama_fesyankes' => $formisian['frm_nama_fasyankes'],
        'alamat_fesyankes' => $formisian['frm_alamat_fasyankes'],
        'kota_fesyankes' => $formisian['frm_kota_fasyankes'],
        'keperluan' => $formisian['frm_keperluan'],
        'berlaku_str' => (!empty($formisian['frm_masa_berlaku_str']) AND $formisian['frm_masa_berlaku_str'] != '0000-00-00') ? $formisian['frm_masa_berlaku_str'] : '',
        'no_recomendasi' => $no_rekomendasi,
        'no_surat' => $formisian['frm_no_surat_pengantar'],
        'alamat_praktik' => $formisian['frm_alamat_tempat_praktik'],
        'no_rt' => $formisian['frm_rt'],
        'no_rw' => $formisian['frm_rw'],
        'tgl_terbit' => date('d-m-Y'),
        'tgl_habis' => (!empty($formisian['frm_bu_masa_berlaku']) AND $formisian['frm_bu_masa_berlaku'] != '0000-00-00') ? mysql_to_date($formisian['frm_bu_masa_berlaku']) : date('d-m-Y', mktime(0,0,0,date('m')+3, date('d'), date('Y'))),
        'habis_bu' => date('d-m-Y', mktime(0,0,0,date('m'), date('d'), date('Y')+1)),
        'no_surat_sertifikat' => $nomorsertifikatlayanan,
        'no_nik' => $formisian['frm_nik'],
        'nama_usaha' => $formisian['frm_bu_nama_perusahaan'],
        'jenis_usaha' => $formisian['frm_bu_jenis_usaha'],
        'alamat_perusahaan' => $formisian['frm_bu_alamat_perusahaan'],
        'telepon' => $formisian['frm_telp'],
        'status_bangunan' => $formisian['frm_bu_status_bangunan'],
        'peruntukan_bangunan' => $formisian['frm_bu_peruntukan_bangunan'],
        'kesesuaian' => $formisian['frm_bu_kesesuaian_peruntukan'],
        'no_notaris' => $formisian['frm_bu_nomor_notaris'],
        'nama_notaris' => $formisian['frm_bu_nama_notaris'],
        'tanggal_notaris' => (!empty($formisian['frm_bu_tanggal_notaris']) AND $formisian['frm_bu_tanggal_notaris'] != '0000-00-00') ? mysql_to_date($formisian['frm_bu_tanggal_notaris']) : '',
        'jumlah_karyawan' => $formisian['frm_bu_jumlah_karyawan'],
        'penanggung_jawab' => $formisian['frm_bu_pimpinan_perusahaan'],
        'tipe_kantor' => (!empty($select_tipe_kantor[$formisian['frm_bu_tipe_kantor']]) ? $select_tipe_kantor[$formisian['frm_bu_tipe_kantor']] : ''),
        'logo_template' => '<img alt="" src="'.site_url('assets/backstage/images/logo_report.png').'" style="height:105px; width:88px">',
        'logo_brcode' => '<img alt="" src="'.site_url('assets/backstage/images/brcode.png').'" style="height:30px; width:30px">',
        'logo_foto' => '<img alt="" src="'.site_url('assets/backstage/images/pasfoto.png').'" style="height:105px; width:88px">',

        'warga_negara_pemohon' => $formisian['frm_warga_negara'],
        'bin_binti_pemohon' => $formisian['frm_bin_binti_pemohon'],
        'jejaka_duda_pemohon' => $formisian['frm_status_perkawinan'],
        'perawan_janda_pemohon' => $formisian['frm_status_perkawinan'],
        'suami_istri_terdahulu_pemohon' => $formisian['frm_nama_pasangan_terdahulu'],
        'ortu_ayah_nama_pemohon' => $formisian['frm_ortu_ayah_nama'],
        'ortu_ayah_tempat_lahir_pemohon' => $formisian['frm_ortu_ayah_tempat_lahir'],
        'ortu_ayah_tanggal_lahir_pemohon' => (!empty($formisian['frm_ortu_ayah_tanggal_lahir']) AND $formisian['frm_ortu_ayah_tanggal_lahir'] != '0000-00-00') ? mysql_to_date($formisian['frm_ortu_ayah_tanggal_lahir']) : '',
        'ortu_ayah_warga_negara_pemohon' => $formisian['frm_ortu_ayah_warga_negara'],
        'ortu_ayah_agama_pemohon' => (!empty($select_option_agama[$formisian['frm_ortu_ayah_agama']]) ? $select_option_agama[$formisian['frm_ortu_ayah_agama']] : ''),
        'ortu_ayah_pekerjaan_pemohon' => $formisian['frm_ortu_ayah_pekerjaan'],
        'ortu_ayah_alamat_pemohon' => $formisian['frm_ortu_ayah_tempat_tinggal'],
        'ortu_ibu_nama_pemohon' => $formisian['frm_ortu_ibu_nama'],
        'ortu_ibu_tempat_lahir_pemohon' => $formisian['frm_ortu_ibu_tempat_lahir'],
        'ortu_ibu_tanggal_lahir_pemohon' => (!empty($formisian['frm_ortu_ibu_tanggal_lahir']) AND $formisian['frm_ortu_ibu_tanggal_lahir'] != '0000-00-00') ? mysql_to_date($formisian['frm_ortu_ibu_tanggal_lahir']) : '',
        'ortu_ibu_warga_negara_pemohon' => $formisian['frm_ortu_ibu_warga_negara'],
        'ortu_ibu_agama_pemohon' => (!empty($select_option_agama[$formisian['frm_ortu_ibu_agama']]) ? $select_option_agama[$formisian['frm_ortu_ibu_agama']] : ''),
        'ortu_ibu_pekerjaan_pemohon' => $formisian['frm_ortu_ibu_pekerjaan'],
        'ortu_ibu_alamat_pemohon' => $formisian['frm_ortu_ibu_tempat_tinggal'],
        'nama_mendiang' => $formisian['frm_mendiang_nama'],
        'bin_binti_mendiang' => $formisian['frm_mendiang_bin_binti'],
        'tempat_lahir_mendiang' => $formisian['frm_mendiang_tempat_lahir'],
        'tanggal_lahir_mendiang' => (!empty($formisian['frm_mendiang_tanggal_lahir']) AND $formisian['frm_mendiang_tanggal_lahir'] != '0000-00-00') ? mysql_to_date($formisian['frm_mendiang_tanggal_lahir']) : '',
        'warga_negara_mendiang' => $formisian['frm_mendiang_warga_negara'],
        'agama_mendiang' => (!empty($select_option_agama[$formisian['frm_mendiang_agama']]) ? $select_option_agama[$formisian['frm_mendiang_agama']] : ''),
        'pekerjaan_mendiang' => $formisian['frm_mendiang_pekerjaan'],
        'alamat_mendiang' => $formisian['frm_mendiang_tempat_tinggal'],
        'waktu_meninggal_mendiang' => $formisian['frm_mendiang_tanggal_meninggal'],
        'sebab_meninggal_mendiang' => $formisian['frm_mendiang_sebab_meninggal'],
        'lokasi_meninggal_mendiang' => $formisian['frm_mendiang_lokasi_meninggal'],
        'status_hubungan_mendiang' => $formisian['frm_mendiang_status_hubungan'],
        'nik_mendiang' => $formisian['frm_mendiang_nik'],
        'jenis_kelamin_mendiang' => (!empty($select_option_jeniskelamin[$formisian['frm_mendiang_jenis_kelamin']]) ? $select_option_jeniskelamin[$formisian['frm_mendiang_jenis_kelamin']] : ''),
        'catatan_pemohon' => $formisian['frm_notes'],
        'tanggal_dikeluarkan' => (!empty($formisian['frm_tanggal_dikeluarkan']) AND $formisian['frm_tanggal_dikeluarkan'] != '0000-00-00') ? mysql_to_date($formisian['frm_tanggal_dikeluarkan']) : '',
        'status_pemohon' => (!empty($status_perkawinan[$formisian['frm_status_perkawinan']]) ? $status_perkawinan[$formisian['frm_status_perkawinan']] : ''),

        'penfor_sd_pemohon' => $formisian['frm_karkun_sd'],
        'tahun_penfor_sd_pemohon' => $formisian['frm_karkun_sd_tahun'],
        'penfor_smtp_pemohon' => $formisian['frm_karkun_smtp'],
        'tahun_penfor_smtp_pemohon' => $formisian['frm_karkun_smtp_tahun'],
        'penfor_smta_pemohon' => $formisian['frm_karkun_smta'],
        'tahun_penfor_smta_pemohon' => $formisian['frm_karkun_smta_tahun'],
        'penfor_sm_pemohon' => $formisian['frm_karkun_sm'],
        'tahun_penfor_sm_pemohon' => $formisian['frm_karkun_sm_tahun'],
        'penfor_aktaii_pemohon' => $formisian['frm_karkun_akta2'],
        'tahun_penfor_aktaii_pemohon' => $formisian['frm_karkun_akta2_tahun'],
        'penfor_aktaiii_pemohon' => $formisian['frm_karkun_akta3'],
        'tahun_penfor_aktaiii_pemohon' => $formisian['frm_karkun_akta3_tahun'],
        'penfor_s_pemohon' => $formisian['frm_karkun_s'],
        'tahun_penfor_s_pemohon' => $formisian['frm_karkun_s_tahun'],
        'penfor_doktor_pemohon' => $formisian['frm_karkun_doktor'],
        'tahun_penfor_doktor_pemohon' => $formisian['frm_karkun_doktor_tahun'],

        'keterampilan_satu_pemohon' => (!empty($frm_karkun_keterampilan[0]['nama']) ? $frm_karkun_keterampilan[0]['nama'] : ''),
        'tahun_keterampilan_satu_pemohon' => (!empty($frm_karkun_keterampilan[0]['tahun']) ? $frm_karkun_keterampilan[0]['tahun'] : ''),
        'keterampilan_dua_pemohon' => (!empty($frm_karkun_keterampilan[1]['nama']) ? $frm_karkun_keterampilan[1]['nama'] : ''),
        'tahun_keterampilan_dua_pemohon' => (!empty($frm_karkun_keterampilan[1]['tahun']) ? $frm_karkun_keterampilan[1]['tahun'] : ''),
        'keterampilan_tiga_pemohon' => (!empty($frm_karkun_keterampilan[2]['nama']) ? $frm_karkun_keterampilan[2]['nama'] : ''),
        'tahun_keterampilan_tiga_pemohon' => (!empty($frm_karkun_keterampilan[2]['tahun']) ? $frm_karkun_keterampilan[2]['tahun'] : ''),

        'tanggal_terbit' => (!empty($formisian['frm_tanggal_dikeluarkan']) AND $formisian['frm_tanggal_dikeluarkan'] != '0000-00-00') ? mysql_to_date($formisian['frm_tanggal_dikeluarkan']) : '',
    );
    $layanan['tpsr_template'] = parse_stringphp($layanan['tpsr_template'], $arr_data);

    echo $layanan['tpsr_template'];
}

?>