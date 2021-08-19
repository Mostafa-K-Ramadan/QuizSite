<?php
$conn = new mysqli("localhost","root","","QuizSite") or die("unable to connect");
if($conn){
    
  $password = $_POST['password'];
  $name = $_POST['username'];
  $type = $_POST['type-of-user'];
  $id = rand(10,100000);

  
  $sql = "INSERT INTO user (id, password, name, type)
  VALUES ({$id}, '{$password}', '{$name}', '{$type}')";
  
if ($conn->query($sql) === TRUE) {
  header('Location: Login.php');
} 
  $conn->close(); 

}

?>