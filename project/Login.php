<!--============================================LOG IN PAGE=================================================-->
<!--
Student names: Ahmed Ahmed & Mansur Mansur
       COURSE: COIS 3420H
       PURPOSE: This is the log In page. It contains:
                1- A HTML form in which a user can fill the required information for the lgoin process.
                2- A PHP code that:
                    I.   Validates the user's information in the HTML form given
                    II.  Prints the error messages if the user's informaiton are not valid by
										     comparing the username & password with the ones in record (in the database)
                    III. Processes the login process for correct username and password
                    IV.  Redirects the user to the bucketlist information page
REFERENCES:
  https://www.dreamincode.net/forums/topic/286198-simple-login-page-with-only-3-password-attempts/
-->
	<?php //START OF PHP CODE
	include('includes/database.php'); //requres database connection
	session_start(); //start the session

	// Get database connection
	$pdo = connectDB();


	//variable to exit the login page if number of attempts exceeded
	$exit = false; //set to false for the first time

	//array to store errors during validaton
	$errors = [];

	//boolean variable to verify passowrds
	$passExists = false;
//===========================================LOG IN VALIDATION=======================================================//
	/*
		Validates the user's Username and password by:
			 1- Setting the number of attempts at 0
			 2- Getting the username and password from the $_POST
			 3- Gets the username and password from the database and compares with the ones obtained from the $_POST
			 4- validates the username and passowrd
	*/

	// Validate on submit (login)
  if (isset($_POST['login'])){

			 // Check if the attempts velue is set
			 if(!isset($_SESSION['Attempts'])) {
				// if not set it at zero
				$_SESSION['Attempts'] = 0;
			}
			/* Get everything from $_POST */
			$username = $_POST['username'] ?? NULL;
			$psw = $_POST['psw'] ?? NULL;


		  // Get the username and passowrd fromt he database
		  $statement = $pdo->prepare("SELECT id, username, password FROM users WHERE username = ?");
		  $statement->execute([$username]);
		  $results = $statement->fetch();

			//verify the passowrd
			if(password_verify($psw, $results['password']))
			{
				$passExists = true;
			}

		  //check if the username & the password given is not valid by comparing the ones in the database table
	    if ($results['username'] == !$username || !$passExists) {
			//store the an ERROR message in the array
			array_push($errors, "Invalid username or Password");
			$_SESSION['Attempts']++; //increment the number of attempts in session
			//check if the number of attempts has reached 3 or more
			if ($_SESSION['Attempts'] >= 3){
			//set the flag of the exit to be true
			$exit = true;
			}
		}



		  // Sets cookies when remember box is checked on login
			if(isset($_POST['remember']) ) {
				  //sets the cookies for the user's username
      		setcookie('username', $_POST['username']);
					//sets the cookies for the user's password
	    	  setcookie('psw', $_POST['psw']);
	       }

	//========================================PROCESS LOG IN==========================================================//
	 	  /*
	 	   The following piece of code processes log in process by:
	 	        =>First ensuring there is no valiation errors
	 	        =>unsetting the remaining number of attempts in session
	 	        =>Redirect the user to the BucketList page
	 	  */
		if (count($errors) == 0)
		{

						//unset the remaining attempts on successful login
				    unset($_SESSION['Attempts']);

			 			// Set the userid to session variable.
						$_SESSION['user'] = $results['username'];
			 			$_SESSION['userid'] = $results['id'];
						//print a welcome message with the user's usrname
					 // Redirect to index.
  		      header("Location: ./display.php");
						echo $results['username'];

			      die();
		}

 //==============================================EXIT THE LOG IN PAGE================================================//
	/*
		The follwing code exits the user from the login page if the  number of unsuccessful
		attempts on the login process exceeds 3 and prints an alert message to indicate that.
		It also unsets the attempts in session.
	*/
	  //check if the exit flag is set (3 or more unsuccessful attempts)
		if($exit){
		//print an alert message to the user
		$_SESSION['message'] = "Sorry 😞! you have execeeded the maximum number of login attempts allowed. You can login after sometime.";
		//unset the remaining attempts in session
		unset($_SESSION['Attempts']);
		header("Location: error.php");
		}
	}

	//forgot password code
	if(isset($_POST['forgot'])){
		header("Location: forgot.php");
		die();
	}
?><!--END OF PHP CODE-->

<!Doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
    <title>Login|welcome</title>
    <link rel="stylesheet" href="css/master.css">
	</head>
	<body>
		<div class="container">
			<!-- Login form -->
			<form id="loginForm" action="Login.php" method="post">
					<h3>Login Form </h3>
					<!--echo out username and passowrd ERRORS-->
					<?php foreach ($errors as $error): ?>
						<div id="error"><?= $error ?></div>
					<?php endforeach; ?>
					<fieldset>
						<input type="text" placeholder="Username*" name="username" required="">
					</fieldset>
				 <fieldset>
				 	 <input type="password" placeholder="Password*" name="psw" required="" >
				 </fieldset>
				 <fieldset>
					 <div><button name="forgot"><a class="terms" href="forgot.php" >Forgot your password?</a></button></div>
				 </fieldset>
				 <div class="Logintext"></div>
				 <fieldset>
					 <input type="checkbox" id="checkbox" checked="checked" name="remember" style="margin-bottom:15px">
					 <label for="remember">Remember Me</label>
				 </fieldset>
				 <fieldset>
					 <button type="submit" name="login" value="submit">Login</button>
				 </fieldset>
				 <fieldset>
					 <div >Not registered? <a class="mainform"href="SignUp.php">Create an account</a></div>
				 </fieldset>
				 <p class="copyright">Designed by Mansur & Ahmed</p>
			</form>
		</div>
	</body>
</html>
