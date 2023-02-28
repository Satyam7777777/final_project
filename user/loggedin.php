<?php
	
	if( session_status() !== PHP_SESSION_ACTIVE ){
		session_start();
	}
	
	
	if( isset($_SESSION['user']) && isset($_SESSION['token']) ){
?>

<html>
  <head>
	
	<meta id="token" name="token" data-content="<?php echo $_SESSION['token']; ?>" />
  
  
    <link rel="stylesheet" href="main.css">
	<script src="ajax.js"></script>
    <script src="main.js"></script>
	<script src="status.js"></script>
  </head>
  <body>

    <header>
      <div id="logo"></div>
      <div id="logoInfo">ALUMNI PORTAL <span>NIT Arunachal Pradesh</span> </div>
      <div id="bell"></div>
      <div id="user"></div>
      <div id="arrow" onclick="hideShow()" data-value="1"></div>

      <div id="arrowOption">
          <div onclick="logout()" class="arrowOption1">LOGOUT <img src="img/logout.png"/></div>
      </div>

    </header>

    <footer>
      © Copyright 2023 by NIT Arunachal Pradesh, All Rights Reserved. Developed by
      <span style="color:green;">Akrati Singh, Liton Barman, Satyam</span>
      Privacy Policy | Legal Disclaimer | RTI | Terms & Conditions |
    </footer>
  </body>
  <script>
  
  
	const token = document.getElementById('token').getAttribute('data-content');
	
	console.log(token);
  
    var s = new statusManager();
	s.init();

  </script>
</html>


<?php
	}
	else{
		echo "<h1>User Not Set</h1>";
	}
	
	exit();
?>