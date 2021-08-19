<?php
session_start();
?>
<html lang="en">

<head> 
    <title> QuizSite  </title>
    <link href="main.css" rel="stylesheet">
    <link rel="icon" href="images/icon.png" type="image/gif" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>



<!-- Reuesable Container -->    
<div id="quiz_box"> 
<div class="progress sticky">
    <div class="progress-bar progress-bar-success progress-bar-striped active sticky" role="progressbar" style="width:0%" id="progress" name="progress">
    </div>
  </div>
 <div id="get-quiz"></div>

 
<?php

$id = $_SESSION["quiz_id"];

echo "<h1 class='centerText'> Quiz ID: ".$id."<h1>";

$conn = new mysqli("localhost","root","","QuizSite") or die("unable to connect");
if($conn){

$timer = $_SESSION['timer'];
 echo "<p class='centerText' id='timer' value='{$timer}'>{$timer}</p>";
 echo "<form action='send_answer.php' method='post' id='quiz_form'>";
 echo "<input type='hidden' id='answers' name='answers'>";
 echo "<input type='hidden' id='numberQuestion' name='numberQuestion'>";
    $sql = "SELECT id, id_quiz,question_text FROM question where id_quiz= '{$id}' group by id";

    $result = $conn->query($sql);
    $index = 1;   
    if ($result->num_rows > 0) {
 
      // output data of each row
      $count = 1;
      while($row = $result->fetch_assoc()) {
        //question id 
        $id_question = $row['id'];
        echo "<h2 class='bold'>{$index} ) {$row['question_text']}</h2>";

// printing all answer of each question
$sqlAnswer = "SELECT id, answer FROM question where id= '{$id_question}'";

$resultAnswer = $conn->query($sqlAnswer);
if ($resultAnswer->num_rows > 0) {
  // output data of each row
  while($rowAnswer = $resultAnswer->fetch_assoc()) {
    //question id 
    $answer = $rowAnswer['answer'];
    echo "<input type='radio' class='radioSize' onclick='{progressBar()}' id='{$answer}{$count}' name='{$id_question}' value='{$answer}'>";
    echo "<label class='labelAnswer' for='{$answer}{$count}'>{$answer}</label><br>";
    $count++;
  }    
}
$index++;  }
    } 
}
$conn->close();

?>

<input type="submit" name="submitAnswer" onclick="submitAnswerToProcess()" value="Submit Answer" class="button med-size">
</form>

</div>   

</body>    

</html>
<!-- 
number of question: SELECT count(id), id_quiz FROM question GROUP by id_quiz
number of question in each quiz: SELECT id, id_quiz FROM question where id_quiz=7714795 group by id
number of answer for each question: SELECT id, question_text, answer, correct, id_quiz FROM question WHERE id = 385559
  -->
<script>

function submitAnswerToProcess(){
  var answers = [];
var checked = false;
    var radioAnswers = document.getElementsByTagName("input");

for (var i = 0; i < radioAnswers.length; i++) {

  if (radioAnswers[i].checked) {
    checked =true;
    var ans = {answer: radioAnswers[i].value};
    var ques = {question: radioAnswers[i].name};
    answers.push(ans,ques);
  }
  } 
  if(checked){
            var ansJSON = JSON.stringify(answers);
            var ansH = document.getElementById("answers");
            ansH.value = ansJSON;
                       
  }
}

function progressBar(){

  var questions = document.getElementsByTagName("h2");
  var radioAnswers = document.getElementsByTagName("input");
  var progress = document.getElementById("progress"); 

  var numberQuestion = questions.length;
  var count = 0;

  for (var i = 0; i < radioAnswers.length; i++) {
    if (radioAnswers[i].checked) {
      count++;
    }
  }

  var newProgress = ( count / numberQuestion ) * 100;
  var widthProg = newProgress + "%";
  progress.style.width= widthProg;


}


function startTimer(duration, display) {
  var progress = document.getElementById("progress"); 
    var timer = duration, minutes, seconds;
    var bTimer = timer;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (bTimer * 0.05 > timer){
          progress.classList.add('progress-bar-danger');
          progress.classList.remove('progress-bar-warning');
        }
        else if(bTimer * 0.15 > timer){
          progress.classList.add('progress-bar-warning');
          progress.classList.remove('progress-bar-success');
        }
        if (--timer < 0) {
          submitAnswerToProcess();
          document.getElementById("quiz_form").submit();
        }
    }, 1000);
}

window.onload = function timer() { 

  display = document.getElementById("timer");
        var min = 60 * display.innerText;
    startTimer(min, display);
}

</script>

