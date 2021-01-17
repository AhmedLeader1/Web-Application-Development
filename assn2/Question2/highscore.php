<!--Highscore Page-->
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
include 'includes/Database.php';
$pdo=connectdb();
?>

<!--HTML starts-->
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  $PAGE_TITLE = "HIGH SCORE";
  include './includes/metadata.php';
   ?>
</head>
<body>
  <?php include './includes/header.php'; ?>
  <div class="container">

<h1> High Score Table </h1>
<table>
  <tr>
    <th>USERNAME</th>
    <th>SCORE</th>
  </tr>
    <?php
    $stmt=$pdo->prepare("SELECT username,score FROM a2_scores ORDER BY score DESC");
    $stmt->execute();
    foreach($stmt as $row): ?>
    <tr>
      <td><?php echo $row['username'];?></td>
      <td><?php echo $row['score'];?></td>
    </tr>
    <?php endforeach;?>
</table><br/>
</div>
  <?php include './includes/footer.php'; ?>
</body>
</html>
