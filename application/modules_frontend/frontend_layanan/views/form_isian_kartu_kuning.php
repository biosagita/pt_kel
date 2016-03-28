<?php
    $select_option_jeniskelamin = $general['jenis_kelamin'];
    $select_option_agama = $general['agama'];
    $status_perkawinan = $general['status_perkawinan'];
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
<?php if(count($berkaslayanan) > 0): ?>
<?php $cnt = count($form_input); $cnt_part = ceil($cnt/2); ?>
<form method="post" action="<?php echo $action_form; ?>" class="form-horizontal bordered-row">
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
                            <input type="text" class="form-control" name="frm_nik" placeholder="NIK" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tempat Tanggal Lahir</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_tempatlahir" placeholder="Tempat Lahir" value="">
                        </div>
                        <div class="col-sm-4">
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon">
                                    <i class="glyph-icon icon-calendar"></i>
                                </span>
                                <input type="text" class="form-control bootstrap-datepicker" data-date-format="yyyy-mm-dd" name="frm_tanggallahir" placeholder="Tanggal Lahir" value="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jenis Kelamin</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="frm_jeniskelamin" id="frm_jeniskelamin" required>
                                <?php foreach($select_option_jeniskelamin as $key => $value): ?>
                                <option value="<?php echo (!empty($key) ? $key : ''); ?>"><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="frm_status_perkawinan" id="frm_status_perkawinan" required>
                                <?php foreach($status_perkawinan as $key => $value): ?>
                                <option value="<?php echo (!empty($key) ? $key : ''); ?>"><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Agama</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="frm_agama" id="frm_agama" required>
                                <?php foreach($select_option_agama as $key => $value): ?>
                                <option value="<?php echo (!empty($key) ? $key : ''); ?>"><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Alamat Tinggal</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="frm_alamat" placeholder="Alamat" value="">
                        </div>
                    </div>
                    <hr/>
                    <h3>Pendidikan Formal</h3>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">SD / SEDERAJAT</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_sd" placeholder="SD / SEDERAJAT" value="">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_sd_tahun" placeholder="Tahun" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">SMTP / SEDERAJAT</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_smtp" placeholder="SMTP / SEDERAJAT" value="">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_smtp_tahun" placeholder="Tahun" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">SMTA / SEDERAJAT</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_smta" placeholder="SMTA / SEDERAJAT" value="">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_smta_tahun" placeholder="Tahun" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">SM / D.II / D.III</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_sm" placeholder="SM / D.II / D.III" value="">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_sm_tahun" placeholder="Tahun" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">AKTA.II</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_akta2" placeholder="AKTA.II" value="">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_akta2_tahun" placeholder="Tahun" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">AKTA.III</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_akta3" placeholder="AKTA.III" value="">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_akta3_tahun" placeholder="Tahun" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">S / PASCA / S.1 / AKTA.IV / D.IV</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_s" placeholder="S / PASCA / S.1 / AKTA.IV / D.IV" value="">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_s_tahun" placeholder="Tahun" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">DOKTOR.II / AKTA.V</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_doktor" placeholder="DOKTOR.II / AKTA.V" value="">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="frm_karkun_doktor_tahun" placeholder="Tahun" value="">
                        </div>
                    </div>
                    <hr/>
                    <h3>KETERAMPILAN</h3>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Keterampilan 1</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="keterampilan[]" placeholder="Keterampilan " value="">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="keterampilan_tahun[]" placeholder="Tahun" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Keterampilan 2</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="keterampilan[]" placeholder="Keterampilan 2" value="">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="keterampilan_tahun[]" placeholder="Tahun" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Keterampilan 3</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="keterampilan[]" placeholder="Keterampilan 3" value="">
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="keterampilan_tahun[]" placeholder="Tahun" value="">
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
                                <input type="text" class="form-control bootstrap-datepicker" data-date-format="yyyy-mm-dd" name="frm_tanggal_dikeluarkan" placeholder="Tanggal Dikeluarkan" value="">
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
        <p class="bg-danger text-center" style="padding:10px;">Berkas layanan ini belum ada, mohon dilengkapi terlebih dahulu</p>
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