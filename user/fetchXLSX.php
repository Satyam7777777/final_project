<?php
	
	if( session_status() !== PHP_SESSION_ACTIVE ){
		session_start();
	}
	
	require_once 'fileHandle/excel/generateXLSX.php';
	
	
	if( isset($_POST['requestItem']) ){
		$_SESSION['requestItem'] = $_POST['requestItem'];
		
		print_r(json_decode(base64_decode($_SESSION['requestItem'])));
	}
	elseif( isset($_SESSION['requestItem']) ){
		$temp = $_SESSION['requestItem'];
		unset($_SESSION['requestItem']);
		
		
		$temp = json_decode(base64_decode($temp));
		
		generateXLSX($temp);
	}

?>