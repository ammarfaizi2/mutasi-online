<?php

namespace Controllers;

use System\DB;
use Handler\FileHandler as F;

class InputMutasiController
{
	public static function run($user)
	{
		if (isset($_POST['submit'])) {
			self::postAction();
		} else {
			view("input_mutasi/_index");
		}
	}

	public static function postAction()
	{
		if (empty($_POST['kirim_ke']) or empty($_POST['nopol']) or empty($_POST['nama_pemilik']) or empty($_POST['no_rangka']) or empty($_POST['no_mesin']) or empty($_POST['no_bpkb']) or empty($_POST['no_stnk']) or empty($_POST['no_hp']) or empty($_POST['submit']) or empty($_FILES['stnk']['tmp_name']) or empty($_FILES['notice_pajak']['tmp_name']) or empty($_FILES['ktp']['tmp_name']) or empty($_FILES['kwitansi_jual_beli']['tmp_name']) or empty($_FILES['cek_fisik']['tmp_name']) or empty($_FILES['bpkb']['tmp_name']) or empty($_FILES['bukti_pembayaran_pnbp_mutasi_keluar']['tmp_name'])) {
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<title></title>
				<script type="text/javascript">
					alert("Data tidak lengkap !");
					window.location = "?pg=input_mutasi";
				</script>
			</head>
			<body>
			
			</body>
			</html>
			<?php
			die(1);
		}
		$u = BASEPATH."/assets/users/";
		$st = DB::pdo()->prepare("INSERT INTO `pemohon` (`memohon_ke`, `nopol`, `tanggal`, `nama_pemilik`, `no_rangka`, `no_mesin`, `no_bpkb`, `no_stnk`, `no_hp`, `file_stnk`, `file_notice_pajak`, `file_ktp`, `file_kwitansi_jual_beli`, `file_cek_fisik`, `file_bpkb`, `file_bukti_pembayaran_pnpb`, `file_struk_pelunasan_pajak`, `file_pelunasan_jasa_raharja`) VALUES (:mohon_ke, :nopol, :tanggal, :nama_pemilik, :no_rangka, :no_mesin, :no_bpkb, :no_stnk, :no_hp, :stnk, :notice_pajak, :ktp, :kwitansi_jual_beli, :cek_fisik, :bpkb, :bukti_pemb, :struk_pelunasan, :pelunasan_jr);");
		$a = function($a)
		{
			$a = explode("/", $a);
			return end($a);
		};
		$exe = $st->execute(array(
				":mohon_ke" => $_POST['kirim_ke'],
				":nopol" => ($np = preg_replace("[^A-Z0-9]", "", strtoupper($_POST['nopol']))),
				":tanggal" => (date("Y-m-d H:i:s")),
				":nama_pemilik" => $_POST['nama_pemilik'],
				":no_rangka" => $_POST['no_rangka'],
				":no_mesin" => $_POST['no_mesin'],
				":no_bpkb" => $_POST['no_bpkb'],
				":no_stnk" => $_POST['no_stnk'],
				":no_hp" => $_POST['no_hp'],
				":stnk" => $a(F::gf("stnk", $u."stnk_".$np.".jpg")),
				":notice_pajak" => $a(F::gf("notice_pajak", $u."notice_pajak_".$np.".jpg")),
				":ktp" => $a(F::gf("ktp", $u."ktp_".$np.".jpg")),
				":kwitansi_jual_beli" => $a(F::gf("kwitansi_jual_beli", $u."kwitansi_jual_beli_".$np.".jpg")),
				":cek_fisik" => $a(F::gf("cek_fisik", $u."cek_fisik_".$np.".jpg")),
				":bpkb" => $a(F::gf("bpkb", $u."bpkb_".$np.".jpg")),
				":bukti_pemb" =>  $a(F::gf("bukti_pembayaran_pnbp_mutasi_keluar", $u."bukti_pembayaran_pnbp_mutasi_keluar_".$np.".jpg")),
				":struk_pelunasan" => $a(F::gf("struk_pelunasan_pajak", $u."struk_pelunasan_pajak_".$np.".jpg")),
				":pelunasan_jr" => $a(F::gf("struk_pelunasan_jr", $u."struk_pelunasan_jr_".$np.".jpg")),
			));
		if (!$exe) {
			var_dump($st->errorInfo());
			die(1);
		}
	}
}
