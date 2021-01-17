<?php
/* require or include the library */
include "includes/library.php";

  /* Connect to DB */
$pdo=connectDB();
/* ------ <from-the-last-lab> ------- */
/* Redirect if $_POST has nothing in it */
if (!isset($_POST) || count($_POST) <= 0) {
  header("Location: voting.php");}

/* $errors starts as an empty array */
$errors = [];

/* Get everything from $_POST */
$name = $_POST['name'] ?? NULL;
$email = $_POST['email'] ?? NULL;
$perspective = $_POST['perspective'] ?? NULL;
$choice = $_POST['choice'] ?? NULL;
$agree = $_POST['agree'] ?? NULL;

/* Error Validation (from last lab) */
if (!isset($name) || strlen($name) === 0) array_push($errors, "Please enter a name.");
if (strpos($name, ' ') === FALSE) array_push($errors, "Please use your first and last name.");
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) array_push($errors, "Please enter a valid email address.");
if (!isset($perspective)) array_push($errors, "Please select your persepctive.");
if ($choice < 0) array_push($errors, "Please select an option.");
if (!isset($agree)) array_push($errors, "Please agree to the terms and conditions.");
/* ------ </from-the-last-lab> ------- */

/* If no errors, do database work */
if (count($errors) === 0) {

  /* Add the vote to `allvotes` */
  $query =  "INSERT INTO `cois3420_allvotes` (name, email, perspective, candy_choice) VALUES (?, ?, ?, ?)";
 $pdo->prepare($query)->execute([$name, $email, $perspective, $choice]);




  /* Increase the vote-count in `candies` */
$query = "UPDATE `cois3420_candies` SET votecount = votecount + 1 WHERE id = ?";
   $stm=$pdo->prepare($query);
   $pdo->execute([$_POST['choice']]);

  /* Redirect to thankyou.php */
header("Location:thankyou.php");
exit()
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  $PAGE_TITLE = "Something went wrong";
  include "./includes/metadata.php";
  ?>
</head>
<body>
  <?php include "./includes/header.php"; ?>
  <main>
    <h1>Errors</h1>
    <ul id="errors">
      <?php foreach ($errors as $error): ?>
        <li><?= $error ?></li>
      <?php endforeach; ?>
    </ul>
  </main>
  <!-- footer goes here -->
  <?php include "./includes/footer.php"; ?>
</body>

</html>
<?php if (empty($errors)) header("Location: thankyou.php"); ?>
