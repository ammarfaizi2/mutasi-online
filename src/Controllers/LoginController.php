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
            $exe = $st->execute(
                array(
                    ":user" => ($user = strtolower($_POST['username']))
                )
            );
            if (!$exe) {
                var_dump($st->errorInfo());
                die(1);
            }
            if ($st = $st->fetch(PDO::FETCH_NUM)) {
                var_dump($st);
                if (T::decrypt($st[0], "polres") === $_POST['password']) {
                    $sess = rstr(32);
                    $key  = rstr(32);
                    $expired = time()+(3600*24*14);
                    $st = DB::pdo()->prepare("INSERT INTO `admin_session` (`id_session`, `ur_wx`, `username`, `session`, `session_key`, `created_at`, `expired_at`) VALUES (null, :ur_wx, :user, :sess, :sesskey, :cr, :ex);");
                    $exe = $st->execute(
                        array(
                            ":ur_wx" => base64_encode(rstr(120)),
                            ":user" => $user,
                            ":sess" => $sess,
                            ":sesskey" => $key,
                            ":cr" => (date("Y-m-d H:i:s")),
                            ":ex" => (date("Y-m-d H:i:s", $expired))
                        )
                    );
                    if ($exe) {
                        setcookie("user_session", $sess, $expired);
                        setcookie("user", $user, $expired);
                        setcookie("sess_key", $key, $expired);
                        header("location:?login=ok&ur=".uniqid(time())."&hash_lg=".sha1(time())."&handler=".urlencode(base64_encode(__CLASS__."::".__METHOD__))."&session=".urlencode(rstr(64)));
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
            view(
                "auth/login_page", array(
                        "compare" => $compare,
                        "ckey" => $ckey
                )
            );
            return 0;
        }
    }
}
