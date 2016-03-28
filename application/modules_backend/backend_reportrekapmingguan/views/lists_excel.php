<!--table>
    <tbody>
    	<tr>
    		<td colspan="8">&nbsp;</td>
    	</tr>
    	<tr>
    		<td colspan="8">&nbsp;</td>
    	</tr>
    	<tr>
    		<td colspan="8">&nbsp;</td>
    	</tr>
    	<tr>
    		<td colspan="8">&nbsp;</td>
    	</tr>
    	<tr>
    		<td colspan="8">&nbsp;</td>
    	</tr>
    	<tr>
    		<td colspan="8">&nbsp;</td>
    	</tr>
	</tbody>
</table-->
<table border="1">
	<thead>
	    <tr>
	        <th>Jumlah Pengunjung</th>
	        <th>Pengaduan</th>
	        <th>Konsultasi</th>
	        <th>Berkas Masuk</th>
	        <th>Berkas Terbit</th>
	        <th>Berkas Tolak</th>
	        <th>Berkas Proses</th>
	        <th>Retribusi</th>
	    </tr>
    </thead>
    <tbody>
		<tr>
	        <td><?php echo (!empty($daftartamu['total']) ? $daftartamu['total'] : '-'); ?></td>
	        <td>-</td>
	        <td>-</td>
	        <td><?php echo (!empty($berkaslayanan_total['total']) ? $berkaslayanan_total['total'] : '-'); ?></td>
	        <td><?php echo (!empty($berkaslayanan_approved['total']) ? $berkaslayanan_approved['total'] : '-'); ?></td>
	        <td><?php echo (!empty($berkaslayanan_reject['total']) ? $berkaslayanan_reject['total'] : '-'); ?></td>
	        <td><?php echo (!empty($berkaslayanan_proses['total']) ? $berkaslayanan_proses['total'] : '-'); ?></td>
	        <td><?php echo (!empty($retribusi['total']) ? $retribusi['total'] : 0); ?></td>
	    </tr>
	</tbody>
</table>