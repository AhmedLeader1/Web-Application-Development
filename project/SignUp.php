<!--============================================SIGN UP (REGISTRATON) PAGE=================================================-->
<!--
Student names: Ahmed Ahmed & Mansur Mansur
       COURSE: COIS 3420H
       PURPOSE: This is the registration page. It contains:
                1- A HTML form in which a user can fill the required information.
                2- A PHP code that:
                    I.   Validates the user's information in the HTML form given
                    II.  Prints the error messages if the user's informaiton are not valid, or already in use
                    III. Processes the registration process for successful user's informaiton
                    IV.  Stores the user's data into the database talbe
                    V.   Redirects the user to the index page
REFERENCE:
      https://www.codexworld.com/how-to/validate-password-strength-in-php/

-->
<?php //start of the PHP code
include ("includes/database.php"); // Include library file
session_start();  //start the session
$pdo = connectDB();   // Get database connection

//An arry to store errors
$PswErrors = [];  //for password errors
$userErrors = []; // for username errors
$emErrors = [];   //for email errors
$PswMErrors = []; //for password mismatch errors

// Validate on submit (register)
  if (isset($_POST['register'])) {

    /* Get everything from $_POST */
    $username = $_POST['username'] ?? NULL; //for username
    $email = $_POST['email'] ?? NULL; //for email address
    $psw = $_POST['psw'] ?? NULL; //for password


    // compare the username given with the ones in the database table
    $query = "SELECT 1 username FROM users WHERE username = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_POST['username']]);
    $result = $stmt->fetchAll();

    // check if the username is already in use
    if (!empty($result)) {
      // set the flag to be false if the username is in use
      $newUsername = false;

    }

    // compare the email given with the ones already in register in the table
    $query = "SELECT 1 email FROM users WHERE email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_POST['email']]);
    $result = $stmt->fetchAll();

    // check if the email is already in use
    if (!empty($result)) {
      // set the flag to be false if the email is already registered
      $newEmail = false;

    }

    //===========================================USERNAME VALIDATION=======================================================//
    /*
      Validate Username with the following conditions:
         1- Do not register a username with less than 3 character and more than 10 characters
         2- Do not allow usernmae with special characters other than the regualr ones and numbers
         3- Do not allow a username that has already been in use to registred again
    */
      if (!( strlen($_POST['username']) >= 3 && strlen($_POST['username']) <= 10 && preg_match("/^[a-zA-Z0-9]*$/", $_POST['username']) )) array_push($userErrors, "invalid username");
      if (isset($newUsername) && !$newUsername) array_push($userErrors, "username already in use"); //allow only unique username

    //============================================ EMAIL VALIDATON========================================================//
    /*
      Validate email with the following conditions:
         1- Do not allow an invalid email, the email should be valid.
         2- Do not allow an already existing email to be registered
    */
      if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) array_push($emErrors, "Invalid email address");
      if (isset($newEmail) && !$newEmail) array_push($emErrors, "email already in use"); //allow only unique emails


    //============================================= PASSWORD VALIDATION====================================================//
    /*
      For the password to be strong enough it should have the following conditons before it can be accepted as a valid password:
        1- It should be atleast 8 characters long
        2- It must contain at least 1 Upercase letter
        3- It must contain at leaset 1 lowercase Letter
        4- It must contain at least 1 number
        5- It must contain at least 1 special character
    */
      if (strlen($psw) < '8')  array_push ($PswErrors, "Your Password Must Contain At Least 8 Characters");
      elseif(!preg_match("#[A-Z]+#", $psw))   array_push ($PswErrors,"Your Password Must Contain At Least 1 Uppercase Letter");
      elseif(!preg_match("#[a-z]+#", $psw))  array_push ($PswErrors,"Your Password Must Contain At Least 1 Lowercase Letter");
      elseif(!preg_match("#[0-9]+#", $psw))  array_push ($PswErrors,"Your Password Must Contain At Least 1 Number");
      elseif(!preg_match('@[^\w]@', $psw))  array_push ($PswErrors,"Your Password Must Contain At Least 1 special character e.g '!, @ etc.'");

      // Validate Password Confirm (equals password)
      if (!( $psw === $_POST['psw_repeat'] ))array_push($PswMErrors, "The passowrds should match");


    //======================================PROCESS REGISTRATION==========================================================//
    /*
      The following piece of code processes registraton process by:
        =>First ensuring there is no valiation errors
        =>Hashing the passowrd for security purposes
        =>Inserting all the user information such as username, email, and passowrd(hashed password) INTO the database table
    */

    // Check if there is no validation errors
    if (count($userErrors) === 0 && count($PswErrors) === 0 && count($emErrors) === 0  && count($PswMErrors) === 0) {

      // Hash Password
      $HashPsw = password_hash($psw, PASSWORD_DEFAULT);


      /*
        Insert all the user information intot he tabel
      */
      $query = "INSERT INTO users (username, email, password) VALUES (?,?,?)";
      $pdo->prepare($query)->execute([$_POST['username'], $_POST['email'], $HashPsw]);

      //get the id of the user from the database table
        $query = "SELECT id FROM users WHERE username = ? LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$_POST['username']]);
        $result = $stmt->fetchAll();

      // Get the user id retrieved from the table
      $userId = $result[0]['id'];

      // Set session variable to userid
      $_SESSION['id'] = $userId;

      $_SESSION['message'] = "Hi there! Thank you for signing up! Your Bucketlist account is now active😊!";
      // Redirect the user to index page
      header("Location: ./success.php");
      die();


  }
}
?> <!--END OF PHP CODE-->

