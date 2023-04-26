
async function uploadFile(fileupload) {

    let formData = new FormData();           
    formData.append("file", fileupload.files[0]);
    
    let resCode = await fetch('registration.php', {
      method: "POST", 
      body: formData
    });

    // resCode['status']
}


function validateImage(file){

    var filePath = file.value;
         
    // Allowing file type
    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
             
    if (!allowedExtensions.exec(filePath)) {
        file.value = '';
        return false;
    }
    return true;
}



function validateSize(file){
    console.log(file.files[0].size);
    return file.files[0].size <= 2097152;
}



function register(){

    var fileImage = document.getElementById("userFileInput");

    if( fileImage.value == "" ){
        console.log("No Image Selected");
    }
    else if( !validateImage(fileImage) || !validateSize(fileImage) ){
        console.log("Not a valid image");
    }
    else{
        uploadFile(fileImage);
    }
    


    var fname = document.getElementById("firstname").value;
    var mname = document.getElementById("middlename").value;
    var lname = document.getElementById("lastname").value;
    var rollno = document.getElementById("rollno").value;
    var department= document.getElementById("department").value;
    var syear = document.getElementById("startyear").value;
    var eyear = document.getElementById("endyear").value;
    
    var address1 = document.getElementById("address1").value + document.getElementById("address12").value;
    var address2 = document.getElementById("address2").value + document.getElementById("address22").value;
    var pincode = document.getElementById("pincode").value;
    var sociallink1 = document.getElementById("sociallink1").value;
    var sociallink2 = document.getElementById("sociallink2").value;
    var phoneno1 = document.getElementById("phoneno1").value;
    var phoneno2 = document.getElementById("phoneno2").value;
    var email1 = document.getElementById("email1").value;
    var email2 = document.getElementById("email2").value;
    var parentphoneno = document.getElementById("parentphoneno").value;
    var currentcity = document.getElementById("currentcity").value;
    var currentstate = document.getElementById("currentstate").value;

    token = "ddsdfsef";

    var obj = {"fname" : fname, "mname" : mname, "lname" : lname, "rollno" : rollno, "department" : department, "syear" : syear, "eyear" : eyear,
            "address1" : address1, "address2" : address2, "pincode" : pincode, "sociallink1" : sociallink1, "sociallink2" : sociallink2, 
            "phoneno1" : phoneno1, "phoneno2" : phoneno2, "email1" : email1, "email2" : email2, "parentphoneno" : parentphoneno, "currentcity" : currentcity, "currentstate" : currentcity };
    
    var formData = btoa(JSON.stringify(obj));   


    var hold = new AJAX("registration.php", "POST", true, token);
		hold.init();
    
	hold.send("registration="+formData, function(arg){

        console.log(arg);


	});
    
}