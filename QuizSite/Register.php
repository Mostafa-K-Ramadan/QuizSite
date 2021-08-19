
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
    
    <form action="registeration.php" method="post" id="register_form">
    
        <h1 class="centerText marginBM">Welcome to QuizSite</h1>
        <hr class="marginBM">
       
    <label class="centerText marginBM font40" >User Name</label>
    <input class="center marginBM sizeInput"  type="text" id="username" name="username" placeholder="username">
    
    <label class="centerText marginBM font40 textInput" >Password</label>
    <input class="center marginBM sizeInput" onkeyup="lvlPassordDetected()" type="password" name="password" id="password" placeholder="********"> 

 
    <label class="centerText marginBM font40" >Confirm Password</label>
    <input class="center marginBM sizeInput"  type="password" id="conf_password" onkeyup="registerChecking()">

    
    <div class="center marginBM">
    <label for="instructor" class="font40">Instructor</label>
    <input type="radio" name="type-of-user" id="instructor" value="Instructor" class="radioSize">
    <label for="student" class="font40" >Student</label>
    <input type="radio" name="type-of-user" id="student" value="Student" class="radioSize">
    </div>
    
    <input class="center button marginTP size-register" type="button" onclick="register()" name="Register" value="Register">
    
    
    </form>        
    </div>   
    
    </body>    
    </html>

    <script>   

    function register() {

var password = document.getElementById("password")
  , confirm_password = document.getElementById("conf_password");

  

var access = true;
var feilds = document.getElementsByTagName("input");  
for(var i =0; i < feilds.length ; i++)
if (feilds[i].value.length == 0)
    access = false;
if(!(document.getElementById("instructor").checked || document.getElementById("student").checked))
    access = false;
if (access){


  if(password.value == confirm_password.value) {

      var conf = confirm("Press click ok to confirm your registration!");
    var result = conf ? "register_form" : "none";

    if (0 != result.localeCompare("none"))
    document.getElementById(result).submit();

  } 
     else {    alert("Passowrds are not match");}
    }
    else {    alert("Please complete the registeration form");}
  
  }  

  function registerChecking() {

var password = document.getElementById("password")
, confirm_password = document.getElementById("conf_password");

 if (password.value != confirm_password.value) {
confirm_password.style.borderBottom = "5px solid #ff0000";
}else if(password.value == confirm_password.value){
confirm_password.style.borderBottom = "5px solid #00ff00";  
} 

  }  


  function lvlPassordDetected() {
  var pass = document.getElementById("password").value;
var arr = [0,0,0];



 for(var i = 0; i < pass.length ;i++){
     var passText = pass.charAt(i); 
    
 if (!(isNaN(passText))){ arr[0]++; }
 else if (passText == passText.toUpperCase()){ arr[1]++;}
 else if (passText == passText.toLowerCase()){ arr[2]++;}

 }

 if (arr[0] > 5 && arr[1] > 0 && arr[2] > 0) { document.getElementById("password").style.borderBottom = "5px solid #00ff00";}
 else if (arr[0] > 2 && (arr[1] > 0 || arr[2] > 0)) { document.getElementById("password").style.borderBottom = "5px solid #ffa500";}
 else { document.getElementById("password").style.borderBottom = "5px solid #ff0000";}
}
    </script>


