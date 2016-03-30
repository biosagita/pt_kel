<div class="panel">
    <div class="panel-body">
        <h3 class="title-hero text-center">
            Formulir Persyaratan Permohonan<br/><?php echo $layanan['lyn_name']; ?>
        </h3>
        <?php if(count($persyaratanlayanan) > 0): ?>
        <div class="example-box-wrapper">
            <form method="post" action="<?php echo $action_form; ?>" class="form-horizontal bordered-row">
                <input type="hidden" name="hd_bly_id" value="<?php echo $hd_bly_id; ?>" />
                <input type="hidden" name="hd_lyn_id" value="<?php echo $hd_lyn_id; ?>" />
                <div class="form-group">
                    <label class="col-sm-3 control-label">No Berkas</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="noberkas" placeholder="No Berkas" value="<?php echo (!empty($berkaslayanan['bly_noberkas']) ? $berkaslayanan['bly_noberkas'] : ''); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="pemohon" placeholder="Nama" value="<?php echo (!empty($daftartamu['dftm_nama']) ? $daftartamu['dftm_nama'] : ''); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Persyaratan</label>
                    <div class="col-sm-6">
                        <table class="table table-condensed table-hover">
                            <tbody>
                                <tr>
                                    <td colspan="3" style="text-align:right;">
                                        <label id="checkall">Check All</label>
                                    </td>
                                </tr>
                                <?php $tmp = !empty($berkaslayanan['bly_persyaratan']) ? unserialize($berkaslayanan['bly_persyaratan']) : array(); ?>
                                <?php $cnt = 1; ?>
                                <?php foreach($persyaratanlayanan as $value): ?>
                                <tr>
                                    <td><?php echo $cnt; ?></td>
                                    <td><?php echo $value['ply_desc']; ?></td>
                                    <td>
                                        <div class="checkbox checkbox-success">
                                            <label>
                                                <input type="checkbox" name="plyid[<?php echo $value['ply_id']; ?>]" id="plyid_<?php echo $value['ply_id']; ?>" class="custom-checkbox" value="<?php echo $value['ply_id']; ?>" <?php echo (!empty($tmp[$value['ply_id']]) ? 'checked' : ''); ?>>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <?php $cnt++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Keterangan</label>
                    <div class="col-sm-6">
                        <textarea name="notes" class="form-control" placeholder="Keterangan"><?php echo (!empty($berkaslayanan['bly_notes']) ? $berkaslayanan['bly_notes'] : ''); ?></textarea>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-blue-alt btn-lg btn-block">Submit Data</button>
                </div>
            </form>
        </div>
        <?php else: ?>
        <div class="example-box-wrapper">
            <p class="bg-danger text-center" style="padding:10px;">Persyaratan untuk layanan ini belum ada, mohon dilengkapi terlebih dahulu</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#checkall').click(function(){
            var me = $(this);
            if(me.hasClass('checked')) {
                $('.custom-checkbox:checked').trigger('click');
                me.removeClass('checked');
                me.text('Check All');
            } else {
                $('.custom-checkbox:not(:checked)').trigger('click');
                me.addClass('checked');
                me.text('Uncheck All');
            }
        });
    });
</script>