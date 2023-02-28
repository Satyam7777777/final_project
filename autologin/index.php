<?php
	
	$url = 'http://';
	
	if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==='on' ){
		$url = 'https://';
	}
	
	$url .= $_SERVER['HTTP_HOST'];
	$parsed = explode("/", $_SERVER['REQUEST_URI']);
	$size = sizeof($parsed);
	
	for($x=0; $x<$size-2; $x++){
		$url = $url.'/'.$parsed[$x];
	}
	
	header("Location: ".$url);
?>