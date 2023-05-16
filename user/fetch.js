function populateYear(){

    const d = new Date();
    let curYear = d.getFullYear();
    var year = document.getElementById("data_year");

    for (var i = 2010; i <= curYear; i++) {

      var option = document.createElement('option');
      option.value = option.innerHTML = i;
      year.appendChild(option);
    }
}

function makeNameCenter(){

  var hold = document.getElementById("data_name");
  var parentSize = hold.parentElement.offsetWidth;
  var size = parentSize - hold.offsetLeft - 150;

  hold.style.width = size + "px";
}


function resizeSearch(){

  var hold = document.getElementById("articleSection1Result");
  var parentSize = hold.parentElement.parentElement.offsetHeight;
  var size = parentSize - hold.offsetTop - 20 - 150;

  console.log(parentSize);

  hold.style.height = size + "px";
}


function studentNames(){

  var hold = document.getElementById("StudentNames");
  var parentSize = hold.parentElement.offsetWidth;
  var size = parentSize - hold.offsetLeft - 90;

  hold.style.width = size + "px";
}




populateYear();
makeNameCenter();
resizeSearch();
//studentNames();



function addStudentDetailResult(dept, year, roll, name){

    var parent = document.getElementById("articleSection1Result");
    var studentDetailTag = document.createElement("div");

    var deptTag = document.createElement("div");
    var yearTag = document.createElement("div");
    var rollTag = document.createElement("div");
    var nameTag = document.createElement("div");
    var detailTag = document.createElement("div");

	var selector = document.createElement("input");

    studentDetailTag.className = "StudentDetails";

    deptTag.className = "StudentDepartment";
    yearTag.className = "StudentYear";
    rollTag.className = "StudentRoll";
    nameTag.className = "StudentName";
    detailTag.className = "Detail";

	selector.className = "StudentSelector";
	selector.type = "Checkbox";

    deptTag.innerHTML = dept;
    yearTag.innerHTML = year;
    rollTag.innerHTML = roll;
    nameTag.innerHTML = name;
    detailTag.innerHTML = "Details";


      var parentSize = parent.offsetWidth;
      var size = parentSize - nameTag.offsetLeft - 90 - 140;

      nameTag.style.width = size + "px";


    studentDetailTag.append(deptTag);
    studentDetailTag.append(yearTag);
    studentDetailTag.append(rollTag);
    studentDetailTag.append(nameTag);
    studentDetailTag.append(detailTag);

	studentDetailTag.append(selector);


    parent.appendChild(studentDetailTag);



	selector.onclick = function(){
		console.log(roll);
		addRollNoIn(roll);
	}
}



// for(i=0; i<30; i++){
  // addStudentDetailResult("Chemistry", 2010, "CHE/10/07", "Rohit Raj");
// }




function clearFetchArea(){

	clearRollNo();

	var parent = document.getElementById("articleSection1Result");

	while(  parent.firstChild ){
		parent.removeChild(parent.lastChild);
	}
}




class fetchData{

	sendData(){

		var dept = document.getElementById("data_dept").value;
		var year = document.getElementById("data_year").value;
		var roll = document.getElementById("data_rollno").value;
		var name = document.getElementById("data_name").value;
    var degree = document.getElementById("data_degree").value;

		var obj = {"dept" : dept, "year" : year, "roll" : roll, "name" : name, "degree" : degree};
		var formData = JSON.stringify(obj);



		/*
		for(let [name, value] of formData) {
		  console.log(`${name} = ${value}`); // key1 = value1, then key2 = value2
		}
		*/

		//console.log(formData);
		//alert("Working");

		var hold = new AJAX("fetch.php", "POST", true, token);
		hold.init();

		hold.send("fetchQ="+btoa(formData), function(arg){

			var obj = JSON.parse(atob(arg));

			obj.forEach((val) => {
				addStudentDetailResult(val['dept'], val['sYear'], val['rollno'], val['fname']);
			});

		});
	};

};


var holdUniqueRoll = new Set();



function addRollNoIn(rollno){
	holdUniqueRoll.add(rollno);
}

function clearRollNo(){
	holdUniqueRoll.clear();
}


function getXLSN(){

	var dataArray = new Array();

	for(item of holdUniqueRoll.values()){
		//console.log(item);
		dataArray.push(item);
	}

	dataArray = JSON.stringify(dataArray);

	var hold = new AJAX("fetchXLSX.php", "POST", true, token);
	hold.init();

	hold.send("requestItem="+btoa(dataArray), function(arg){
		console.log(arg);
	});

	window.location = "fetchXLSX.php";
}
