<div class="panel">
    <div class="panel-body">
        <h3 class="title-hero text-center">
            Daftar Layanan Notifikasi
        </h3>
        <?php if(count($berkaslayanan) > 0): ?>
        <div class="example-box-wrapper">
            <table id="datatable-tabletools" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No. Berkas</th>
                        <th>Nama</th>
                        <th>Layanan</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $cnt = 1; ?>
                    <?php foreach($berkaslayanan as $value): ?>
                    <?php $url_layanan = site_url('list-berkas-layanan/'.sanitize_title_with_dashes($value['lyn_name']) . URL_DELIMITER . $value['lyn_id']); ?>
                    <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo $value['bly_noberkas']; ?></td>
                        <td><?php echo $value['bly_pemohon']; ?></td>
                        <td><a href="<?php echo $url_layanan; ?>"><?php echo (!empty($value['lyn_name']) ? $value['lyn_name'] : '-'); ?></a></td>
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
                            <!--<a class="btn btn-default" href="<?php echo site_url('berkas-layanan/detail/' . $value['bly_id']); ?>" style="min-width:40px;">Detail</a>-->
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

                            <?php if($value['bly_lyn_id'] == ID_LAYANAN_RETRIBUSI): ?>
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
                        </td>
                    </tr>
                    <?php $cnt++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="example-box-wrapper">
            <p class="bg-danger text-center" style="padding:10px;">List layanan notifikasi ini belum ada</p>
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
                    "width" : '320px'
                }
            ]
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