<?php

  $errors=array();
  ###do data validation here
  var_dump($_POST);

  $choice =$_POST['choice']?? "";
  if($choice == -1){
	  $errors['choice'] = "product choice error";
  }


  $name =$_POST['name']?? "";
  if((strlen($name) <= 0 ) || (strlen($name) !== "")){
	  $errors['name'] = "the name should be grater than 0";
  }

 $prof =$_POST['prof']?? "";
  if($prof ==0){

	$errors['prof'] = "you need to select one the perspective";
}



// Validate e-mail
$email =$_POST['email']?? "";
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false){
	 $errors['email'] = "email erro";
 }

$agree =$_POST['agree']??"";{
	if($agree =="" )
$errors['agree'] = "you must agree";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <?php $PAGE_TITLE="process";
 include 'includes/metadata.php'
 ?>
</head>
<body>
  <?php include 'includes/header.php'?>
  <main>
    <h1>Errors</h1>
    <ul id="errors">
      <?php foreach ($errors as $error): ?>
        <li><?= $error ?></li>
      <?php endforeach; ?>
    </ul>
  </main>
  <?php include 'includes/footer.php'?>

  <!-- Fix for Chrome bug, leave this. https://stackoverflow.com/a/42969608 -->
  <script> </script>
</body>

</html>
