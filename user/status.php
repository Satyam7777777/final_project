<?php
	
	if( session_status() !== PHP_SESSION_ACTIVE ){
		session_start();
	}
	
	
	require_once 'connection.php';
	require_once 'token.php';
	
	
	
	
	class statusManager extends DBConnection {
		
		protected $credTable;
		
		
		public function __construct(){
			
			parent::__construct();
			
			$this->credTable = userCred;
		}
		
		public function getTime($user){
			
			try{
				$con = &$this->getCon();
				
				if( $con->connect_error ){

					throw new Exception("Error : Failed to connect to database");
				}
				else{
					$cmd = "SELECT lastTime FROM $this->credTable where rollno = '$user';";
					
					try{
						$result = $con->query($cmd);

						if( !$result ){
							throw new Exception("Error : Unable to retrieve data from database");
						}
						else{

							$row = mysqli_fetch_array($result);

							if( $row && sizeof($row)>=1 ){
																
								$con->close();
								return $row[0];
							}
							
							$con->close();
							return PHP_INT_MAX;
						}
					}
					catch(Exception $e){
						echo $e;
						return PHP_INT_MAX;
					}
				}
			}
			catch(Exception $e){
				echo $e;
				return PHP_INT_MAX;
			}
			
		}
		
		public function checkOnline($user){
			
			$lasttime = $this->getTime($user);
			
			if( tokenManager::timeDiff($lasttime) ){
				return true;
			}

			return false;
		}
		
		public function updateTime($user){
			
			$con = &$this->getCon();
			
			if( !$con ) return false;
			
			$time = floor(time());
			$cmd = "UPDATE $this->credTable SET lastTime='$time' WHERE rollno='$user'";
			$result = $con->query($cmd);
			
			$con->close();
			
			if( $result ) return true;
			return false;
		}
		
		public function responseAlive($token){
			
			$headers = getallheaders();
			
			if( isset($headers['token']) && $token == $headers['token'] && $_POST['status']=="alive" && $this->checkOnline($_SESSION['user']) ){
				echo "Registered Alive";
				
				$this->updateTime($_SESSION['user']);
			}
			else{
				echo "Registered Failed 1";
			}			
		}
		
	};
	
		
	
	if( isset($_SESSION['user']) && isset($_SESSION['token']) && isset($_POST['status']) ){
		
		$status = new statusManager();
		$status->responseAlive($_SESSION['token']);
	}
	

	
	
?>