<?php

	session_start();
	
	if( isset( $_SESSION['AUTH_DONE'] ) ){
		unset( $_SESSION['AUTH_DONE'] );
	}
	
	session_destroy();


?>