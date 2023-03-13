<?php
	
	require_once 'connection.php';
	require_once '../redirect.php';
	
	
	if( session_status() !== PHP_SESSION_ACTIVE ){
		session_start();
	}
	
	
	final class GetProfile extends DBConnection {
		
		protected $credTable;
		protected $admin;
		
		public function __construct($admin=false){
			
			parent::__construct();
			$this->admin = $admin;
			$this->credTable = ($admin ? adminCred : userCred);
		}
		
		public function getProfile(){
			
			try{
				$con = &$this->getCon();
				
				if( $con->connect_error ){
					throw new Exception("Error : Failed to connect to Database");
				}
				else{
					
					$cmd = ($this->admin ? "SELECT profile FROM adminCred WHERE fname='".$_SESSION['user']."';" : "SELECT profile FROM $this->credTable where rollno='".$_SESSION['user']."';");
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
						return true;
					}
				}
			}
			catch(Exception $e){
				echo $e;
				return false;
			}
		}
		
	}
	
	// $getProfile = new GetProfile(true);
	// echo $getProfile->getProfile();
	
	if( isset($_SESSION['user']) && isset($_SESSION['token']) ){
		
		$getProfile = null;
		
		if( isset($_SESSION['admin']) ){
			$getProfile = new GetProfile(true);
		}
		else{
			$getProfile = new GetProfile(false);
		}
		
		if( !isset($same) ){
			echo $getProfile->getProfile();
		}
	}
	else{
		$url = getRedirect(1);
		header("Location: ".$url);
	}
?>