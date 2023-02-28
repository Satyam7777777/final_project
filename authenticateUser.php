<?php
	
	if( session_status() !== PHP_SESSION_ACTIVE ){
		session_start();
	}
	
	require_once 'user/token.php';
	
		
	
	function authenticateUser($user){
		
		echo "User Authenticated";
		
		$_SESSION['user'] = $user;
		$token = new tokenManager($user);
		
		$_SESSION['token'] = $token->getToken();
	}
?>