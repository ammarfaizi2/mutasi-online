<!DOCTYPE html>
<html>
<head>
<title>Input Mutasi</title>
<script type="text/javascript">
	function preview_image(gambar,idpreview){
        var gb = gambar.files;
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
            }else{
                alert("Type file tidak sesuai!");
            }
        }    
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
</style>
</head>
<body>
<center>
	<div>
		<a href="?"><button>Kembali</button></a>
	</div>
	<div class="fcg">
		<form method="post" action="" enctype="multipart/form-data">
			<table border="1">
				<thead>
					<tr><th colspan="2" id="thd"><h3>Input Mutasi</h3></th></tr>
				</thead>
				<tbody>
					<tr><td class="ia">* Nopol</td><td><input type="text" placeholder="Nopol" name="nopol" required></td></tr>
					<tr><td class="ia">* Nama Pemilik</td><td><input type="text" placeholder="Nama Pemilik" name="nama_pemilik" required></td></tr>
					<tr><td class="ia">* No Rangka</td><td><input type="text" placeholder="No Rangka" name="no_rangka" required></td></tr>
					<tr><td class="ia">* No Mesin</td><td><input type="text" placeholder="No Mesin" name="no_mesin" required></td></tr>
					<tr><td class="ia">* No BPKB</td><td><input type="text" placeholder="No BPKB" name="no_bpkb" required></td></tr>
					<tr><td class="ia">* No STNK</td><td><input type="text" placeholder="No STNK" name="no_stnk" required></td></tr>
					<tr><td class="ia">* No HP</td><td><input type="text" placeholder="No HP" name="no_hp" required></td></tr>
				</tbody>
				<tbody>
					<tr><td>* STNK</td><td><input type="file" name="stnk" required></td></tr>
					<tr><td>* Notice Pajak</td><td><input type="file" name="stnk" required></td></tr>
					<tr><td>* KTP</td><td><input type="file" name="stnk" required></td></tr>
					<tr><td style="width: 40%;">* Kwitansi Jual Beli</td><td><input type="file" name="stnk" required></td></tr>
					<tr><td>* Cek Fisik</td><td><input type="file" name="cek_fisik" required></td></tr>
					<tr><td>* BPKB</td><td><input type="file" name="bpkb" required></td></tr>
					<tr><td style="width: 55%;">* Bukti Pembayaran PNPB Mutasi Keluar</td><td><input type="file" name="bukti_pembayaran_pnbp_mutasi_keluar" required></td></tr>
					<tr><td>Struk Pelunasan Pajak</td><td><input type="file" name="struk_pelunasan_pajak"></td></tr>
					<tr><td>Struck Pelunasan Jasa Raharja</td><td><input type="file" name="struk_pelunasan_jasa_raharja"></td></tr>
				</tbody>
				<tfoot>
					<tr><td align="center" colspan="2">
						<div class="sb">
						<input type="submit" name="submit" value="Submit">
						</div>
					</td></tr>
				</tfoot>
			</table>
		</form>
	</div>
</center>
</body>
</html>