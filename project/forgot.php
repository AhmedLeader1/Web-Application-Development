<!--============================================FORGOT PAGE=================================
VERIFIES AND SENDS A RESET EMAIL TO THE USER TO RESET THEIR PASSWORD
-->
<!-- REFERENCE: https://www.youtube.com/watch?time_continue=1768&v=Pz5CbLqdGwM&feature=emb_logo-->
<?php //start of the PHP code
include ("includes/database.php"); // Include library file
session_start();  //start the session
$pdo = connectDB();   // Get database connection

//An arry to store errors
$emErrors = [];   //for email errors

//a boolean to verify email address
$validEmail = false;
// Validate on submit (register)
  if (isset($_POST['submit'])) {

    /* Get everything from $_POST */
    $email = $_POST['email'] ?? NULL; //for email address



    // compare the email given with the ones already in register in the table
    $query = "SELECT 1 email FROM users WHERE email = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$_POST['email']]);
    $result = $stmt->fetchAll();

    // check if the email is already in use
    if (!empty($result)) {
      // set the flag to be false if the email is already registered
      $validEmail = true;
    }

    //============================================ EMAIL VALIDATON========================================================//
    /*
      Validate email with the following conditions:
         1- Do not allow an invalid email, the email should be valid.
         2- Do not allow an already existing email to be registered
    */
      if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) array_push($emErrors, "Invalid email address");
      if (!$validEmail){ array_push($emErrors, "There is no such email in your account");} //allow only unique emails


    // Check if there is no validation errors
    if (count($emErrors) == 0 ) {

      $_SESSION['message'] = "We sent a confirmation link to $email to reset your password!";

      //sent an email with a confirmation link to reset password
      $to = $email;
      $hash = $user['password'];
      $subject = 'Reset Password Link';
      $body ='
       Hi there,

       Please use this code: reset123456 and click the link bellow to reset your password:
       https://loki.trentu.ca/~ahmedahmed/3420/project/reset.php?email='.$email.'&hash='.$hash;

       mail($to, $subject, $body);

      // Redirect the user to index page
      header("Location: ./success.php");
      die();
  }
}
?> <!--END OF PHP CODE-->

<!Doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/master.css">
	</head>
	<body>
		<div class="container">
			<!-- Login form -->
			<form id="loginForm" action="forgot.php" method="post">
					<p>Please enter your email to reset your password</p>
					<!--echo out username and passowrd ERRORS-->
					<?php foreach ($emErrors as $error): ?>
						<div id="error"><?= $error ?></div>
					<?php endforeach; ?>
					<fieldset>
						<input type="text" placeholder="email*" name="email" required="">
					</fieldset>
				 <div class="Logintext"></div>
				 <fieldset>
					<button type="submit" name="submit" value="submit">submit</button>
				 </fieldset>
				 <p class="copyright">Designed by Mansur & Ahmed</p>
			</form>
		</div>
	</body>
</html>
