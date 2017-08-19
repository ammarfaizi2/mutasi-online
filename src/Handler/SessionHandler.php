<?php

namespace Handler;

use PDO;
use System\T;
use System\DB;

class SessionHandler
{
	public static function check_session($session, $user_id)
	{
		$st = DB::pdo()->prepare("SELECT `expired_at` FROM `admin_session` WHERE `id`=:id AND `session`=:session LIMIT 1;");
		$st->execute(array(
				":id" => T::decrypt($user_id, "polres"),
				":session" => T::decrypt($session, "polres")
			));
		return $st->fetch(PDO::FETCH_NUM);
	}
}