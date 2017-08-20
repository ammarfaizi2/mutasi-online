<!DOCTYPE html>
<html>
<head>
<title>Input Mutasi</title>
<script type="text/javascript">
	function pw(gambar,idpreview, bt, fb){
        var gb = gambar.files;
        var bt = document.getElementById(bt);
        for (var i = 0; i < gb.length; i++){
            var gbPreview = gb[i];
            var imageType = /image.*/;
            var preview = document.getElementById(idpreview);            
            var reader  = new FileReader();
            if (gbPreview.type.match(imageType)) {
                preview.file = gbPreview;
                reader.onload = (function(element) {
                    return function(e) {
                        element.src = e.target.result;
                    };
                })(preview);
                reader.readAsDataURL(gbPreview);
                bt.disabled = false;
		        bt.addEventListener("click", function(){
		        	var a = document.getElementById(fb);
		        	a.value = "";
		        	bt.disabled = 1;
		        	document.getElementById(idpreview).src = "";
		        });
            }else{
                alert("Type file tidak sesuai!");
                gambar.value = "";
                bt.disabled = true;
            }
        }
    }
    function ck_file(pv, button, id_wg){
		if (document.getElementById(id_wg).value != "") {
			pw(document.getElementById(id_wg), pv, button, id_wg);
		} else {
			"have_done";
		}
	}
	window.onload = function(){
		ck_file('stnk_pv','bt_stnk','stnk_file');
		ck_file('notice_pajak_pv','bt_notice_pajak','notice_pajak_file');
		ck_file('ktp_pv','bt_ktp','ktp_file');
	}
</script>
<style type="text/css">
	body {
		font-family: Tahoma, Arial;
	}
	.fcg{
		margin-top:3%;
	}
	table {
		border: 2px solid black;
		padding: 3px 3px 3px 3px;
		background-color: #7EF1BB;
		border-collapse: collapse;
	}
	#thd {
		padding-left:3%;
		padding-right:3%;
	}
	.ia{
		width:30%;
	}
	.ii{
		
	}
	.sb{
		margin-top: 3%;
		margin-bottom: 3%;
	}
	.pvw {
		width: 30px;
		height: 30px;
	}
	th, td {
		background-color: #fff;
    	border: 2px solid black;
	}
	tr {
		background-color: #fff;
	}
	#sbid {
		background-color: #57E66A;
		padding: 5px 10px 5px 10px;
	}
