<?php
use System\DB;
$st = DB::pdo()->prepare("SELECT `username`,`nama_polres` FROM `admin` WHERE `username`!=:user  ORDER BY `nama_polres` LIMIT 35;");
$exe = $st->execute(array(
		":user" => strtolower($_COOKIE['user'])
	));
if (!$exe) {
	var_dump($st->errorInfo());
	die(1);
} else {
	$st = $st->fetchAll(\PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Input Mutasi</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<script type="text/javascript" src="assets/js/bootstrap.min.js" ></script>
<script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	(function(){
		console.log(JSON.stringify({"aaa":123}));
	})();
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
		ck_file('kwitansi_jual_beli_pv','bt_kwitansi_jual_beli','kwitansi_jual_beli_file');
		ck_file('cek_fisik_pv','bt_cek_fisik','cek_fisik_file');
		ck_file('bpkb_pv','bt_bpkb','bpkb_file');
		ck_file('bukti_pembayaran_pnbp_mutasi_keluar_pv','bt_bukti_pembayaran_pnbp_mutasi_keluar','bukti_pembayaran_pnbp_mutasi_keluar_file');
		ck_file('struk_pelunasan_pajak_pv','bt_struk_pelunasan_pajak','struk_pelunasan_pajak_file');
		ck_file('struk_pelunasan_jr_pv','bt_struk_pelunasan_jr','struk_pelunasan_jr_file');
	}
</script>
<style type="text/css">
	body {
		font-family: Tahoma, Arial;
		background-color: #D26C6C;
	}
	.fcg{
		margin-top:3%;
		margin-bottom: 10%;
		border-radius: 2%;
	}
	.ia{
		width:30%;
	}
	.ii{
		
	}
	.pvw {
		width: 30px;
		height: 30px;
	}
	th, td {
		 /* background-color: #fff;
    	border: 2px solid black;  */
	}
	input[type="file"] {
    	margin-top:0%;
    	padding-bottom: 12.5%;
    	cursor: pointer;
	}
	tr {
		background-color: #fff;
	}
    .container-fluid {
        width: 50%;
    }
    .container-fluid form .rk{
        text-align: left;
        padding-left: 1em;
    }
	.img-thumbnail {
		width: 30px;
		height: 30px;
	}
	.lf {
		border: 1px solid #ccc;
    	display: inline-block;
    	padding: 10px 14px;
    	cursor: pointer;
	}
	.dlbt {
		padding-top: 15%;
		padding-bottom: 15%;
	}
	i {
		
	}
	.bgg {
		padding-right: 10%;
		padding-left: 10%;
	}
	.pwdtable {
		border: 4px solid #CECECE;
		border-radius: 30px;
	}
	.gt {
		border: 5px solid black;
	}
</style>
</head>
<body>
<center class="container-fluid">
	<div>
		<a href="?"><button class="btn-lg btn-primary" style="margin-top:1em;"><i class="fa fa-fw fa-chevron-left"></i> Kembali</button></a>
	</div>
	<div class="fcg">
		<form method="post" action="?pg=input_mutasi&post=ok" enctype="multipart/form-data" class="table-responsive">
			<table class="table table-striped table-bordered table-hover table-condensed pwdtable gt">
				<thead>
					<tr class="info"><th colspan="4" align="center" id="thd" class="rk" style="padding-bottom:3%;"><center><h3>Input Permohonan Mutasi</h3></center></th></tr>
				</thead>
				<tbody>
					<tr>
					<td>&nbsp;&nbsp;* Kirim ke </td>
					<td colspan="3">
						<select name="kirim_ke" req>
						<option></option>
						<?php
						foreach ($st as $val) {
							?><option value="<?php print $val['username']; ?>"><?php print $val['nama_polres']; ?></option><?php
						}
						?>
						</select></td>
					</tr>
					<tr><td class="ia rk active">* Nopol</td><td colspan="3" class="warning"><input type="text" size="50" placeholder="Nopol" name="nopol" class="form-control" req></td></tr>
					<tr><td class="ia rk active">* Nama Pemilik</td><td colspan="3" class="warning"><input size="50" type="text" placeholder="Nama Pemilik" name="nama_pemilik" class="form-control" req></td></tr>
					<tr><td class="ia rk active">* No Rangka</td><td colspan="3" class="warning"><input size="50" type="text" placeholder="No Rangka" name="no_rangka" class="form-control" req></td></tr>
					<tr><td class="ia rk active">* No Mesin</td><td colspan="3" class="warning"><input size="50" type="text" placeholder="No Mesin" name="no_mesin" class="form-control" req></td></tr>
					<tr><td class="ia rk active">* No BPKB</td><td colspan="3" class="warning"><input size="50" type="text" placeholder="No BPKB" name="no_bpkb" class="form-control" req></td></tr>
					<tr><td class="ia rk active">* No STNK</td><td colspan="3" class="warning"><input size="50" type="text" placeholder="No STNK" name="no_stnk" class="form-control" req></td></tr>
					<tr><td class="ia rk active">* No HP</td><td colspan="3" class="warning"><input size="50" type="text" placeholder="No HP" name="no_hp" class="form-control" req></td></tr>
				</tbody>
				<tbody>
					<tr>
						<td class="rk active">* STNK</td>
						<td class="warning">
								<input type="file" size="10" name="stnk" onchange="pw(this,'stnk_pv','bt_stnk','stnk_file');" id="stnk_file" class="btn-warning form-control" req>
						</td>
						<td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="stnk_pv"></td>
						<td align="center" class="warning"><button id="bt_stnk" type="button" disabled class="dlbt"><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
					</tr>
					
					<tr>
                        <td class="rk active">* Notice Pajak</td>
                        <td class="warning">
                                <input type="file" size="10" name="notice_pajak" onchange="pw(this,'notice_pajak_pv','bt_notice_pajak','notice_pajak_file');" id="notice_pajak_file" class="btn-warning form-control" req>

                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="notice_pajak_pv"></td>
                        <td align="center" class="warning"><button id="bt_notice_pajak" type="button" disabled class="dlbt"><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">* KTP</td>
                        <td class="warning">
                                <input type="file" size="10" name="ktp" onchange="pw(this,'ktp_pv','bt_ktp','ktp_file');" id="ktp_file" class="btn-warning form-control" req>

                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="ktp_pv"></td>
                        <td align="center" class="warning"><button value="Hapus" id="bt_ktp" type="button" disabled class="dlbt"><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">* Kwitansi Jual Beli</td>
                        <td class="warning">
                                <input type="file" size="10" name="kwitansi_jual_beli" onchange="pw(this,'kwitansi_jual_beli_pv','bt_kwitansi_jual_beli','kwitansi_jual_beli_file');" id="kwitansi_jual_beli_file" class="btn-warning form-control" req>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="kwitansi_jual_beli_pv"></td>
                        <td align="center" class="warning"><button id="bt_kwitansi_jual_beli" type="button" disabled class="dlbt"><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">* Cek Fisik</td>
                        <td class="warning">
                                <input type="file" size="10" name="cek_fisik" onchange="pw(this,'cek_fisik_pv','bt_cek_fisik','cek_fisik_file');" id="cek_fisik_file" class="btn-warning form-control" req>

                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="cek_fisik_pv"></td>
                        <td align="center" class="warning"><button id="bt_cek_fisik" type="button" disabled class="dlbt"><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">* BPKB</td>
                        <td class="warning">
                                <input type="file" size="10" name="bpkb" onchange="pw(this,'bpkb_pv','bt_bpkb','bpkb_file');" id="bpkb_file" class="btn-warning form-control" req>

                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="bpkb_pv"></td>
                        <td align="center" class="warning"><button id="bt_bpkb" type="button" disabled class="dlbt"><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">* Bukti Pembayaran PNBP Mutasi Keluar</td>
                        <td class="warning">
                                <input type="file" size="10" name="bukti_pembayaran_pnbp_mutasi_keluar" onchange="pw(this,'bukti_pembayaran_pnbp_mutasi_keluar_pv','bt_bukti_pembayaran_pnbp_mutasi_keluar','bukti_pembayaran_pnbp_mutasi_keluar_file');" id="bukti_pembayaran_pnbp_mutasi_keluar_file" class="btn-warning form-control" req>

                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="bukti_pembayaran_pnbp_mutasi_keluar_pv"></td>
                        <td align="center" class="warning"><button id="bt_bukti_pembayaran_pnbp_mutasi_keluar" type="button" disabled class="dlbt"><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">Struk Pelunasan Pajak</td>
                        <td class="warning">
                                <input type="file" size="10" name="struk_pelunasan_pajak" onchange="pw(this,'struk_pelunasan_pajak_pv','bt_struk_pelunasan_pajak','struk_pelunasan_pajak_file');" id="struk_pelunasan_pajak_file" class="btn-warning form-control">

                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="struk_pelunasan_pajak_pv"></td>
                        <td align="center" class="warning"><button id="bt_struk_pelunasan_pajak" type="button" disabled class="dlbt"><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">Struk Pelunasan Jasa Raharja</td>
                        <td class="warning">
                                <input type="file" size="10" name="struk_pelunasan_jr" onchange="pw(this,'struk_pelunasan_jr_pv','bt_struk_pelunasan_jr','struk_pelunasan_jr_file');" id="struk_pelunasan_jr_file" class="btn-warning form-control">

                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="struk_pelunasan_jr_pv"></td>
                        <td align="center" class="warning"><button id="bt_struk_pelunasan_jr" type="button" disabled class="dlbt"><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>
				</tbody>
				<tfoot>
					<tr><td align="center" colspan="4">
						<div class="sb">
						<input type="submit" name="submit" value="Submit" class="btn-success btn-lg btn bgg">
						</div>
					</td></tr>
				</tfoot>
			</table>
		</form>
	</div>
</center>
</body>
</html>