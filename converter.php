<?php

$res_1 = '';
$res_2 = '';
$res_3 = '';
$res_4 = '';
if(!empty($_POST)) {
	if(!empty($_POST['x_tanggal_waktu'])) $res_1 = strtotime($_POST['x_tanggal_waktu']);
	if(!empty($_POST['y_tanggal_waktu'])) $res_2 = date('Y-m-d H:i:s', $_POST['y_tanggal_waktu']);
	if(!empty($_POST['y_waktu'])) $res_3 = date('H:i:s', $_POST['y_waktu']);
	if(!empty($_POST['z_waktu'])) $res_4 = date('l', $_POST['z_waktu']);

	$d1 = new DateTime("2012-07-08 00:00:00");
	$d2 = new DateTime("2012-07-09 00:01:00");
	$diff = (array) $d2->diff($d1);
	if($diff['i'] < 10) $diff['i'] = ('0' . $diff['i']);
	echo $diff['i'];
	//print_r( $diff ) ;
	//DateInterval Object ( [y] => 0 [m] => 0 [d] => 1 [h] => 0 [i] => 1 [s] => 0 [invert] => 1 [days] => 1 )
}

?>

<!DOCTYPE html>
<html lang ="en">
	<head>
		<title>Converter</title>
	</head>
	<body>
		<form action="" method="post">
			<input placeholder="Date to string" name="x_tanggal_waktu" value="<?php echo (!empty($_POST['x_tanggal_waktu']) ? $_POST['x_tanggal_waktu'] : ''); ?>"> = <?php echo $res_1; ?>
			<br /><br />
			<input placeholder="String to date" name="y_tanggal_waktu" value="<?php echo (!empty($_POST['y_tanggal_waktu']) ? $_POST['y_tanggal_waktu'] : ''); ?>"> = <?php echo $res_2; ?>
			<br /><br />
			<input placeholder="String to time" name="y_waktu" value="<?php echo (!empty($_POST['y_waktu']) ? $_POST['y_waktu'] : ''); ?>"> = <?php echo $res_3; ?>
			<br /><br />
			<input placeholder="Time to nama hari" name="z_waktu" value="<?php echo (!empty($_POST['z_waktu']) ? $_POST['z_waktu'] : ''); ?>"> = <?php echo $res_4; ?>
			<br /><br />
			<input type="submit" name="submit">
		</form>
	</body>
</html>