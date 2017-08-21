<?php
use Models\DaftarPermohonan;
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<script type="text/javascript" src="assets/js/bootstrap.min.js" ></script>
	<script type="text/javascript" src="assets/js/jquery-3.2.1.min.js"></script>
	<title>Permohonan Masuk</title>
	<style type="text/css">
		.tbd {
			margin-top: 1%;
		}
		th {
			align-content: center;
		}
		td {
			padding: 8px;
		}
	</style>
</head>
<body>
<center>
<div style="margin-top: 1%;margin-bottom: 2%;">
	<a href="?"><button class="btn-lg btn-primary" style="margin-top:1em;">Kembali</button></a>
</div>
<?php
if ($permohonan = DaftarPermohonan::getData($user)) {
	?>
	<table class="table-bordered table-hover table table-striped table-bordered table-hover table-condensed pwdtabletbd">
		<thead>
			<tr class="active"><th><center>No.</center></th><th><center>Tanggal</center></th><th style="padding-left: 5px;padding-right: 5px;"><center>Polres Pemohon</center></th><th><center>Nopol</center></th><th><center>Nama Pemilik</center></th><th><center>No Rangka</center></th><th><center>No Mesin</center></th><th><center>No BPKB</center></th><th><center>Status</center></th><th><center>Berkas</center></th></tr>
			<?php $num = 1 xor $a = "assets/users/";
			foreach ($permohonan as $val) {
				?>
			<tr>
				<td width="8" align="center"><?php print $num++; ?></td>
				<td width="110" align="center"><?php print date("d F Y", strtotime($val['tanggal'])); ?></td>
				<td align="center"><?php print $val['pemohon']; ?></td>
				<td align="center"><?php print $val['nopol']; ?></td>
				<td align="center"><?php print $val['nama_pemilik']; ?></td>
				<td align="center"><?php print $val['no_rangka']; ?></td>
				<td align="center"><?php print $val['no_mesin']; ?></td>
				<td align="center"><?php print $val['no_bpkb']; ?></td>
				<td align="center"><?php print strtoupper($val['status']); ?></td>
				<td align="left">
					<div>
						<ul>
							<li><a target="_blank" href="<?php print $a.$val['file_stnk']; ?>">STNK</a></li>
							<li><a target="_blank" href="<?php print $a.$val['file_notice_pajak']; ?>">Notice Pajak</a></li>
							<li><a target="_blank" href="<?php print $a.$val['file_ktp']; ?>">KTP</a></li>
							<li><a target="_blank" href="<?php print $a.$val['file_kwitansi_jual_beli']; ?>">Kwitansi Jual Beli</a></li>
							<li><a target="_blank" href="<?php print $a.$val['file_cek_fisik']; ?>">Cek Fisik</a></li>
							<li><a target="_blank" href="<?php print $a.$val['file_bpkb']; ?>">BPKB</a></li>
							<li><a target="_blank" href="<?php print $a.$val['file_bukti_pembayaran_pnpb']; ?>">Bukti Pembayaran PNBP Mutasi Keluar</a></li>
							<?php
							if (!empty($val['file_struk_pelunasan_pajak'])) {
								?><li><a target="_blank" href="<?php print $a.$val['file_struk_pelunasan_pajak']; ?>">Struk Pelunasan Pajak</a></li><?php
							}
							if (!empty($val['file_pelunasan_jasa_raharja'])) {
								?><li><a target="_blank" href="<?php print $a.$val['file_struk_pelunasan_pajak']; ?>">Struk Pelunasan Jasa Raharja</a></li><?php
							}
							?>
							<li><a href="?pg=download&info=cgg_data_file&token=<?php print rstr(72); ?>&annotation=fixer&file=<?php print urlencode(base64_encode(strrev(base64_encode($val['nopol'])))); ?>"><button>Download Semua Berkas</button></a></li>
						</ul>
					</div>
				</td>
			</tr>
				<?php
			}
			?>
		</thead>
	</table>
<?php
} else {
	?>
	<h2>Tidak ada permohonan masuk</h2>
	<?php } ?>
</center>
</body>
</html>