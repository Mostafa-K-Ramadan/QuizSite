
<?php 
// Start the session
session_start();

$conn = new mysqli("localhost","root","","QuizSite") or die("unable to connect");
if($conn){

    
if (isset($_POST['quiz'])){ 

    $quiz = $_POST['quiz'];

    $decoded = json_decode($quiz, true);

   $id = $decoded["id"];
   $timer = $decoded["timer"];
   $user_id = $_SESSION["user_id"];

    for ( $i = 0; $i < sizeof($decoded["question"]); $i++){


        $question_text = $decoded["question"][$i]["question"];
        $id_question = rand(10,1000000);
        $answer = null;
        $correct = null;
         

        if($decoded["question"][$i]["Shown"] == "answertf") {
            for ( $j = 0; $j < 2; $j++){
        $answer = $decoded["question"][$i]["answer"][$j]["answer"];
        $correct = $decoded["question"][$i]["answer"][$j]["correct"];   

        $sql = "INSERT INTO question (id, question_text, answer, correct, id_quiz)
        VALUES ({$id_question}, '{$question_text}', '{$answer}', '{$correct}', {$id})";  
        $conn->query($sql);
            }
    }
    else{  
        for ( $j = 0; $j < 4; $j++){
            $answer = $decoded["question"][$i]["answer"][$j]["answer"];
            $correct = $decoded["question"][$i]["answer"][$j]["correct"]; 

            $sql = "INSERT INTO question (id, question_text, answer, correct, id_quiz)
            VALUES ({$id_question}, '{$question_text}', '{$answer}', '{$correct}', {$id})";  
            $conn->query($sql);
                }
    }

    }
    $sql = "INSERT INTO quiz (id, timer,ins_id)
    VALUES ({$id}, {$timer}, {$user_id})";
    $conn->query($sql);
   header('Location: Instructor.php');


}
}

$conn->close();

?>
 
