
function validate(x, y){

	if( x.length==0 && y.length==0 ){
		return 3;
	}
	else if( !(x.length > 0 && x.length <= 20) || x.match(/[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\?~]/) ){
		return 1;
	}
	else if( !(y.length >= 3 && y.length <= 20) ){
		return 2;
	}

	return 0;
}


var loginErrorCount = 0;


function tryLogin(user, pass){

	var ajaxobj = new AJAX("login.php", "POST", true, pass);
	ajaxobj.init();
	ajaxobj.send("user="+user, function(arg){
		if( arg != "User Authenticated" ){
			console.log("Failed : Login Credendials Incorrect"+arg);
			incorrectUP("Incorrect ! Username or Password");
		}
		else{
			location.assign('http://127.0.0.1/final/final_project/user/loggedin.php');
		}
	});

}


function makeLoginDelay(){

	document.getElementById("userIn").disabled = true;
	document.getElementById("pass").disabled = true;
	document.getElementById("submit").disabled = true;

	var time = 30;
	var t = setInterval(delayText, 1000);

	function delayText(){
		var txt = "Try login after " + time-- + " sec";
		incorrectUP(txt);

		if( time<0 ){
			clearInterval(t);
			document.getElementById("userIn").disabled = false;
			document.getElementById("pass").disabled = false;
			document.getElementById("submit").disabled = false;
			document.getElementById("userIn").value = "";
			document.getElementById("pass").value = "";
			incorrectUP("Try login now");
		}
	}
}

function grab(){

	var val = validate(document.getElementById('userIn').value, document.getElementById('pass').value);

	if( loginErrorCount==3 ){
		makeLoginDelay();
		return;
	}

	if( val==3 ){
		incorrectUP("Invalid Username & Password !");
		loginErrorCount++;
	}
	else if( val==1 ){
		incorrectUP("Invalid Username !");
		loginErrorCount++;
	}
	else if( val==2 ){
		incorrectUP("Invalid Password !");
		loginErrorCount++;
	}
	else{
		tryLogin(document.getElementById('userIn').value, document.getElementById('pass').value);
	}

}



function tryadminLogin(user, pass){

	var ajaxobj = new AJAX("adminlogin.php", "POST", true, pass);
	ajaxobj.init();
	ajaxobj.send("admin=true&user="+user, function(arg){
		if( arg != "User Authenticated" ){
			console.log("Failed : Login Credendials Incorrect"+arg);
			incorrectadminUP("Incorrect ! Username or Password");
		}
		else{
			location.assign('http://127.0.0.1/final/final_project/user/adminin.php');
		}
	});

}


function grabAdmin(){

	var val = validate(document.getElementById('adminIn').value, document.getElementById('adminpass').value);

	//console.log(document.getElementById('adminIn').value+" "+document.getElementById('adminpass').value);
	tryadminLogin(document.getElementById('adminIn').value, document.getElementById('adminpass').value);
}
