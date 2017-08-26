<?php
use System\DB;

$nopol = $uniq = base64_decode(gzinflate(base64_decode($_GET['npid'])));
$st = DB::pdo()->prepare("SELECT `a`.`nama_polres` AS `pengirim`,`nopol`,`nama_pemilik`,`no_rangka`,`no_mesin`,`no_bpkb`,`no_stnk`,`no_hp` FROM `pemohon` INNER JOIN `admin` AS `a` ON `a`.`username`=`pemohon` WHERE `nopol`=:nopol LIMIT 1;");
$exe = $st->execute(array(
		":nopol" => $nopol
	));
if (!$exe) {
	var_dump($st->errorInfo());
	die();
}
$st = $st->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>Input Mutasi</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js" ></script>
<script type="text/javascript">
	function upload(_file, file_name, sess, funger)
	{
		var bb = document.getElementById("ls");
	    bb.disabled = 1;
		//var _file = document.getElementById(file);
		if(_file.files.length === 0){
			alert("File bermasalah");
			return 0;
		}
		var data = new FormData();
		data.append('file', _file.files[0]);
		var request = new XMLHttpRequest();
	    request.onreadystatechange = function(){
	        if(request.readyState == 4){
	            try {
	                var resp = JSON.parse(request.response);
	            } catch (e){
	                var resp = {
	                    status: 'error',
	                    data: 'Unknown error occurred: [' + request.responseText + ']'
	                };
	            }
	            resp.status = resp.status===false ? "Error" : "Success";
	            alert(resp.status + ': ' + resp.data);
	            bb.disabled = 0;
	            funger();
	        } else {
	        	bb.disabled = 1;
	        }
	    };
		request.open('POST', '?pg=upload&what=reply_mutasi&sess='+encodeURIComponent(sess)+'&file_name='+encodeURIComponent(file_name)+"&rr="+(new Date()));
		request.send(data);
	}
	function do_prev(file_instance, id_preview, save_name, button_id)
	{
		var gb = file_instance.files,
			pv = document.getElementById(id_preview),
			i  = 0;
		for(;i<gb.length;i++){
			if(gb[i].type.match(/image.*/)){
				upload(file_instance, save_name, "<?php print $uniq; ?>", function(){

				});
				pv.file = gb[i];
				var reader = new FileReader();
				reader.onload = (function(element){
					return function (e) {
						element.src = e.target.result;
					}
				})(pv);
				reader.readAsDataURL(gb[i]);
				var bt = document.getElementById(button_id);
				bt.disabled = 0;
				bt.addEventListener("click", function(){
					var bb = document.getElementById("ls");
					bb.disabled = 1;
					var a = new XMLHttpRequest();
					a.onreadystatechange = function()
					{
						if(a.readyState == 4){
							alert("Berhasil menghapus!");
							bb.disabled = 0;
						} else {
							bb.disabled = 1;
						}
					};
					a.open('GET', "?pg=upload&what=reply_mutasi_delete&sess="+encodeURIComponent("<?php print $uniq; ?>")+"&delete="+save_name);
					a.send(null);
					this.disabled = 1;
					document.getElementById(id_preview).src = "";
					file_instance.value = null;
				});
			} else {
				alert("Type file tidak sesuai!");
			}
		}
	}
