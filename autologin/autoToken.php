<?php
	
	if( session_status() !== PHP_SESSION_ACTIVE ){
		session_start();
	}
	
	
	require_once '../user/token.php';
	require_once  '../authenticateUser.php';
	
	
	
	final class autoToken{
		
		protected $user;
		protected $token;
		protected $expire;
		
		public function __construct($user, $token){
			
			$this->user = $user;
			$this->token = $token;
		}
		
		public function login(){
			
			$time = (time() + 3600);
			setcookie('user', $this->user, $time, "/", "", false, true);
			setcookie('token', $this->token, $time, "/", "", false, true);
		}
		
		public function logout(){
			
			$time = (time() - 3600);
			setcookie($this->user, $this->token, $time, "/", "", false, true);
		}
		
		public function getToken(){
			
			if( isset($_COOKIE['token']) ){
				return $_COOKIE['token'];
			}
			return false;
		}
		
		public function validate(){
			
			$token1 = $this->getToken();
			$headers = getallheaders();
			$token2 = $headers['token'];
			
			if( $token1 == $token2 && $this->token == $token2 ){
				return true;
			}
			
			
			return false;
		}
		
	};
	
	
	$headers = getallheaders();
	
	if( isset($headers['token']) && isset($_POST['user']) && isset($_POST['autologin']) && $_POST['autologin'] == "true" ){
		
		$tokenmanager = new tokenManager($_POST['user']);
		$token = null;
		
		if( $tokenmanager->getPreviousToken($_POST['user']) ){
			$token = $tokenmanager->getToken();
		}
		$autotoken = new autoToken($_POST['user'], $token);
		
		
		if( $autotoken->validate() ){
			echo "credendials success";
			
			$_SESSION['user'] = $_POST['user'];
			$token = new tokenManager($_POST['user']);			
			$_SESSION['token'] = $token->getToken();
		}
		else{
			echo "credendials failed";
		}
	}		
	else if( !isset($same) ){
		
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

	}
?>