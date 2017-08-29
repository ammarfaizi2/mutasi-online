<?php

namespace Handler;

use PDO;
use System\DB;
use Models\User;
use Controllers\R2PTG;
use Controllers\APIUpload;
use Controllers\CaptchaController;
use Controllers\DownloadController;
use Controllers\InputMutasiController;
use Controllers\PermohonanMasukController;
use Controllers\PermohonanKeluarController;

class App
{
    public static function run()
    {
        $user = User::get_info($_COOKIE['user']);
        if (isset($_GET['pg'])) {
            switch (strtolower($_GET['pg'])) {
            case 'input_mutasi':
                    InputMutasiController::run($user);
                break;
            case 'permohonan_masuk':           
                    PermohonanMasukController::run($user);
                break;
            case 'permohonan_keluar':
                    PermohonanKeluarController::run($user);
                break;
            case 'logout':
                if (isset($_COOKIE['user'], $_COOKIE['user_session'], $_COOKIE['sess_key'])) {
                    $st = DB::pdo()->prepare("DELETE FROM `admin_session` WHERE `username`=:user AND `session`=:user_session AND `session_key`=:sess_key LIMIT 1;");
                    $st->execute(
                        array(
                            ":user" => $_COOKIE['user'],
                            ":user_session" => $_COOKIE['user_session'],
                            ":sess_key" => $_COOKIE['sess_key']
                            )
                    );
                }
                    setcookie("user", null, null);
                    setcookie("user_session", null, null);
                    setcookie("sess_key", null, null);
                    header("location:?ref=logout&r_cm=".rstr(72));
                die(1);
                    break;
            case 'download':
                    DownloadController::run();
                break;
            case 'r2ptg':
                    R2PTG::run();
                break;
            case 'upload':
                    APIUpload::run();
                break;
            case 'captcha':
                    CaptchaController::run();
                break;
            default:
                http_response_code(404);
                echo "Not Found !";
                die(1);
                break;
            }
        } else {
            view("index_user");
        }
    }
}
