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
<form method="post" action="<?php echo site_url('user-layanan/form'); ?>" class="form-horizontal bordered-row">
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
                            <select class="form-control" name="<?php echo $name_input; ?>" <?php echo $disabled; ?> <?php echo $required; ?>>
                                <?php foreach($form_input[$i]['select_option'] as $key => $value): ?>
                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php else: ?>
                            <input type="text" class="form-control" name="<?php echo $name_input; ?>" placeholder="<?php echo $form_input[$i]['label']; ?>" value="<?php echo $val; ?>" <?php echo $disabled; ?> <?php echo $required; ?>>
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
                            <select class="form-control" name="<?php echo $name_input; ?>" <?php echo $disabled; ?> <?php echo $required; ?>>
                                <?php foreach($form_input[$i]['select_option'] as $key => $value): ?>
                                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php else: ?>
                            <input type="text" class="form-control" name="<?php echo $name_input; ?>" placeholder="<?php echo $form_input[$i]['label']; ?>" value="<?php echo $val; ?>" <?php echo $disabled; ?> <?php echo $required; ?>>
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