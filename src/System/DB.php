<?php

namespace System;

defined("DBHOST") or die("DB Constant not defined !");

use PDO;

class DB
{
	public static function pdo()
	{
		return new PDO("mysql:host=".DBHOST.";dbname=".DBNAME, DBUSER, DBPASS);
	}
}