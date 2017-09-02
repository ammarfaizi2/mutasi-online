<?php

namespace Controllers;

class CaptchaController
{
	public static function run()
	{
		function en($str)
		{
			return base64_encode(gzdeflate(base64_encode(gzdeflate($str))));
		}
		function de($str)
		{
			return gzinflate(base64_decode(gzinflate(base64_decode($str))));
		}
		if (isset($_GET['c'])) {
			$dir = ASSETS_DIR.'/fonts/helvetica_regular.ttf';
			$image = imagecreatetruecolor(170, 60);
			$black = imagecolorallocate($image, 0, 0, 0);
			$color = imagecolorallocate($image, 255, 100, 90);
			$white = imagecolorallocate($image, 255, 255, 255);
			imagefilledrectangle($image,0,0,399,99,$white);
			imagettftext($image, 30, 3, 20, 40, $color, $dir, de($_GET['c']));
			header("Content-type: image/png");
			imagepng($image);
			imagedestroy($image);
		} elseif (isset($_GET['request_change'])) {
			header("Content-type:application/json");
			$a = substr(md5(rstr(32)), 0, 4);
			die(json_encode(array(
					"captcha" => ($en = en($a)),
					"hash_compare" => sha1($en)
				)));
		} elseif (isset($_GET['compare'])) {
			header("Content-type:application/json");
			$hash = $_GET['hash'];
			$input = $_GET['input'];
			$c = $_GET['compare'];
			if (sha1($c) == $hash and de($c) == $input) {
				die(json_encode(array(
						"status" => true
					)));
			} else {
				die(json_encode(array(
						"status" => false
					)));
			}
		}
	}
}