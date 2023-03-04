<?php
	
	if( session_status() !== PHP_SESSION_ACTIVE ){
		session_start();
	}
	
	require_once 'connection.php';
	
	
	final class adminManager extends DBConnection{
		
		protected $token;
		protected $timeout;
		protected $credTable;
		protected $user;
		
		public function __construct($user){
			
			parent::__construct($user);
			
			$this->credTable = adminCred;
			$this->user = $user;
			$this->init();
		}
		
		public static function timeDiff($timeS){
			
			$min = floor( (float)(time() - $timeS) / (float)60 );
			return ($min<0) ? false : ($min<=15 ? true : false);
		}
		
		public function getPreviousToken($user){
			
			try{
				$con = &$this->getCon();
				
				if( $con->connect_error ){
					throw new Exception("Error : Failed to connect to database");
				}
				else{
					$cmd = "SELECT * FROM $this->credTable WHERE fname = '$user';";
					
					try{
						$result = $con->query($cmd);
						
						if( !$result ){
							throw new Exception("Error : Unable to retrieve data from database");
						}
						else{
							$row = mysqli_fetch_array($result);
							
							if( $row && sizeof()>=8 && $this->timeDiff((int)$row[3]) ){
								
								$this->token = $row[2];
								$this->timeout = $row[3];
								
								$con->close();
								return true;
							}
							
							$con->close();
							return false;
						}
					}
					catch(Exception $e){
						echo $e;
						return false;
					}
				}
			}
			catch(Exception $e){
				echo $e;
				return false;
			}
			
			return true;
		}
		
		
		public function updateTime($user, $t=false){
			
			$con = &$this->getCon();
			
			if( !$con ) return false;
			
			$time = ( $t==false ? floor(time()) : floor( time() - 3600 ) );
			$cmd = "UPDATE $this->credTable SET lastTime='$time' WHERE fname='$user';";
			$result = $con->query($cmd);
			
			$con->close();
			
			if( $result ) return true;
			return false;
		}
		
		
		private function createNewToken(){
			
			$this->token = bin2hex(random_bytes(16));
		}
		
		public function getToken(){
			return $this->token;
		}
		
		public function init(){
			
			if( isset($_SESSION['admin']) && isset($_POST['user']) && isset($_POST['user']) ){
				$this->createNewToken();
			}
			else if( isset($_SESSION['admin']) && !isset($_POST['user']) ){
				
				$headers = getallheaders();
				
				if( isset($headers['token']) && $headers['token'] == $_SESSION['token'] ){
					// good
				}
				else{
					session_destroy();
				}
			}
			else{
				session_destroy();
			}
		}
		
		public function authenticateToken($token){
			
			if( $this->token == $token ){
				return true;
			}
			return false;
		}

	};
	
?>