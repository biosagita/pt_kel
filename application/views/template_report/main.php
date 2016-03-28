<!DOCTYPE html>
<html lang ="en">
	<head>
		<title><?php echo $title; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/bootstrap/css/datepicker.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/custom/css/custom.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>/bootstrap/css/print.css">

		<script type="text/javascript" src="<?php echo $assets; ?>/jquery/jquery.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Payroll</a>
				</div>
				<div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
					<ul class="nav navbar-nav">
						<li <?php echo ($title == 'Transfer BRI' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('report/transfer-bri'); ?>">Transfer BRI</a></li>
						<li <?php echo ($title == 'Rekap Pot Grade' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('report/rekap-pot-grade'); ?>">Rekap Pot Grade</a></li>
						<li <?php echo ($title == 'Tanda Terima' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('report/tanda-terima'); ?>">Tanda Terima</a></li>
						<li <?php echo ($title == 'Rekap Keb' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('report/rekap-keb'); ?>">Rekap Keb</a></li>
						<li <?php echo ($title == 'Rekap Keb Norek' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('report/rekap-keb-norek'); ?>">Rekap Keb Norek</a></li>
						<li <?php echo ($title == 'Rekap LPJ' ? 'class="active"' : ''); ?>><a href="<?php echo site_url('report/rekap-lpj'); ?>">Rekap LPJ</a></li>
						<li><a href="<?php echo site_url('backend/jabatan'); ?>"><?php echo $admin_userlevel; ?></a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
	    </nav>
	    
		<div class="container">
		    <?php echo $contents; ?>
		</div>

		<script type="text/javascript" src="<?php echo $assets; ?>/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo $assets; ?>/bootstrap/js/bootstrap-datepicker.js"></script>
		<script type="text/javascript" src="<?php echo $assets; ?>/jquery/modernizr.js"></script>
		<script type="text/javascript" src="<?php echo $assets; ?>/jquery/jquery-cookie.js"></script>
		<script type="text/javascript" src="<?php echo $assets; ?>/custom/js/custom.js"></script>
	</body>
</html>