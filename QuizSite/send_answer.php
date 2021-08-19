<?php
session_start();
header( "refresh:6;url=Student.php" );
?>


<html lang="en">

<head> 
    <title> QuizSite  </title>
    <link href="main.css" rel="stylesheet">
    <link rel="icon" href="images/icon.png" type="image/gif" >
</head>
<body>
<!-- Reuesable Container -->    
<div id="quiz_box">

<?php
$id = $_SESSION["quiz_id"];

$conn = new mysqli("localhost","root","","QuizSite") or die("unable to connect");
if($conn){

    $ans = $_POST['answers'];

    $decoded = json_decode($ans, true);


  $count = 0;  
     for($i = 0; $i < sizeof($decoded); $i+=2){
      
        //echo $i;
        $answer = $decoded[$i]['answer']; 
        $question_answer_id = $decoded[$i+1]['question'];

        $sql = "SELECT id,answer FROM question where id= '{$question_answer_id}' AND answer='{$answer}' AND correct=1";
        $result = $conn->query($sql);  
        if ($result->num_rows > 0){
            $count++;
            }  
     }
      
$user = $_SESSION["user_id"];
$id_ans = rand(10,100000);

$sql = "SELECT id FROM question where id_quiz= '{$id}' group by id";
$result = $conn->query($sql); 
$total = $result->num_rows;

$sql = "INSERT INTO answer (id, id_quiz, id_user, correct,total)
VALUES ({$id_ans}, '{$id}', '{$user}', '{$count}', '{$total}')";
$conn->query($sql);
  } 
$percentage = (($count/$total)*100);  
$fraction = number_format($percentage, 2, '.', '');
  echo "<h1 class='centerText'> You got: {$fraction} out of 100</h1>";
  echo "<h3 class='centerText'> The page will colse after 5 seconds</h3>";
$conn->close();
?>


</div>   

</body>    

</html>




