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
// Check that the contact ID exists
if (isset($_GET['id'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM users_lists WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetchAll();
    if (empty($contact)) {
        exit('List doesn\'t exist with that ID!');
    }
    // Make sure the user confirms beore deletion
    if(!empty($contact)) {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM users_lists WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'You have deleted the List!';
            header('Location: myList.php');
            exit;
        }
    }
?>
