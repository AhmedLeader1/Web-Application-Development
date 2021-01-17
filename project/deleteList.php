<!--==========================================================DELETE LIST PAGE==================================================================
Student names: Ahmed Ahmed & Mansur Mansur
       COURSE: COIS 3420H
       PURPOSE: This is the DELETE LIST page. It contains only a PHP code that gets the id of a list from the bucketlist contents of the user,
                it then removes/deletes the list from the bucketlist

Note: This page works behind the scene
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
// Check that the list id exists
if (isset($_GET['id'])) {
    // Select the list that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM users_lists WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $list = $stmt->fetchAll();
    if (empty($list)) {
        exit('There is no List with that ID!');
    }
    // Delete the content in thelist if it is not empty
    if(!empty($list)) {

            // Run the query to delete the list from the database
            $stmt = $pdo->prepare('DELETE FROM users_lists WHERE id = ?');
            $stmt->execute([$_GET['id']]);

            //redirect the user to myList page
            header('Location: myList.php');
            exit(); //exit the program
        }
    }
?>
