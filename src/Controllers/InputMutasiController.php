<?php

namespace Controllers;

use PDO;
use System\DB;
use Handler\PCLZip;
use Handler\FileHandler as F;

class InputMutasiController
{
    public static function run($user)
    {
        if (isset($_POST['submit'])) {
            self::postAction();
        } else {
            view("input_mutasi/_index");
        }
    }

    public static function postAction()
    {
    
    }
}
