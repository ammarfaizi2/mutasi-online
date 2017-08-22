<?php
$ch = curl_init("http://localhost:8000/assets/zip/AD1234BCD.zip");
curl_setopt_array($ch, array(
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_HEADER => true
	));
$out = curl_exec($ch);

var_dump(substr($out,0,curl_getinfo($ch)['header_size']));
curl_close($ch);

die();