<?php

namespace Controllers;

use Models\R2PTGModelCrr as RRG;

class R2PTG
{
	public static function run()
	{
		if (isset($_GET['npid'])) {
			$q = base64_decode(@gzinflate(base64_decode($_GET['npid'])));
			if (($dt = RRG::check_rt($q)) != "sudah" and $dt !== false) {
				view("r2ptg/_index", array("st" => $dt));
			} else {
				if (!$dt===false){
					http_response_code(404);
					die("Not Found!");
				} else {
					?>
<!DOCTYPE html>
<html>
<head>
	<title>Sudah diproses</title>
	<style type="text/css">
		h1{
			font-family: Helvetica;
		}
	</style>
</head>
<body>
<h1>Permintaan mutasi ini telah selesai diproses!</h1>
<a href="?pg=permohonan_masuk&amp;r=<?php print urlencode(rstr(32)); ?>"><button style="cursor:pointer;">Kembali</button></a>
</body>
</html>
					<?php
				}
			}
		} else {
			header("location:?pg=permohonan_masuk");
			die(1);
		}
	}
}