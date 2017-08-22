<?php

namespace Controllers;

class DownloadController
{
	public static function run()
	{
		if (isset($_GET['info']) and $_GET['info'] == "cgg_data_file") {
			if (file_exists($a = ASSETS_DIR."/zip/".base64_decode(strrev(base64_decode($_GET['file']))).".zip")) {
				http_response_code(200);
				set_time_limit(0);
				ignore_user_abort(true);
				ini_set("max_execution_time", false);
				header("Content-Type: application/zip");
				header("filename=wq.zip");
				$handle = fopen($a, "r");
				while (!feof($handle)) {
					print fread($handle, 4096);
					flush();
				}
				fclose($handle);
				die(1);
			} else {
				http_response_code(404);
				echo "Not Found";
				die();
			}
		}
	}
}
