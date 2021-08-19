<?php
session_start();
?>

<html lang="en">

<head> 
    <title> QuizSite  </title>
    <link href="main.css" rel="stylesheet">
    <link rel="icon" href="images/icon.png" type="image/gif" >
</head>

<body>

<!-- Reuesable Container -->    
<div id="loginContainer">
<img class="center marginTP" src="images/profile.svg" alt="profile picture">

<form action="" method="post">

    <h1 class="centerText marginBM">Welcome to QuizSite</h1>
    <hr class="marginBM">


<label class="centerText marginBM font40">User Name</label>
<input class="center marginBM sizeInput"  type="text" name="username" id="username">

<label class="centerText marginBM font40">Password</label>

<input class="center marginBM sizeInput"  type="password" name="password" id="password">

	<input class="button center button-size" onclick="register()" type="button" value="Sign up">
	<input class="button center button-size" type="submit" value="Sign in" name="check" onclick="check()">
</form>    
</div>   
</body>    
</html>

<script>
    
    function register(){
        window.location.href = "Register.php";
    }
    function check(){
    	var name = document.getElementById("username");
    	var pass = document.getElementById("password");

    	if(name.value == "" || pass.value == ""){
    		alert("username or password is empty");
    	}
    }

</script>

<?php

$conn = new mysqli("localhost","root","","QuizSite") or die("unable to connect");
if($conn){


if (isset($_POST['check'])){ 
    $password = $_POST['password'];
    $name = $_POST['username'];
    $type = null;
    $id = null;

    $sql = "SELECT id, name, password,type FROM user where name = '{$name}' AND password = '{$password}'";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
      $id = $row["id"];
      $_SESSION["user_id"] = $id;
      header('Location:'. $row["type"]. '.php');
      }

    } else {

echo '<script>alert("Please check again your username and password")</script>'; 
    }
   
    


}}
$conn->close();
?>