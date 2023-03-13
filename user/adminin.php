<?php
	
	if( session_status() !== PHP_SESSION_ACTIVE ){
		session_start();
	}
	
	require_once 'fileHandle/getProfile.php';
	
	
	if( isset($_SESSION['user']) && isset($_SESSION['token']) && isset($_SESSION['user']) ){
		
		
?>

<html>
  <head>
	
	<meta id="user" name="user" data-content="<?php echo $_SESSION['user']; ?>" />
	<meta id="token" name="token" data-content="<?php echo $_SESSION['token']; ?>" />
	<meta id="profilePicURL" name="profilePIC" data-content="<?php
		$getP = new GetProfile(true);
		$image = $getP->getProfile();
		
		if( $image=="" ){
			echo "NULL";
		}
		else{
			echo "userImg/".$image;
		}
	?>" />
  
  
    <link rel="stylesheet" href="main.css">
	<script src="ajax.js"></script>
    <script src="adminmain.js"></script>
  </head>
  <body>

    <header>
      <div id="logo"></div>
      <div id="logoInfo">ALUMNI PORTAL <span>NIT Arunachal Pradesh</span> </div>
      <div id="bell"></div>
      <div id="userProfile"></div>
      <div id="arrow" onclick="hideShow()" data-value="1"></div>

      <div id="arrowOption">
          <div onclick="logout()" class="arrowOption1">LOGOUT <img src="img/logout.png"/></div>
      </div>

    </header>
	
	<br/><br/><br/><br/><br/>
	<h1 id="report" style="color:#fff;"><?php echo $_SESSION['token']; ?></h1>

    <footer>
      © Copyright 2023 by NIT Arunachal Pradesh, All Rights Reserved. Developed by
      <span style="color:green;">Akrati Singh, Liton Barman, Satyam</span>
      Privacy Policy | Legal Disclaimer | RTI | Terms & Conditions |
    </footer>
  </body>
  <script>
  
	const user = document.getElementById('user').getAttribute('data-content');
	const token = document.getElementById('token').getAttribute('data-content');
	
	 

	// var scs = new AJAX("test2.php", "POST", true, token);
	
	// if( scs.init() ){
		// console.log("perfect");
		// scs.send("", function(arg){
			// console.log(arg);
		// });
	// }
	
	var userPic = document.getElementById("profilePicURL").getAttribute("data-content");;
	
	if( userPic != "NULL" ){
		document.getElementById("userProfile").style.backgroundImage = "url("+userPic+")";
	}
	
	//location.assign('http://127.0.0.1/final/final_project/user/'+userPic);
	
	
  </script>
</html>


<?php
	}
	else{
		
		// redirect to main
		echo "<h1>User Not Set</h1>";
	}
	
	/*
	
	$getP = new GetProfile(true);
		$image = $getP->getProfile();
		
		if( $image=="" ){
			echo "NULL";
		}
		else{
			echo $image;
		}
	
	*/
	
	exit();
?>