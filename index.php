<?php
try {
	require __DIR__."/src/autoload.php";
	Handler\RkyRoute::run();
} catch (\Exception $e) {
	var_dump($e->getMessage());
	die(1);
} catch (\Error $e) {
	var_dump($e->getMessage());
	die(1);
} catch (\ErrorException $e) {
	var_dump($e->getMessage());
	die(1);
}