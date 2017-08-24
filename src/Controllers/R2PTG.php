<?php

namespace Controllers;

use Models\R2PTGModelCrr as RRG;

class R2PTG
{
	public static function run()
	{
		if (isset($_GET['npid'])) {
			$q = base64_decode(gzinflate(base64_decode($_GET['npid'])));
			if (($dt = RRG::check_rt($q)) != "sudah") {
				view("r2ptg/_index", array("dt" => $dt));
			} else {
				echo "Sudah diproses !";
			}
		} else {
			header("location:?pg=permohonan_masuk");
			die(1);
		}
	}
}