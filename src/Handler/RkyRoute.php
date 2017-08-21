<?php

namespace Handler;

use Handler\SessionHandler as L;
use Controllers\LoginController as Login;

class RkyRoute
{
    public static function run()
    {
        if (isset($_COOKIE['user_session'], $_COOKIE['user'], $_COOKIE['sess_key']) and L::check_session($_COOKIE['user_session'], $_COOKIE['user'], $_COOKIE['sess_key'])) {
            App::run();
        } else {
            Login::run();
        }
    }
}
