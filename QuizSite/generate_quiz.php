<?php
session_start();
$id = $_SESSION["user_id"];

$conn = new mysqli("localhost","root","","QuizSite") or die("unable to connect");

if($conn){

  $sql = "SELECT name FROM user where id = '{$id}'";
  $result = $conn->query($sql);

  $row = $result->fetch_assoc();
echo "<h1 class=''>Mr. {$row['name']}</h1>";
echo "<table id='t01'>";
echo " <tr>
<th>Quiz ID</th>
<th>Quiz Time</th> 
<th>Quiz Details</th>
</tr>
";
// get all quiz was created by this instructor 
$sqlQuiz = "SELECT id, timer FROM quiz WHERE ins_id = $id";
$resultQuiz = $conn->query($sqlQuiz);

if ($resultQuiz->num_rows > 0) {
  // output data of each row
  while($row = $resultQuiz->fetch_assoc()) {
  $quiz_id = $row["id"];
  $timer = $row["timer"];
  echo " <tr>
  <td class='bold'>{$quiz_id}</td>
  <td class='bold'>{$timer}</td> 
  <td><input type='button' id='{$quiz_id}' name='{$quiz_id}' class='btn-list' value='Details' onclick='{showDetails({$quiz_id})}'></td>
  </tr>
  ";
  }

} else {
echo "<tr><td colspan='3' class='font2_2'>
There is no quiz created before
</td></tr>"; 
}
echo "</table>";
}
$conn->close();
?>

<!--
SELECT id, timer FROM quiz WHERE ins_id = $id
SELECT id_user, correct, totoal FROM answer WHERE id_quiz = $quiz
-->
