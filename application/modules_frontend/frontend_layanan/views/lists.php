<div class="panel">
    <div class="panel-body">
        <h3 class="title-hero text-center">
            Daftar Persyaratan Permohonan<br/><?php echo $layanan['lyn_name']; ?>
        </h3>
        <?php if(count($berkaslayanan) > 0): ?>
        <div class="example-box-wrapper">
            <table id="datatable-tabletools" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Berkas</th>
                        <th>Nama</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $cnt = 1; ?>
                    <?php foreach($berkaslayanan as $value): ?>
                    <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo $value['bly_noberkas']; ?></td>
                        <td><?php echo $value['bly_pemohon']; ?></td>
                        <td><?php echo (!empty($value['bly_notes']) ? $value['bly_notes'] : '-'); ?></td>
                        <td class="text-center">
                            <?php if($value['bly_status'] == BERKAS_APPROVED): ?>
                            <a class="btn btn-success" href="#" style="min-width:120px;">Approved</a>
                            <?php elseif($value['bly_status'] == BERKAS_REJECT): ?>
                            <a class="btn btn-warning" href="#" style="min-width:120px;">Reject</a>
                            <?php elseif($value['bly_status'] == BERKAS_LENGKAP): ?>
                            <a class="btn btn-primary" href="#" style="min-width:120px;">Lengkap</a>
                            <?php else: ?>
                            <a class="btn btn-danger" href="#" style="min-width:120px;">Belum Lengkap</a>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a class="btn btn-default" href="<?php echo site_url('berkas-layanan/edit/' . $value['bly_id']); ?>" style="min-width:40px;">Edit</a>

                            <?php if($value['bly_status'] > 0): ?>
                            <a class="btn btn-default" href="<?php echo site_url('berkas-layanan/form/' . $value['bly_id']); ?>" style="min-width:40px;">Form</a>
                            <?php endif; ?>

                            <?php if($value['bly_status'] > 0 AND !empty($value['frm_id'])): ?>
                                <?php if($value['bly_status'] == BERKAS_APPROVED): ?>
                                <a class="btn btn-default" href="<?php echo site_url('berkas-layanan/unapproved/' . $value['bly_id']); ?>" style="min-width:40px;">Unapproved</a>
                                <?php elseif($value['bly_status'] == BERKAS_REJECT): ?>
                                <a class="btn btn-default" href="<?php echo site_url('berkas-layanan/unapproved/' . $value['bly_id']); ?>" style="min-width:40px;">Unreject</a>
                                <?php else: ?>
                                <a class="btn btn-default" href="<?php echo site_url('berkas-layanan/approved/' . $value['bly_id']); ?>" style="min-width:40px;">Approved</a>
                                <a class="btn btn-default" href="<?php echo site_url('berkas-layanan/reject/' . $value['bly_id']); ?>" style="min-width:40px;">Reject</a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if($layanan['lyn_id'] == ID_LAYANAN_RETRIBUSI): ?>
                                <a class="btn btn-default" href="<?php echo site_url('berkas-layanan/finish/' . $value['bly_id']); ?>" style="min-width:40px;" <?php echo (!empty($value['dftm_complete']) ? 'disabled' : ''); ?>>Finish</a>
                            <?php else: ?>
                                <?php if($value['bly_status'] == BERKAS_APPROVED AND !empty($value['frm_id'])): ?>
                                <a target="_blank" class="btn btn-default" href="<?php echo site_url('berkas-layanan/sertifikat/' . $value['bly_id']); ?>" style="min-width:40px;">Sertifikat</a>
                                <a class="btn btn-default" href="<?php echo site_url('berkas-layanan/finish/' . $value['bly_id']); ?>" style="min-width:40px;" <?php echo (!empty($value['dftm_complete']) ? 'disabled' : ''); ?>>Finish</a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if($value['bly_status'] == BERKAS_REJECT AND !empty($value['frm_id'])): ?>
                            <a class="btn btn-default" href="<?php echo site_url('berkas-layanan/finish/' . $value['bly_id']); ?>" style="min-width:40px;" <?php echo (!empty($value['dftm_complete']) ? 'disabled' : ''); ?>>Finish</a>
                            <?php endif; ?>

                            <a class="btn btn-danger" href="<?php echo site_url('berkas-layanan/delete/' . $value['bly_id']); ?>" style="min-width:40px;">DELETE</a>

                        </td>
                    </tr>
                    <?php $cnt++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="example-box-wrapper">
            <p class="bg-danger text-center" style="padding:10px;">List berkas layanan ini belum ada</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var dataTable = $('#datatable-tabletools').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'colvis',
                    text: 'Column Visibility',
                    columns: ':not(:first-child)'
                }
            ],
            "columnDefs": [ 
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                },
                {
                    "targets": 4,
                    "width" : '200px'
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 5,
                    "width" : '400px'
                }
            ],
            "order": [[ 1, 'asc' ]]
        } );

        /*
        var colvis = new $.fn.dataTable.ColVis( dataTable );
        $( colvis.button() ).insertAfter('div.dataTables_filter');
        */

    } );

    $(document).ready(function() {
        $('.dataTables_filter input').attr("placeholder", "Search...");
    });

</script>