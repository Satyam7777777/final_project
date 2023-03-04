
class statusManager{
	
	time = null;
	t = null;
	
	constructor(){
		this.time = 15000;
	}
	
	init(){
		this.t = setInterval(this.callAlive, this.time);
	}
	
	destruct(){
		console.log("Status calling stopped");
		clearInterval(this.t);
	}
	
	
	callAlive(){
		
		var hold = new AJAX("status.php", "POST", true, token);
		hold.init();
		hold.send("status=alive", function(arg){
		
			if( arg != "Registered Alive" ){
				console.log("Offline : "+arg);
				// redirect
			}
			else{
				console.log("Online : "+arg);
			}
		});
	};
	
};


//var s = new statusManager();
//s.init();

