<!--Results page-->
<!--  Student Name: Ahmed Ahmed
         Student #: 0632851

            Course: COIS 3420H
      Assignment #: Assignment 2 Question 2

           Purpose: In Question 2 of this assignment, I am required to create an online quiz
                    that self processes itself once a user enters his/her user names.
                    Then when the user completes the quiz, the program shows the result they got
                    and allows the user to review the results and the correct answer of each question in the quiz.
                    Lastly, the program allows the user to view the scores and compare with theirs.
-->
<?php

//starting the session

include 'includes/Database.php';
$pdo=connectdb();

$_SESSION['question'] = 1;



$question = ("SELECT * FROM a2_quest");
$stmt=$pdo->prepare($question);
$stmt->execute();
$col=$stmt->fetchAll();



?>


<!--HTML starts-->
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  $PAGE_TITLE = "RESPONSE BREAKDOWN";
  include './includes/metadata.php';
   ?>
</head>
<body>
  <?php include './includes/header.php'; ?>
  <main>
<div class="container">
<h1> Response Breakdown</h1>
<?php

foreach ($col as $row)
{
$ques = "question";
echo "<li class='$ques'>".$row['question']."</li>";

$ans = ("SELECT * FROM a2_ans where fk_questid=?");
$stmt2=$pdo->prepare($ans);
$stmt2->execute([$_SESSION['question']]);

$_SESSION['question']++;

while($row= $stmt2->fetch())
{
    if ($row['correct']==1)
    {
      echo "<li class='correct'>".$row['answer']." ".$row['choicecount']."</li>";
    }
    else if ($row['correct']==0)
     {
      echo "<li>".$row['answer']." ".$row['choicecount']."</li>";
    }
   }
}
?>
<div>
  <a href="highscore.php" class="start">View high scores</a>
  <a href="index.php" class="start">Redo the Quiz</a>
</div>
</div>
  </main>
    <?php include './includes/footer.php'; ?>
</body>
</html>
