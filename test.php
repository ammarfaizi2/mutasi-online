<?php
$a = <<<aaa
                    <tr>
                        <td class="rk active">STNK</td>
                        <td class="warning">
                            <label class="lf">
                                <input type="file" size="10" name="stnk" onchange="pw(this,'stnk_pv','bt_stnk','stnk_file');" id="stnk_file" class="btn-warning form-control" required>
                                <i class="if"></i>Choose file
                            </label>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:10%;border:1px solid black;" src="" class="img-thumbnail" id="stnk_pv"></td>
                        <td align="center" class="warning"><button id="bt_stnk" type="button" disabled class="btn-danger"><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>
aaa;
$wg = "";
foreach (array('notice_pajak', 'ktp', 'kwitansi_jual_beli', 'cek_fisik', 'bpkb', 'bukti_pembayaran_pnbp_mutasi_keluar', 'struk_pelunasan_pajak', 'struk_pelunasan_jr') as $val) {
    $wg .= str_replace("stnk", $val, $a)."\n\n";
}

file_put_contents("aaa.txt", $wg);

$a = <<<aaa
ck_file('ktp_pv','bt_ktp','ktp_file');
aaa;
$wg = "";
foreach (array('kwitansi_jual_beli', 'cek_fisik', 'bpkb', 'bukti_pembayaran_pnbp_mutasi_keluar', 'struk_pelunasan_pajak', 'struk_pelunasan_jr') as $val) {
    $wg .= str_replace("ktp", $val, $a)."\n";
}

file_put_contents("aaa.txt", $wg);