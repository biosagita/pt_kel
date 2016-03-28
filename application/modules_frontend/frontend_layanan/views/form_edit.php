<div class="panel">
    <div class="panel-body">
        <h3 class="title-hero text-center">
            Formulir Persyaratan Permohonan<br/><?php echo $layanan['lyn_name']; ?>
        </h3>
        <?php if(count($persyaratanlayanan) > 0): ?>
        <div class="example-box-wrapper">
            <form method="post" action="<?php echo site_url('berkas-layanan/edit/' . $hd_bly_id); ?>" class="form-horizontal bordered-row">
                <input type="hidden" name="hd_bly_id" value="<?php echo $hd_bly_id; ?>" />
                <input type="hidden" name="hd_lyn_id" value="<?php echo $hd_lyn_id; ?>" />
                <div class="form-group">
                    <label class="col-sm-3 control-label">No Berkas</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="noberkas" placeholder="No Berkas" value="<?php echo $berkaslayanan['bly_noberkas']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="pemohon" placeholder="Nama" value="<?php echo $berkaslayanan['bly_pemohon']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Persyaratan</label>
                    <div class="col-sm-6">
                        <table class="table table-condensed table-hover">
                            <tbody>
                                <?php $tmp = unserialize($berkaslayanan['bly_persyaratan']); ?>
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
                        <textarea name="notes" class="form-control" placeholder="Keterangan"><?php echo $berkaslayanan['bly_notes']; ?></textarea>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button type="submit" class="btn btn-blue-alt btn-lg">Update Data</button>
                    <a href="<?php echo $url_listberkaslayanan; ?>" type="button" class="btn btn-default btn-lg">Batal</a>
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