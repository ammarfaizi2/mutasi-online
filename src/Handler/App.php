<?php

namespace Handler;

use PDO;
use System\DB;
use Models\User;
use Controllers\InputMutasiController;

class App
{
	public static function run()
	{
		$user = User::get_info($_COOKIE['user']);
		if (isset($_GET['pg'])) {
			switch(strtolower($_GET['pg'])) {
				case 'input_mutasi':
						InputMutasiController::run($user);
					break;
				case 'permohonan_masuk':
						echo "Belum dibuat";
					break;
				case 'cek_permohonan_keluar':
						echo "Belum dibuat";
					break;
				case 'logout':
						if (isset($_COOKIE['user'], $_COOKIE['user_session'], $_COOKIE['sess_key'])) {
							$st = DB::pdo()->prepare("DELETE FROM `admin_session` WHERE `username`=:user AND `session`=:user_session AND `session_key`=:sess_key LIMIT 1;");
							$st->execute(array(
									":user" => $_COOKIE['user'],
									":user_session" => $_COOKIE['user_session'],
									":sess_key" => $_COOKIE['sess_key']
								));
						}
						setcookie("user", null, null);
						setcookie("user_session", null, null);
						setcookie("sess_key", null, null);
						header("location:?ref=logout");
						die(1);
					break;
			}
		} else {
			view("index_user");
		}
	}
}