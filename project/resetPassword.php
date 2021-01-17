<!--==============================================RESET PASSWORD PAGE================================================
 This page allows the user to create a new passowrd
-->
<?php //START OF PHP CODE
include ("includes/database.php"); // Include library file
session_start();  //start the session
$pdo = connectDB();   // Get database connection

//An arry to store errors
$PswErrors = [];  //for password errors
$codErrors = []; //for validation code
$PswMErrors = []; //for password mismatch errors

//booleann to verify email
$validEmail = false;
  if (isset($_POST['submit']))
      {

				/* Get everything from $_POST */
				$code = $_POST['code'] ?? NULL; //for the user's existing password
				$psw = $_POST['psw'] ?? NULL; //for the new password

        // compare the code given with the ones in the database table
        $stmt = $pdo->prepare("SELECT * FROM reset WHERE reset_code = ?");
        $stmt->execute([$_POST['code']]);
        $result = $stmt->fetch();

        //verify the code
        if($result['reset_code'] != $_POST['code']){
          array_push($codErrors, "Invalid code");
        }



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



	//========================================UPDATE USER ACCOUNT==========================================================//
							/*
								   The following piece of code processes log in process by:
															=>First ensuring there is no valiation errors
															=>Update the user's informaiton and store in the database
															=>Display a successful message and redirect the user to the index page
							*/
						if (count($PswErrors) == 0 && count($codErrors) == 0 && count($PswMErrors) == 0) {

								// Hash Password
								$HashPsw = password_hash($_POST['psw'], PASSWORD_DEFAULT);

                // UPDATE username in the users table.
          			$stm = "UPDATE users SET password = ? WHERE email = ?";
        				$pdo->prepare($stm)->execute([$HashPsw, $_SESSION['email']]);


                //display a succsessful mesage then redirect to the loging page
                $_SESSION['message'] = "Hi there! Your have reset your password succsessfully😊!";
                // Redirect the user to index page
                header("Location: ./success.php");
                die();
      }
		}



?><!--END OF PHP CODE-->
<!Doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/master.css">
	</head>
	<body>
		<div class="container">
			<!-- Login form -->
			<form id="loginForm" action="resetPassword.php" method="post">
					<h3>Reset Password </h3>
          <!--echo out username and passowrd ERRORS-->
          <?php foreach ($codErrors as $error): ?>
            <div id="error"><?= $error ?></div>
          <?php endforeach; ?>
				 <fieldset>
				 	 <input type="text" placeholder="code" name="code" required="" >
				 </fieldset>
         <!--echo out username and passowrd ERRORS-->
         <?php foreach ($PswErrors as $error): ?>
           <div id="error"><?= $error ?></div>
         <?php endforeach; ?>
				 <fieldset>
				 	 <input type="password" placeholder="new password*" name="psw" required="" >
				 </fieldset>
         <!--echo out username and passowrd ERRORS-->
         <?php foreach ($PswMErrors as $error): ?>
           <div id="error"><?= $error ?></div>
         <?php endforeach; ?>
        <fieldset>
          <input type="password" placeholder="confirm password*" name="psw_repeat" required="" >
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
