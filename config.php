<?php
if ($_SERVER['REMOTE_ADDR'] != "127.0.0.1" and !isset($_SERVER['HTTPS'])) {
	$url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	header("location:".$url);
	die($url);
}

/*define("DBHOST", "localhost");
define("DBUSER", "tegaljat_mutasi");
define("DBPASS", "triosemut123");
define("DBNAME", "tegaljat_mutasi");*/

define("DBHOST", "localhost");
define("DBUSER", "debian-sys-maint");
define("DBPASS", "");
define("DBNAME", "mutasi");

/*define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBNAME", "mutasi");*/

define("ASSETS_DIR", __DIR__."/assets");
