<?php
	
	$hash = null;
	
	if( isset($_GET['pass']) ){
		$hash = md5($_GET['pass']."admin@4444");
	}
	else if( isset($_GET['passAdmin']) ){
		$hash = md5($_GET['passAdmin']."user@5555");
	}
	echo $hash." => ".strlen($hash);
?>	