<?php
	
	if( session_status() !== PHP_SESSION_ACTIVE ){
		session_start();
	}
	
	
	require_once 'connection.php';
	require_once 'status.php';
	
	
	
	
	class tokenManager extends DBConnection{
		
		protected $token;
		protected $timeout;
		protected $credTable;
		protected $user;
		
		
		public function __construct($user){
			
			parent::__construct();
			
			$this->credTable = userCred;
			$this->user = $user;
			$this->init();
		}
		
		public static function timeDiff($timeS){
			
			$min = floor( (float)(time() - $timeS) / (float)60 );
			return ($min<0) ? false : ($min<=15 ? true : false);
		}
		
		private function getPreviousToken($user){
			
			
			try{
				$con = &$this->getCon();

				if( $con->connect_error ){

					throw new Exception("Error : Failed to connect to database");
				}
				else{
					$cmd = "SELECT * FROM $this->credTable where rollno = '$user';";
					
					try{
						$result = $con->query($cmd);

						if( !$result ){
							throw new Exception("Error : Unable to retrieve data from database");
						}
						else{

							$row = mysqli_fetch_array($result);

							if( $row && sizeof($row)>=5 && $this->timeDiff((int)$row[4]) ){
								
								$this->token = $row[3];
								$this->timeout = $row[4];
																
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
			
			$time = $t==false ? floor(time()) : floor( time() - 3600 );
			$cmd = "UPDATE $this->credTable SET lastTime='$time' WHERE rollno='$user'";
			$result = $con->query($cmd);
			
			$con->close();
			
			if( $result ) return true;
			return false;
		}
		
		public function updateToken($user, $token){
			
			$con = &$this->getCon();
			
			if( !$con ) return false;
			
			$cmd = "UPDATE $this->credTable SET token='$token' WHERE rollno='$user'";
			$result = $con->query($cmd);

			$con->close();
			
			if( $result ) return true;
			
			return false;
		}
		
		
		
		
		public function checkOnline($user){
			
			$status = new statusManager();
			return $status->checkOnline($user);
		}
		
		
		
		
		private function createNewToken(){
			
			$this->token = bin2hex(random_bytes(32));
			
			$this->updateTime($this->user);
			$this->updateToken($this->user, $this->token);
		}
		
		public function getToken(){
			return $this->token;
		}
		
		public function init(){
			
			if( isset($_POST['NFT']) && $this->getPreviousToken($this->user) ){
				
				if( $this->checkOnline($this->user) ){
					echo "Its Online";
					$this->updateTime($this->user);
				}
				else{
					
					echo "we are here";
					//session_destroy();
					//header("Location : https");
				}
			}
			else{		
				$this->createNewToken();
			}
		}
		
		
		public function authenticateToken($token){
			
			$headers = getallheaders();
			
			if( isset($headers['token']) && $token == $headers['token'] ){
				return true;
			}
			else{
				echo false;
			}
		}
		
	};
	

?>