<div class="panel">
    <div class="panel-body">
        <h3 class="title-hero text-center">
            Daftar Tamu
        </h3>
        <form method="post" class="form-horizontal bordered-row" action="<?php echo site_url('daftar-tamu/lists'); ?>">
            <div class="form-group row" style="margin-bottom:20px;">
                <label class="col-sm-3 control-label">Periode</label>
                <div class="col-sm-6">
                    <input class="form-control" name="periode" id="daterangepicker-example" value="<?php echo $periode; ?>" />
                </div>
                <div class="col-sm-3">
                    <input type="submit" class="btn btn-success" value="Process" />
                </div>
            </div>
        </form>
        <?php if(count($daftartamu) > 0): ?>
        <div class="example-box-wrapper">
            <table id="datatable-tabletools" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Instansi</th>
                        <th>No. HP</th>
                        <th>Layanan</th>
                        <th>Tanggal</th>
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
                        <td><?php echo $value['dftm_telp']; ?></td>
                        <td><a href="<?php echo $url_layanan; ?>"><?php echo (!empty($value['lyn_name']) ? $value['lyn_name'] : '-'); ?></a></td>
                        <td><?php echo datetime_to_date($value['dftm_entrydate']); ?></td>
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
                        <td><?php echo ((!empty($value['dftm_complete']) OR $value['dftm_status'] == STATUS_CETAK) ? '<a href="'.$next_action_url.'" class="btn btn-success">COMPLETE</a>' : '<a href="'.$next_action_url.'" class="btn btn-danger">PENDING</a>'); ?> 
                            <?php if(empty($value['dftm_complete']) AND $value['dftm_status'] != STATUS_CETAK): ?>
                            <a class="btn btn-warning" href="<?php echo site_url('skip-daftar-tamu/' . $value['dftm_id']); ?>">Skip</a>
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
                    "width": '120px',
                    "targets": 3,
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