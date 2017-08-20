<?php
ini_set("post_max_size", "40M");
ini_set("upload_max_filesize", "40M");
require __DIR__."/../config.php";
require __DIR__."/helpers/view.php";
require __DIR__."/helpers/rstr.php";
define("BASEPATH", realpath(__DIR__."/.."));
function load_class__($class)
{
	require __DIR__."/".str_replace("\\", "/", $class).".php";	
}
spl_autoload_register('load_class__');