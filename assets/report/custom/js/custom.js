$(document).ready(function () {
	if($.fn.datepicker){
	    $('.datepicker').datepicker({
	        format: 'dd-mm-yyyy',
	        startDate: '-3d'
	    }).on('changeDate', function(e){
            $(this).datepicker('hide');
        });
	}
})