<?php
	
	//error_reporting(0);
	//set_time_limit(5);
	
	if( isset($_POST['autologin']) && isset($_POST['user']) && isset($_POST['token']) ){
		
		
		
	}
	else{		
		$same = true;
		include 'autologin/autoLogin.php';
	}

?>