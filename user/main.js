
function hideShow(){
  var hold = document.getElementById('arrow');
  var hold2 = document.getElementById('arrowOption');

  if( hold.getAttribute('data-value')==1 ){
    hold.style.transform = "rotateZ(180deg)";
    hold2.style.display = "block";
    hold.setAttribute('data-value', '0');
  }
  else{
    hold.style.transform = "rotateZ(0deg)";
    hold2.style.display = "none";
    hold.setAttribute('data-value', '1');
  }
}


function hideShowEmoji(){
  var hold = document.getElementById('inputEmojiButton');
  var hold2 = document.getElementById('inputEmoji');

  if( hold.getAttribute('data-value')==1 ){
    hold2.style.display = "block";
    hold.setAttribute('data-value', '0');
  }
  else{
    hold2.style.display = "none";
    hold.setAttribute('data-value', '1');
  }
}



function logout(){

	var me = new AJAX("logout.php", "POST", true, token);
	me.init();
	me.send("logout=true", function(arg){

		s.destruct();

		console.log(arg);

		setTimeout(function(){
			location.assign('http://127.0.0.1/final/final_project/');

		},2000);
	});
}


function resizeArticle(){

  var article = document.getElementById("articleContent");
  var winY = window.innerHeight;
  article.style.height = (winY - 170) + "px";
  resizeChatBox();
}

function resizeChatBox(){

  var chatBox = document.getElementById("chatBox");

  var chatContainer = document.getElementById("chatContainer");
  chatContainer.style.width = chatBox.clientWidth + "px";

  var winY = window.innerHeight;
  chatBox.style.height = (winY - 240) + "px";

  var chatInput = document.getElementById("chatInput");

  var sendButton = document.getElementById("sendButton");
  sendButton.style.width = (sendButton.offsetHeight) + "px";
  var leftSize = 0;
  sendButton.style.right = leftSize + "px";

  var emojiInput = document.getElementById("inputEmojiButton");
  emojiInput.style.width = (emojiInput.offsetHeight) + "px";
  emojiInput.style.right = (sendButton.offsetWidth-10) + "px";

  var inputArea = document.getElementById("inputArea");
  inputArea.style.width = (chatInput.offsetWidth - chatInput.offsetHeight-35 )+"px";

}

function hideShowSections(id){

  for(x=1; x<4; x++){
    if( x==id ) continue;
    document.getElementById("navoption"+x).style.background = "rgba(32,44,170,0.8)";
    document.getElementById("articleSection"+x).style.display = "none";
  }

  document.getElementById("navoption"+id).style.background = "black";
  document.getElementById("articleSection"+id).style.display = "block";

}



function addGroupElement(){

    var groupAsideSection1 = document.getElementById("groupAsideSection1");

    var group = document.createElement("div");
    group.className = "eachGroup";
    var bac = document.createElement("div");
    bac.className = "eachGroupPic";
    var des = document.createElement("div");
    des.className = "eachGroupName";
    des.innerHTML = "Batch 2020 2024";

    group.appendChild(bac);
    group.appendChild(des);
    groupAsideSection1.appendChild(group);
}

addGroupElement();
addGroupElement();
addGroupElement();
addGroupElement();
addGroupElement();
addGroupElement();


function addIndividualElement(){

    var groupAsideSection1 = document.getElementById("groupAsideSection2");

    var group = document.createElement("div");
    group.className = "eachGroup";
    var bac = document.createElement("div");
    bac.className = "eachGroupPic";
    var des = document.createElement("div");
    des.className = "eachGroupName";
    des.innerHTML = "Satyam";

    group.appendChild(bac);
    group.appendChild(des);
    groupAsideSection1.appendChild(group);
}


addIndividualElement();
addIndividualElement();
addIndividualElement();
addIndividualElement();
addIndividualElement();
addIndividualElement();
addIndividualElement();


// mange chat bubble positions



function scrollToBottom(){
  var hold = document.getElementById("chatContainer");
  setTimeout(function(){
    hold.scrollTo(0, (hold.scrollHeight) + 100);
  }, 2);
}




function calculateNextPos(child, chatCtr){

    var posX = (chatCtr.offsetWidth) - (child.clientWidth);

    child.style.left = (posX - 80) + "px";
}



function sizeChats(str){

  var copy = str;
  let splited = copy.split(" ");

  if(splited.length <= 10 || splited.length > 120){

    var size = 0;

    for(x=0; x<splited.length; x++){
      size += (splited[x].length * 11);
    }
    return size;
  }
  return 0;
}

function recvChats(x){
  var chatCtr = document.getElementById("chatContainer");
  var chat = document.createElement("div");

  chat.className = "chats-r";
  //"<svg><polygon points=\"40,20 40,0 10,0\" /></svg>"
  chat.innerHTML = "<svg><polygon points=\"40,20 40,0 10,0\" /></svg>" + x;

  var size = sizeChats(x);
  if( size!=0 ){
    chat.style.width = size+"px";
  }

  //chat.style.top = posY + "px";
  //calculateNextPos(chatCtr);
  chatCtr.appendChild(chat);
  scrollToBottom();
}


function sendChats(x){
  var chatCtr = document.getElementById("chatContainer");
  var chat = document.createElement("div");

  chat.className = "chats-s";
  chat.innerHTML = "<svg><polygon points=\"0,0 40,0 0,20\" /></svg>"+x;

  var size = sizeChats(x);
  if( size!=0 ){
    chat.style.width = size+"px";
  }

  //chat.style.top = posY + "px";
  //calculateNextPos(chatCtr);
  chatCtr.appendChild(chat);
  calculateNextPos(chat, document.getElementById("chatBox"));
  scrollToBottom();
}





recvChats("Hi !");
recvChats("Hi !!! There. ");
recvChats("Jorge, this side.");
recvChats("Regarding project, I send you the spec. and waiting for your reply. Regarding project, I send you the spec. and waiting for your reply. Regarding project, I send you the spec. and waiting for your reply. Regarding project, I send you the spec. and waiting for your reply.");

recvChats("Jorge, this side.");
sendChats("Hi !");
sendChats("Hi !!! There. ");
sendChats("Jorge, this side.");
sendChats("Regarding project, I send you the spec. and waiting for your reply. Regarding project, I send you the spec. and waiting for your reply. Regarding project, I send you the spec. and waiting for your reply. Regarding project, I send you the spec. and waiting for your reply.");
sendChats("Jorge, this side.");


recvChats("Jorge, this side. Jorge, this side. Jorge, this side.  Jorge, this side.");
sendChats("Hi !");

recvChats("Jorge, this side.");
sendChats("Hi !");

recvChats("Jorge, this side.");
sendChats("Hi !");


function sendText(){
  var textInput = document.getElementById("inputArea");

  if(textInput.value=="") return;

  sendChats(textInput.value);

  /*
    Do necessary Ajax call
  */

  textInput.value="";
}


document.getElementById("inputArea").onkeydown = function(e){
  if( e.isTrusted && e.key=="Enter" && e.ctrlKey==false && e.code=="Enter" ){
    sendText();
  }
}


document.getElementById("sendButton").onclick = function(){
  sendText();
}


function addEmojis(){

  var ctx = document.getElementById("inputEmoji");
  var emoji = 128512;

  for(i=0; i<80; i++){
    var el = document.createElement("div");

    el.className = "emojiClass";
    el.innerHTML = "&#"+emoji;
    el.setAttribute('data-value', el.innerHTML);

    //console.log(el.innerHTML);

    el.onclick = function(){
      //console.log(el.innerHTML);
    }

    emoji++;

    ctx.appendChild(el);
  }
}

addEmojis();
