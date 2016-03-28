<div class="panel">
    <div class="panel-body">
        <h3 class="title-hero text-center">
            Daftar Skip Tamu
        </h3>
        <?php if(count($daftartamu) > 0): ?>
        <div class="example-box-wrapper">
            <table id="datatable-tabletools" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Instansi</th>
                        <th>Alamat</th>
                        <th>No. HP</th>
                        <th>Layanan</th>
                        <th>State</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $cnt = 1; ?>
                    <?php foreach($daftartamu as $value): ?>
                    <?php $url_layanan = site_url('list-berkas-layanan/'.sanitize_title_with_dashes($value['lyn_name']) . URL_DELIMITER . $value['lyn_id']); ?>
                    <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo $value['dftm_nama']; ?></td>
                        <td><?php echo $value['dftm_instansi']; ?></td>
                        <td><?php echo $value['dftm_alamat']; ?></td>
                        <td><?php echo $value['dftm_telp']; ?></td>
                        <td><a href="<?php echo $url_layanan; ?>"><?php echo (!empty($value['lyn_name']) ? $value['lyn_name'] : '-'); ?></a></td>
                        <td>
                            <?php 
                                $next_action_url = '#';
                                switch ($value['dftm_status']) {
                                    case STATUS_BERKASLAYANAN:
                                        $status_label = 'Berkas Layanan';
                                        $next_action_url = site_url('state-berkas-layanan/' . $value['dftm_id']);
                                        break;
                                    case STATUS_FORMISIAN:
                                        $status_label = 'Form Isian';
                                        break;
                                    case STATUS_APPROVAL:
                                        $status_label = 'Approval';
                                        break;
                                    case STATUS_CETAK:
                                        $status_label = 'Cetak';
                                        break;
                                    default:
                                        $status_label = 'Daftar Tamu';
                                        $next_action_url = site_url('state-daftar-tamu/' . $value['dftm_id']);
                                        break;
                                }
                            ?>
                            <?php echo $status_label; ?>
                        </td>
                        <td>
                            <a class="btn btn-warning" href="<?php echo site_url('unskip-daftar-tamu/' . $value['dftm_id']); ?>">Unskip</a>
                        </td>
                    </tr>
                    <?php $cnt++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="example-box-wrapper">
            <p class="bg-danger text-center" style="padding:10px;">List daftar tamu belum ada</p>
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
                    "width": '220px',
                    "targets": 7,
                }
            ]
        } );

    } );

    $(document).ready(function() {
        $('.dataTables_filter input').attr("placeholder", "Search...");
    });

</script>