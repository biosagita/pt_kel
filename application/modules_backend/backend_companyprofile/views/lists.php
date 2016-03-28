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
                    "searchable": false,
                    "orderable": false,
                    "targets": <?php echo (count($column_list) - 1); ?>
                }
            ],
            "order": [[ 1, 'asc' ]],
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

    <br/>

    <div class="row" id="panel_list">
    	<div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">
        		    <div class="panel">
                        <div class="panel-body">
                            <div class="example-box-wrapper">
                                <form class="form-horizontal bordered-row">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Nama</label>
                                        <div class="col-sm-8">
                                            <a href="#" id="inline-firstname" data-type="text" data-pk="1" data-placement="right" data-placeholder="Required" data-title="Enter your firstname">Kelurahan Kenari</a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Alamat</label>
                                        <div class="col-sm-8">
                                            <a href="#" id="inline-comments" data-type="textarea" data-pk="1" data-placeholder="Your comments here..." data-title="Enter comments">Jakarta</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    	</div>
    </div>

    <div class="panel" id="panel_form"></div>

</div>