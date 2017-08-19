<?php

namespace Handler;

use Handler\SessionHandler as L;
use Controllers\LoginController as Login;

class RkyRoute
{
	public static function run()
	{
		if (isset($_COOKIE['user']) and isset($_COOKIE['session']) and L::check_session($_COOKIE['session'], $_COOKIE['user'])) {
			App::run();
		} else {
			Login::run();
		}
	}
}