<?php
$uniq = $st['nopol'];
/*use System\DB;

$nopol = $uniq = base64_decode(gzinflate(base64_decode($_GET['npid'])));
$st = DB::pdo()->prepare("SELECT `a`.`nama_polres` AS `pengirim`,`nopol`,`nama_pemilik`,`no_rangka`,`no_mesin`,`no_bpkb`,`no_stnk`,`no_hp` FROM `pemohon` INNER JOIN `admin` AS `a` ON `a`.`username`=`pemohon` WHERE `nopol`=:nopol LIMIT 1;");
$exe = $st->execute(array(
		":nopol" => $nopol
	));
if (!$exe) {
	var_dump($st->errorInfo());
	die();
}
$st = $st->fetch(PDO::FETCH_ASSOC);*/
?>
<!DOCTYPE html>
<html>
<head>
<title>Balas Permohonan Mutasi</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js" ></script>
<script type="text/javascript">
	function upload(_file, file_name, sess, funger)
	{
		var bb = document.getElementById("ls");
		try{
			typeof bb.disabled;
		} catch(e) {
			var bb = {
				"disabled" : 0
			};
		}
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
					try	{
						bb.disabled = 1;
					} catch (e) {
						bb = {
							"disabled":0
						};
					}
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
		<a href="?pg=permohonan_masuk&amp;rd=<?php print urlencode(rstr(32)); ?>"><button class="btn-lg btn-primary" style="margin-top:1em;"><i class="fa fa-fw fa-chevron-left"></i> Kembali</button></a>
	</div>
	<div class="fcg">
		<form method="post" action="?pg=r2ptg&amp;post=ok&amp;nopol=<?php print urlencode($st['nopol']); ?>" class="table-responsive">
			<table class="table table-striped table-bordered table-hover table-condensed pwdtable gt">
				<thead>
					<tr class="info"><th colspan="4" align="center" id="thd" class="rk" style="padding-bottom:3%;"><center><h3>Balas Permohonan Mutasi</h3></center></th></tr>
				</thead>
				<tbody>
					<tr><td class="ia rk active">* Pengirim</td><td colspan="3" class="warning"><input type="text" size="50" value="<?php print $st['pemohon']; ?>" name="nopol" class="form-control" readonly></td></tr>
					<tr><td class="ia rk active">* Nopol</td><td colspan="3" class="warning"><input type="text" size="50" value="<?php print $st['nopol']; ?>" name="nopol" class="form-control" readonly></td></tr>
					<tr><td class="ia rk active">* Nama Pemilik</td><td colspan="3" class="warning"><input size="50" type="text" value="<?php print $st['nama_pemilik']; ?>" name="nama_pemilik" class="form-control" readonly></td></tr>
					<tr><td class="ia rk active">* No Rangka</td><td colspan="3" class="warning"><input size="50" type="text" value="<?php print $st['no_rangka']; ?>" name="no_rangka" class="form-control" readonly></td></tr>
					<tr><td class="ia rk active">* No Mesin</td><td colspan="3" class="warning"><input size="50" type="text" value="<?php print $st['no_mesin']; ?>" name="no_mesin" class="form-control" readonly></td></tr>
					<tr><td class="ia rk active">* No BPKB</td><td colspan="3" class="warning"><input size="50" type="text" value="<?php print $st['no_bpkb']; ?>" name="no_bpkb" class="form-control" readonly></td></tr>
					<tr><td class="ia rk active">* No STNK</td><td colspan="3" class="warning"><input size="50" type="text" value="<?php print $st['no_stnk']; ?>" name="no_stnk" class="form-control" readonly></td></tr>
				</tbody>
				<tbody>
					  <tr>
                        <td class="rk active">* Surat Pengantar</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'surat_pengantar_preview','surat_pengantar', 'surat_pengantar_button');" size="10" name="surat_pengantar" id="surat_pengantar_file" class="btn-warning form-control" required>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="surat_pengantar_preview"></td>
                        <td align="center" class="warning"><button id="surat_pengantar_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">* Surat Keterangan Pindah Pengganti</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'surat_keterangan_pindah_pengganti_preview','surat_keterangan_pindah_pengganti', 'surat_keterangan_pindah_pengganti_button');" size="10" name="surat_keterangan_pindah_pengganti" id="surat_keterangan_pindah_pengganti_file" class="btn-warning form-control" required>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="surat_keterangan_pindah_pengganti_preview"></td>
                        <td align="center" class="warning"><button id="surat_keterangan_pindah_pengganti_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">* Tanda Bukti Pengiriman Dokumen</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'tanda_bukti_pengiriman_dokumen_preview','tanda_bukti_pengiriman_dokumen', 'tanda_bukti_pengiriman_dokumen_button');" size="10" name="tanda_bukti_pengiriman_dokumen" id="tanda_bukti_pengiriman_dokumen_file" class="btn-warning form-control" required>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="tanda_bukti_pengiriman_dokumen_preview"></td>
                        <td align="center" class="warning"><button id="tanda_bukti_pengiriman_dokumen_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">* Daftar Kelengkapan Dokumen</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'daftar_kelengkapan_dokumen_preview','daftar_kelengkapan_dokumen', 'daftar_kelengkapan_dokumen_button');" size="10" name="daftar_kelengkapan_dokumen" id="daftar_kelengkapan_dokumen_file" class="btn-warning form-control" required>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="daftar_kelengkapan_dokumen_preview"></td>
                        <td align="center" class="warning"><button id="daftar_kelengkapan_dokumen_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">* Surat Keterangan Fiskol Antar Daerah</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'surat_keterangan_fiskol_antar_daerah_preview','surat_keterangan_fiskol_antar_daerah', 'surat_keterangan_fiskol_antar_daerah_button');" size="10" name="surat_keterangan_fiskol_antar_daerah" id="surat_keterangan_fiskol_antar_daerah_file" class="btn-warning form-control" required>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="surat_keterangan_fiskol_antar_daerah_preview"></td>
                        <td align="center" class="warning"><button id="surat_keterangan_fiskol_antar_daerah_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">* Kartu Induk BPKB</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'kartu_induk_bpkb_preview','kartu_induk_bpkb', 'kartu_induk_bpkb_button');" size="10" name="kartu_induk_bpkb" id="kartu_induk_bpkb_file" class="btn-warning form-control" required>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="kartu_induk_bpkb_preview"></td>
                        <td align="center" class="warning"><button id="kartu_induk_bpkb_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">* Faktur STNK atau Surat Pengganti STNK</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'faktur_stnk_preview','faktur_stnk', 'faktur_stnk_button');" size="10" name="faktur_stnk" id="faktur_stnk_file" class="btn-warning form-control" required>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="faktur_stnk_preview"></td>
                        <td align="center" class="warning"><button id="faktur_stnk_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">* Faktur BPKB atau Surat Pengganti BPKB</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'faktur_bpkb_preview','faktur_bpkb', 'faktur_bpkb_button');" size="10" name="faktur_bpkb" id="faktur_bpkb_file" class="btn-warning form-control" required>
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="faktur_bpkb_preview"></td>
                        <td align="center" class="warning"><button id="faktur_bpkb_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>

                    <tr>
                        <td class="rk active">Form A</td>
                        <td class="warning">
                                <input type="file" onchange="do_prev(this,'form_a_preview','form_a', 'form_a_button');" size="10" name="form_a" id="form_a_file" class="btn-warning form-control">
                        </td>
                        <td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="form_a_preview"></td>
                        <td align="center" class="warning"><button id="form_a_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
                    </tr>
				</tbody>
				<tfoot>
					<tr><td align="center" colspan="4">
						<input type="hidden" name="uniq" value="<?php print $uniq; ?>">
						<div id=sbbb class="sb">
						<div id="cc_div">
							<?php $captcha = substr(md5(rstr(32)),0,4) xor $edc = base64_encode(gzdeflate(base64_encode(gzdeflate($captcha))));?>
							<div style="margin-top:2%;">
							<img id="ccimg" style="border:2px solid #000;margin-bottom:2%;" src="?pg=captcha&amp;c=<?php print urlencode($edc); ?>&amp;hash_compare=<?php print $sh = sha1($edc); ?>">
							<p style="margin-top:-2%;"><a href="javascript:void(0);" id="cgcc">Ganti captcha</a></p>
							<input type="hidden" name="captcha_value" id="cc_val" value="<?php print $edc; ?>">
							<input type="hidden" name="captcha_hash" id="cc_hash" value="<?php print $sh; ?>">
							<p style="margin-top:-1%;"><label>Masukkan Captcha</label><br></p>
							<p style="margin-top:-1%;"><input type="text" id="cctext" name="captcha_input" maxlength="4" required></p>
							</div>
							<button class="btn-success btn-lg btn bgg" onclick="return false;" id="ccc">Lanjut</button>
						</div>
						</div>
						<script type="text/javascript">
							var cggwd = function(){
								document.getElementById("ccimg").src = "";
								var a = new XMLHttpRequest();
								a.onreadystatechange = function(){
									if (this.readyState == 4) {
										var b = "";
										try{
											b = JSON.parse(this.responseText);
										} catch(e) {
											alert("Error !");
											window.location = "";
											return false;
										}
										document.getElementById("ccimg").src = "?pg=captcha&c="+b.captcha+"&hash_compare="+b.hash_compare;
										document.getElementById("cc_val").value = b.captcha;
										document.getElementById("cc_hash").value = b.hash_compare;
										document.getElementById("cctext").value = "";
									}
								};
								a.open("GET", "?pg=captcha&request_change=" + document.getElementById("cc_hash").value);
								a.send(null);
							};
							cggwd();
							document.getElementById("cgcc").addEventListener("click", cggwd);
							document.getElementById("ccc").addEventListener("click", function(){
								var a = document.getElementsByTagName("input"),
									flag = true;
								var a = ["surat_pengantar", "surat_keterangan_pindah_pengganti", "tanda_bukti_pengiriman_dokumen", "daftar_kelengkapan_dokumen", "surat_keterangan_fiskol_antar_daerah", "kartu_induk_bpkb", "faktur_stnk", "faktur_bpkb"];
								for(x in a){
									if (document.getElementById(a[x]+"_file").value == "") {
										flag = false;
										break;
									}
								}
								if (flag) {
									document.getElementById("cctext").value;
									var a = new XMLHttpRequest();
									a.onreadystatechange = function(){
										if (this.readyState == 4) {
											var b = "";
											try{
												b = JSON.parse(this.responseText);
											} catch(e) {
												alert("Error !");
												window.location = "";
												return false;
											}
											if (b.status === true) {
												document.getElementById("sbbb").innerHTML += '<input id="ls" type="submit" name="submit" value="Submit" class="btn-success btn-lg btn bgg">';
												document.getElementById("cc_div").innerHTML = "";
											} else {
												alert("Captcha salah !");
											}
										}
									}
									a.open("GET", "?pg=captcha&compare=" + encodeURIComponent(document.getElementById("cc_val").value) + "&hash=" + document.getElementById("cc_hash").value + "&input=" + encodeURIComponent(document.getElementById("cctext").value));
									a.send(null);
								} else {
									alert("Data belum lengkap!");
								}
							});
						</script>
					</td></tr>
				</tfoot>
			</table>
			<script type="text/javascript">
var a = ["surat_pengantar", "surat_keterangan_pindah_pengganti", "tanda_bukti_pengiriman_dokumen", "daftar_kelengkapan_dokumen", "surat_keterangan_fiskol_antar_daerah", "kartu_induk_bpkb", "faktur_stnk", "faktur_bpkb", "form_a"],
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