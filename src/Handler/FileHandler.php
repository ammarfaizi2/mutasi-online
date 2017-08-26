<?php

namespace Handler;

class FileHandler
{
    public static function gf($input_name, $save_to, $tmp_handler)
    {
        if (isset($_FILES[$input_name]['tmp_name']) and !empty($_FILES[$input_name]['tmp_name'])) {
            if (move_uploaded_file($_FILES[$input_name]['tmp_name'], $save_to)) {
                $a = explode("/", $save_to);
                $a = end($a);
                is_dir(ASSETS_DIR."/_tmp_data/") or mkdir(ASSETS_DIR."/_tmp_data/");
                is_dir($h = ASSETS_DIR."/_tmp_data/".$tmp_handler) or mkdir($h);
                copy($save_to, ASSETS_DIR."/_tmp_data/".$tmp_handler."/".$a);
                return $save_to;
            } else {
                return null;
            }
        } else {
            return false;
        }
    }

    public static function td($input_name, $to)
    {
        if (isset($_FILES[$input_name]['tmp_name']) and !empty($_FILES[$input_name]['tmp_name'])) {
            return move_uploaded_file($_FILES[$input_name]['tmp_name'], $to);
        } else {
            return false;
        }
    }
}
