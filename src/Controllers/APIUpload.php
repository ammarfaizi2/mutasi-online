<?php

namespace Controllers;

use Handler\FileHandler as F;

class APIUpload
{
	public static function run()
	{
		ini_set("upload_max_filesize", "40M");
		ini_set("post_max_size", "40M");
		if (isset($_GET['what']) && isset($_GET['sess'])) {
			header("Content-type:application/json");
			switch ($_GET['what']) {
				case 'input_mutasi':
						if (isset($_GET['file_name'])) {
							self::input_mutasi();
						} else {
							die(json_encode(array(
									"status" => false,
									"data" => "Empty file name!"
								)));
						}
					break;
				case 'input_mutasi_delete':
						self::input_mutasi_delete();
					break;
				case 'reply_mutasi':
						if (isset($_GET['file_name'])) {
							self::reply_mutasi();
						} else {
							die(json_encode(array(
									"status" => false,
									"data" => "Empty file name!"
								)));
						}
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
		$v = function($status, $msg){
			return json_encode(array(
					"status" => true,
					"data"   => $msg
				), 128);
		};
		$a = ASSETS_DIR."/_tmp_data/ajax_upload/".$_GET['sess']."_".$_GET['file_name'].".jpg";
		if (F::td('file', $a)) {
			print $v(true, "Berhasil mengupload file ".$_GET['file_name']."!");
		} else {
			print $v(false, "Gagal mengupload file!");
		}
	}

	private static function input_mutasi_delete()
	{
		$sess = $_GET['sess'];
		$del = $_GET['delete'];
		$ed = strlen($sess);
		$ard = array(
				"deleted_file" => array()
			);
		foreach (scandir(ASSETS_DIR."/_tmp_data/ajax_upload/") as $val) {
			if ($val == $sess."_".$del.".jpg") {
				unlink(ASSETS_DIR."/_tmp_data/ajax_upload/".$val);
				$ard['deleted_file'][] = $val;
			}
		}
		print json_encode($ard);
	}

	private static function reply_mutasi()
	{
		
	}
}