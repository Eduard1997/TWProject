<?php
	session_start();

	require_once "Facebook/autoload.php";

	$FB = new \Facebook\Facebook([
		'app_id' => '447305759027719',
		'app_secret' => 'cf6e70317c0fd14fd3275d11335e6b5b',
		'default_graph_version' => 'v2.10'
	]);

	$helper = $FB->getRedirectLoginHelper();
	
?>
