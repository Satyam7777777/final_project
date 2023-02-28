<?php
	
	if( session_status() !== PHP_SESSION_ACTIVE ){
		session_start();
	}
	
	require_once 'token.php';
	
	
	function logout(){
		$token = new tokenManager($_SESSION['user']);
		$token->updateTime($_SESSION['user'], true);
		
		unset($_SESSION['user']);
		unset($_SESSION['token']);
		session_destroy();
		
	}
	
	$headers = getallheaders();
	
	
	if( isset($headers['token']) && isset($_SESSION['token']) && $headers['token']==$_SESSION['token'] && isset($_POST['logout']) && $_POST['logout']=="true" ){
		
		logout();
		
		if( session_status() !== PHP_SESSION_ACTIVE ){
			echo "Session destroyed";
		}
		else{
			echo "Session not destroyed";
		}
	}

?>