<?php
require __DIR__."/../src/autoload.php";

use System\T;
use System\DB;

$pure = <<<pr
1
	
33.01
	
Kabupaten Cilacap
	
Cilacap
2
	
33.02
	
Kabupaten Banyumas
	
Purwokerto
3
	
33.03
	
Kabupaten Purbalingga
	
Purbalingga
4
	
33.04
	
Kabupaten Banjarnegara
	
Banjarnegara
5
	
33.05
	
Kabupaten Kebumen
	
Kebumen
6
	
33.06
	
Kabupaten Purworejo
	
Purworejo
7
	
33.07
	
Kabupaten Wonosobo
	
Wonosobo
8
	
33.08
	
Kabupaten Magelang
	
Mungkid
9
	
33.09
	
Kabupaten Boyolali
	
Boyolali
10
	
33.10
	
Kabupaten Klaten
	
Klaten
11
	
33.11
	
Kabupaten Sukoharjo
	
Sukoharjo
12
	
33.12
	
Kabupaten Wonogiri
	
Wonogiri
13
	
33.13
	
Kabupaten Karanganyar
	
Karanganyar
14
	
33.14
	
Kabupaten Sragen
	
Sragen
15
	
33.15
	
Kabupaten Grobogan
	
Purwodadi
16
	
33.16
	
Kabupaten Blora
	
Blora
17
	
33.17
	
Kabupaten Rembang
	
Rembang
18
	
33.18
	
Kabupaten Pati
	
Pati
19
	
33.19
	
Kabupaten Kudus
	
Kudus
20
	
33.20
	
Kabupaten Jepara
	
Jepara
21
	
33.21
	
Kabupaten Demak
	
Demak
22
	
33.22
	
Kabupaten Semarang
	
Ungaran
23
	
33.23
	
Kabupaten Temanggung
	
Temanggung
24
	
33.24
	
Kabupaten Kendal
	
Kendal
25
	
33.25
	
Kabupaten Batang
	
Batang
26
	
33.26
	
Kabupaten Pekalongan
	
Kajen
27
	
33.27
	
Kabupaten Pemalang
	
Pemalang
28
	
33.28
	
Kabupaten Tegal
	
Slawi
29
	
33.29
	
Kabupaten Brebes
	
Brebes
30
	
33.71
	
Kota Magelang
	
-
31
	
33.72
	
Kota Surakarta
	
-
32
	
33.73
	
Kota Salatiga
	
-
33
	
33.74
	
Kota Semarang
	
-
34
	
33.75
	
Kota Pekalongan
	
-
35
	
33.76
	
Kota Tegal
	
-
pr;

$st = DB::pdo()->prepare("INSERT INTO `admin` (`id`,`username`,`password`,`nama_polres`,`last_login`) VALUES (null, :user, :pass, :nama, null);");
$a = explode("\n", $pure);
$data = array();
foreach ($a as $val) {
    if (strlen($val) > 5 and (strpos($val, "Kabupaten")!==false || strpos($val, "Kota")!== false)) {
        $data[] = trim($val);
        $st->execute(
            array(
                ":user" => strtolower(str_replace(" ", "_", $val)),
                ":pass" => T::encrypt("polres12345", "polres"),
                ":nama" => $val
            )
        );
    }
}
var_dump($data);
