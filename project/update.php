<!--==========================================================UPDATE PAGE==================================================================
Student names: Ahmed Ahmed & Mansur Mansur
       COURSE: COIS 3420H
       PURPOSE: This is the UPDATE page. It contains:
                1- A HTML which shows form in which the user can fill in order to edit an existing list
                2- A PHP code that updates the selected list with the information provided in the edit form

-->
<?php
 include('includes/database.php'); //requres database connection
$pdo = connectDB();   // Get database connection

//session_start
session_start();
//check if the user has logged in
if(!isset($_SESSION['user'])){
  //user has not logged
  header("Location:Login.php");  //redirect the user back to login
  exit();
}

//if already logged in and clicked save button
if(isset($_POST['update'])){
  //get all the values from the post
  $goal = $_POST['goal'] ?? NULL;
  $category = $_POST['category'] ?? NULL;
  $location = $_POST['location'] ?? NULL;
  $description = $_POST['description'] ?? NULL;
  $share = $_POST['share'] ?? NULL;
  $date = $_POST['date'] ?? NULL;

  // UPDATE Goal in the users_list table.
  $stm = "UPDATE users_lists SET goal = ? WHERE id = ?";
  $pdo->prepare($stm)->execute([$_POST['goal'], $_SESSION['list']]);


  // UPDATE Goal in the users_list table.
  $stm = "UPDATE users_lists SET category = ? WHERE id = ?";
  $pdo->prepare($stm)->execute([$_POST['category'], $_SESSION['list']]);


  // UPDATE location in the users_list table.
  $stm = "UPDATE users_lists SET location = ? WHERE id = ?";
  $pdo->prepare($stm)->execute([$_POST['location'], $_SESSION['list']]);


  // UPDATE description in the users_list table.
  $stm = "UPDATE users_lists SET description = ? WHERE id = ?";
  $pdo->prepare($stm)->execute([$_POST['description'], $_SESSION['list']]);


  // UPDATE privacy setting in the users_list table.
  $stm = "UPDATE users_lists SET share = ? WHERE id = ?";
  if ($_POST['share'] == NULL){
    //if the user opts not to share, make it private by inserting 0
    $pdo->prepare($stm)->execute([0, $_SESSION['list']]);
  }else{
    //if the users wishes to share, make it public
  $pdo->prepare($stm)->execute([$_POST['share'], $_SESSION['list']]);
}
  // UPDATE Date in the users_list table.
  $stm = "UPDATE users_lists SET goalDate = ? WHERE id = ?";
  $pdo->prepare($stm)->execute([$_POST['date'], $_SESSION['list']]);

  header("Location: myList.php");
  exit();
}


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update List|welcome</title>
    <link rel="stylesheet" href="css/master.css">
    <script defer src="script/main.js"></script>
  </head>
  <body>
    <div class="container">
      <form id="createGoal" name="createGoal" class="createGoal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h3>Update Your List</h3>
        <fieldset>
          <input type="text" id="goal" name="goal" placeholder="Type your goal here" required="">
        </fieldset>
        <fieldset>
          <select id="category" name="category">
            <option value="">--Please choose category</option>
            <option value="travel">Travel</option>
            <option value="entertainment">Entertainment</option>
            <option value="food">Food</option>
            <option value="health">Health</option>
            <option value="education">Education</option>
            <option value="sports">Sports</option>
            <option value="nature">Nature</option>
          </select>
        </fieldset>
        <fieldset>
          <input type="text" name="location" placeholder="Enter a location" required="">
        </fieldset>
        <fieldset>
          <input type="date" id="date" name="date" placeholder="Enter target date" required="">
        </fieldset>
        <fieldset>
          <textarea id="description" name="description" rows="8" cols="60" placeholder="Describe your goal" required=""></textarea>
        </fieldset>
        <fieldset>
          <input type="checkbox" name="share" value="1">
          <label for="share">Share with friends</label>
        </fieldset>
        <fieldset>
          <button type="submit" name="update" id="save_createGoal" data-submit="...sending">Save</button>
          <button type="reset" name="button" id="cancel_createGoal" data-submit="...canceling">Cancel</button>
        </fieldset>
        <p class="copyright">Designed by Mansur & Ahmed</p>
      </form>
    </div>
  </body>
</html>
