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
(1,	'kabupaten_cilacap',	'LwkyKF/S0QPVXEDiy/8zNCAA',	'Kabupaten Cilacap',	NULL),
(2,	'kabupaten_banyumas',	'r0gy3CXLLcfEzWDSKoWSxTAA',	'Kabupaten Banyumas',	NULL),
(3,	'kabupaten_purbalingga',	'LviTJscSUObEWLvqhjCiPEAA',	'Kabupaten Purbalingga',	NULL),
(4,	'kabupaten_banjarnegara',	'zFn8tIjLPcTC1GDqxn8jJDAA',	'Kabupaten Banjarnegara',	NULL),
(5,	'kabupaten_kebumen',	'zH3MNNTSydx1webLIoWstYAA',	'Kabupaten Kebumen',	NULL),
(6,	'kabupaten_purworejo',	'z7cyJJ3SKcLCUfbbPhmjPRAA',	'Kabupaten Purworejo',	NULL),
(7,	'kabupaten_wonosobo',	'roCiKzASMcx10IHiivC8uIAA',	'Kabupaten Wonosobo',	NULL),
(8,	'kabupaten_magelang',	'zYvdJgQSsSb1Ne1LIom9RWAA',	'Kabupaten Magelang',	NULL),
(9,	'kabupaten_boyolali',	'LL/T3yqKTOPCUdDyPp8bKQAA',	'Kabupaten Boyolali',	NULL),
(10,	'kabupaten_klaten',	'LkQDx1sK1QP1VdDyg3WiOBAA',	'Kabupaten Klaten',	NULL),
(11,	'kabupaten_sukoharjo',	'r8wNOzsSMELkwAvygzmasIAA',	'Kabupaten Sukoharjo',	NULL),
(12,	'kabupaten_wonogiri',	'LoScKtKKNcbCwQbrhj8zMLAA',	'Kabupaten Wonogiri',	NULL),
(13,	'kabupaten_karanganyar',	'LRDNJ/wKzdfkUXdbgz8LtcAA',	'Kabupaten Karanganyar',	NULL),
(14,	'kabupaten_sragen',	'LJvLIUHLVRP1Qc1zhzWKtMAA',	'Kabupaten Sragen',	NULL),
(15,	'kabupaten_grobogan',	'z5M8qwETURlCQcHah9CC2DAA',	'Kabupaten Grobogan',	NULL),
(16,	'kabupaten_blora',	'rML8McHTMEP1xAhKgzmDOWAA',	'Kabupaten Blora',	NULL),
(17,	'kabupaten_rembang',	'zsQzuwST0Qp1QYvyh9W8IUAA',	'Kabupaten Rembang',	NULL),
(18,	'kabupaten_pati',	'rKvqoUjLTRPVXKHSM1mc3HAA',	'Kabupaten Pati',	NULL),
(19,	'kabupaten_kudus',	'z5SSKM3L1QpCQYDqO1miPNAA',	'Kabupaten Kudus',	NULL),
(20,	'kabupaten_jepara',	'zMzMK+0TSRP8TNbLOxmyMCAA',	'Kabupaten Jepara',	NULL),
(21,	'kabupaten_demak',	'LeDNw5ULLEL10OHaOpWSJfAA',	'Kabupaten Demak',	NULL),
(22,	'kabupaten_semarang',	'ztEt0lMLVOL8XMlaIom5xVAA',	'Kabupaten Semarang',	NULL),
(23,	'kabupaten_temanggung',	'zNjKJITTKEb1xGvyxnCKrIAA',	'Kabupaten Temanggung',	NULL),
(24,	'kabupaten_kendal',	'ryoSK78KP8ACxIDSNp8TpGAA',	'Kabupaten Kendal',	NULL),
(25,	'kabupaten_batang',	'LkS9NF/TMcPkwWHiKomCIPAA',	'Kabupaten Batang',	NULL),
(26,	'kabupaten_pekalongan',	'LHf90CnSsSTVzbDiynCqSEAA',	'Kabupaten Pekalongan',	NULL),
(27,	'kabupaten_pemalang',	'zfn9IpAKryACJRHyPtCinXAA',	'Kabupaten Pemalang',	NULL),
(28,	'kabupaten_tegal',	'zky9z/8K1dPC0R1zIo8bsOAA',	'Kabupaten Tegal',	NULL),
(29,	'kabupaten_brebes',	'z5sSODvK1QpCUDHiizmrLEAA',	'Kabupaten Brebes',	NULL),
(30,	'kota_magelang',	'zCj9OJLSK8AEzWDKOhWiucAA',	'Kota Magelang',	NULL),
(31,	'kota_surakarta',	'zjQ9yHvTSRL8TNhSi9C8IbAA',	'Kota Surakarta',	NULL),
(32,	'kota_salatiga',	'rysNw04L3FbCRXHywnCqtGAA',	'Kota Salatiga',	NULL),
(33,	'kota_semarang',	'L0CMLisKVOL1VdhKOpW8PUAA',	'Kota Semarang',	NULL),
(34,	'kota_pekalongan',	'rogSzjMK1QPkQLdzJwCKKPAA',	'Kota Pekalongan',	NULL),
(35,	'kota_tegal',	'LtMz37wSURPVXclqxnWCPAAA',	'Kota Tegal',	NULL);

DROP TABLE IF EXISTS `admin_session`;
CREATE TABLE `admin_session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session` varchar(64) NOT NULL,
  `session_key` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `expired_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `pemohon`;
CREATE TABLE `pemohon` (
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
  `file_struk_pelunasan_pajak` varchar(225) NOT NULL,
  `file_pelunasan_jasa_raharja` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2017-08-19 09:00:49
