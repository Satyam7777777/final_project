<?php

   define("address",  "localhost");
   define("username", "root");
   define("password", "");
   define("dbname",   "alumni_portal");

   define("userCred", "usercred");
   
   
   class DBConnection {
		
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
	};

?>