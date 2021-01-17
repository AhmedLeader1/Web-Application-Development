<!--============================================ERROR PAGE=================================
Displays all the unsuccessfull messages
-->
<?php
//Displays all the successfull messages
session_start();
?>
<!Doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>success|welcome</title>
  <link rel="stylesheet" href="css/master.css">
  <script defer src="script/main.js"></script>
</head>
<body>
  <div class="container">
    <form id="msgform">
      <h3>SUCCESS!</h3>
      <p>
        <?php
        if (isset($_SESSION['message']) AND !empty($_SESSION['message'])):
          echo $_SESSION['message'];
        else:
          header("Location: index.php");
        endif;
        ?>
      </p>
      <a class="msglink" href="Login.php">Login</a>
    </form>
  </div>
</body>
</html>

<?php
//Displays all the error messages
session_start();
?>
<!Doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>error|welcome</title>
  <link rel="stylesheet" href="css/master.css">
  <script defer src="script/main.js"></script>
</head>
<body>
  <div class="container">
    <form id="errorMsgForm">
      <h3>ERROR!</h3>
      <p>
        <?php
        if (isset($_SESSION['message']) AND !empty($_SESSION['message'])):
          echo $_SESSION['message'];
        else:
          header("Location: index.php");
        endif;
        ?>
      </p>
      <a class="msglink" href="index.php">HOME PAGE</a>
    </form>
  </div>
</body>
</html>
