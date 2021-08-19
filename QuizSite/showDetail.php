<?php
$quiz = $_REQUEST['quiz'];

echo "<div class='popup' id='popup-1' style='background-color: gold'>";
echo "<div class='overlay'></div>";
echo "<div class='content'>";
echo "<div class='close-btn' onclick='{togglePopup()}'>X</div>";

echo "<h1>{$quiz}</h1>";

$conn = new mysqli("localhost","root","","QuizSite") or die("unable to connect");

if($conn){

    $sqlStudent = "SELECT id_user, correct, total FROM answer WHERE id_quiz = $quiz";

    $reusltStu = $conn->query($sqlStudent);
    echo "<table id='t01'>";
echo " <tr>
<th>Student name</th>
<th>mark</th> 
</tr>
";
    if ($reusltStu->num_rows > 0) {
      // output data of each student
      while($row = $reusltStu->fetch_assoc()) {

      $student_id = $row["id_user"];
      $correct = $row["correct"];
      $total = $row["total"];

      $sqlStudentName = "SELECT id, name FROM user where id = '{$student_id}'";
      $resultStudent = $conn->query($sqlStudentName);
      
      if ($resultStudent->num_rows > 0) {
          
        $student = $resultStudent->fetch_assoc();
      echo " <tr>
          <td class='bold'>{$student['name']}</td>";

      $percentage = (($correct/$total)*100);  
      $fraction = number_format($percentage, 2, '.', '');

      echo "<td class='bold'>{$fraction}</td> 
      </tr>
      ";}
      else {
        echo "<tr><td colspan='2' class='font1_2'>
        There is no students take the quiz
        </td></tr>"; 
        }
      }
    }
    else {
      echo "<tr><td colspan='2' class='font1_2'>
      There is no students take the quiz
      </td></tr>";
    }
    echo "</table>";
    }
    $conn->close();

echo "</div>";
echo "</div>";




?>