</style>
</head>
<body>
<center>
	<div>
		<a href="?"><button>Kembali</button></a>
	</div>
	<div class="fcg">
		<form method="post" action="" enctype="multipart/form-data">
			<table>
				<thead>
					<tr><th colspan="4" id="thd"><h3>Input Mutasi</h3></th></tr>
				</thead>
				<tbody>
					<tr><td class="ia">* Nopol</td><td colspan="3"><input type="text" size="50" placeholder="Nopol" name="nopol" required></td></tr>
					<tr><td class="ia">* Nama Pemilik</td><td colspan="3"><input size="50" type="text" placeholder="Nama Pemilik" name="nama_pemilik" required></td></tr>
					<tr><td class="ia">* No Rangka</td><td colspan="3"><input size="50" type="text" placeholder="No Rangka" name="no_rangka" required></td></tr>
					<tr><td class="ia">* No Mesin</td><td colspan="3"><input size="50" type="text" placeholder="No Mesin" name="no_mesin" required></td></tr>
					<tr><td class="ia">* No BPKB</td><td colspan="3"><input size="50" type="text" placeholder="No BPKB" name="no_bpkb" required></td></tr>
					<tr><td class="ia">* No STNK</td><td colspan="3"><input size="50" type="text" placeholder="No STNK" name="no_stnk" required></td></tr>
					<tr><td class="ia">* No HP</td><td colspan="3"><input size="50" type="text" placeholder="No HP" name="no_hp" required></td></tr>
				</tbody>
				<tbody>
					<tr>
						<td>* STNK</td>
						<td><input type="file" size="10" name="stnk" onchange="pw(this,'stnk_pv','bt_stnk','stnk_file');" id="stnk_file" required></td>
						<td align="center"><img style="margin-top:10%;border:1px solid black;" src="" class="pvw" id="stnk_pv"></td>
						<td align="center"><button id="bt_stnk" type="button" disabled>Hapus</button></td>
					</tr>
					<tr>
						<td>* Notice Pajak</td>
						<td><input type="file" name="notice_pajak" onchange="pw(this,'notice_pajak_pv','bt_notice_pajak','notice_pajak_file');" id="notice_pajak_file" required></td>
						<td align="center"><img style="margin-top:10%;border:1px solid black;" src="" class="pvw" id="notice_pajak_pv"></td>
						<td align="center"><button id="bt_notice_pajak" type="button" disabled>Hapus</button></td>
					</tr>
					<tr>
						<td>* KTP</td>
						<td><input type="file" name="ktp" onchange="pw(this,'ktp_pv','bt_ktp','ktp_file');" id="ktp_file" required></td>
						<td align="center"><img style="margin-top:10%;border:1px solid black;" src="" class="pvw" id="ktp_pv"></td>
						<td align="center"><button id="bt_ktp" type="button" disabled>Hapus</button></td>
					</tr>
					<tr>
						<td>* Kwitansi Jual Beli</td>
						<td><input type="file" name="kwitansi_jual_beli" onchange="pw(this,'kwitansi_jual_beli_pv','bt_kwitansi_jual_beli','kwitansi_jual_beli_file');" id="kwitansi_jual_beli_file" required></td>
						<td align="center"><img style="margin-top:10%;border:1px solid black;" src="" class="pvw" id="kwitansi_jual_beli_pv"></td>
						<td align="center"><button id="bt_kwitansi_jual_beli" type="button" disabled>Hapus</button></td>
					</tr>
					<tr>
						<td>* Cek Fisik</td>
						<td><input type="file" name="cek_fisik" onchange="pw(this,'cek_fisik_pv','bt_cek_fisik','cek_fisik_file');" id="cek_fisik_file" required></td>
						<td align="center"><img style="margin-top:10%;border:1px solid black;" src="" class="pvw" id="cek_fisik_pv"></td>
						<td align="center"><button id="bt_cek_fisik" type="button" disabled>Hapus</button></td>
					</tr>
					<tr>
						<td>* BPKB</td>
						<td><input type="file" name="bpkb" onchange="pw(this,'bpkb_pv','bt_bpkb','bpkb_file');" id="bpkb_file" required></td>
						<td align="center"><img style="margin-top:10%;border:1px solid black;" src="" class="pvw" id="bpkb_pv"></td>
						<td align="center"><button id="bt_bpkb" type="button" disabled>Hapus</button></td>
					</tr>
					<tr>
						<td style="width: 43%;">* Bukti Pembayaran PNPB Mutasi Keluar</td>
						<td><input type="file" name="bukti_pembayaran_pnbp_mutasi_keluar" onchange="pw(this,'bukti_pembayaran_pnbp_mutasi_keluar_pv','bt_bukti_pembayaran_pnbp_mutasi_keluar','bukti_pembayaran_pnbp_mutasi_keluar_file');" id="bukti_pembayaran_pnbp_mutasi_keluar_file" required></td>
						<td align="center"><img style="margin-top:10%;border:1px solid black;" src="" class="pvw" id="bukti_pembayaran_pnbp_mutasi_keluar_pv"></td>
						<td align="center"><button id="bt_bukti_pembayaran_pnbp_mutasi_keluar" type="button" disabled>Hapus</button></td>
					</tr>
					<tr>
						<td>* Struk Pelunasan Pajak</td>
						<td><input type="file" size="10" name="struk_pelunasan_pajak" onchange="pw(this,'struk_pelunasan_pajak_pv','bt_struk_pelunasan_pajak','struk_pelunasan_pajak_file');" id="struk_pelunasan_pajak_file" required></td>
						<td align="center"><img style="margin-top:10%;border:1px solid black;" src="" class="pvw" id="struk_pelunasan_pajak_pv"></td>
						<td align="center"><button id="bt_struk_pelunasan_pajak" type="button" disabled>Hapus</button></td>
					</tr>
					<tr>
						<td>* Struk Pelunasan Jasa Raharja</td>
						<td><input type="file" size="10" name="struk_pelunasan_jr" onchange="pw(this,'struk_pelunasan_jr_pv','bt_struk_pelunasan_jr','struk_pelunasan_jr_file');" id="struk_pelunasan_jr_file" required></td>
						<td align="center"><img style="margin-top:10%;border:1px solid black;" src="" class="pvw" id="struk_pelunasan_jr_pv"></td>
						<td align="center"><button id="bt_struk_pelunasan_jr" type="button" disabled>Hapus</button></td>
					</tr>
				</tbody>
				<tfoot>
					<tr><td align="center" colspan="4">
						<div class="sb">
						<input id="sbid" type="submit" name="submit" value="Submit">
						</div>
					</td></tr>
				</tfoot>
			</table>
		</form>
	</div>
</center>
</body>
</html>