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
        if (!isset($_POST['kirim_ke'], $_POST['nopol'], $_POST['nama_pemilik'], $_POST['no_rangka'], $_POST['no_mesin'], $_POST['no_bpkb'], $_POST['no_stnk'], $_POST['no_hp'], $_POST['uniq'])){
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title></title>
                <script type="text/javascript">
                    alert("Data tidak lengkap !");
                </script>
            </head>
            <body>
            
            </body>
            </html>
            <?php
            die(1);
        } else {
            $nopol = strtoupper(preg_replace("#[^A-Za-z0-9]#", "", $_POST['nopol']));
            $st = DB::pdo()->prepare("SELECT COUNT(`nopol`) FROM `pemohon` WHERE `nopol`=:nopol AND `memohon_ke`=:ke LIMIT 1;");
            $exe = $st->execute(array(
                    ":nopol" => $nopol,
                    ":ke" => $_POST['kirim_ke']
                ));
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
                    <title>Gagal mengirim permohonan mutasi!</title>
                    <style type="text/css">
                        h2 {
                            font-family: Helvetica;
                        }
                    </style>
                </head>
                <body>
                <h2>Permohonan mutasi dengan nopol <?php print $nopol; ?> ke <?php print $_POST['kirim_ke']; ?> sedang dalam proses, harap tunggu hingga proses mutasi selesai!</h2>
                <a href="?rf=<?php print urlencode(rstr(32)); ?>"><button>Kembali</button></a>
                </body>
                </html>
                <?php
                die();
            }
            $sess = $_POST['uniq'] xor $arc = "";
            foreach (scandir(ASSETS_DIR."/_tmp_data/ajax_upload/") as $val) {
                $a = explode("_", $val, 2);
                if ($sess == $a[0]) {
                    $b = explode(".", $a[1], -1);
                    $sr = ":file_".$b[0];
                    $wd[$sr] = $nopol."_".$a[1];
                    rename(ASSETS_DIR."/_tmp_data/ajax_upload/{$val}",  ASSETS_DIR."/users/".$wd[$sr]);
                    $arc .= ASSETS_DIR."/users/".$wd[$sr].",";
                }
            }
            $arc = trim($arc, ",");
            $st = DB::pdo()->prepare("INSERT INTO `pemohon` (`pemohon`, `memohon_ke`, `nopol`, `tanggal`, `nama_pemilik`, `no_rangka`, `no_mesin`, `no_bpkb`, `no_stnk`, `no_hp`, `file_stnk`, `file_notice_pajak`, `file_ktp`, `file_kwitansi_jual_beli`, `file_cek_fisik`, `file_bpkb`, `file_bukti_pembayaran_pnpb`, `file_struk_pelunasan_pajak`, `file_pelunasan_jasa_raharja`, `status`) VALUES (:pemohon, :memohon_ke, :nopol, :tanggal, :nama_pemilik, :no_rangka, :no_mesin, :no_bpkb, :no_stnk, :no_hp, :file_stnk, :file_notice_pajak, :file_ktp, :file_kwitansi_jual_beli, :file_cek_fisik, :file_bpkb, :file_bukti_pembayaran_pnbp_mutasi_keluar, :file_struk_pelunasan_pajak, :file_struk_pelunasan_jasa_raharja, 'sedang proses');");
            $data = array(
                    ":pemohon" => $_COOKIE['user'],
                    ":memohon_ke" => $_POST['kirim_ke'],
                    ":nopol" => $nopol,
                    ":tanggal" => (date('Y-m-d H:i:s')),
                    ":nama_pemilik" => $_POST['nama_pemilik'],
                    ":no_rangka" => $_POST['no_rangka'],
                    ":no_mesin" => $_POST['no_mesin'],
                    ":no_bpkb" => $_POST['no_bpkb'],
                    ":no_stnk" => $_POST['no_stnk'],
                    ":no_hp" => $_POST['no_hp']
                );
            $data = array_merge($data, $wd);
            if (!isset($data['file_struk_pelunasan_pajak'])) {
                $data['file_struk_pelunasan_pajak'] = null;
            }
            if (!isset($data['file_struk_pelunasan_jasa_raharja'])) {
                $data['file_struk_pelunasan_jasa_raharja'] = null;
            }
            $exe = $st->execute($data);
            if (!$exe) {
                var_dump($st->errorInfo());
                die(1);
            }
            $archive = new PClZip(ASSETS_DIR."/zip/{$nopol}.zip");
            $v_list = $archive->create($arc, PCLZIP_OPT_REMOVE_PATH, realpath(ASSETS_DIR."/users/"));
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Sukses</title>
                <script type="text/javascript">
                    alert("Berhasil mengirim permohonan mutasi!");
                    window.location = "?rd=<?php print rstr(32); ?>";
                </script>
            </head>
            <body>
            
            </body>
            </html>
            <?php
        }
    }
}
