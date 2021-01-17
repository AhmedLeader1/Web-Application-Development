<?php
/* Redirect if $_POST has nothing in it */
if (!isset($_POST) || count($_POST) <= 0) {
  header("Location: voting.php");
}

/* $errors starts as an empty array */
$errors = [];

/* Error Validation */
if (!isset($_POST['name']) || strlen($_POST['name']) == 0)
  array_push($errors, "Please enter a name.");

// if (...)
if (!isset($_POST['name']) || strlen($_POST['name']) == 0)
  array_push($errors, "Please enter a name.");

  $name =$_POST['name']?? "";
  if((strlen($name) <= 0 )|| (strlen($name) !== "")){
   $errors['name'] = "the name should be grater than 0";

//  Push "Please use your first and last name." to $errors


// if (...)
//  Push to $errors
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
	 $errors['email'] = "the eamil should be longer than 0 and not grater than 100";
 }
$agree =$_POST['agree']??"";{
	if($agree =="" )
$errors['agree'] = "you must agree";
}
?>

// and so on...
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  // Set $PAGE_TITLE to something
  // Include the metadata
   $PAGE_TITLE="something";
 include 'includes/metadata.php'
 ?>
  ?>
</head>
<body>

<?php
  // Include the header
  include 'includes/header.php'?>

  <main>
    <h1>Errors</h1>
    <ul id="errors">
      <?php foreach ($errors as $error): ?>
        <li><?= $error ?></li>
      <?php endforeach; ?>
    </ul>
  </main>

<?php
  // Include the footer
   include 'includes/footer.php'?>

  <!-- Fix for Chrome bug, leave this. https://stackoverflow.com/a/42969608 -->
  <script> </script>

</body>

</html>
