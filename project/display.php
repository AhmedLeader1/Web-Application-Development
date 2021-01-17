<!--=====================================DISPLAY PAGE=============================================================
Student names: Ahmed Ahmed & Mansur Mansur
       COURSE: COIS 3420H
       PURPOSE: This is the Display page. It contains:
                1- A HTML which shows the structure of the user dashboard. when the user logs in, they will have navigation
                   menu which will take them to create goal, or setting page, or mylist page, or logout page, and home page which shows all public list
                   of other users.
                2- A PHP code that:
                    I. checks if the user logged in. if no then redirects back to the Login page
                    II. it also displays all the list of other users in the news feed which are public

-->
<?php
   include('includes/database.php'); //requres database connection
   //connect to the database
   $pdo = connectDB();
   //session_start
   session_start();
   //check if the user has logged in
   if(!isset($_SESSION['user'])){
     //user has not logged
     header("Location:Login.php");  //redirect the user back to login
     exit();
   }

   //get all the values in the users_lists
   $statement = $pdo->prepare("SELECT * FROM users_lists WHERE share = ?");
   $statement->execute([1]);
   $results = $statement->fetchAll();

   $count = count($results);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Display|welcome</title>
    <link rel="stylesheet" href="css/master.css">
    <script defer src="script/main.js"></script>
  </head>
  <body>
    <!--sidebar/menu-->
    <nav class="sidebar">
      <h3><br>Bucket List <br></h3>
      <form class="home" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <a href="display.php" name="home">Home</a>
      </form>
      <a href="create.php">Add Goal</a>
      <form class="myList" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <a href="myList.php" name="list">My List</a>
      </form>
      <a href="setting.php">Setting</a>
      <a href="logout.php">Log out</a>
    </nav>

    <!--
       dropdown-menu when the screen is minimized.
  -->
    <header class="header">
      <div class="dropdown">
        <a href="javascript:void(0)" class="menuButton">☰</a>
        <div class="dropdown-content">
          <a href="display.php" name="home">Home</a>
          <a href="create.php" >Add Goal</a>
          <a href="myList.php" name="list">My List</a>
          <a href="setting.php">Setting</a>
          <a href="logout.php">Log out</a>
        </div>
      </div>
        <span>Bucket List</span>
    </header>

    <!--page content-->
    <div class="main">
      <!--Header-->
      <div class="title">
        <h1><br> Welcome <?php echo $_SESSION['user']; ?><br></h1>
        <h1 id="h1"><br>Public Lists (<?php echo $count?> <em>in total</em>)<br></h1>
        <hr class="line">
      </div>
      <!--container display that holds list of other users-->
      <div class="display">
        <div id="shared">
          <!--the loop that goes through all the user list that has been fetched.-->
          <?php foreach ($results as $result): ?>
            <fieldset>
              <div class="userdiv">
                <div class="bar1">
                  <div>
                    <p class="username">
                    <?php
                          // get the user name from the database
                          $statement = $pdo->prepare("SELECT username FROM users WHERE id = ?");
                          $statement->execute([$result['user_id']]);
                          $results = $statement->fetch();
                     ?> </p>
                  </div>
            			<div>
            				<img src="img/profile.png" alt=""> <h1>by <?php echo $results['username']; ?></h1>
            			</div>
                </div>
                <div class="wrapper">
                  <div><span class="span">Goal</span>: <?php echo $result['goal'];  //get goal ?></div>
                  <div><span class="span">Category:</span> <?php echo $result['category'];  //get the category?></div>
                  <div><span class="span">Description</span>: <?php echo $result['description'];  //get the description?></div>
                </div>
              </div>
            </fieldset>
          <?php endforeach; ?> <!--// end of the loop-->
        </div>
      </div>
      </div>
  </body>
</html>
