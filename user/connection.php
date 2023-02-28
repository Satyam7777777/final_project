<?php

    define("address",  "localhost");
    define("username", "root");
    define("password", "");
    define("dbname",   "alumni_portal");

    define("userCred", "usercred");
   
   
    abstract class DBConnection {
		
		protected $address;
	    protected $username;
	    protected $password;
	    protected $dbname;   
	   
	    public function __construct(){
			
		    $this->address  = address;
		    $this->username = username;
		    $this->password = password;
		    $this->dbname   = dbname;
		}
		
		public function &getCon(){
			
			$con = new mysqli( $this->address, $this->username, $this->password, $this->dbname );
			
			if( $con->connect_error ){
				$con = false;
			}
			
			return $con;
		}
	};

?>