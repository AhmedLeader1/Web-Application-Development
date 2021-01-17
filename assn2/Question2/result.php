<!--Result page-->
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
session_start();
//check session for user info
if (!isset($_SESSION['user'])){
    header('Location:index.php');
    exit();
  }

include 'includes/Database.php';
$pdo=connectdb();

//adding user's score
$stmt=$pdo->prepare("INSERT INTO a2_scores (score,username)values (?,?)");
$stmt->execute([$_SESSION['score'],$_SESSION['user']]);
?>

<!--HTML starts-->
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  $PAGE_TITLE = "QUIZ RESULT";
  include './includes/metadata.php';
   ?>
</head>
<body>
  <?php include './includes/header.php'; ?>
  <main>
<div class="container">


<!--Main headline of the result page-->
<h1> RESULTS - Online Quiz</h1>
<p><em>Good job! You have successfully completed the Online Quiz. Your score is: </em><?php echo $_SESSION['score'];?>/5</p>

<!--comments for user based on their score values-->
  <?php if ($_SESSION['score'])
  if($_SESSION['score']<2)
    echo "I am sorry! That was not a good score. stop coding and start having more general knowledge";
  else if ($_SESSION['score']<4 && $_SESSION['score'] > 2)
    echo "You have an average knowledge of the general knowledge. keep it up!";
  else if ($_SESSION['score']>4)
    echo "Congrats!That is an excelent job.You should maintian";
    ?>
    <P>
  <!--displaying the feedback-->
    <?php foreach($_SESSION['feedback'] as $value): ?>
    <?php
    echo "<td>".$value."</td>";
    ?></br><?php endforeach;?>
<div>
  <!--Link to the other pages (e.g. Response Breakdown Page, Highscore page, and the mian page (index page))-->
  <a href="responseBreakdown.php" class="start">View Response Breakdown</a>
  <a href="highscore.php" class="start">View high scores</a>
  <a href="index.php" class="start">Take quiz again</a>
</div>
  </P>
</div>
  </main>

  <!--Link to the footer-->
  <?php include './includes/footer.php'; ?>
</body>
</html>
<!--End the session to avoid score accumulating-->
  <?php session_destroy(); ?>
