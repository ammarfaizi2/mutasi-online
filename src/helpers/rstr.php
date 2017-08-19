<?php

if (!function_exists("rstr")) {
	function rstr($n = 32)
	{
		$str = "QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890---______";
		$wg  = 70;
		$rt	 = "";
		for ($i=0; $i < (int)$n; $i++) { 
			$rt .= $str[rand(0, $wg)];
		}
		return $rt;
	}
}