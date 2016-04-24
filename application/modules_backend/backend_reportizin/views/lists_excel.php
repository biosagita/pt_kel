<table>
    <tbody>
    	<tr>
    		<td colspan="22">&nbsp;</td>
    	</tr>
    	<tr>
    		<td colspan="22">&nbsp;</td>
    	</tr>
    	<tr>
    		<td colspan="22" style="font-size:34px;text-align:center;">SATLAK PTSP KELURAHAN KENARI</td>
    	</tr>
    	<tr>
    		<td colspan="22">&nbsp;</td>
    	</tr>
    	<tr>
    		<td colspan="22">&nbsp;</td>
    	</tr>
	</tbody>
</table>
<table border="1">
	<thead>
	    <tr>
            <th>No Urut</th>
            <th>Kode Izin</th>
            <th>Bentuk Usaha</th>
            <th>Nama Perusahaan</th>
            <th>Nama Penanggung Jawab</th>
            <th>Alamat Perusahaan</th>
            <th>No. Telp</th>
            <th>Penerima Berkas (FO)</th>
            <th>Izin Masuk</th>
            <th>ETA * (Estimated Time Accomplish)</th>
            <th>Kirim ke Tim Teknis</th>
            <th>Kirim ke PTSP Wilayah</th>
            <th>Berkas Tidak Lengkap (Pending)</th>
            <th>Pencetakan Izin</th>
            <th>Penolakan Izin</th>
            <th>Penerbitan Izin</th>
            <th>Diserahkan ke Pemohon</th>
            <th>Jenis Izin</th>
            <th>Jumlah Berkas</th>
            <th>Modal Usaha (Kekayaan Bersih)*</th>
            <th>Nomor Izin (No. SK)*</th>
            <th>ODS (1/0)</th>
            <?php if(!empty($show_waktu_finish)): ?>
            <th>Waktu Finish</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php $cnt = 1; foreach($daftartamu as $value): ?>
        <?php
            $date_berkastidaklengkap = '';
            if(empty($value['frm_no_surat_sertifikat'])) {
                if(!empty($value['dftm_entry_daftartamu']) AND $value['dftm_entry_daftartamu'] != '0000-00-00 00:00:00') $date_berkastidaklengkap = excel_datetime($value['dftm_entry_daftartamu']);
                if(!empty($value['dftm_entry_berkas']) AND $value['dftm_entry_berkas'] != '0000-00-00 00:00:00') $date_berkastidaklengkap = excel_datetime($value['dftm_entry_berkas']);
                if(!empty($value['dftm_entry_formisian']) AND $value['dftm_entry_formisian'] != '0000-00-00 00:00:00') $date_berkastidaklengkap = excel_datetime($value['dftm_entry_formisian']);
                if(!empty($value['dftm_entry_approval']) AND $value['dftm_entry_approval'] != '0000-00-00 00:00:00') $date_berkastidaklengkap = excel_datetime($value['dftm_entry_approval']);
                if(!empty($value['dftm_entry_cetak']) AND $value['dftm_entry_cetak'] != '0000-00-00 00:00:00') $date_berkastidaklengkap = excel_datetime($value['dftm_entry_cetak']);
            }

            $detik_layanan = !empty($value['detik_layanan']) ? $value['detik_layanan'] : 0;
            if(!empty($detik_layanan)) {
                $detik_layanan = floor($detik_layanan / (24*3600));
                $detik_layanan = ($detik_layanan <= 1) ? 1 : 0;
            }

            $kode_izin = '';
            if(!empty($value['frm_no_surat_sertifikat'])) {
                if($value['lyn_gly_id'] == ID_GROUP_PELAYANAN_KESEHATAN) {
                    $arr_hrf = array('', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
                    $tmp = explode(' / ', $value['frm_no_surat_sertifikat']);
                    if(!empty($tmp[1])) {
                        $tmp2 = explode('.', $tmp[1]);
                        if(!empty($tmp2[0]) AND !empty($tmp2[1])) {
                            $tmp2[0] = !empty($arr_hrf[$tmp2[0]]) ? $arr_hrf[$tmp2[0]] : '';
                            $kode_izin = $tmp2[0].'.'.$tmp2[1];
                        }
                    }
                }

                if($value['lyn_gly_id'] == ID_GROUP_PELAYANAN_UMUM) {
                    $kode_izin = 'PM1';
                }
            }
        ?>
        <tr>
            <td><?php echo $cnt; ?></td>
            <td><?php echo $kode_izin; ?></td>
            <td>-</td>
            <td><?php echo (!empty($value['dftm_instansi']) ? $value['dftm_instansi'] : '-'); ?></td>
            <td><?php echo (!empty($value['dftm_nama']) ? $value['dftm_nama'] : '-'); ?></td>
            <td><?php echo (!empty($value['dftm_alamat']) ? $value['dftm_alamat'] : '-'); ?></td>
            <td><?php echo (!empty($value['dftm_telp']) ? $value['dftm_telp'] : '-'); ?></td>
            <td><?php echo (!empty($value['dftm_entryuser']) ? $value['dftm_entryuser'] : '-'); ?></td>
            <td><?php echo (!empty($value['dftm_entrydate']) ? excel_datetime($value['dftm_entrydate']) : '-'); ?></td>
            <td><?php echo (!empty($value['dftm_entrydate']) ? excel_datetime($value['dftm_entrydate']) : '-'); ?></td>
            <td>-</td>
            <td>-</td>
            <td><?php echo (!empty($date_berkastidaklengkap) ? $date_berkastidaklengkap : '-'); ?></td>
            <td><?php echo ((empty($date_berkastidaklengkap) AND !empty($value['dftm_entry_cetak']) AND $value['dftm_entry_cetak'] != '0000-00-00 00:00:00') ? excel_datetime($value['dftm_entry_cetak']) : '-'); ?></td>
            <td><?php echo (($value['bly_status'] == BERKAS_REJECT AND (!empty($value['dftm_entry_approval']) AND $value['dftm_entry_approval'] != '0000-00-00 00:00:00')) ? excel_datetime($value['dftm_entry_approval']) : '-'); ?></td>
            <td><?php echo ((empty($date_berkastidaklengkap) AND $value['bly_status'] == BERKAS_APPROVED AND (!empty($value['dftm_entry_cetak']) AND $value['dftm_entry_cetak'] != '0000-00-00 00:00:00')) ? excel_datetime($value['dftm_entry_cetak']) : '-'); ?></td>
            <td><?php echo ((empty($date_berkastidaklengkap) AND !empty($value['dftm_entry_cetak']) AND $value['dftm_entry_cetak'] != '0000-00-00 00:00:00') ? excel_datetime($value['dftm_entry_cetak']) : '-'); ?></td>
            <td><?php echo (!empty($value['gly_name']) ? $value['gly_name'] : '-'); ?></td>
            <td>1</td>
            <td>-</td>
            <td><?php echo (!empty($value['frm_no_surat_sertifikat']) ? $value['frm_no_surat_sertifikat'] : '-'); ?></td>
            <td><?php echo $detik_layanan; ?></td>
            <?php if(!empty($show_waktu_finish)): ?>
            <td><?php echo ((!empty($value['dftm_entry_complete']) AND $value['dftm_entry_complete'] != '0000-00-00 00:00:00') ? excel_datetime($value['dftm_entry_complete']) : '-'); ?></td>
            <?php endif; ?>
        </tr>
        <?php $cnt++; endforeach; ?>
    </tbody>
</table>