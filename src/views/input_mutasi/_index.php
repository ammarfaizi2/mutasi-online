<?php
use System\DB;
$st = DB::pdo()->prepare("SELECT `username`,`nama_polres` FROM `admin` WHERE `username`!=:user  ORDER BY `nama_polres` LIMIT 35;");
$exe = $st->execute(
    array(
        ":user" => strtolower($_COOKIE['user'])
    )
);
if (!$exe) {
    var_dump($st->errorInfo());
    die(1);
} else {
    $st = $st->fetchAll(\PDO::FETCH_ASSOC);
}
$uniq = time();
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
	function upload(_file, se_file)
	{
		//var _file = document.getElementById(file);
		if(_file.files.length === 0){
			alert("File bermasalah");
			return 0;
		}
		var data = new FormData();
		data.append(se_file, _file.files[0]);
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
	            console.log(resp.status + ': ' + resp.data);
	        }
	    };
	    request.upload.addEventListener('progress', function(e){
	        
	    }, false);
		request.open('POST', '?pg=upload&what=input_mutasi');
		request.send(data);
	}
	function do_prev(file_instance, id_preview, save_name)
	{
		var gb = file_instance.files,
			pv = document.getElementById(id_preview),
			i  = 0;
		for(;i<gb.length;i++){
			var reader = new FileReader();
			if(gb[i].type.match(/image.*/)){
				pv.file = gb[i];
				reader.onload = (function(element){
					return function (e) {
						element.src = e.target.result;
					}
				})(pv);
				reader.readAsDataURL(gb[i]);
				upload(file_instance, save_name);
			} else {
				alert("Type file tidak sesuai!");
			}
		}
	}
	window.onload = function()
	{
		var a = ["stnk"],
		    b = null;
		for(x in a) {
			b = document.getElementById(a[x]+"_file");
			b.addEventListener("change", function(){
				do_prev(b, a[x]+"_preview", a[x]+"_file", a[x]+"_from_<?php print $uniq; ?>");
			});
		}
	};
</script>
<link rel="stylesheet" type="text/css" href="assets/css/input.css">
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
						<select name="kirim_ke" required>
						<option></option>
        <?php
        foreach ($st as $val) {
            ?><option value="<?php print $val['username']; ?>"><?php print $val['nama_polres']; ?></option><?php

        }
                        ?>
						</select></td>
					</tr>
					<tr><td class="ia rk active">* Nopol</td><td colspan="3" class="warning"><input type="text" size="50" placeholder="Nopol" name="nopol" class="form-control" required></td></tr>
					<tr><td class="ia rk active">* Nama Pemilik</td><td colspan="3" class="warning"><input size="50" type="text" placeholder="Nama Pemilik" name="nama_pemilik" class="form-control" required></td></tr>
					<tr><td class="ia rk active">* No Rangka</td><td colspan="3" class="warning"><input size="50" type="text" placeholder="No Rangka" name="no_rangka" class="form-control" required></td></tr>
					<tr><td class="ia rk active">* No Mesin</td><td colspan="3" class="warning"><input size="50" type="text" placeholder="No Mesin" name="no_mesin" class="form-control" required></td></tr>
					<tr><td class="ia rk active">* No BPKB</td><td colspan="3" class="warning"><input size="50" type="text" placeholder="No BPKB" name="no_bpkb" class="form-control" required></td></tr>
					<tr><td class="ia rk active">* No STNK</td><td colspan="3" class="warning"><input size="50" type="text" placeholder="No STNK" name="no_stnk" class="form-control" required></td></tr>
					<tr><td class="ia rk active">* No HP</td><td colspan="3" class="warning"><input size="50" type="text" placeholder="No HP" name="no_hp" class="form-control" required></td></tr>
				</tbody>
				<tbody>
					<tr>
						<td class="rk active">* STNK</td>
						<td class="warning">
								<input type="file" size="10" name="stnk" id="stnk_file" class="btn-warning form-control" required>
						</td>
						<td align="center" class="warning"><img style="margin-top:30%;border:1px solid black;" src="" class="img-thumbnail" id="stnk_preview"></td>
						<td align="center" class="warning"><button id="stnk_button" type="button" class="dlbt" disabled><i class="fa fa-fw fa-trash"></i> Hapus</button></td>
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