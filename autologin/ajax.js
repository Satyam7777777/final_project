class AJAX{

	static url;
	static isToken;
	static token;
	sock = null;
	method = null;
	response = null;

	constructor(url, method, istoken, token=null){

		this.url = url;
		this.method = method;
		this.isToken = istoken;
		this.token = token;
	}

	init(){

		try{
			this.sock = new XMLHttpRequest();
		}
		catch(e1){

			try{
				this.sock = new ActiveXObject("Microsoft.XMLHttp");
			}
			catch(e2){
				console.log(e1.message);
				console.log(e2.message);
				return false;
			}
		}

		return true;
	}

	send(msg, handle=function(arg){}){

		if( !this.sock ) return false;


		this.sock.open(this.method, this.url, true);


		// this is necessary for POST
		this.sock.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		//this.sock.withCredentials = false;

		if( this.isToken ){
			this.sock.setRequestHeader("token", this.token);
		}
		
		
        this.sock.onreadystatechange = function(){

			if(this.readyState==4 && this.status==200){
				handle(this.responseText);
				//arg = this.responseText;
	        }
	    }

		this.sock.send(msg);
	}

};


//var hold = new AJAX("check.php", "POST", true, "Liton Barman");
//hold.init();
//hold.send("name=liton");
