<?php
$pdo = System\DB::pdo() xor $a = "assets/users/";
$sql2 = $pdo->prepare("SELECT COUNT(*) AS jumlah FROM `pemohon` WHERE `memohon_ke`=:ke;");
$sql2->execute(array(
	":ke" => $_COOKIE['user']
));
$get_jumlah = $sql2->fetch(PDO::FETCH_NUM);

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Permohonan Masuk</title>
		<link href="assets/css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style>
		.align-middle{
			vertical-align: middle !important;
		}
		.wq {
			padding: 10px 20px 10px 20px;
			border: 2px solid white;
			border-radius: 2%;
		}
		.wdd:hover{
			background-color: #E7E0E0;
		}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-inverse" role="navigation">
		<center>
			<div class="container-fluid" style="margin-left: 47%;margin-top: 1%;margin-bottom:2%;">
				<div class="navbar-header">
				<div style="margin-top:2%;">
					<a href="?rs=<?php print rstr(72); ?>"><button class="wq btn-primary">Kembali</button></a>
				</div>
				</div>
			</div>
		</center>
		</nav>
		<center>
			<div style="margin-bottom: 2%;">
				<h2>Permohonan Masuk Polres <?php print $user['nama_polres']; ?></h2>
			</div>
		</center>
		<?php
		if ($get_jumlah[0] == 0) {
			?>
			<center>
			<div style="margin-top: 8%;">
				<h1 style="font-weight: bold;">Tidak ada permohonan masuk</h1>
			</div>
			</center>
			<?php
			die();
		}
		?>
		<div style="padding: 0 15px; margin-bottom: 4%;">
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr class="active"><th><center>No.</center></th><th><center>Tanggal</center></th><th style="padding-left: 5px;padding-right: 5px;"><center>Polres Pemohon</center></th><th><center>Nopol</center></th><th><center>Nama Pemilik</center></th><th><center>No Rangka</center></th><th><center>No Mesin</center></th><th><center>No BPKB</center></th><th><center>Status</center></th><th><center>Berkas</center></th></tr>
					<?php
					$page = (isset($_GET['page']))? (int)$_GET['page'] : 1;
					$limit = 5; // Jumlah data per halamannya
					$offset = ($page - 1) * $limit;
					$sql = $pdo->prepare("SELECT `b`.`nama_polres` AS `pemohon`,`a`.`memohon_ke`, `a`.`nopol`, `a`.`tanggal`, `a`.`nama_pemilik`, `a`.`no_rangka`, `a`.`no_mesin`, `a`.`no_bpkb`, `a`.`no_stnk`, `a`.`no_hp`, `a`.`file_stnk`, `a`.`file_notice_pajak`, `a`.`file_ktp`, `a`.`file_kwitansi_jual_beli`, `a`.`file_cek_fisik`, `a`.`file_bpkb`, `a`.`file_bukti_pembayaran_pnpb`, `a`.`file_struk_pelunasan_pajak`, `a`.`file_pelunasan_jasa_raharja`,`a`.`status` FROM `pemohon` AS `a` INNER JOIN `admin` AS `b` ON `a`.`pemohon`=`b`.`username` WHERE `memohon_ke`=:ke ORDER BY `status` LIMIT {$offset},{$limit};");
					$sql->execute(array(
						":ke" => $user['username'],
					));
					$num = 1;
					$no = $offset + 1;
					while($val = $sql->fetch(PDO::FETCH_ASSOC)){
						?>
						<tr>
						<td class="align-middle text-center" width="8" align="center"><?php print $no; ?></td>
						<td class="align-middle text-center" width="110" align="center"><?php print date("d F Y h:i:s A", strtotime($val['tanggal'])); ?></td>
						<td class="align-middle text-center" width="7%;" align="center"><?php print $val['pemohon']; ?></td>
						<td style="cursor:pointer;" onclick="window.location='?pg=r2ptg&amp;npid=<?php print htmlspecialchars(urlencode(base64_encode(gzdeflate(base64_encode($val['nopol']))))); ?>'" class="wdd align-middle text-center" align="center"><?php print $val['nopol']; ?></td>
						<td class="align-middle text-center" width="10%;" align="center"><?php print $val['nama_pemilik']; ?></td>
						<td class="align-middle text-center" align="center"><?php print $val['no_rangka']; ?></td>
						<td class="align-middle text-center" width="15%;" align="center"><?php print $val['no_mesin']; ?></td>
						<td class="align-middle text-center" align="center"><?php print $val['no_bpkb']; ?></td>
						<td class="align-middle text-center" width="8%;" align="center"><?php print strtoupper($val['status']); ?></td>
						<td>
						<div style="margin-left: 10%;">
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
								<li><a href="?pg=download&amp;info=cgg_data_file&amp;token=<?php print rstr(72); ?>&annotation=fixer&file=<?php print urlencode(base64_encode(strrev(base64_encode($val['nopol'])))); ?>"><button>Download Semua Berkas</button></a></li>
						</div>
						</td>
						</tr>

					<?php
						$no++; // Tambah 1 setiap kali looping
					}
					?>
				</table>
			</div>
			<center>
			<ul class="pagination">
				<?php
				if($page == 1){
				?>
					<li class="disabled"><a href="#">First</a></li>
					<li class="disabled"><a href="#">&laquo;</a></li>
				<?php
				}else{
					$link_prev = ($page > 1)? $page - 1 : 1;
				?>
					<li><a href="?pg=permohonan_masuk&amp;page=1">First</a></li>
					<li><a href="?pg=permohonan_masuk&amp;page=<?php echo $link_prev; ?>">&laquo;</a></li>
				<?php
				}
				$jumlah_page = ceil($get_jumlah[0] / $limit);
				$jumlah_number = 4;
				$start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1;
				$end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page;
				for($i = $start_number; $i <= $end_number; $i++){
					$link_active = ($page == $i)? ' class="active"' : '';
				?>
					<li<?php echo $link_active; ?>><a href="?pg=permohonan_masuk&amp;page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
				<?php
				}
				?>
				<?php
				if($page == $jumlah_page){
				?>
					<li class="disabled"><a href="#">&raquo;</a></li>
					<li class="disabled"><a href="#">Last</a></li>
				<?php
				}else{
					$link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
				?>
					<li><a href="?pg=permohonan_masuk&amp;page=<?php echo $link_next; ?>">&raquo;</a></li>
					<li><a href="?pg=permohonan_masuk&amp;page=<?php echo $jumlah_page; ?>">Last</a></li>
				<?php
				}
				?>
			</ul>
			</center>
		</div>
	</body>
</html>

