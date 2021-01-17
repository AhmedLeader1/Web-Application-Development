<!--==============================================RESET PAGE================================================
Makes sure only the user with the reset link can access the RESET PASSWORD PAGE
-->
<?php //START OF PHP CODE
include ("includes/database.php"); // Include library file
session_start();  //start the session
$pdo = connectDB();   // Get database connection

//An arry to store errors
$PswErrors = [];  //for password errors
$emErrors = []; // for username errors
$PswMErrors = []; //for password mismatch errors

  if (isset($_GET['email']) && !empty($_GET['email']))
      {
        // Select the list that is going to be edited
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$_GET['email']]);
        $results = $stmt->fetchAll();

        if(!empty($results)){

          $_SESSION['email'] = $_GET['email'];
          header("Location: resetPassword.php");
          die();
        }
      }
    else {
        $_SESSION['message'] = "Invalid URL access";
        header("Location: error.php");
        die();
      }
?>
