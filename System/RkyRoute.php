<?php

namespace System;

use System\App;
use System\Login;
use System\SessionHandler as S;

class RkyRoute
{
	public static function run()
	{
		if (S::check_session()) {
			App::run();
		} else {
			Login::run();
		}
	}
}