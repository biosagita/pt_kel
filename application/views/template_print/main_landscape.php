<!DOCTYPE html>
<html lang ="en">
	<head>
		<title><?php echo $title; ?></title>
		<style type="text/css">
			table {
				width: 100%;
			    border:none !important;
			}
			th, td {
				vertical-align: top;
			    border:none !important;
			}
			@media print{
				@page {size: landscape;}
				table {font-size: 10px;}
			}
		</style>
	</head>
	<body>
		<?php echo $contents; ?>
	</body>
</html>