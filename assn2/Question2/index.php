<!--Index page(main page)-->
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
//when user submits
if (isset($_POST['submit'])) {
    $_SESSION['question']=1;
    $_SESSION['score']=0;
    $_SESSION['feedback']=array();
    $user=$_POST['username'];
    $_SESSION['user'] = $user;
    header("Location: Quiz.php"); //redirect
    exit();
}
?>

<!--HTML starts-->
<!DOCTYPE html>
<html lang="en">
<head>


  <?php
  $PAGE_TITLE = "HOME |Welcome";
  include './includes/metadata.php';
   ?>
</head>
<body>
    <?php include './includes/header.php'; ?>
  <main>
    <div class="container">
      <!--Welcome message and a genral info about the Quiz -->
      <h1>Welcome to Online Quiz</h1>
      <p> In this quiz, you will fine 5 multiple choice questions that is going to test your knowledge on General concepts</p>
        <ul>
          <li><strong>Number of Questions:</strong> 5 </li>
          <li><strong>Type of Quiz: </strong> Multiple Choice</li>
        </ul>
  <!--self processing form-->
  <form name="Login" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <div id="container">
      <!--Ask the user to enter a user name before self prosessing the Quiz-->
      <label for="username">Enter your username</label>
      <input type="text" name="username" id="username" placeholder="AhmedLeader" required/>
      <div><input class="start" type="submit" name="submit" value="Submit" /></div>
    </div>
  </form>
</div><br/>
</main>
<!--link to the footer-->
  <?php include './includes/footer.php'; ?>
</body>
</html>
