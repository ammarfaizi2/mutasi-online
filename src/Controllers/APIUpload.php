<?php

namespace Controllers;

class APIUpload
{
	public static function run()
	{
		if (isset($_GET['what'])) {
			switch ($_GET['what']) {
				case 'input_mutasi':
						self::input_mutasi();
					break;
				default:
					echo "Error !";
					break;
			}
		} else {
			http_response_code(404);
			echo "Not Found!";
		}
	}

	private static function input_mutasi()
	{
		header("Content-type:application/json");
		$v = function($status, $msg){
			return json_encode(array(
					"status" => $status,
					"data"   => $msg
				), 128);
		};
		print json_encode($_FILES, 128);
	}
}