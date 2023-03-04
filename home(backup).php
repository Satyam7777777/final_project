<?php
	
	if( isset($_GET['default']) && $_GET['default']=="true" ){
	
	// -----------------------------------------------------------------
 ?>
 
 
 <!DOCTYPE html>
<html>
   <head>

     <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
     <meta name="viewport" content="initial-scale=1.0, width=device-width" />

	   <script src="user/ajax.js"></script>
	   <script src="encodeCred.js"></script>

	 <title>Alumni Portal</title>
     <link rel="icon" href="img/titlelogo.png" type="image/x-icon"/>

     <link rel="stylesheet" href="main.css"/>


   </head>

   <body onload="init()" onresize="init()" >

     <header>

        <img id="header-logo1" src="img/logo.png" height=90 />
        <div id="header-logo2">
          <h1 style="color:rgb(36,120,182);font-weight:bolder;margin-bottom:6px;">ALUMNI PORTAL</h1>
          <h3 style="color:rgb(121,119,120);">NIT Arunachal Pradesh</h3>
        </div>

     </header>

    <nav>
      <ul id="options">
        <li onclick="goToHome()">Home</li>
        <li>News</li>
        <li>Register</li>
        <li onclick="goToLogin()">Login</li>
      </ul>

      <img src="img/setting.png" height=30 id="setting" />

    </nav>
    <div id="fillPlace"></div>

    <aside id="shutter-main">

      <div id="shutter-info">
        <div id="shutter-info-txt">Liton Barman</div>
        <div id="shutter-info-explore">Explore</div>
      </div>

      <div class="shutter-container" id="shutter">
        <div class="shutter left"></div>
        <div class="shutter right"></div>
      </div>
    </aside>

    <aside id="news-feed">

    </aside>


    <article id="articleContent">

      <section id="loginAdmin">

        <div id="login">

            <input type="text" name="rollno" id="userIn" placeholder="Roll Number" required/>
            <input type="password" name="pass" id="pass" placeholder="Password" required>
            <input type="submit" id="submit" onclick="grab()" value="Login" style="cursor:pointer;width:310px;margin-top:60px;">

            <div id="loginError">INCORRECT ! Username or Password</div>

            <div id="loginOptions">
              <span onclick="rotateAL()">Admin</span> or <span>Forgot Password !</span>
            </div>

        </div>

        <div id="admin">

          <input type="text" name="rollno" id="adminIn" placeholder="Username" required/>
          <input type="password" name="pass" id="adminpass" placeholder="Password" required>
          <input type="submit" id="adminsubmit" onclick="grabAdmin()" value="Admin Login" style="cursor:pointer;width:310px;margin-top:60px;">

          <div id="adminError">INCORRECT ! Username or Password</div>

          <div id="adminOptions">
            <span onclick="rotateAL()">Login</span> or <span>Forgot Password !</span>
          </div>
        </div>

      </section>

      <section id="register"></section>

    </article>

    <footer id="footer">
      <div class="footerSection">
         <h3>NIT Arunachal Pradesh</h3>
         <hr>
         <p> Jote, District: Papum Pare
Arunachal Pradesh, India - 791113<p>
         <p>+91 0360-2954549</p>
         <p>nitapadmin@nitap.ac.in</p>
         <br/>

         <h3>Academic</h3>
         <hr>
         <p>Scholarship<p>
         <p>Construction activity at Permanent Campus</p>
         <p>Digital Initiatives by MHRD</p>
         <p>Faculty Login</p>
         <p>National Academic Depository (NAD)</p>
         <p>NIT Moodle</p>

         <h3>Quick Link</h3>
         <hr>
         <p>Civil Engineering Student Society</p>
         <p>Electrical Engineering Student Society</p>
         <p>Electronics & Communication Engineering Student</p>
         <p>Mechanical Engineering Student Society</p>
         <p>National Service Scheme(NSS)</p>
         <p>Proceedings and Publications</p>
         <p>StartUp Cell: Prakousol</p>
         <p>Student's Coding Club</p>
         <p>Training & Placement</p>
         <br/>
      </div>
      <br/>

      <div class="actualFooter">
        © Copyright 2023 by NIT Arunachal Pradesh, All Rights Reserved. Developed by
        <span style="color:green;">Akrati Singh, Liton Barman, Satyam</span>
        Privacy Policy | Legal Disclaimer | RTI | Terms & Conditions |
      </div>

    </footer>

   </body>
   <script src="main.js"></script>
</html>

 
 

<?php 
	// -----------------------------------------------------------------
	}
	else{
		
		$url = 'http://';
	
		if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==='on' ){
			$url = 'https://';
		}
		
		$url .= $_SERVER['HTTP_HOST'];
		$parsed = explode("/", $_SERVER['REQUEST_URI']);
		$size = sizeof($parsed);
		
		for($x=0; $x<$size-1; $x++){
			$url = $url.'/'.$parsed[$x];
		}
		
		header("Location: ".$url);
		exit();
	}
?>
