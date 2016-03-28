<?php
$file = "$filename.xls";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");
?>

<?php echo $contents; ?>