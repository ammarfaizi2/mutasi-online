<?php

namespace Controllers;

class CaptchaController
{
	public static function run()
	{
		$dir = '../assets/fonts/helvetica_regular.ttf';
		$image = imagecreatetruecolor(170, 60);
		$black = imagecolorallocate($image, 0, 0, 0);
		$color = imagecolorallocate($image, 255, 100, 90);
		$white = imagecolorallocate($image, 255, 255, 255);
		imagefilledrectangle($image,0,30,399,99,$white);
		imagettftext($image, 30, 3, 20, 40, $color, $dir, gzinflate(base64_decode($_GET['crd'])));
		header("Content-type: image/png");
		imagepng($image);
		imagedestroy($image);
	}
}