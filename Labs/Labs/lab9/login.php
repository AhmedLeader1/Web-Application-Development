<?php
session_start();
require "./includes/library.php";

$errors = [];

/* If this form has been submitted... */
if (isset($_POST['submit'])) {
  /* Process log-in request */
  $username = $_POST['username'];
  $password = $_POST['password'];

  /* Connect to DB */
  $pdo = connectDB();

  /* Check the database for occurances of $username */
  $query = "SELECT username, password FROM `cois3420_users` WHERE username = ?";
  $statement = $pdo->prepare($query);

  $statement->execute([ $username ]);
  $results = $statement->fetch();

  if ($results === FALSE) {
    array_push($errors, "That user doesn't exist.");
  } else if (password_verify($password, $results['password'])) {
    $_SESSION['username'] = $username;
    header("Location: results.php");
    exit();
  } else {
    array_push($errors, "Incorrect password.");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  $PAGE_TITLE = "Login to Willy Wonka";
  include "./includes/metadata.php";
  ?>
  <style>
    #login-form {
      padding: 0.25rem;
    }
  </style>
</head>
<body>
  <?php include "./includes/header.php" ?>
  <main>
    <h1>Login</h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
      <div id="login-form">
        <div class="centered">
          <label for="username">Username:</label>
          <input type="text" name="username" id="username" placeholder="Username">
        </div>
        <div class="centered">
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" placeholder="Password">
        </div>
        <div class="centered">
          <ul id="errors">
            <?php foreach ($errors as $error): ?>
              <li><?= $error ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <button id="submit" name="submit" class="centered">Log In</button>
    </form>
  </main>
  <?php include "./includes/footer.php" ?>
</body>
</html>