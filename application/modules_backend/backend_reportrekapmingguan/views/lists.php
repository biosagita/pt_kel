<!--<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/widgets/daterangepicker/daterangepicker.css">-->
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/daterangepicker/moment.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo $assets; ?>/widgets/daterangepicker/daterangepicker-demo.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable-example').dataTable({
            /*
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
            ]
            */
        });
    });
</script>

<div class="page-content">
    <div class="page-header">
        <h2><?php echo $info_page['title']; ?></h2>
        <p><?php echo $info_page['desc']; ?></p>
    </div>

    <div class="row" id="panel_list">
        <div class="col-xs-12">
            <div class="row">
                <form method="post" class="form-horizontal bordered-row" action="<?php echo site_url('backend_reportrekapmingguan/reportrekapmingguan'); ?>">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Periode</label>
                    <div class="col-sm-6">
                        <input class="form-control" name="periode" id="daterangepicker-example" value="<?php echo $periode; ?>" />
                    </div>
                    <div class="col-sm-3">
                        <input type="submit" class="btn btn-success" value="Process" /> <a class="btn btn-info mrg20B" href="<?php echo site_url('report-rekap-mingguan/excel/?periode='.str_replace(' - ', '_', $periode)); ?>">EXCEL</a>
                    </div>
                </div>
                </form>
            </div>
            <!--<div class="row">
                <div class="col-xs-12">
                    <div class="pull-right tableTools-container"><a class="btn btn-info mrg20B" href="<?php echo site_url('report-rekap-mingguan/excel/?periode='.str_replace(' - ', '_', $periode)); ?>">EXCEL</a></div>
                </div>
            </div>-->
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-striped table-bordered table-hover" id="datatable-example">
                    <thead>
                    <tr>
                        <th>Jumlah Pengunjung</th>
                        <th>Pengaduan</th>
                        <th>Konsultasi</th>
                        <th>Berkas Masuk</th>
                        <th>Berkas Terbit</th>
                        <th>Berkas Tolak</th>
                        <th>Berkas Proses</th>
                        <th>Retribusi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo (!empty($daftartamu['total']) ? $daftartamu['total'] : '-'); ?></td>
                            <td>-</td>
                            <td>-</td>
                            <td><?php echo (!empty($berkaslayanan_total['total']) ? $berkaslayanan_total['total'] : '-'); ?></td>
                            <td><?php echo (!empty($berkaslayanan_approved['total']) ? $berkaslayanan_approved['total'] : '-'); ?></td>
                            <td><?php echo (!empty($berkaslayanan_reject['total']) ? $berkaslayanan_reject['total'] : '-'); ?></td>
                            <td><?php echo (!empty($berkaslayanan_proses['total']) ? $berkaslayanan_proses['total'] : '-'); ?></td>
                            <td><?php echo (!empty($retribusi['total']) ? $retribusi['total'] : 0); ?></td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="panel" id="panel_form"></div>

</div>