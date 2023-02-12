<?php

    require_once 'connection.php';
	
	
	final class GetUserCred extends DBConnection {
		
		private $credTable;
		
		public function __construct(){

			parent::__construct();
			$this->credTable = userCred;
		}
		
		
		public function getHash($user, $hash){
			
			
			try{
				$con = new mysqli( $this->address, $this->username, $this->password, $this->dbname );
				
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
							
							if( $row && $row[2] == $hash ){
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
			
		}
		
	};
	
	
	$con = new GetUserCred();

	
	
	session_start();
	
	
	if( isset( $_POST['rollno'] ) && isset( $_POST['pass'] ) ){
		
		if( $con->getHash($_POST['rollno'], $_POST['pass']) ){
			
			$_SESSION['AUTH_DONE'] = true;
			
		}
		else{
			$_SESSION['AUTH_DONE'] = false;
		}
		
	}
	






	
?>