<div class="panel">
    <div class="panel-body">
        <h3 class="title-hero text-center">
            Daftar Tamu Non Layanan
        </h3>
        <?php if(count($daftartamunonlayanan) > 0): ?>
        <div class="example-box-wrapper">
            <table id="datatable-tabletools" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Instansi</th>
                        <th>Alamat</th>
                        <th>No. HP</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $cnt = 1; ?>
                    <?php foreach($daftartamunonlayanan as $value): ?>
                    <tr>
                        <td><?php echo $cnt; ?></td>
                        <td><?php echo $value['dfnl_nama']; ?></td>
                        <td><?php echo $value['dfnl_instansi']; ?></td>
                        <td><?php echo $value['dfnl_alamat']; ?></td>
                        <td><?php echo $value['dfnl_telp']; ?></td>
                    </tr>
                    <?php $cnt++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="example-box-wrapper">
            <p class="bg-danger text-center" style="padding:10px;">List daftar tamu non layanan belum ada</p>
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
                    "width": '100px';
                    "targets": 8,
                }
            ],
            "order": [[ 1, 'asc' ]]
        } );

    } );

    $(document).ready(function() {
        $('.dataTables_filter input').attr("placeholder", "Search...");
    });

</script>