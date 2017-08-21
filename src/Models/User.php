<?php

namespace Models;

use PDO;
use System\DB;

class User
{
    public static function get_info($user)
    {
        $st = DB::pdo()->prepare("SELECT * FROM `admin` WHERE `username`=:user LIMIT 1;");
        $exe = $st->execute(
            array(
            ":user" => $user
            )
        );
        if ($exe) {
            $rr = $st->fetch(PDO::FETCH_ASSOC);
            if ($rr) {
                return $rr;
            } else {
                echo("Database bermasalah. Data {$user}");
                var_dump(debug_backtrace());
                die();
            }
        } else {
            var_dump($st->errorInfo());
            die();
        }
    }
}
