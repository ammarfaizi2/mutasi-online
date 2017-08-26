<?php







$arr = ["surat_pengantar", "surat_keterangan_pindah_pengganti", "tanda_bukti_pengiriman_dokumen", "daftar_kelengkapan_dokumen", "surat_keterangan_fiskol_antar_daerah", "kartu_induk_bpkb", "faktur_stnk", "faktur_bpkb", "form_a"];
foreach ($arr as $val) 

$w = str_replace("_", " ", $val) xor print '                    <tr>
                        <td class="rk active">* '.ucwords($w).'</td>
                        <td class="warning">
                                <input type="file" '."onchange=\"do_prev(this,'{$val}_preview','{$val}', '{$val}_button');\"".' size="10" name="'.$val.'" id="'.$val.'_file" class="btn-warning form-control" req>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="'.$val.'_preview"></td>
                        <td align="center" class="warning"><button id="'.$val.'_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

';

