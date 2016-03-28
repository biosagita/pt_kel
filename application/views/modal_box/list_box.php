<div class="modal-header bg-primary">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
     <h4 class="modal-title"><?php echo $group_layanan['gly_name']; ?></h4>
</div>
<div class="modal-body">
	<div class="row">
    <?php if(!empty($layanan)): ?>
    	<?php foreach($layanan as $value): ?>
    	<a href="<?php echo site_url('daftar-tamu/' . sanitize_title_with_dashes($value['lyn_name']) . URL_DELIMITER . $value['lyn_id']); ?>">
            <div class="icon-box col-md-2">
            	<div style="margin-bottom:20px;width:98%;text-align: center;border-width: 1px;border-style: solid;border-color: #dfe8f1;min-height: 160px;">
	                <i class="icon-medium glyph-icon icon-file-text"></i>
	                <h3 class="icon-title" style="margin: 0 10px;font-weight:bold;"><?php echo $value['lyn_name']; ?></h3>
                </div>
            </div>
        </a>
    	<?php endforeach; ?>
	<?php else: ?>
		<p class="bg-danger text-center" style="padding:10px;">List data tidak ada</p>
	<?php endif; ?>
	</div>
</div>
<!--<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-primary">Save changes</button>
</div>-->