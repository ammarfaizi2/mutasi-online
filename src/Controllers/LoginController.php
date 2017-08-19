<?php

namespace Controllers;

use PDO;
use System\T;
use System\DB;

class LoginController
{
	public static function run()
	{
		if (isset($_POST['login'], $_POST['username'], $_POST['password'])) {
			$st = DB::pdo()->prepare("SELECT `password` FROM `admin` WHERE `username`=:user LIMIT 1;");
			$st->execute(array(
					":user" => ($user = strtolower($_POST['username']))
				));
			if ($st = $st->fetch(PDO::FETCH_NUM)) {
				if (T::decrypt($st[0], "polres") === $_POST['password']) {
					$sess = rstr(64);
					$key  = rstr(32);
					$expired = time()+(3600*24*14);
					$st = DB::pdo()->prepare("INSERT INTO `admin_session` (`id`, `session`, `session_key`, `created_at`, `expired_at`) VALUES (null, :sess, :sesskey, :cr, :ex);");
					$exe = $st->execute(array(
							":sess" => $sess,
							":sesskey" => $key,
							":cr" => (date("Y-m-d H:i:s")),
							":ex" => (date("Y-m-d H:i:s", $expired))
						));
					if ($exe) {
							setcookie("user_session", T::encrypt($sess, $key), $expired);
							setcookie("user", T::encrypt($user, "polres"), $expired);
							setcookie("sess_key", T::encrypt($key, "polres"), $expired);
							header("location:?login=ok");
							die(1);
					} else {
						var_dump($st->errorInfo());
						die();
					}
				}
			} else {
				header("location:?msg=login_failed");
				die(1);
			}
		} else {
			$csrf = rstr(32);
			$ckey = rstr(64);
			$compare = T::encrypt($csrf, $ckey);
			setcookie("csrf_compare", T::encrypt($csrf, $ckey), time()+7200);
			view("auth/login_page", array(
						"compare" => $compare,
						"ckey" => $ckey
				));
			return 0;
		}
	}
}