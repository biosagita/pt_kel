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
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-body">
                <div class="example-box-wrapper">
                    <?php for($i=0; $i<$cnt_part; $i++): ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $form_input[$i]['label']; ?></label>
                        <div class="col-sm-9">
                            <?php $name_input = $form_input[$i]['name']; $disabled = !empty($form_input[$i]['disabled']) ? 'disabled' : ''; $val = !empty($_POST[$name_input]) ? $_POST[$name_input] : (!empty($form_input[$i]['default']) ? $form_input[$i]['default'] : ''); $required = !empty($form_input[$i]['required']) ? 'required' : ''; ?>
                            <?php if(!empty($form_input[$i]['type']) AND $form_input[$i]['type'] == 'select'): ?>
                            <select class="form-control" name="<?php echo $name_input; ?>" id="<?php echo $name_input; ?>" <?php echo $disabled; ?> <?php echo $required; ?>>
                                <?php foreach($form_input[$i]['select_option'] as $key => $value): ?>
                                <option value="<?php echo (!empty($key) ? $key : ''); ?>" <?php echo ($val == $key? 'selected' : ''); ?>><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php elseif(!empty($form_input[$i]['type']) AND $form_input[$i]['type'] == 'checkbox'): ?>
                            <div class="checkbox checkbox-success">
                                <label>
                                    <input type="checkbox" class="custom-checkbox" id="<?php echo $name_input; ?>" name="<?php echo $name_input; ?>" value="1" <?php echo !empty($val) ? 'checked' : ''; ?> <?php echo $disabled; ?> <?php echo $required; ?>> (checklist ini bila layanan diperpanjang)
                                </label>
                            </div>
                            <?php else: ?>
                            
                            <?php if(strpos($form_input[$i]['label'], 'yyyy-mm-dd') !== false): ?>
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon">
                                    <i class="glyph-icon icon-calendar"></i>
                                </span>
                                <input type="text" class="form-control bootstrap-datepicker" data-date-format="yyyy-mm-dd" name="<?php echo $name_input; ?>" placeholder="<?php echo $form_input[$i]['label']; ?>" value="<?php echo $val; ?>" <?php echo $disabled; ?> <?php echo $required; ?>>
                            </div>
                            <?php else: ?>
                            <input type="text" class="form-control" name="<?php echo $name_input; ?>" placeholder="<?php echo $form_input[$i]['label']; ?>" value="<?php echo $val; ?>" <?php echo $disabled; ?> <?php echo $required; ?>>
                            <?php endif; ?>

                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel">
            <div class="panel-body">
                <div class="example-box-wrapper">
                    <?php for($i=$cnt_part; $i<$cnt; $i++): ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo $form_input[$i]['label']; ?></label>
                        <div class="col-sm-9">
                            <?php $name_input = $form_input[$i]['name']; $disabled = !empty($form_input[$i]['disabled']) ? 'disabled' : ''; $val = !empty($_POST[$name_input]) ? $_POST[$name_input] : (!empty($form_input[$i]['default']) ? $form_input[$i]['default'] : ''); $required = !empty($form_input[$i]['required']) ? 'required' : ''; ?>
                            <?php if(!empty($form_input[$i]['type']) AND $form_input[$i]['type'] == 'select'): ?>
                            <select class="form-control" name="<?php echo $name_input; ?>" id="<?php echo $name_input; ?>" <?php echo $disabled; ?> <?php echo $required; ?>>
                                <?php foreach($form_input[$i]['select_option'] as $key => $value): ?>
                                <option value="<?php echo (!empty($key) ? $key : ''); ?>" <?php echo ($val == $key? 'selected' : ''); ?>><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php elseif(!empty($form_input[$i]['type']) AND $form_input[$i]['type'] == 'checkbox'): ?>
                            <div class="checkbox checkbox-success">
                                <label>
                                    <input type="checkbox" class="custom-checkbox" id="<?php echo $name_input; ?>" name="<?php echo $name_input; ?>" value="1" <?php echo !empty($val) ? 'checked' : ''; ?> <?php echo $disabled; ?> <?php echo $required; ?>> (checklist ini bila layanan diperpanjang)
                                </label>
                            </div>
                            <?php else: ?>
                            
                            <?php if(strpos($form_input[$i]['label'], 'yyyy-mm-dd') !== false): ?>
                            <div class="input-prepend input-group">
                                <span class="add-on input-group-addon">
                                    <i class="glyph-icon icon-calendar"></i>
                                </span>
                                <input type="text" class="form-control bootstrap-datepicker" data-date-format="yyyy-mm-dd" name="<?php echo $name_input; ?>" placeholder="<?php echo $form_input[$i]['label']; ?>" value="<?php echo $val; ?>" <?php echo $disabled; ?> <?php echo $required; ?>>
                            </div>
                            <?php else: ?>
                            <input type="text" class="form-control" name="<?php echo $name_input; ?>" placeholder="<?php echo $form_input[$i]['label']; ?>" value="<?php echo $val; ?>" <?php echo $disabled; ?> <?php echo $required; ?>>
                            <?php endif; ?>
                            
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group text-center">
            <button type="submit" class="btn btn-blue-alt btn-lg">Update Data</button>
            <a href="<?php echo $url_listberkaslayanan; ?>" type="button" class="btn btn-default btn-lg">Batal</button>
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