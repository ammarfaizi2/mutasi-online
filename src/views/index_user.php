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
	background-image: url(assets/bg.jpg);
  	background-position: center center;  
  	background-repeat: no-repeat;
  	background-attachment: fixed;
  	background-size: cover;
  	background-color: #464646;
}
.cg {
	margin-top: 3%;
}
.wcf {
	margin-top: 3%;
}
.cgf{
	background-color: #fff;
	width: 35%;
	margin-top: 7%;
	padding-top: 1%;
	padding-bottom: 2%;
	margin-bottom: 10%;
	border: 3px solid #000;
}
.btgg{
	font-family: Helvetica, Arial;
	padding: 3% 10% 3% 10%;
	word-wrap: break-word;
	color:#fff;
	background-color:#39C21B;
	border: 3px solid #000;
	border-radius: 3%;
	font-size: 145%;
	font-weight: bolder;
}
.btgg:hover{
	background-color:#41A326;
}
.bfg{
	font-family: Helvetica, Arial;
	padding: 2% 24% 2% 24%;
	color: #fff;
	font-size: 125%;
	background-color: #EC971F;
	border-radius: 3%;
	font-size: 145%;
	font-weight: bolder;
}
.bfg:hover{
	background-color: #D18A2C;
}
</style>
</head>
<body>
<center>
	<div class="cgf">
		<div>
			<img src="assets/logo.jpg" width="170" height="150">
		</div>
		<div class="wcf">
			<h2 style="font-family:Helvetica;font-weight:bold;">Mutasi Online Polres <?php print $nama_polres; ?></h2>
		</div>
		<div class="cg">
			<p><a href="?pg=input_mutasi"><button class="btgg" style="padding: 3% 9% 3% 9%;">Input Permohonan Cabut Berkas</button></a></p>
			<p><a href="?pg=permohonan_keluar"><button class="btgg">Data Mutasi Keluar</button></a></p>
			<p><a href="?pg=permohonan_masuk"><button class="btgg">Data Permohonan Cabut Berkas</button></a></p>
			<p><a href="?pg=logout"><button class="bfg">Logout</button></a></p>
		</div>
	</div>
</center>
</body>
</html>