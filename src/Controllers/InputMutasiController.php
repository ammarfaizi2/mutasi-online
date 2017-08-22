<?php

namespace Controllers;

use PDO;
use System\DB;
use Handler\PCLZip;
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
        $st = DB::pdo()->prepare("SELECT COUNT(*) FROM `pemohon` WHERE `nopol`=:nopol AND `status`='sedang proses' LIMIT 1;");
        $exe = $st->execute(
            array(
                ":nopol" => ($np = preg_replace("#[^A-Z0-9\s]#", "", strtoupper($_POST['nopol'])))
            )
        );
        if (!$exe) {
            var_dump($st->errorInfo());
            die(1);
        }
        $st = $st->fetch(PDO::FETCH_NUM);
        if ($st[0] > 0) {
            ?>
			<!DOCTYPE html>
			<html>
			<head>
                <link rel="stylesheet" href="assets/css/bootstrap.min.css">
                <link rel="stylesheet" href="assets/css/font-awesome.min.css">
                <script type="text/javascript" src="assets/js/bootstrap.min.js" ></script>
                <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
				<title>Gagal</title>
				<style type="text/css">
					body {
						font-family: Tahoma, Helvetica, Arial;
					}
				</style>
			</head>
			<body>
			<center>
                <div>
                    <a href="?"><button class="btn-lg btn-primary" style="margin-top:1em;"><i class="fa fa-fw fa-chevron-left"></i> Kembali</button></a>
                </div>
				<h1>Gagal melakukan permohonan mutasi!</h1>
				<h2>Nopol <?php print $np; ?> sedang dalam proses permohonan mutasi.</h2>
			</center>
			</body>
			</html>
    <?php
            die(1);
        }
        $u = BASEPATH."/assets/users/";
        $st = DB::pdo()->prepare("INSERT INTO `pemohon` (`pemohon`,`memohon_ke`, `nopol`, `tanggal`, `nama_pemilik`, `no_rangka`, `no_mesin`, `no_bpkb`, `no_stnk`, `no_hp`, `file_stnk`, `file_notice_pajak`, `file_ktp`, `file_kwitansi_jual_beli`, `file_cek_fisik`, `file_bpkb`, `file_bukti_pembayaran_pnpb`, `file_struk_pelunasan_pajak`, `file_pelunasan_jasa_raharja`,`status`) VALUES (:pemohon,:mohon_ke, :nopol, :tanggal, :nama_pemilik, :no_rangka, :no_mesin, :no_bpkb, :no_stnk, :no_hp, :stnk, :notice_pajak, :ktp, :kwitansi_jual_beli, :cek_fisik, :bpkb, :bukti_pemb, :struk_pelunasan, :pelunasan_jr, 'sedang proses');");
        $a = function ($a) {
            $a = explode("/", $a);
            return end($a);
        };
        $handler = time();
        $exe = $st->execute(
            array(
                ":pemohon" => strtolower($_COOKIE['user']),
                ":mohon_ke" => $_POST['kirim_ke'],
                ":nopol" => $np,
                ":tanggal" => (date("Y-m-d H:i:s")),
                ":nama_pemilik" => $_POST['nama_pemilik'],
                ":no_rangka" => $_POST['no_rangka'],
                ":no_mesin" => $_POST['no_mesin'],
                ":no_bpkb" => $_POST['no_bpkb'],
                ":no_stnk" => $_POST['no_stnk'],
                ":no_hp" => $_POST['no_hp'],
                ":stnk" => $a(F::gf("stnk", $u."stnk_".$np.".jpg", $handler)),
                ":notice_pajak" => $a(F::gf("notice_pajak", $u."notice_pajak_".$np.".jpg", $handler)),
                ":ktp" => $a(F::gf("ktp", $u."ktp_".$np.".jpg", $handler)),
                ":kwitansi_jual_beli" => $a(F::gf("kwitansi_jual_beli", $u."kwitansi_jual_beli_".$np.".jpg", $handler)),
                ":cek_fisik" => $a(F::gf("cek_fisik", $u."cek_fisik_".$np.".jpg", $handler)),
                ":bpkb" => $a(F::gf("bpkb", $u."bpkb_".$np.".jpg", $handler)),
                ":bukti_pemb" =>  $a(F::gf("bukti_pembayaran_pnbp_mutasi_keluar", $u."bukti_pembayaran_pnbp_mutasi_keluar_".$np.".jpg", $handler)),
                ":struk_pelunasan" => $a(F::gf("struk_pelunasan_pajak", $u."struk_pelunasan_pajak_".$np.".jpg", $handler)),
                ":pelunasan_jr" => $a(F::gf("struk_pelunasan_jr", $u."struk_pelunasan_jr_".$np.".jpg", $handler)),
            )
        );
        if (!$exe) {
            var_dump($st->errorInfo());
            die(1);
        } else {
            $archive = new PCLZip(ASSETS_DIR."/zip/{$np}.zip");
            $v_list = $archive->create(ASSETS_DIR."/_tmp_data/{$handler}", PCLZIP_OPT_REMOVE_PATH, realpath(ASSETS_DIR."/_tmp_data/{$handler}"));
            $a = scandir(ASSETS_DIR."/_tmp_data/{$handler}");
            unset($a[0], $a[1]);
            foreach ($a as $val) {
                unlink(ASSETS_DIR."/_tmp_data/{$handler}/".$val);
            }
            rmdir(ASSETS_DIR."/_tmp_data/{$handler}");
            $st = DB::pdo()->prepare("SELECT `nama_polres` FROM `admin` WHERE `username`=:user LIMIT 1;");
            $exe = $st->execute(
                array(
                    ":user" => strtolower($_POST['kirim_ke'])
                )
            );
            if (!$exe) {
                var_dump($st->errorInfo());
                die(1);
            }
            if (!($a = $st->fetch(PDO::FETCH_NUM))) {
                echo "Database bermasalah atau input telah dimanipulasi !";
                die(1);
            } ?>
			<!DOCTYPE html>
			<html>
			<head>
				<title>Sukses</title>
				<style type="text/css">
					body {
						font-family: Tahoma, Helvetica, Arial;
					}
				</style>
                <link rel="stylesheet" href="assets/css/bootstrap.min.css">
                <link rel="stylesheet" href="assets/css/font-awesome.min.css">
                <script type="text/javascript" src="assets/js/bootstrap.min.js" ></script>
                <script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
			</head>
			<body>
			<center>
                <div>
                    <a href="?"><button class="btn-lg btn-primary" style="margin-top:1em;"><i class="fa fa-fw fa-chevron-left"></i> Kembali</button></a>
                </div>
				<div>
					<h2>Berhasil mengirim permohonan ke Polres <?php print $a[0]; ?></h2>
					<h3>Nopol <?php print $np; ?></h3>
				</div>
			</center>
			</body>
			</html>
    <?php

        }
    }
}
