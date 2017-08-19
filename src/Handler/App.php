<?php

namespace Handler;

use Controllers\InputMutasiController;
use Models\User;

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
			}
		} else {
			view("index_user");
		}
	}
}