
<html lang="en">

    <head> 
        <title> QuizSite  </title>
        <link href="main.css" rel="stylesheet">
        <link rel="icon" href="images/icon.png" type="image/gif" >
    </head>
    
    <body>
<h1 class="centerText heading">Instructor Page</h1>

        <div id="parent">

<div class="insDiv" id="createNewExam" onclick="createNewQuiz()">
    <div class="centerInDiv">Create New Quiz</div> 
</div>

<div class="insDiv" id="history" onclick="prevQuiz()">
    <div class="centerInDiv">Previous Quiz</div> 
</div>
</div>

    </body> 
</html>  

<script>

function createNewQuiz() {
    window.location.href = "CreateQuiz.php";
}

function prevQuiz() {
    window.location.href = "PreviousQuiz.html";
}

</script>