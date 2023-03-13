<?php
	
	function getFileType($file){
		$parsed = explode("/", $file['type']);
		return $parsed[1];
	}
	
	function validImage($str){
		
		if( $str=="jpg" || $str=="png" || $str=="gif" || $str=="jpeg" ){
			return true;
		}
		return false;
	}
	
		
	if( isset($_FILES['fileToUpload']) && validImage(getFileType($_FILES['fileToUpload'])) && $_FILES['fileToUpload']['size'] < 10485000 ){
		
		$file = $_FILES['fileToUpload'];
		$target_dir = "../userImg/";
		$extension = getFileType($file);
		$name = bin2hex(random_bytes(16)).'.'.$extension;
		$target_file = $target_dir.$name;
		
		if( move_uploaded_file($file['tmp_name'], $target_file) ){
			//echo "File Uploaded";
			echo $name;
		}
		else{
			echo "Something went wrong";
		}
	}
	else{
		echo "Invalid or No Image";
	}
?>









<?php
	/*
	//$targetDir = "fileHandle";
	
	echo $_FILES['fileToUpload']['name']."<br/>";
	echo $_FILES['fileToUpload']['full_path']."<br/>";
	echo $_FILES['fileToUpload']['type']."<br/>";
	echo $_FILES['fileToUpload']['tmp_name']."<br/>";
	echo $_FILES['fileToUpload']['error']."<br/>";
	echo $_FILES['fileToUpload']['size']."<br/>";
	
	//getimagesize($_FILES['fileToUpload']['tmp_name']);
	
	
	echo filesize($_FILES['fileToUpload']['tmp_name'])."<br/>";
	echo pathinfo()."<br/>";
	*/
?>

<pre><?php //print_r(getimagesize($_FILES['fileToUpload']['tmp_name'])); ?></pre>