<?php
// Start the session
session_start();
?>

<html lang="en">

<head> 
    <title> QuizSite  </title>
    <link href="main.css" rel="stylesheet">
    <link rel="icon" href="images/icon.png" type="image/gif">
</head>

<body>
<h1 class="centerText heading">Create a Quiz</h1>

    <div id="divQuiz">
        <p id="iQuiz" class="centerText font40 bold"></p>

<form action="process_quiz.php" method="post">

<input type="hidden" id="quiz" name="quiz">         

        <div id="DivTypeQuistion">

            <label class="font2_2 marginRT">Choose question type: </label> 
            <label class="font2_2">MCQ </label>
            <input type="radio" id="mcq" name="tQuis" onclick="show('block')" class="typeQuistion"> 
            <label class="font2_2">True / False </label>
            <input type="radio" id="tf" name="tQuis" onclick="show('block')" class="typeQuistion">
            <br>
             
            <div id="divQuistion"> 
                <label class="font2_2">Enter question: </label> 
                <input type="text" id="quistion" class="font2_2">   
               </div>

            <div id="answerMCQ" style="display:none;">
                <input type="radio" id="answerMr1" name="answerM" class="marginTP radioSize">
                <input type="text" id="answerMt1" class="font1_2 marginTP">
                <br>
                <input type="radio" id="answerMr2" name="answerM" class="marginTP radioSize">
                <input type="text" id="answerMt2" class="font1_2 marginTP">
                <br>
                <input type="radio" id="answerMr3" name="answerM" class="marginTP radioSize">
                <input type="text" id="answerMt3" class="font1_2 marginTP">
                <br>
                <input type="radio" id="answerMr4" name="answerM" class="marginTP radioSize">
                <input type="text" id="answerMt4" class="font1_2 marginTP">
                <br>
            </div>

            <div id="answerTF" style="display:none;">
                <input type="radio" id="answertfr1" name="answertf" class="marginTP radioSize">
                <input type="text" id="answertft1" class="font1_2 marginTP" value="True" disabled>
                <br>
                <input type="radio" id="answertfr2" name="answertf" class="marginTP radioSize">
                <input type="text" id="answertft2" class="font1_2 marginTP" value="False" disabled>
                <br>
            </div>
            


        </div>

        <div class="marginTP" style="margin-left: 3%;display:none;" id="quizButton">
            <input type="button" id="add" value="Add question" class="button" style="width: auto;height: 5%;margin: 1%;" onclick="checkSelectedAnswer()">
            <input type="submit" id="create" value="Create a quiz" onclick="createQuiz()" class="button" style="width: auto;height: 5%; margin: 1%;">
        </div>

</form>

</div>

</body> 
</html>  

<script>

var timer = null;

function Quiz(question,id,timer){

this.question = question;
this.id = id;
this.timer=timer;

}


var quistions = [];
var quiz = null;


var id = generateQuizId();


function checkSelectedAnswer(){


    var mcq = document.getElementById("mcq");
    var tf = document.getElementById("tf");
    var quis = document.getElementById("quistion");

    var shown = (mcq.checked) ? "answerM" : "answertf";

    var check = true;
    var checkValue = false;
    var answers = [];
// store answer
    


  if (quis.value == "") {alert("Please insert your quistion");

} else {

    var answer = document.getElementsByName(shown);

    

  for (var i = 0; i < answer.length; i++) {

    if (answer[i].checked) {
        check = false;
      // Execute the code here 

    }
    var name = shown+"t"+(i+1);
    if (document.getElementById(name).value == ""){
        checkValue = true;
    }
    

// get the element(answer) here and add them into array || document.getElementById(name).value || answer[i].checked
var ans = {  answer: document.getElementById(name).value , correct: answer[i].checked  };
    answers.push(ans);

  } 
  if (checkValue) alert("Please insert your answers");
  else if (check) alert("Please select the correct answer");
  

  }

  if (!check && !checkValue){
      // quistion added
      
// add quistion and answer list into object

// quiz.value 
var question = {question: quis.value,answer: answers, Shown: shown};
    quistions.push(question);

      mcq.checked =false;
      tf.checked = false;
      show('none');
  } 
  
}

function createQuiz(){
    if(quistions.length != 0){
        while(true){
        timer = window.prompt("How long quiz will be in minutes?")

        if(timer > 0){
            quiz= new Quiz(quistions,id,timer);
            var quizJSON = JSON.stringify(quiz);
            var quizH = document.getElementById("quiz");
            quizH.value = quizJSON;
            break;
        }else{
            alert("Please write number of minutes again");
        }
        
        }
    
    }else{
        alert("Please insert at least one question");
    }
}

function show(visible) {

    var divmcq = document.getElementById("answerMCQ");
    var divtf = document.getElementById("answerTF");
    var divbut = document.getElementById("quizButton");
    var divQuistion = document.getElementById("divQuistion");

    var mcq = document.getElementById("mcq");
    var tf = document.getElementById("tf");

    var resultM = (mcq.checked) ? "block" : "none";
    var resultTF= (tf.checked) ? "block" : "none";

    divmcq.style.display = resultM;
    divtf.style.display = resultTF;
    divbut.style.display = "block";
    divQuistion.style.display = visible;


   
        var quistion = document.getElementById("quistion");

    for (var i = 0; i < 2 ; i++) {
        var radio = document.getElementById("answertfr"+(i+1));
        radio.checked = false;

    }  

    for (var i = 0; i < 4 ; i++) {
        var radio = document.getElementById("answerMr"+(i+1));
        var text = document.getElementById("answerMt"+(i+1));

        radio.checked = false;
        text.value = text.defaultValue; 
    }
    quistion.value = quistion.defaultValue;

    
   /* for (var i = 0; i < 4; i++) {

var element = document.getElementById("answer");

        var para = document.createElement("input");
        para.setAttribute("type", "radio");
        para.setAttribute("id", i+"r");
        para.setAttribute("name", "Answer");
        element.appendChild(para);

        para = document.createElement("input");
        para.setAttribute("type", "text");
        para.setAttribute("id", i+"t");
        para.setAttribute("class", "font1_2");
        element.appendChild(para);           
   
        para = document.createElement("br");
        element.appendChild(para); 

                    }*/
}

function generateQuizId() {
  var x = Math.floor((Math.random() * 10000000) + 1);
  document.getElementById("iQuiz").innerHTML = "Quiz id: "+x;
  return x;
}

</script>