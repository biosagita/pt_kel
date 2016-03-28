<!DOCTYPE html>
<html lang ="en">
	<head>
		<title><?php echo $title; ?></title>
		<!-- Favicons -->
		<link rel="shortcut icon" href="<?php echo site_url('favicon.png'); ?>">
		
		<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/reset.css">
		<style type="text/css">
			@page{
				size: auto;
				margin: 0mm 30px;
			}
			body>table{width: 96% !important;margin: auto;}
			th,td {vertical-align: top;}
			img{margin-right: 20px;}
		</style>
	</head>
	<body>
		<?php echo $contents; ?>
	</body>
</html>