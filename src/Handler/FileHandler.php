<?php

namespace Handler;

class FileHandler
{
	public static function gf($input_name, $dir, $file_name)
	{
		if (isset($_FILES[$input_name])) {
			
		} else {
			return false;
		}
	}
}