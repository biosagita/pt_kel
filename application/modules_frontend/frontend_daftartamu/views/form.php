<div class="panel">
    <div class="panel-body">
        <h3 class="title-hero text-center">
            Formulir Daftar Tamu
        </h3>
        <div class="example-box-wrapper">
            <form method="post" action="<?php echo $action_form; ?>" class="form-horizontal bordered-row">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nama</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="dftm_nama" placeholder="Nama" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Instansi</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="dftm_instansi" placeholder="Instansi" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">NIK</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="dftm_nik" placeholder="NIK" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Gender</label>
                    <div class="col-sm-6">
                        <select name="dftm_jeniskelamin" class="form-control" required>
                            <option value="">--Pilih Gender--</option>
                            <option value="laki-laki">Laki-laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Alamat</label>
                    <div class="col-sm-6">
                        <textarea name="dftm_alamat" class="form-control" placeholder="Alamat" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">No. HP</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="dftm_telp" placeholder="No. HP" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Keperluan</label>
                    <div class="col-sm-6">
                        <textarea name="dftm_keperluan" class="form-control" placeholder="Keperluan" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-blue-alt btn-lg btn-block">Submit Data</button>
                </div>
            </form>
        </div>
    </div>
</div>