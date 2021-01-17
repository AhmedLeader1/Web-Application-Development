<!--============================================SETTING PAGE=================================================-->
<!--
Student names: Ahmed Ahmed & Mansur Mansur
       COURSE: COIS 3420H
       PURPOSE: This is the Setting page. It contains:
                1- A HTML form in which a user can edit their account, such as editting username, passowrd etc.
                2- A link to completely delete thier account.
-->
<?php //START OF PHP CODE
include ("includes/database.php"); // Include library file
session_start();  //start the session
$pdo = connectDB();   // Get database connection

//An arry to store errors
$PswErrors = [];  //for password errors
$userErrors = []; // for username errors
$PswMErrors = []; //for password mismatch errors


//Check if the user is not logged in
	if ( !isset($_SESSION['user']) ) {
    // if, then redirect to the login page
		header("Location:Login.php");
		exit();
	}

    //check if the user wants to delete the account
    if (isset($_POST['delete'])) {
      //prepare and execute the delete query of the user based withe userid in session
      $query = "DELETE FROM users WHERE id = ?";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$_SESSION['userid']]);

      // Unset and destroy user's session
      session_unset();
      session_destroy();

      // redirect the user to main index page
      header("Location: ./index.php");
      die();
    }

		 //Get the info of the user in session from the database
			$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
			$stmt->execute([$_SESSION['userid']]);
			$info = $stmt->fetchAll();


      if (isset($_POST['update']))
      {

				/* Get everything from $_POST */
	      $username = $_POST['username'] ?? NULL; //for Username
				$current_psw = $_POST['current_psw'] ?? NULL; //for the user's existing password
				$psw = $_POST['psw'] ?? NULL; //for the new password

        // compare the username given with the ones in the database table
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$_POST['username']]);
        $result = $stmt->fetch();


            // check if the username is already in use
            if (!empty($result) && $result['id'] != $_SESSION['userid']) {
                // set the flag to be false if the username is in use
								array_push($userErrors, "username already in use"); //allow only unique username
                }

              //===========================================USERNAME VALIDATION=======================================================//
                    /*
                      Validate Username with the following conditions:
                         1- Do not register a username with less than 3 character and more than 10 characters
                         2- Do not allow usernmae with special characters other than the regualr ones and numbers
                         3- Do not allow a username that has already been in use to registred again
                    */
              if (!( strlen($_POST['username']) >= 3 && strlen($_POST['username']) <= 10 && preg_match("/^[a-zA-Z0-9]*$/", $_POST['username']) )) array_push($userErrors, "invalid username");

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
						if (count($PswErrors) == 0 && count($userErrors) == 0 && count($PswMErrors) == 0 ){

								// Hash Password
								$HashPsw = password_hash($_POST['psw'], PASSWORD_DEFAULT);

                // UPDATE username in the users table.
          			$stm = "UPDATE users SET username = ? WHERE id = ?";
        				$pdo->prepare($stm)->execute([$_POST['username'], $_SESSION['userid']]);


								 // UPDATE password in the users table.
								 $stm2 = "UPDATE users SET password = ? WHERE id = ?";
								 $pdo->prepare($stm2)->execute([$HashPsw, $_SESSION['userid']]);

                //display a succsessful mesage then redirect to the loging page
                $_SESSION['message'] = "Hi there! Your account has been succesfully updated😊!";
                // Redirect the user to index page
                header("Location: ./success.php");
                die();
      }
		}



?><!--END OF PHP CODE-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>setting|welcome</title>
    <link rel="stylesheet" href="css/master.css">
		<script defer src="script/main.js"></script>
  </head>
  <body>
    <div class="container">
			<div class="bar1">
				<div>
					<img src="img/profile.png" alt="">
				</div>
				<div>
					<div>
						<p class="username"> <?php echo $_SESSION['user']; ?> </p>
						<h2>Setting</h2>
					</div>
				</div>
				<div id="edit">
						<p class="editAccount">Edit Account</p>
				</div>
				<div id="delete">
					<p class="deleteAccount">Delete Account</p>
				</div>
			</div>
			<div class="container">

				<div class="container">
  				<!-- update account form -->
  				<form id="updateForm" action="#" method="post">
						<h3 id="edit">Edit Account</h3>
  									<!--echo out username and passowrd ERRORS-->
						<span class='error' id="UsernameError"></span>
				              <!--echo out username ERRORS-->
				              <?php foreach ($userErrors as $error): ?>
				                <li id="error"><?= $error ?></li>
				              <?php endforeach; ?>
						<fieldset>
							<label for="username">Username</label>
							<input id="name" type="text" placeholder="username*" name="username" required="">
						</fieldset>

							<span class='error' id="PasswordError">
											<!--echo out password strength ERRORS-->
								<?php foreach ($PswErrors as $error): ?>
									<li id ="error"><?= $error ?></li>
								<?php endforeach; ?>
						<fieldset>
							<label for="psw"> new password: </label>
							<input id="psw" type="password" placeholder="password*" name="psw" required="" >
						</fieldset>

							<span class='error' id="PasswordError">
	                      <!--echo out password strength ERRORS-->
	                <?php foreach ($PswMErrors as $error): ?>
	                  <li id ="error"><?= $error ?></li>
	                <?php endforeach; ?>
						<fieldset>
							<label for="psw_repeat">confirm password: </label>
							<input id="psw" type="password" placeholder="confirm password*" name="psw_repeat" required="" >
						</fieldset>
            <fieldset>
            	<button type="submit" name="update" value="submit">Update</button>
            </fieldset>
  				</form>
  			</div>
				<div class="container">
					<!-- update account form -->
					<form id="deleteForm" action="#" method="post">
						<h3 id="delete">Delete Account</h3>
						<img src="img/delete.png"/>
						 <fieldset>
						 	<button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete your account? This action is irreversible!')">Delete Account</button>
						 </fieldset>
					</form>
				</div>
			</div>
    </div>
  </body>
</html>
