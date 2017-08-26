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
            $sess = $_POST['uniq'];
            foreach (scandir(ASSETS_DIR."/_tmp_data/ajax_upload/") as $val) {
                $a = explode("_", $val, 2);
                if ($sess == $a[0]) {
                    $b = explode(".", $a[1], -1);
                    $sr = ":file_".$b[0];
                    $wd[$sr] = $nopol."_".$a[1];
                    copy(ASSETS_DIR."/_tmp_data/ajax_upload/{$val}",  ASSETS_DIR."/users/".$wd[$sr]);
                }
            }
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

        }
    }
}
