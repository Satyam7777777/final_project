function localSTokenExist(){
	if( localStorage.getItem("token") == null ){
		return false;
	}
	return true;
}

function localSGetUser(){
	return localStorage.getItem("user");
}

function localSGetToken(){
	return localStorage.getItem("token");
}

function localSSetUser(user, token){
	localStorage.setItem("user", user);
	localStorage.setItem("token", token);
}

function localSDeleteUser(){
	if( localSTokenExist() ){
		localStorage.removeItem("user");
		localStorage.removeItem("token");
	}
}

function localSSendCred(){
	
	var autoToken = new AJAX("autoToken.php", "POST", true, token);
		
	autoToken.init();
	autoToken.send("login=true&user="+user+"&token="+token, function(arg){
			
		console.log(arg);
			
	});
}



var token = null;
var user = null;

//localSDeleteUser();

if( localSTokenExist() ){
	console.log(localSGetToken());
	token = localSGetToken();
	user = localSGetUser();
}
else{
	console.log("Setting Credendials");
	localSSetUser("CSE/19/06", "12345667");
}
