<?php foreach($kelurahan as $key => $value): ?>
<option value="<?php echo (!empty($key) ? $key : ''); ?>"><?php echo $value; ?></option>
<?php endforeach; ?>