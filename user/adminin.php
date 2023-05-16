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
	<link rel="stylesheet" href="fetch.css">

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
	
	
	
	
	
	<nav>
      <ul>
        <li id="navoption1" onclick="hideShowSections(1)" style="background:black;"></li>
        <li id="navoption2" onclick="hideShowSections(2)"></li>
        <li id="navoption3" onclick="hideShowSections(3)"></li>
      </ul>
    </nav>

    <article id="articleContent">

      <section id="articleSection1" style="display:block;">

          <div id="articleSection1Search">

            <select name="data_dept" id="data_dept">
              <option value="">Select Department</option>
              <option value="cse">Computer Science Engineering</option>
              <option value="me">Mechenical Engineering</option>
              <option value="civil">Civil Engineering</option>
              <option value="ece">Electronic and Electrical Engineering </option>
              <option value="ee">Electronic Engineering</option>
              <option value="bio">Biotechnology</option>
            </select>

            <select name="data_degree" id="data_degree">
              <option value="">Degree</option>
              <option value="BTech">BTech</option>
              <option value="MTech">MTech</option>
              <option value="PHD">PHD</option>
              <option value="MBA">MBA</option>
              <option value="MS">MS</option>
            </select>

            <select name="data_year" id="data_year">
              <option value="">Year</option>
            </select>

            <input type="number" name="data_rollno" id="data_rollno" placeholder="Roll No." />

            <input type="text" name="data_name" id="data_name" placeholder="Name" />
            <button id="data_button" onclick="fetch()">Search</button>
			<button id="download_button" onclick="getXLSN()">Download</button>

          </div>

          <div id="articleSection1Result">

              <!-- generated by Js -->

          </div>

      </section>

      <section id="articleSection2" style="">

        <div id="groupAside">

          <div class="groupAsideSectionDes">Groups :</div>
          <div class="groupAsideSection" id="groupAsideSection1">


          </div>

          <div class="groupAsideSectionDes">Personal :</div>
          <div class="groupAsideSection" id="groupAsideSection2">

          </div>

        </div>

        <div id="chatBox">

          <div id="chatContainer">



          </div>

          <div id="inputEmoji">
          </div>

          <div id="chatInput">

            <input id="inputArea" placeholder="Aa" type="text"/>
            <div id="inputEmojiButton" data-value="1" onclick="hideShowEmoji()"></div>
            <div id="sendButton"></div>
          </div>
        </div>

      </section>

      <section id="articleSection3" style="background:red;"></section>

    </article>
	
	
	
	
	
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
  
  <script src="fetch.js"></script>
  <script>
    function fetch(){
		clearFetchArea();
		var f = new fetchData;
		f.sendData();
    }
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