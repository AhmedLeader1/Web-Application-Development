<?php
  #put form processing here
  include "includes/library.php";

  $usererror = "";
  $username = "";

  if(isset($_POST['submit'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $pdo = connectDB();
    $query = "SELECT username, password FROM `cois3420_users` WHERE username = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$username]);

    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if(password_verify($password,$result['password'])){

      session_start();
      $_SESSION['user'] = $result['username'];
      $_SESSION['userid'] = $result['id'];

      header("Location:results.php");
      exit();
    }else{
      $usererror = "incorrect password";
    }


  }elseif (isset($_COOKIE['user'])) {
    $username = $_COOKIE['user'];
  }

  #run the following query using a prepared statement to check the database for users
  #whose name matches what the user submitted in $_POS
  #fetch results
  #use if, else if, else statement to check the following

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  $PAGE_TITLE = "Login";
  include './includes/metadata.php';
  ?>
</head>
<body>
  <?php include './includes/header.php'; ?>

       <main>
         <h1>Super Secret Voting Results</h1>

        <form id="login" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" />
            <div>
              <label for="username">Username:</label>
              <!--notice the echo of username to allow for a sticky form on error-->
              <input type="text" id="username" name="username" size="25" value="<?php echo $username; ?>">
            </div>
            <div>
              <label for="password">Password:</label>
              <input type="password" id="password" name="password" size="25" />
            </div>
            <div>
               <!--notice variable which triggers output of error message if sticky processing fails-->
           <?php if ($usererror){?><span class="error">Your username or password was invalid</span> <?php }?>
            </div>
            <div>
                <label for="remember">Remember:</label>
              <input type="checkbox" name="remember" value="remember" />
            </div>

          <button id="submit" name="submit" class="centered">Login</button>

    </form>


      </main><!--Content-->
     <?php include './includes/footer.php'; ?>
</body>
</html>
