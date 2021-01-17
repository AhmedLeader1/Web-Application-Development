<!--==========================================================EDIT PAGE==================================================================
Student names: Ahmed Ahmed & Mansur Mansur
       COURSE: COIS 3420H
       PURPOSE: This is the Display page. It contains only a PHP code that gets the id of a list from the bucketlist contents of the user,
                it then stored the id of the selected list in SESSION to allow the user to edit the selected list in the UPDATE PAGE.

Note: This page works behind the scene
-->
<?php
include ("includes/database.php"); // Include library file
session_start();  //start the session
$pdo = connectDB();   // Get database connection

//check if the user has logged in
if(!isset($_SESSION['user'])){
  //user has not logged
  header("Location:Login.php");  //redirect the user back to login
  exit();
}
// Check if the list id exists, for example update.php?id=1 will get the list with the id of 1
if (isset($_GET['id'])) {
  // Select the list that is going to be edited
  $stmt = $pdo->prepare('SELECT * FROM users_lists WHERE id = ?');
  $stmt->execute([$_GET['id']]);
  $results = $stmt->fetchAll();

  //check if the id given returns anything other than NULL
  if (!empty($results)) {
    //store the id of the list in SESSION
    $_SESSION['list'] = $_GET['id'];
    ///redirec the user to the UPDATE page
    header("Location: update.php");

  }
}

?>
