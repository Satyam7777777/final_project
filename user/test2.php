<?php
	
	$same = true;
	require_once '../autologin/autoToken.php';
	
	$autotoken = new autoToken($_SESSION['user'], $_SESSION['token']);
	
	echo $autotoken->getToken();
	
?>