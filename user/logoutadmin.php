<?php
	
	if( session_status() !== PHP_SESSION_ACTIVE ){
		session_start();
	}
	
	
	require_once 'adminManager.php';
	
	
	function logout(){
		$token = new adminManager($_SESSION['user']);
		$token->updateTime($_SESSION['user'], true);
		
		 unset($_SESSION['admin']);
		 unset($_SESSION['user']);
		 unset($_SESSION['token']);
		 session_destroy();
		
	}
	
	$headers = getallheaders();
	
	
	if( isset($headers['token']) && isset($_SESSION['token']) && $headers['token']==$_SESSION['token'] && isset($_POST['logoutadmin']) && $_POST['logoutadmin']=="true" ){
		
		logout();
		
		if( session_status() !== PHP_SESSION_ACTIVE ){
			echo "Session destroyed";
		}
		else{
			echo "Session not destroyed";
		}
	}
?>