<?php
	
	require_once '../redirect.php';
	
	$url = getRedirect(1);
	
	header("Location: ".$url);
?>