<script type="text/javascript">

    function doFormEdit(rowid) {
        var param_list = {
            'formid'            : '#dynamic_form',
            'panel_form'        : '#panel_form',
            'url_ajax_action'   : '<?php echo $ajax_form_edit; ?>',
            'parameter'         : {'data_id' : rowid},
            'data_type'         : 'html',
            'callback'          : function(data) {
                $(param_list.panel_form).append(data);
                $(param_list.formid).find(':input:eq(1)').focus();
                autoScrolling(param_list.panel_form);
            }
        };
        $(param_list.panel_form).empty();
        MYAPP.doAjax.process(param_list.url_ajax_action, param_list.parameter, param_list.callback, param_list.data_type);
    }

    function showModalBoxDelete(rowid) {
        var cfm = confirm('delete this data?');
        if(!cfm) return false;
        doFormDelete(rowid);        
    }

    function doFormDelete(rowid) {
        var param = {
            'url_ajax_action'   : '<?php echo $ajax_action_delete; ?>',
            'parameter'         : {'data_id' : rowid},
            'data_type'         : 'json',
            'callback'          : function(data) {
                if(data.err_msg == '') {
                    $.jGrowl(data.success_msg, {
                        sticky: false,
                        position: 'top-right',
                        theme: 'bg-red'
                    });
                    refreshTable();
                } else {
                    $.jGrowl(data.err_msg, {
                        sticky: false,
                        position: 'top-right',
                        theme: 'bg-red'
                    });
                }
                $('#smallModal').modal('hide');
            }
        };
        MYAPP.doAjax.process(param.url_ajax_action, param.parameter, param.callback, param.data_type);
    }

    function autoScrolling(panel_id) {
        $('html, body').animate({
            scrollTop: $(panel_id).offset().top
        }, 700);
    }

    myowndatatable = '';
    $(document).ready(function() {
        myowndatatable = $('#datatable-example').dataTable({
            "autoWidth": false,
        	"processing": true,
	        "serverSide": true,
	        "ajax": '<?php echo $ajax_lists; ?>',
            "columnDefs": [ 
                {
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                },
                {
                    "width": "50%",
                    "targets": 1
                },
                {
                    "searchable": false,
                    "orderable": false,
                    "width": "15%",
                    "targets": <?php echo (count($column_list) - 1); ?>
                }
            ],
            "order": [[ 2, 'asc' ]],
            "drawCallback": function ( settings ) {
                var api = this.api();
                var rows = api.rows( {page:'current'} ).nodes();
                var last=null;
     
                api.column(2, {page:'current'} ).data().each( function ( group, i ) {
                    if ( last !== group ) {
                        $(rows).eq( i ).before(
                            '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                        );
     
                        last = group;
                    }
                } );
            },
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
        });

        // Order by the grouping
        $('#datatable-example tbody').on( 'click', 'tr.group', function () {
            var currentOrder = myowndatatable.fnSettings().aaSorting;
            if ( currentOrder[0][0] === 2 && currentOrder[0][1] === 'asc' ) {
                myowndatatable.fnSort( [ 2, 'desc' ] );
            }
            else {
                myowndatatable.fnSort( [ 2, 'asc' ] );
            }
        });
    });

    $(document).ready(function() {
        $('.dataTables_filter input').attr("placeholder", "Search...");
    });

    function refreshTable() {
        /*
        myowndatatable.fnClearTable(0);
        myowndatatable.fnDraw();
        */
        myowndatatable.fnStandingRedraw();
    }

    $(function() { "use strict";
        var param_list = {
            'formid'            : '#dynamic_form',
            'panel_form'        : '#panel_form',
            'add_data'          : '#add_data',
            'panel_list'        : '#panel_list',
        };

        $(param_list.add_data).click(function() {
            $(param_list.panel_form).empty();
            var param = {
                'url_ajax_action'   : '<?php echo $ajax_form_add; ?>',
                'parameter'         : {},
                'data_type'         : 'html',
                'callback'          : function(data) {
                    $(param_list.panel_form).append(data);
                    $(param_list.formid).find(':input:first').focus();
                    autoScrolling(param_list.panel_form);
                }
            };
            MYAPP.doAjax.process(param.url_ajax_action, param.parameter, param.callback, param.data_type);
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
                <div class="col-xs-12">
                    <div class="pull-right tableTools-container">
                        <button type="button" class="btn btn-info mrg20B" id="add_data">
                            Add Data
                        </button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
        		    <table class="table table-striped table-bordered table-hover" id="datatable-example">
        		    <thead>
        		    <tr>
                        <?php foreach($column_list as $val) : ?>
                            <th><?php echo $val['title_header_column']; ?></th>
                        <?php endforeach; ?>
        		    </tr>
        		    </thead>
        		    </table>
                </div>
            </div>
    	</div>
    </div>

    <div class="panel" id="panel_form"></div>

</div>