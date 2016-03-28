<?php
    $select_option_jeniskelamin = $general['jenis_kelamin'];
    $select_option_agama = $general['agama'];
    $status_perkawinan = $general['status_perkawinan'];
?>

<?php
$keterampilan = array();
$keterampilan_tahun = array();

$frm_karkun_keterampilan = array();
if(!empty($formisian['frm_karkun_keterampilan'])) {
    $frm_karkun_keterampilan = unserialize($formisian['frm_karkun_keterampilan']);
}

for($i=0;$i<3;$i++) {
    if(!empty($_POST['keterampilan'][$i])) {
        $keterampilan[$i] = $_POST['keterampilan'][$i];
    } else {
        $keterampilan[$i] = !empty($frm_karkun_keterampilan[$i]['nama']) ? $frm_karkun_keterampilan[$i]['nama'] : '';
    }

    if(!empty($_POST['keterampilan_tahun'][$i])) {
        $keterampilan_tahun[$i] = $_POST['keterampilan_tahun'][$i];
    } else {
        $keterampilan_tahun[$i] = !empty($frm_karkun_keterampilan[$i]['tahun']) ? $frm_karkun_keterampilan[$i]['tahun'] : '';
    }
}
?>

<style type="text/css">
#page-title {
    padding: 20px;
    position: relative;
}
</style>

<div id="page-title">
    <h3 class="title-hero text-center">
        Formulir Isi Data<br/><?php echo $layanan['lyn_name']; ?>
    </h3>