<!--START OF HTML DOCUMENT-->
<!DOCTYPE html>
<html>
 <head>
   <meta charset="utf-8">
   <title>Create account|welcome</title>
   <link rel="stylesheet" href="css/master.css">
 </head>
 <body>
   <!-- main content -->
   <div class="container">
     <form id="signupForm" action="SignUp.php" method="post">
       <h3>Registration Form</h3>
       <span class='error' id="UsernameError"></span>
       <!--echo out username ERRORS-->
       <?php foreach ($userErrors as $error): ?>
         <li id="error"><?= $error ?></li>
       <?php endforeach; ?>
       <fieldset>
         <input type="text" placeholder="username*" name="username" required="">
       </fieldset>
       <span class='error' id="EmailError"></span>
       <!--echo out email ERRORS-->
       <?php foreach ($emErrors as $error): ?>
         <li id="error"><?= $error ?></li>
       <?php endforeach; ?>
       <fieldset>
         <input type="email" placeholder="yourname@example.com*" name="email" required="">
       </fieldset>
       <span class='error' id="PasswordError">
       <!--echo out password strength ERRORS-->
       <?php foreach ($PswErrors as $error): ?>
         <li id ="error"><?= $error ?></li>
       <?php endforeach; ?>
       <fieldset>
         <input type="password" placeholder="Password*" name="psw" required="">
       </fieldset>
       <span class='error' id="PasswordError">
       <!--echo out password mismatch ERRORS-->
       <?php foreach ($PswMErrors as $error): ?>
         <li id ="error"><?= $error ?></li>
       <?php endforeach; ?>
       <fieldset>
         <input type="password" placeholder="Confirm Password*" name="psw_repeat" required="">
       </fieldset>
       <fieldset>
         <input type="checkbox" id="checkbox" checked name="remember">
         <label for="checkbox">Remember me</label>
       </fieldset>
       <fieldset>
         <div >By creating an account, you agree to our <a class="terms" href="#">Terms of Service &amp; Privacy Policy.</a></div>
       </fieldset>
       <fieldset>
         <button type="submit" class="btn" name="register">Create an account</button>
       </fieldset>
        <fieldset>
          <div >Already have an account? <a class="mainform"href="Login.php">Sign in</a></div>
        </fieldset>
        <p class="copyright">Designed by Mansur & Ahmed</p>
     </form>
   </body>
</html>
