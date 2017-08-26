<?php
header("Content-type:text/plain");
$a = mysqli_connect("localhost", "debian-sys-maint", "", "mutasi");
$b = mysqli_query($a, "SELECT * FROM `pemohon` WHERE no_rangka=".mysqli_real_escape_string($a, $_GET['a'])) or die(mysqli_error($a));
print json_encode(mysqli_fetch_assoc($b), JSON_PRETTY_PRINT);