</div>
<?php if(count($formisian) > 0): ?>
<?php $cnt = count($form_input); $cnt_part = ceil($cnt/2); ?>
<form method="post" action="<?php echo site_url('berkas-layanan/form-edit/' . $hd_frm_id); ?>" class="form-horizontal bordered-row">
<input type="hidden" name="hd_frm_id" value="<?php echo $hd_frm_id; ?>" />
<input type="hidden" name="hd_bly_id" value="<?php echo $hd_bly_id; ?>" />
<input type="hidden" name="hd_lyn_id" value="<?php echo $hd_lyn_id; ?>" />
<div class="row">
    <div class="col-md-12">
        <div class="panel">
            <div class="panel-body">
                <div class="example-box-wrapper">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No. Surat</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="frm_no" placeholder="No. Surat" value="<?php echo $berkaslayanan['bly_noberkas']; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="frm_nama" placeholder="Nama" value="<?php echo $berkaslayanan['bly_pemohon']; ?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">NIK</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="frm_nik" placeholder="NIK" value="<?php echo (!empty($_POST['frm_nik']) ? $_POST['frm_nik'] : (!empty($formisian['frm_nik']) ? $formisian['frm_nik'] : '')); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_tempatlahir" placeholder="Tempat Lahir" value="<?php echo (!empty($_POST['frm_tempatlahir']) ? $_POST['frm_tempatlahir'] : (!empty($formisian['frm_tempatlahir']) ? $formisian['frm_tempatlahir'] : '')); ?>">
                        </div>
                        <div class="col-sm-4">
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon">
                                    <i class="glyph-icon icon-calendar"></i>
                                </span>
                                <input type="text" class="form-control bootstrap-datepicker" data-date-format="yyyy-mm-dd" name="frm_tanggallahir" placeholder="Tanggal Lahir" value="<?php echo (!empty($_POST['frm_tanggallahir']) ? $_POST['frm_tanggallahir'] : (!empty($formisian['frm_tanggallahir']) ? $formisian['frm_tanggallahir'] : '')); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="frm_jeniskelamin" id="frm_jeniskelamin" required>
                                <?php $val = !empty($_POST['frm_jeniskelamin']) ? $_POST['frm_jeniskelamin'] : (!empty($formisian['frm_jeniskelamin']) ? $formisian['frm_jeniskelamin'] : '') ?>
                                <?php foreach($select_option_jeniskelamin as $key => $value): ?>
                                <option value="<?php echo (!empty($key) ? $key : ''); ?>" <?php echo ($val == $key? 'selected' : ''); ?>><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="frm_status_perkawinan" id="frm_status_perkawinan" required>
                                <?php $val = !empty($_POST['frm_status_perkawinan']) ? $_POST['frm_status_perkawinan'] : (!empty($formisian['frm_status_perkawinan']) ? $formisian['frm_status_perkawinan'] : '') ?>
                                <?php foreach($status_perkawinan as $key => $value): ?>
                                <option value="<?php echo (!empty($key) ? $key : ''); ?>" <?php echo ($val == $key? 'selected' : ''); ?>><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Agama</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="frm_agama" id="frm_agama" required>
                                <?php $val = !empty($_POST['frm_agama']) ? $_POST['frm_agama'] : (!empty($formisian['frm_agama']) ? $formisian['frm_agama'] : '') ?>
                                <?php foreach($select_option_agama as $key => $value): ?>
                                <option value="<?php echo (!empty($key) ? $key : ''); ?>" <?php echo ($val == $key? 'selected' : ''); ?>><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Alamat Tinggal</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="frm_alamat" placeholder="Alamat" value="<?php echo (!empty($_POST['frm_alamat']) ? $_POST['frm_alamat'] : (!empty($formisian['frm_alamat']) ? $formisian['frm_alamat'] : '')); ?>">
                        </div>
                    </div>
                    <hr/>
                    <h3>Pendidikan Formal</h3>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">SD / SEDERAJAT</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_sd" placeholder="SD / SEDERAJAT" value="<?php echo (!empty($_POST['frm_karkun_sd']) ? $_POST['frm_karkun_sd'] : (!empty($formisian['frm_karkun_sd']) ? $formisian['frm_karkun_sd'] : '')); ?>">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_sd_tahun" placeholder="Tahun" value="<?php echo (!empty($_POST['frm_karkun_sd_tahun']) ? $_POST['frm_karkun_sd_tahun'] : (!empty($formisian['frm_karkun_sd_tahun']) ? $formisian['frm_karkun_sd_tahun'] : '')); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">SMTP / SEDERAJAT</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_smtp" placeholder="SMTP / SEDERAJAT" value="<?php echo (!empty($_POST['frm_karkun_smtp']) ? $_POST['frm_karkun_smtp'] : (!empty($formisian['frm_karkun_smtp']) ? $formisian['frm_karkun_smtp'] : '')); ?>">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_smtp_tahun" placeholder="Tahun" value="<?php echo (!empty($_POST['frm_karkun_smtp_tahun']) ? $_POST['frm_karkun_smtp_tahun'] : (!empty($formisian['frm_karkun_smtp_tahun']) ? $formisian['frm_karkun_smtp_tahun'] : '')); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">SMTA / SEDERAJAT</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_smta" placeholder="SMTA / SEDERAJAT" value="<?php echo (!empty($_POST['frm_karkun_smta']) ? $_POST['frm_karkun_smta'] : (!empty($formisian['frm_karkun_smta']) ? $formisian['frm_karkun_smta'] : '')); ?>">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_smta_tahun" placeholder="Tahun" value="<?php echo (!empty($_POST['frm_karkun_smta_tahun']) ? $_POST['frm_karkun_smta_tahun'] : (!empty($formisian['frm_karkun_smta_tahun']) ? $formisian['frm_karkun_smta_tahun'] : '')); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">SM / D.II / D.III</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_sm" placeholder="SM / D.II / D.III" value="<?php echo (!empty($_POST['frm_karkun_sm']) ? $_POST['frm_karkun_sm'] : (!empty($formisian['frm_karkun_sm']) ? $formisian['frm_karkun_sm'] : '')); ?>">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_sm_tahun" placeholder="Tahun" value="<?php echo (!empty($_POST['frm_karkun_sm_tahun']) ? $_POST['frm_karkun_sm_tahun'] : (!empty($formisian['frm_karkun_sm_tahun']) ? $formisian['frm_karkun_sm_tahun'] : '')); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">AKTA.II</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_akta2" placeholder="AKTA.II" value="<?php echo (!empty($_POST['frm_karkun_akta2']) ? $_POST['frm_karkun_akta2'] : (!empty($formisian['frm_karkun_akta2']) ? $formisian['frm_karkun_akta2'] : '')); ?>">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_akta2_tahun" placeholder="Tahun" value="<?php echo (!empty($_POST['frm_karkun_akta2_tahun']) ? $_POST['frm_karkun_akta2_tahun'] : (!empty($formisian['frm_karkun_akta2_tahun']) ? $formisian['frm_karkun_akta2_tahun'] : '')); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">AKTA.III</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_akta3" placeholder="AKTA.III" value="<?php echo (!empty($_POST['frm_karkun_akta3']) ? $_POST['frm_karkun_akta3'] : (!empty($formisian['frm_karkun_akta3']) ? $formisian['frm_karkun_akta3'] : '')); ?>">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_akta3_tahun" placeholder="Tahun" value="<?php echo (!empty($_POST['frm_karkun_akta3_tahun']) ? $_POST['frm_karkun_akta3_tahun'] : (!empty($formisian['frm_karkun_akta3_tahun']) ? $formisian['frm_karkun_akta3_tahun'] : '')); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">S / PASCA / S.1 / AKTA.IV / D.IV</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_s" placeholder="S / PASCA / S.1 / AKTA.IV / D.IV" value="<?php echo (!empty($_POST['frm_karkun_s']) ? $_POST['frm_karkun_s'] : (!empty($formisian['frm_karkun_s']) ? $formisian['frm_karkun_s'] : '')); ?>">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_s_tahun" placeholder="Tahun" value="<?php echo (!empty($_POST['frm_karkun_s_tahun']) ? $_POST['frm_karkun_s_tahun'] : (!empty($formisian['frm_karkun_s_tahun']) ? $formisian['frm_karkun_s_tahun'] : '')); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">DOKTOR.II / AKTA.V</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_doktor" placeholder="DOKTOR.II / AKTA.V" value="<?php echo (!empty($_POST['frm_karkun_doktor']) ? $_POST['frm_karkun_doktor'] : (!empty($formisian['frm_karkun_doktor']) ? $formisian['frm_karkun_doktor'] : '')); ?>">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_doktor_tahun" placeholder="Tahun" value="<?php echo (!empty($_POST['frm_karkun_doktor_tahun']) ? $_POST['frm_karkun_doktor_tahun'] : (!empty($formisian['frm_karkun_doktor_tahun']) ? $formisian['frm_karkun_doktor_tahun'] : '')); ?>">
                        </div>
                    </div>
                    <hr/>
                    <h3>KETERAMPILAN</h3>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Keterampilan 1</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="keterampilan[]" placeholder="Keterampilan " value="<?php echo (!empty($keterampilan[0]) ? $keterampilan[0] : ''); ?>">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="keterampilan_tahun[]" placeholder="Tahun" value="<?php echo (!empty($keterampilan_tahun[0]) ? $keterampilan_tahun[0] : ''); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Keterampilan 2</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="keterampilan[]" placeholder="Keterampilan 2" value="<?php echo (!empty($keterampilan[1]) ? $keterampilan[1] : ''); ?>">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="keterampilan_tahun[]" placeholder="Tahun" value="<?php echo (!empty($keterampilan_tahun[1]) ? $keterampilan_tahun[1] : ''); ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Keterampilan 3</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="keterampilan[]" placeholder="Keterampilan 3" value="<?php echo (!empty($keterampilan[2]) ? $keterampilan[2] : ''); ?>">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="keterampilan_tahun[]" placeholder="Tahun" value="<?php echo (!empty($keterampilan_tahun[2]) ? $keterampilan_tahun[2] : ''); ?>">
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tanggal Dikeluarkan</label>
                        <div class="col-sm-9">
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon">
                                    <i class="glyph-icon icon-calendar"></i>
                                </span>
                                <input type="text" class="form-control bootstrap-datepicker" data-date-format="yyyy-mm-dd" name="frm_tanggal_dikeluarkan" placeholder="Tanggal Dikeluarkan" value="<?php echo (!empty($_POST['frm_tanggal_dikeluarkan']) ? $_POST['frm_tanggal_dikeluarkan'] : (!empty($formisian['frm_tanggal_dikeluarkan']) ? $formisian['frm_tanggal_dikeluarkan'] : '')); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group text-center">
            <button type="submit" class="btn btn-blue-alt btn-lg btn-block">Submit Data</button>
        </div>
    </div>
