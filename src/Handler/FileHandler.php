<?php

namespace Handler;

class FileHandler
{
	public static function gf($input_name, $save_to)
	{
		if (isset($_FILES[$input_name])) {
			move_uploaded_file($_FILES[$input_name]['tmp_file'], $save_to)
		} else {
			return false;
		}
	}
}