<?php
	
	if( session_status() !== PHP_SESSION_ACTIVE ){
		session_start();
	}
	

    require_once  'user/connection.php';
	require_once  'authenticateUser.php';


	final class GetUserCred extends DBConnection {

		private $credTable;

		public function __construct(){

			parent::__construct();
			$this->credTable = userCred;
		}


		public function getHash($user, $hash){


			try{
				$con = &$this->getCon();

				if( $con->connect_error ){

					throw new Exception("Error : Failed to connect to database");
				}
				else{
					$cmd = "SELECT * FROM $this->credTable WHERE rollno = '$user';";
					
					try{
						$result = $con->query($cmd);

						if( !$result ){
							throw new Exception("Error : Unable to retrieve data from database");
						}
						else{

							$row = mysqli_fetch_array($result);

							if( $row && sizeof($row)>=3 && $row[2] == $hash ){
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
	
	//if( $_SERVER['REQUEST_METHOD'] === 'POST' ){}
	
	
	
	$headers = getallheaders();
	
	
	if( isset($headers['token']) && isset($_POST['user']) ){
		
		$hash = md5($headers['token']."admin@4444");   // Note : Here token is password hash and not 'token'
		
		$con = new GetUserCred();
		
		if( $con->getHash($_POST['user'], $hash) ){
			
			authenticateUser($_POST['user']);
		}
		else{
			// need to redirect to login page
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
