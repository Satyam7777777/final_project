<?php
	function getRedirect($back=0){
		
		$url = 'http://';
	
		if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==='on' ){
			$url = 'https://';
		}
		
		$url .= $_SERVER['HTTP_HOST'];	
		$parsed = explode("/", $_SERVER['REQUEST_URI']);
		$size = sizeof($parsed);
		
		for($x=1; $x<($size-1-$back); $x++){
			$url = $url.'/'.$parsed[$x];
		}
		return $url;
	}
?>