<?php
	
	$url = 'http://';
	
	if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==='on' ){
		$url = 'https://';
	}
	
	$url .= $_SERVER['HTTP_HOST'];
	$parsed = explode("/", $_SERVER['REQUEST_URI']);
	$size = sizeof($parsed);
	
	for($x=0; $x<$size-1; $x++){
		$url = $url.'/'.$parsed[$x];
	}
	
	echo $url;
	
	// if( (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) ){
		
		// if( strtolower(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST)) != strtolower($_SERVER['HTTP_HOST']) ){
			
			// referer or request not from the same domain
		// }
	// }
	
	
	// $url = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	
	
	
	// if( $_SERVER['REQUEST_METHOD'] === 'GET' ){
		// echo "It's GET";
	// }
	// else{
		// echo "It's POST";
	// }
	
	
	//exit() when script require some input
	//die() when immediatly want to terminate the script
	// no technical difference in exit() & die()
	
?>

   <pre><?php //print_r($parsed); ?></pre>
	
	