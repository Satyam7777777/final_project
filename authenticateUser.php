<?php
	
	if( session_status() !== PHP_SESSION_ACTIVE ){
		session_start();
	}
	
	require_once 'user/token.php';
	require_once 'user/adminManager.php';
		
	
	function authenticateUser($user){
		
		echo "User Authenticated";
		
		$_SESSION['user'] = $user;
		$token = new tokenManager($user);
		
		$_SESSION['token'] = $token->getToken();
	}
	
	function authenticateAdminUser($user){
		
		echo  "User Authenticated";
		
		$_SESSION['user'] = $user;
		$_SESSION['admin'] = true;
		$token = new adminManager($user);
		
		$_SESSION['token'] = $token->getToken();
	}
	
?>