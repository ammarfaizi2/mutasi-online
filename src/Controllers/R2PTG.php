<?php

namespace Controllers;

use PDO;
use System\DB;
use Handler\PCLZip;
use Models\R2PTGModelCrr as RRG;

class R2PTG
{
	public static function run()
	{
		if (isset($_POST['submit'])) {
			self::submit();
			die();
		}
		if (isset($_GET['npid'])) {
			$q = base64_decode(@gzinflate(base64_decode($_GET['npid'])));
			if (($dt = RRG::check_rt($q)) != "sudah" and $dt !== false) {
				view("r2ptg/_index", array("st" => $dt));
			} else {
				if ($dt===false){
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

	private static function submit()
	{
		$st = DB::pdo()->prepare("INSERT INTO `balasan` (`nopol`, `surat_pengantar`, `surat_keterangan_pindah_pengganti`, `tanda_bukti_pengiriman_dokumen`, `daftar_kelengkapan_dokumen`, `surat_keterangan_fiskol_antar_daerah`, `kartu_induk_bpkb`, `faktur_stnk`, `faktur_bpkb`, `form_a`, `created_at`) VALUES (:nopol, :surat_pengantar, :surat_keterangan_pindah_pengganti, :tanda_bukti_pengiriman_dokumen, :daftar_kelengkapan_dokumen, :surat_keterangan_fiskol_antar_daerah, :kartu_induk_bpkb, :faktur_stnk, :faktur_bpkb, :form_a, :created_at);");
		
		$nopol = $_GET['nopol'] xor $arc = "";
		foreach (scandir(ASSETS_DIR."/_tmp_data/ajax_upload/") as $val) {
			$a = explode("_", $val, 2);
			if ($a[0] == $nopol) {
				$b = explode(".", $a[1], -1);
				$wqdata[":".$b[0]] = $val;
				rename(ASSETS_DIR."/_tmp_data/ajax_upload/{$val}", ASSETS_DIR."/users/{$val}");
				$arc .= ASSETS_DIR."/users/{$val},";
			}
		}
		$arc = trim($arc, ",");
		$data = array(
				":nopol" => $_GET['nopol'],
				":created_at" => (date("Y-m-d H:i:s"))
			);
		$data = array_merge($wqdata, $data);
		if (!isset($data[':form_a'])) {
			$data[':form_a'] = null;
		}
		$exe = $st->execute($data);
		if (!$exe) {
			var_dump($st->errorInfo());
			die(1);
		}
		$st = DB::pdo()->prepare("UPDATE `pemohon` SET `status`='selesai' WHERE `nopol`=:nopol AND `memohon_ke`=:memohon_ke LIMIT 1;");
		$exe = $st->execute(array(
				":nopol" => $nopol,
				":memohon_ke" => $_COOKIE['user']
			));
		if (!$exe) {
			var_dump($st->errorInfo());
			die(1);
		}
		$archive = new PClZip(ASSETS_DIR."/zip/{$nopol}_balasan.zip");
		$v_list = $archive->create($arc, PCLZIP_OPT_REMOVE_PATH, realpath(ASSETS_DIR."/users/"));
		?>
		<!DOCTYPE html>
		<html>
		<head>
			<title>Berhasil</title>
			<script type="text/javascript">
				alert("Berhasil mengirim balasan!");
				window.location = "?ref=<?php print urlencode(rstr(32)); ?>";
			</script>
		</head>
		<body>		
		</body>
		</html>
		<?php
	}
}







