<?php
use System\DB;
$st = DB::pdo()->prepare("SELECT `nama_polres` FROM `admin` WHERE `username`=:user LIMIT 1;");
$exe = $st->execute(array(
		":user" => strtolower($_COOKIE['user'])
	));
if (!$exe) {
	var_dump($st->errorInfo());
	die(1);
}
$st = $st->fetch(PDO::FETCH_NUM);
$nama_polres = $st[0];
?>
<!DOCTYPE html>
<html>
<head>
<title>Mutasi Online</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js" ></script>
<style>
body {
	background-color: #FAFCC2;
}
.cg {
	margin-top: 3%;
}
.btg {
	margin-top: 1%;
}
.btn {
	width: 20%;
	color:#fff;
	font-family: Helvetica;
	font-weight: bold;
}
.wcf {
	margin-top: 3%;
}
</style>
</head>
<body>
<center>
	<div class="wcf">
		<h1 style="font-family:Helvetica;font-weight:bold;">Mutasi Online Polres <?php print $nama_polres; ?></h1>
	</div>
	<div class="cg jumbotron">
		<div class="btg">
		 	<a href="?pg=input_mutasi"><button class="btn btn-lg btn-success">Input Mutasi Keluar</button></a>
		</div>
		<div class="btg">
			<a href="?pg=permohonan_keluar"><button class="btn btn-lg btn-success">Data Mutasi Keluar</button></a>
		</div>
		<div class="btg">
			<a href="?pg=permohonan_masuk"><button class="btn btn-lg btn-success">Data Mutasi Masuk</button></a>
		</div>
		<div class="btg">
			<a href="?pg=logout"><button class="btn btn-lg btn-warning">Logout</button></a>
		</div>
	</div>
</center>
</body>
</html>