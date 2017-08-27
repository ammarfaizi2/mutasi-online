<?php
require __DIR__."/src/autoload.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
$st = System\DB::pdo()->prepare("SELECT `username`,`nama_polres` FROM `admin`;");
$st->execute();
?>
<table border="2">
	<tr><td align="center">No.</td><td align="center">Username</td><td align="center">Nama Polres</td></tr>
	<?php
	$i = 1;
	while ($val = $st->fetch(PDO::FETCH_NUM)) {
	?>
	<tr><td align="center"><?php print $i++; ?></td><td align="center"><?php print $val[0]; ?></td><td align="center"><?php print $val[1]; ?></td></tr>
	<?php
	}
	?>
</table>
</body>
</html>