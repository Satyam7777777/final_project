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
  var size = parentSize - hold.offsetLeft - 80;

  hold.style.width = size + "px";
}


function resizeSearch(){

  var hold = document.getElementById("articleSection1Result");
  var parentSize = hold.parentElement.offsetHeight;
  var size = parentSize - hold.offsetTop - 20 - 150;

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

    studentDetailTag.className = "StudentDetails";

    deptTag.className = "StudentDepartment";
    yearTag.className = "StudentYear";
    rollTag.className = "StudentRoll";
    nameTag.className = "StudentName";
    detailTag.className = "Detail";

    deptTag.innerHTML = dept;
    yearTag.innerHTML = year;
    rollTag.innerHTML = roll;
    nameTag.innerHTML = name;
    detailTag.innerHTML = "Details";


      var parentSize = parent.offsetWidth;
      var size = parentSize - nameTag.offsetLeft - 90;

      nameTag.style.width = size + "px";


    studentDetailTag.append(deptTag);
    studentDetailTag.append(yearTag);
    studentDetailTag.append(rollTag);
    studentDetailTag.append(nameTag);
    studentDetailTag.append(detailTag);


    parent.appendChild(studentDetailTag);
}



for(i=0; i<30; i++){
  addStudentDetailResult("Chemistry", 2010, "CHE/10/07", "Rohit Raj");
}
