<?php

if (!function_exists("view")) {
	function view($__view_file, $__variable = null)
	{
		if (is_array($__variable)) {
			foreach ($__variable as $__key => $__val) {
				$$__key = $__val;
			}
		}
		require __DIR__."/../views/".$__view_file.".php";
	}
}