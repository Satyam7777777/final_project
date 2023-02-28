<?php
	
	if( session_status() !== PHP_SESSION_ACTIVE ){
		session_start();
	}
	
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
			setcookie($this->user, $this->token, $time, "/", "", false, true);
		}
		
		public function logout(){
			
			$time = (time() - 3600);
			setcookie($this->user, $this->token, $time, "/", "", false, true);
		}
		
		public function getToken(){
			
			if( isset($_COOKIE[$this->user]) ){
				return $_COOKIE[$this->user];
			}
			return false;
		}
		
		public function validate(){
			
			$token1 = $this->getToken();
			$headers = getallheaders();
			
			$token2 = "random_byte@123";
			$user = null;
			
			if( isset($headers['token']) && isset($_POST['user']) && isset($_POST['login']) && $_POST['login'] == "true" ){
				$token2 = $headers['token'];
				$user = $_POST['user'];
			}
			else{
				return false;
			}
			
			echo $user."  ".$token2;
			
			if( strcmp($token1, $token2) ){ // need to comapred the stored token from database
				return true;
			}
			
			return false;
		}
		
	};
	
	$autoToken = new autoToken("CSE/19/05", "Liton_Barman");
	
	$autoToken->validate();

?>