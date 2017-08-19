<?php
require __DIR__."/../config.php";
require __DIR__."/helpers/view.php";
require __DIR__."/helpers/rstr.php";
function load_class__($class)
{
	require __DIR__."/".str_replace("\\", "/", $class).".php";	
}
spl_autoload_register('load_class__');