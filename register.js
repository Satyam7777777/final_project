
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
        return false;
    }
    else if( !validateImage(fileImage) || !validateSize(fileImage) ){
        console.log("Not a valid image");
        return false;
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


// verifyWindow SubmitSection


function focusOTPInput(n){
  var otp1 = document.getElementById("digit-1");
  var otp2 = document.getElementById("digit-2");
  var otp3 = document.getElementById("digit-3");
  var otp4 = document.getElementById("digit-4");

  if(n==1){
    otp1.focus();
    otp1.value = "";
    otp2.value = "";
    otp3.value = "";
    otp4.value = "";
  }
  else if( n==2 ){
    if( otp1.value.length==1 ){
      otp2.focus();
    }
  }
  else if( n==3 ){
    if( otp2.value.length==1 ){
      otp3.focus();
    }
  }
  else if( n==4 ){
    if( otp3.value.length==1 ){
      otp4.focus();
    }
  }
  else if(n==5){
    if( otp4.value.length==1 ){
      otp4.blur();
    }
  }
}

function hideShowOTPWINDOW(con){
   var win = document.getElementById("verifyWindow");

   if( con ){
     //win.style.visibility = "visible";
     win.style.display = "block";
     centerVerifyWindow();
     setTimerOTP();
   }
   else{
     //win.style.visibility = "hidden";
     win.style.display = "none";
     centerVerifyWindow();
   }
}



var otpTimer;
var otpCount = 120;

function setTimerOTP(){

  document.getElementById("resendButton").style.visibility = "hidden";
  clearInterval(otpTimer);
  otpCount = 120;
  otpTimer = setInterval(function(){
    otpCount--;
    document.getElementById("verifyWindowCountdown").innerHTML = otpCount;
    if( otpCount==0 ){
      document.getElementById("resendButton").style.visibility = "visible";
      clearInterval(otpTimer);
    }
  }, 1000);
}

function verifyOTP(){
  var otp = [1, 2, 3, 4];
  var otp1 = document.getElementById("digit-1");
  var otp2 = document.getElementById("digit-2");
  var otp3 = document.getElementById("digit-3");
  var otp4 = document.getElementById("digit-4");

  if( otp1.value==otp[0] && otp2.value==otp[1] && otp3.value==otp[2] && otp4.value==otp[3] ){
    return true;
  }
  else{
    alert("Wrong OTP");
    return false;
  }
}

function clearOTP(){
  document.getElementById("digit-1").value = "";
  document.getElementById("digit-2").value = "";
  document.getElementById("digit-3").value = "";
  document.getElementById("digit-4").value = "";

  focusOTPInput(1);
  setTimerOTP();
}


function submitForm(){

  if(verifyOTP()){
    register();
    pdfNow();
  }
}


function cancleOTP(){
  hideShowOTPWINDOW(false);
  clearOTP();
}
