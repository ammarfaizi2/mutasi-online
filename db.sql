-- Adminer 4.3.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` text NOT NULL,
  `nama_polres` varchar(60) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `admin` (`id`, `username`, `password`, `nama_polres`, `last_login`) VALUES
(1, 'polrescilacap',  'LwkyKF/S0QPVXEDiy/8zNCAA', 'Cilacap',  NULL),
(2, 'polresbanyumas', 'r0gy3CXLLcfEzWDSKoWSxTAA', 'Banyumas', NULL),
(3, 'polrespurbalingga',  'LviTJscSUObEWLvqhjCiPEAA', 'Purbalingga',  NULL),
(4, 'polresbanjarnegara', 'zFn8tIjLPcTC1GDqxn8jJDAA', 'Banjarnegara', NULL),
(5, 'polreskebumen',  'zH3MNNTSydx1webLIoWstYAA', 'Kebumen',  NULL),
(6, 'polrespurworejo',  'z7cyJJ3SKcLCUfbbPhmjPRAA', 'Purworejo',  NULL),
(7, 'polreswonosobo', 'roCiKzASMcx10IHiivC8uIAA', 'Wonosobo', NULL),
(8, 'polresmagelang', 'zYvdJgQSsSb1Ne1LIom9RWAA', 'Magelang', NULL),
(9, 'polresboyolali', 'LL/T3yqKTOPCUdDyPp8bKQAA', 'Boyolali', NULL),
(10,  'polresklaten', 'LkQDx1sK1QP1VdDyg3WiOBAA', 'Klaten', NULL),
(11,  'polressukoharjo',  'r8wNOzsSMELkwAvygzmasIAA', 'Sukoharjo',  NULL),
(12,  'polreswonogiri', 'LoScKtKKNcbCwQbrhj8zMLAA', 'Wonogiri', NULL),
(13,  'polreskaranganyar',  'LRDNJ/wKzdfkUXdbgz8LtcAA', 'Karanganyar',  NULL),
(14,  'polressragen', 'LJvLIUHLVRP1Qc1zhzWKtMAA', 'Sragen', NULL),
(15,  'polresgrobogan', 'z5M8qwETURlCQcHah9CC2DAA', 'Grobogan', NULL),
(16,  'polresblora',  'rML8McHTMEP1xAhKgzmDOWAA', 'Blora',  NULL),
(17,  'polresrembang',  'zsQzuwST0Qp1QYvyh9W8IUAA', 'Rembang',  NULL),
(18,  'polrespati', 'rKvqoUjLTRPVXKHSM1mc3HAA', 'Pati', NULL),
(19,  'polreskudus',  'z5SSKM3L1QpCQYDqO1miPNAA', 'Kudus',  NULL),
(20,  'polresjepara', 'zMzMK+0TSRP8TNbLOxmyMCAA', 'Jepara', NULL),
(21,  'polresdemak',  'LeDNw5ULLEL10OHaOpWSJfAA', 'Demak',  NULL),
(22,  'polressemarang', 'ztEt0lMLVOL8XMlaIom5xVAA', 'Semarang', NULL),
(23,  'polrestemanggung', 'zNjKJITTKEb1xGvyxnCKrIAA', 'Temanggung', NULL),
(24,  'polreskendal', 'ryoSK78KP8ACxIDSNp8TpGAA', 'Kendal', NULL),
(25,  'polresbatang', 'LkS9NF/TMcPkwWHiKomCIPAA', 'Batang', NULL),
(26,  'polrespekalongan', 'LHf90CnSsSTVzbDiynCqSEAA', 'Pekalongan', NULL),
(27,  'polrespemalang', 'zfn9IpAKryACJRHyPtCinXAA', 'Pemalang', NULL),
(28,  'polrestegal',  'zky9z/8K1dPC0R1zIo8bsOAA', 'Tegal',  NULL),
(29,  'polresbrebes', 'z5sSODvK1QpCUDHiizmrLEAA', 'Brebes', NULL),
(30,  'polresmagelangkota',  'zCj9OJLSK8AEzWDKOhWiucAA', 'Kota Magelang',  NULL),
(31,  'polressurakartakota', 'zjQ9yHvTSRL8TNhSi9C8IbAA', 'Kota Surakarta', NULL),
(32,  'polressalatigakota',  'rysNw04L3FbCRXHywnCqtGAA', 'Kota Salatiga',  NULL),
(33,  'polrestabessemarang',  'L0CMLisKVOL1VdhKOpW8PUAA', 'Kota Semarang',  NULL),
(34,  'polrespekalongankota',  'rogSzjMK1QPkQLdzJwCKKPAA', 'Kota Pekalongan',  NULL),
(35,  'polrestegalkota', 'LtMz37wSURPVXclqxnWCPAAA', 'Kota Tegal', NULL);

DROP TABLE IF EXISTS `admin_session`;
CREATE TABLE `admin_session` (
  `id_session` int(11) NOT NULL AUTO_INCREMENT,
  `ur_wx` text NOT NULL,
  `username` varchar(72) NOT NULL,
  `session` varchar(64) NOT NULL,
  `session_key` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `expired_at` datetime NOT NULL,
  PRIMARY KEY (`id_session`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `balasan`;
CREATE TABLE `balasan` (
  `nopol` varchar(25) NOT NULL,
  `surat_pengantar` varchar(225) NOT NULL,
  `surat_keterangan_pindah_pengganti` varchar(225) NOT NULL,
  `tanda_bukti_pengiriman_dokumen` varchar(225) NOT NULL,
  `daftar_kelengkapan_dokument` varchar(225) NOT NULL,
  `surat_keterangan_fiskol_antar_daerah` varchar(225) NOT NULL,
  `kartu_induk_bpkb` varchar(225) NOT NULL,
  `faktur_stnk` varchar(225) NOT NULL,
  `faktu_bpkb` varchar(225) NOT NULL,
  `form_a` varchar(225) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `pemohon`;
CREATE TABLE `pemohon` (
  `pemohon` varchar(72) NOT NULL,
  `memohon_ke` varchar(64) NOT NULL,
  `nopol` varchar(25) NOT NULL,
  `tanggal` datetime NOT NULL,
  `nama_pemilik` varchar(225) NOT NULL,
  `no_rangka` varchar(100) NOT NULL,
  `no_mesin` varchar(100) NOT NULL,
  `no_bpkb` varchar(100) NOT NULL,
  `no_stnk` varchar(100) NOT NULL,
  `no_hp` varchar(25) NOT NULL,
  `file_stnk` varchar(225) NOT NULL,
  `file_notice_pajak` varchar(225) NOT NULL,
  `file_ktp` varchar(225) NOT NULL,
  `file_kwitansi_jual_beli` varchar(225) NOT NULL,
  `file_cek_fisik` varchar(225) NOT NULL,
  `file_bpkb` varchar(225) NOT NULL,
  `file_bukti_pembayaran_pnpb` varchar(225) NOT NULL,
  `file_struk_pelunasan_pajak` varchar(225) DEFAULT NULL,
  `file_pelunasan_jasa_raharja` varchar(225) DEFAULT NULL,
  `status` enum('sedang proses','selesai') NOT NULL DEFAULT 'sedang proses'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2017-08-26 13:51:19
