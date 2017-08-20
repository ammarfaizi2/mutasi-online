<?php

namespace Handler;

class FileHandler
{
	public static function gf($input_name, $save_to)
	{
		if (isset($_FILES[$input_name]['tmp_name']) and !empty($_FILES[$input_name]['tmp_name'])) {
			if (move_uploaded_file($_FILES[$input_name]['tmp_name'], $save_to)) {
				return $save_to;
			} else {
				return null;
			}
		} else {
			return false;
		}
	}
}