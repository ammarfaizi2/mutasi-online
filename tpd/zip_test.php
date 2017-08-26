<?php
require __DIR__."/../src/autoload.php";
use Handler\PCLZip;

$archive = new PCLZip(__DIR__.'/a.zip');
$v_list = $archive->create(__DIR__."/../src", PCLZIP_OPT_REMOVE_PATH, realpath(__DIR__."/../src"));