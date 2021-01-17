<!--Second page- quiz starts-->
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
//start the session
session_start();

//check if the user's session is set
if (!isset($_SESSION['user'])){
    // if not redirect to the main page
    header('Location: index.php');
    exit();
}
//link to the databse
include 'includes/Database.php';
//create a database connection
$pdo=connectdb();

//check if the user clicks submit
if (isset($_POST['submit'])) {
    $choice=$_POST['ans'];//for user's response to the question

    //updtate the choice count in the database
    $stmt4=$pdo->prepare("UPDATE a2_ans SET choicecount = choicecount+1 where id=?");
    $stmt4->execute([$choice]);

    //select the type of choices from the dtabase based on the id
    $stmt3=$pdo->prepare("SELECT correct FROM a2_ans where id=?");
    $stmt3->execute([$choice]);
    $success=$stmt3->fetchColumn();
    //increment user's score if they get the righ answer
     if($success){
       $_SESSION['score']++;
       // compare the user's choice with the correct answer and give an appropriate feedback
       $_SESSION['feedback'][] =  $_SESSION['question'] . ". Your response is right, the answer is - " . $_SESSION['correctans'];
     }else{

       // compare the user's choice with the correct answer and give an appropriate feedback
       $_SESSION['feedback'][] =  $_SESSION['question'] . ". Your response is wrong, the answer is - " . $_SESSION['correctans'];
     }
     //Move to the next question
     $_SESSION['question']++;

     //chekc if the user andwers all the question...
     if ($_SESSION['question']>5){
        header('Location: result.php'); //if then take to the result page
        exit();
     }
 }

//set $question to the in session
$question=$_SESSION['question'];
// select questions from the database
$stmt=$pdo->prepare("SELECT question FROM a2_quest where id=?");
$stmt->execute([$question]);
$row=$stmt->fetchColumn();

// select the answers from the base based on the questions
$stmt2=$pdo->prepare("SELECT * FROM a2_ans where fk_questid=?");
$stmt2->execute([$question]);
?>


<!--HTML page starts here-->
<!DOCTYPE html>
<html lang="en">
<head>
  <!--link to the medadata-->
  <?php
  $PAGE_TITLE = "Quiz";
  include './includes/metadata.php';
   ?>
</head>
<body>
  <!-- link to the header page-->
    <?php include './includes/header.php'; ?>
  <div class="container">
    <!--Show question number in session-->
    <div class ="current">Question: <?php echo $_SESSION['question'];?> of 5</div>
  <fieldset>
    <!--Print the choices in radio format with submit option at the end-->
    <form name="submit" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <legend><?php echo $row;?></legend>
      <ul>
        <?php foreach($stmt2 as $ans):?>
          <li>
            <!-- make usre the user selects an answer before moving to the next quesion-->
          <input name="ans" type="radio"  required value= "<?php echo $ans['id'];?>" />
          <!--print the choices-->
          <?php echo $ans['answer'];?>
          <!--check if the choice is the right answer or not-->
          <?php if($ans['correct']){
            //if its the correct answrt store it the session answer
              $_SESSION['correctans']=$ans['answer'];
            }
          ?>
        <?php endforeach;?><!--end foreach-->
      </li>
      </ul>
      <div>
        <!--submit option-->
      <input type="submit" class="start" name="submit" value="Submit" />
    </div>
    </form>

  </div>
  <!--footer link-->
  <?php include './includes/footer.php'; ?>
</body>

</html>