</div>
</form>
<?php else: ?>
<div class="row">
    <div class="col-md-12">
        <p class="bg-danger text-center" style="padding:10px;">Form isian ini belum ada, mohon dilengkapi terlebih dahulu</p>
    </div>
</div>
<?php endif; ?>

<script type="text/javascript">
$(document).ready(function() {
    $('#frm_provinsi').change(function(){
        var me = $(this);
        var nilai = me.val() || 'xx';
        $('#frm_kota').load('<?php echo site_url("frontend_layanan/layanan/get_data_kota/'+nilai+'") ?>');
        $('#frm_kecamatan').load('<?php echo site_url("frontend_layanan/layanan/get_data_kecamatan/xx'+nilai+'") ?>');
        $('#frm_kelurahan').load('<?php echo site_url("frontend_layanan/layanan/get_data_kelurahan/xx'+nilai+'") ?>');
    });

    $('#frm_kota').change(function(){
        var me = $(this);
        var nilai = me.val() || 'xx';
        $('#frm_kecamatan').load('<?php echo site_url("frontend_layanan/layanan/get_data_kecamatan/'+nilai+'") ?>');
        $('#frm_kelurahan').load('<?php echo site_url("frontend_layanan/layanan/get_data_kelurahan/xx'+nilai+'") ?>');
    })

    $('#frm_kecamatan').change(function(){
        var me = $(this);
        var nilai = me.val() || 'xx';
        $('#frm_kelurahan').load('<?php echo site_url("frontend_layanan/layanan/get_data_kelurahan/'+nilai+'") ?>');
    });
})
</script>