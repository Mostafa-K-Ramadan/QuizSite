<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>QuizSite</title>
	<link href="main.css" rel="stylesheet">
	<link rel="icon" href="images/icon.png" type="image/gif">
</head>
<body>
	<h1 class="centerText heading">Student Page</h1>

	<div class="background-student">
    <form action="" method="post">
		<label class="centerText font2_2">Enter Quiz ID</label>
		<input type="number" class="center marginBM sizeInput spacing" name="quiz_id">
		<input type="submit" class="enter-student " name="entered" value="Enter">
		
    </form>

	<?php

$conn = new mysqli("localhost","root","","QuizSite") or die("unable to connect");
if($conn){


if (isset($_POST['entered'])){ 
	if ($_POST['quiz_id'] != ""){
    $quiz_id = $_POST['quiz_id'];
  
	$sql = "SELECT id,timer FROM quiz where id={$quiz_id}";
	
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
		$_SESSION["timer"] = $row["timer"];
		$_SESSION["quiz_id"] = $row["id"]; 
		echo $_SESSION["timer"];
		header('Location: Quiz.php');
	  }
	} else {
	  echo "<h3 class='warningMsg'>Invalid quiz ID</h3>";
	}    	
}
else {
	echo "<h3 class='warningMsg'>Please insert quiz ID</h3>";	
}
}
$conn->close();
}

/*$conn = new mysqli("localhost","root","","QuizSite") or die("unable to connect");
if($conn){

if (isset($_POST['check'])){ 
    $password = $_POST['password'];
  
}
}
$conn->close();*/
?>
	</div>

</body>
</html>



