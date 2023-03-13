<?php
	
	require_once '../redirect.php';
	
	$url = getRedirect(1);
	0
	header("Location: ".$url);
?>