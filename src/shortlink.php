<?php

if (! defined('WASAP')) {
	exit();
}

//gets the data from a URL  
function tinyurl($url)  {

	$ch = curl_init();
	$timeout = 5;

	curl_setopt($ch,CURLOPT_URL,'https://tinyurl.com/api-create.php?url='.$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);

	$data = curl_exec($ch);
	curl_close($ch);

	return $data;  
}
