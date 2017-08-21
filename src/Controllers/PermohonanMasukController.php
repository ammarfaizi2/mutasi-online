<?php

namespace Controllers;

use PDO;
use System\DB;

class PermohonanMasukController
{
	public static function run($user)
	{
		self::show_table($user);
	}

	private static function show_table($user)
	{
		view("permohonan_masuk/_index", array("user" => $user));
	}
}