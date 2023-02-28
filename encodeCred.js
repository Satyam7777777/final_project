
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

function grab(){

	var val = validate(document.getElementById('userIn').value, document.getElementById('pass').value);

	if( val==3 ){
		incorrectUP("Invalid Username & Password !");
	}
	else if( val==1 ){
		incorrectUP("Invalid Username !");
	}
	else if( val==2 ){
		incorrectUP("Invalid Password !");
	}
	else{
		tryLogin(document.getElementById('userIn').value, document.getElementById('pass').value);
	}

}
