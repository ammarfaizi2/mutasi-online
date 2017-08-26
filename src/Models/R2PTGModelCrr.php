<?php

namespace Models;

use PDO;
use System\DB;

class R2PTGModelCrr
{
	public static function check_rt($nopol)
	{
		$st = DB::pdo()->prepare("SELECT `a`.`nama_polres` AS `pemohon`,`nopol`,`nama_pemilik`,`no_rangka`,`no_mesin`,`no_bpkb`,`no_stnk`,`status` FROM `pemohon` INNER JOIN `admin` AS `a` ON `pemohon`.`pemohon`=`a`.`username` WHERE `nopol`=:nopol AND `memohon_ke`=:ke LIMIT 1;");
		$exe = $st->execute(array(
				":nopol" => $nopol,
				":ke" => $_COOKIE['user']
			));
		if (!$exe) {
			var_dump($st->errorInfo());
			die(1);
		}
		$st = $st->fetch(PDO::FETCH_ASSOC);
		if ($st['status'] == "sedang proses") {
			return $st;
		} else {
			return $st===false ? false : "sudah";
		}
	}
}