</script>
<link rel="stylesheet" type="text/css" href="assets/css/input.css">
</head>
<body>
<center class="container-fluid">
	<div>
		<a href="?"><button class="btn-lg btn-primary" style="margin-top:1em;"><i class="fa fa-fw fa-chevron-left"></i> Kembali</button></a>
	</div>
	<div class="fcg">
		<form method="post" action="?pg=input_mutasi&post=ok" class="table-responsive">
			<table class="table table-striped table-bordered table-hover table-condensed pwdtable gt">
				<thead>
					<tr class="info"><th colspan="4" align="center" id="thd" class="rk" style="padding-bottom:3%;"><center><h3>Input Permohonan Mutasi</h3></center></th></tr>
				</thead>
				<tbody>
					<tr><td class="ia rk active">* Pengirim</td><td colspan="3" class="warning"><input type="text" size="50" value="<?php print $st['pengirim']; ?>" name="nopol" class="form-control" readonly></td></tr>
					<tr><td class="ia rk active">* Nopol</td><td colspan="3" class="warning"><input type="text" size="50" value="<?php print $st['nopol']; ?>" name="nopol" class="form-control" readonly></td></tr>
					<tr><td class="ia rk active">* Nama Pemilik</td><td colspan="3" class="warning"><input size="50" type="text" value="<?php print $st['nama_pemilik']; ?>" name="nama_pemilik" class="form-control" readonly></td></tr>
					<tr><td class="ia rk active">* No Rangka</td><td colspan="3" class="warning"><input size="50" type="text" value="<?php print $st['no_rangka']; ?>" name="no_rangka" class="form-control" readonly></td></tr>
					<tr><td class="ia rk active">* No Mesin</td><td colspan="3" class="warning"><input size="50" type="text" value="<?php print $st['no_mesin']; ?>" name="no_mesin" class="form-control" readonly></td></tr>
					<tr><td class="ia rk active">* No BPKB</td><td colspan="3" class="warning"><input size="50" type="text" value="<?php print $st['no_bpkb']; ?>" name="no_bpkb" class="form-control" readonly></td></tr>
					<tr><td class="ia rk active">* No STNK</td><td colspan="3" class="warning"><input size="50" type="text" value="<?php print $st['no_stnk']; ?>" name="no_stnk" class="form-control" readonly></td></tr>
					<tr><td class="ia rk active">* No HP</td><td colspan="3" class="warning"><input size="50" type="text" value="<?php print $st['no_hp']; ?>" name="no_hp" class="form-control" readonly></td></tr>
				</tbody>
				<tbody>
					<tr>
                        <td class="rk active">* STNK</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'stnk_preview','stnk', 'stnk_button');" size="10" name="stnk" id="stnk_file" class="btn-warning form-control" required>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="stnk_preview"></td>
                        <td align="center" class="warning"><button id="stnk_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>
					 <tr>
                        <td class="rk active">* Notice Pajak</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'notice_pajak_preview','notice_pajak', 'notice_pajak_button');" size="10" name="notice_pajak" id="notice_pajak_file" class="btn-warning form-control" required>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="notice_pajak_preview"></td>
                        <td align="center" class="warning"><button id="notice_pajak_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">* KTP</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'ktp_preview','ktp', 'ktp_button');" size="10" name="ktp" id="ktp_file" class="btn-warning form-control" required>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="ktp_preview"></td>
                        <td align="center" class="warning"><button id="ktp_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">* Kwitansi Jual Beli</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'kwitansi_jual_beli_preview','kwitansi_jual_beli', 'kwitansi_jual_beli_button');" size="10" name="kwitansi_jual_beli" id="kwitansi_jual_beli_file" class="btn-warning form-control" required>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="kwitansi_jual_beli_preview"></td>
                        <td align="center" class="warning"><button id="kwitansi_jual_beli_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">* Cek Fisik</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'cek_fisik_preview','cek_fisik', 'cek_fisik_button');" size="10" name="cek_fisik" id="cek_fisik_file" class="btn-warning form-control" required>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="cek_fisik_preview"></td>
                        <td align="center" class="warning"><button id="cek_fisik_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">* BPKB</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'bpkb_preview','bpkb', 'bpkb_button');" size="10" name="bpkb" id="bpkb_file" class="btn-warning form-control" required>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="bpkb_preview"></td>
                        <td align="center" class="warning"><button id="bpkb_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">* Bukti Pembayaran PNBP Mutasi Keluar</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'bukti_pembayaran_pnbp_mutasi_keluar_preview','bukti_pembayaran_pnbp_mutasi_keluar', 'bukti_pembayaran_pnbp_mutasi_keluar_button');" size="10" name="bukti_pembayaran_pnbp_mutasi_keluar" id="bukti_pembayaran_pnbp_mutasi_keluar_file" class="btn-warning form-control" required>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="bukti_pembayaran_pnbp_mutasi_keluar_preview"></td>
                        <td align="center" class="warning"><button id="bukti_pembayaran_pnbp_mutasi_keluar_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">Struk Pelunasan Pajak</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'struk_pelunasan_pajak_preview','struk_pelunasan_pajak', 'struk_pelunasan_pajak_button');" size="10" name="struk_pelunasan_pajak" id="struk_pelunasan_pajak_file" class="btn-warning form-control">
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="struk_pelunasan_pajak_preview"></td>
                        <td align="center" class="warning"><button id="struk_pelunasan_pajak_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">Struk Pelunasan Jasa Raharja</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'struk_pelunasan_jasa_raharja_preview','struk_pelunasan_jasa_raharja', 'struk_pelunasan_jasa_raharja_button');" size="10" name="struk_pelunasan_jasa_raharja" id="struk_pelunasan_jasa_raharja_file" class="btn-warning form-control">
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="struk_pelunasan_jasa_raharja_preview"></td>
                        <td align="center" class="warning"><button id="struk_pelunasan_jasa_raharja_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

				</tbody>
				<tfoot>
					<tr><td align="center" colspan="4">
						<div class="sb">
						<input type="hidden" name="uniq" value="<?php print $uniq; ?>">
						<input id="ls" type="submit" name="submit" value="Submit" class="btn-success btn-lg btn bgg">
						</div>
					</td></tr>
				</tfoot>
			</table>
			<script type="text/javascript">
var a = ["stnk","notice_pajak", "ktp", "kwitansi_jual_beli", "cek_fisik", "bpkb", "bukti_pembayaran_pnbp_mutasi_keluar", "struk_pelunasan_pajak", "struk_pelunasan_jasa_raharja"],
			b = [];
		for(x in a) {
			b[a[x]] = document.getElementById(a[x]+"_file");
			b[a[x]].value = "";
		}
</script>
		</form>
	</div>
</center>
</body>
</html>