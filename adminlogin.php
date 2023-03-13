<?php
	
	if( session_status() !== PHP_SESSION_ACTIVE ){
		session_start();
	}
	
	require_once 'user/connection.php';
	require_once 'authenticateUser.php';
	
	
	final class GetAdminUserCred extends DBConnection {
		
		private $credTable;
		
		public function __construct(){
			
			parent::__construct();
			$this->credTable = adminCred;
		}
		
		public function getHash($user, $hash){
			
			try{
				$con = &$this->getCon();
				
				if( $con->connect_error ){
					
					throw new Exception("Error : Failed to connect to database");
				}
				else{
					
					$cmd = "SELECT * FROM $this->credTable WHERE fname='$user';";
					
					try{
						$result = $con->query($cmd);
						
						if( !$result ){
							throw new Exception("Error : Unable to retrieve data from database");
						}
						else{
							
							$row = mysqli_fetch_array($result);
							
							if( $row && sizeof($row)>=5 && $row[1]==$hash ){
								//echo $row[1];
								$con->close();
								return true;
							}
							
							
							$con->close();
							return false;
						}
					}
					catch(Exception $e){
						//echo $e;
						return false;
					}
				}
			}
			catch(Exception $e){
				//echo $e;
				return false;
			}
		}
	};
	
	
	$headers = getallheaders();
	
	if( isset($_POST['admin']) && $_POST['admin']=="true" && isset($headers['token']) && isset($_POST['user']) ){
		
		$hash = md5($headers['token']."user@5555");   //  Note : Here token is password hash and not 'token'
		
		$con = new GetAdminUserCred();
		
		if( $con->getHash($_POST['user'], $hash) ){
			
			//echo $headers['token']." ".$_POST['user'];
			
			authenticateAdminUser($_POST['user']);
		}
		else{
			echo "Here";
			// need to redirect to admin login page
			session_destroy();
			echo false;
			exit();
		}
	}
	else{
		echo false;
		exit();
	}
	
	exit();
	
?>