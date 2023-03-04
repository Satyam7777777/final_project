var screenX = 0;
var screenY = 0;
var lg1 = document.getElementById("header-logo1");
var lg2 = document.getElementById("header-logo2");
var loginAdmin = document.getElementById("loginAdmin");
var incUP = document.getElementById("loginError");
var incadminUP = document.getElementById("adminError");



// nav setting

var setting = document.getElementById("setting");
var options = document.getElementById("options");
var visible = false;

setting.onclick = function(){
  if( visible ){
    options.style.display = "none";
    visible = !visible;
  }
  else{
    options.style.display = "block";
    visible = !visible;
  }
}


// nav setting end


function init(){

   screenX = window.innerWidth;
   screenY = window.innerHeight;

   document.getElementById("articleContent").scrollIntoView();

   manageHeader();

   if(screenX > 768){
     options.style.display = "block";
   }
   else{
     options.style.display = "none";
   }

   // algin the Login
   loginAdmin.style.left = ((screenX - login.offsetWidth)/2) + "px";
   //alert( (screenX - login.offsetLeft)/2 );
}

function manageHeader(){

  if( screenX <= 768 ){

    lg1.style.height = "170px";
    lg1.style.left = "20px";
    lg1.style.top = "30px";
    lg2.style.left = "200px";
    lg2.style.top = "50px";
  }
  else{

    lg1.style.height = "90px";
    lg1.style.left = "150px";
    lg1.style.top = "10px";
    lg2.style.left = "270px";
    lg2.style.top = "10px";
  }
}



/* Animation area */

var images = ["img/1.jpg", "img/2.jpg"];
var container = document.getElementById("shutter-main");
var shutter = document.getElementById("shutter");
var explore = document.getElementById("shutter-info-explore");
var i = 0;

function doFlip(){
  shutter.classList.add("shutterAnim");
  setTimeout(function(){
    shutter.classList.remove("shutterAnim");
    i++;
    if( i==images.length ){
      i=0;
    }
    container.style.backgroundImage = "url("+images[i]+")";
    setTimeout(doFlip, 2500);

  }, 800);
}

doFlip();

/* Animation area end */

/* Background animation */

var ctx = document.getElementById("articleContent");

function light(x,y, posx, posy, time, lifespan){

  var dirX = x, dirY = y;

  var li = document.createElement("div");
  li.classList.add("lights");
  li.style.top = posy + "px";
  li.style.left = posx + "px";
  ctx.appendChild(li);

  x = li.offsetLeft;
  y = li.offsetTop;

  function move(){

    x += dirX;
    y = y - dirY;

    li.style.top = y + "px";
    li.style.left = x + "px";
  }

  var t = setInterval(move, time);
  setTimeout(function(){
    clearInterval(t);
    li.remove();
  }, lifespan);
}

setInterval(function(){
  new light(1.6, 1.6, Math.random()*1320 , Math.random()*1134 + 180, Math.random()*100 + 20, Math.random()*12000 + 6000);
}, 300);


/* Background animation end */


function goToHome(){
  document.getElementById("fillPlace").scrollIntoView();
}

function goToLogin(){
  document.getElementById("articleContent").scrollIntoView();
}


function incorrectUP(msg){
  incUP.innerHTML = msg;
  incUP.style.display = "block";
}

function incorrectadminUP(msg){
  incadminUP.innerHTML = msg;
  incadminUP.style.display = "block";
}

var rotateAdminLogin = true;

function rotateAL(){
  var loginAdmin = document.getElementById("loginAdmin");

  if( rotateAdminLogin ){
      loginAdmin.classList.remove("ro2");
      loginAdmin.classList.add("ro1");
  }
  else{
      loginAdmin.classList.remove("ro1");
      loginAdmin.classList.add("ro2");
  }

  rotateAdminLogin = !rotateAdminLogin;
}

rotateAL();
