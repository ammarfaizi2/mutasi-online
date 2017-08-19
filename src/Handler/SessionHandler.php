<?php

namespace Handler;

use PDO;
use System\T;
use System\DB;

class SessionHandler
{
	public static function check_session($session, $user_id, $sess_key)
	{
		$st = DB::pdo()->prepare("SELECT `expired_at` FROM `admin_session` WHERE `username`=:user AND `session`=:session AND `session_key`=:sess_key LIMIT 1;");
		$exe = $st->execute(array(
				":user" => $user_id,
				":session" => $session,
				":sess_key" => $sess_key
			));
		if ($exe) {
			$st = $st->fetch(PDO::FETCH_NUM);
			if (isset($st[0])){
				return strtotime($st[0]) > time();
			} else {
				return false;
			}
		} else {
			var_dump($st->errorInfo());
		}
	}
}