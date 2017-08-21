<?php

namespace Models;

use PDO;
use System\DB;

class DaftarPermohonan
{
	public static function getData($user, $offset = 0, $limit = 20)
	{
		$st = DB::pdo()->prepare("SELECT `b`.`nama_polres` AS `pemohon`,`a`.`memohon_ke`, `a`.`nopol`, `a`.`tanggal`, `a`.`nama_pemilik`, `a`.`no_rangka`, `a`.`no_mesin`, `a`.`no_bpkb`, `a`.`no_stnk`, `a`.`no_hp`, `a`.`file_stnk`, `a`.`file_notice_pajak`, `a`.`file_ktp`, `a`.`file_kwitansi_jual_beli`, `a`.`file_cek_fisik`, `a`.`file_bpkb`, `a`.`file_bukti_pembayaran_pnpb`, `a`.`file_struk_pelunasan_pajak`, `a`.`file_pelunasan_jasa_raharja`,`a`.`status` FROM `pemohon` AS `a` INNER JOIN `admin` AS `b` ON `a`.`pemohon`=`b`.`username` WHERE `memohon_ke`=:ke ORDER BY `status` LIMIT {$offset},{$limit};");
		$exe = $st->execute(array(
				":ke" => $user['username'],
			));
		if (!$exe) {
			var_dump($st->errorInfo());
			die(1);
		}
		if ($st = $st->fetchAll(PDO::FETCH_ASSOC)) {
			return $st;
		} else {
			return array();
		}
	}
}