<?php 
	
	require_once 'redirect.php';
	
	if( isset($same) && $same==true ){
?>

<html>
  <head>
	<script id="testHide1"><?php include 'autologin/ajax.js'; ?></script>
	<script id="testHide2"><?php include 'autologin/autoToken.js'; ?></script>

    <style>
      body{background: rgb(32,44,70);}
      .lds-ellipsis {
        position:fixed;
        top:49%;
        left:49%;
        display: inline-block;
        width: 80px;
        height: 80px;
      }
      .lds-ellipsis div {
        position: absolute;
        top: 33px;
        width: 13px;
        height: 13px;
        border-radius: 50%;
        background: #fff;
        animation-timing-function: cubic-bezier(0, 1, 1, 0);
      }
      .lds-ellipsis div:nth-child(1) {
        left: 8px;
        animation: lds-ellipsis1 0.6s infinite;
      }
      .lds-ellipsis div:nth-child(2) {
        left: 8px;
        animation: lds-ellipsis2 0.6s infinite;
      }
      .lds-ellipsis div:nth-child(3) {
        left: 32px;
        animation: lds-ellipsis2 0.6s infinite;
      }
      .lds-ellipsis div:nth-child(4) {
        left: 56px;
        animation: lds-ellipsis3 0.6s infinite;
      }
      @keyframes lds-ellipsis1 {
        0% {
          transform: scale(0);
        }
        100% {
          transform: scale(1);
        }
      }
      @keyframes lds-ellipsis3 {
        0% {
          transform: scale(1);
        }
        100% {
          transform: scale(0);
        }
      }
      @keyframes lds-ellipsis2 {
        0% {
          transform: translate(0, 0);
        }
        100% {
          transform: translate(24px, 0);
        }
      }
    </style>
  </head>
  <body>
    <div id="loader" class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
  </body>
  <script id="testHide3">
    var loader = document.getElementById("loader");
    window.onload = function(){
      loader.style.top = ((window.innerHeight - loader.clientHeight) / 2)+"px";
      loader.style.left = ((window.innerWeight - loader.clientWidth) / 2)+"px";
    }
	
	var autoLogin = true;
	var token = null;
	var user = null;
	
	
	if( autoLogin ){
		
		if( localSTokenExist() ){
			//console.log(localSGetToken());
			token = localSGetToken();
			user = localSGetUser();
		}
		localSSendCred();
	}
	
	document.getElementById("testHide1").remove();
	document.getElementById("testHide2").remove();
	document.getElementById("testHide3").remove();
	
  </script>
</html>


<?php
	}
	else{
		$url = getRedirect();
		//echo "here";
		header("Location: ".$url);
	}
?>