<!--================================================ADD A LIST PAGE===================================================================
Student names: Ahmed Ahmed & Mansur Mansur
       COURSE: COIS 3420H
       PURPOSE: This is the create page. It contains:
                1- A HTML (the html body contains only the form) which contains a create goal form. which allows the user to
                   add a goal to their list.
                2- A PHP code that:
                    I. it checks first whether the user has already logged in. if so
                       the user can proceed with add goal or else it will redirect back to login page.
                    II. when the save button is clicked while all the form is filled,
                        it insert the goal in users_lists table in the database.
                    III. if the insertion was success it redirects the user back to
                         the display page.
-->
<?php
include ("includes/database.php"); // Include library file
session_start();  //start the session
$pdo = connectDB();   // Get database connection

//check if the user has logged in
if(!isset($_SESSION['user'])){
  //user has not logged
  header("Location:Login.php");  //redirect the user back to login
  exit();
}

//if already logged in and clicked save button

if(isset($_POST['button'])){

  //get all the values from the post
  $goal = $_POST['goal'] ?? NULL;
  $category = $_POST['category'] ?? NULL;
  $location = $_POST['location'] ?? NULL;
  $description = $_POST['description'] ?? NULL;
  $share = $_POST['share'] ?? NULL;
  $date = $_POST['date'] ?? NULL;
  $submit = $_POST['save_createGoal'] ?? NULL;



  /*
    Insert all the user information intot he tabel
  */
  $user_id = $_SESSION['userid'];
  $query = "INSERT INTO users_lists (user_id, goal, category, description, location, goalDate, share) VALUES (?,?,?,?,?,?,?)";
  if($_POST['share']== NULL){  //if user did not click the share radio button set the share column to 0. which is make it private.
    $pdo->prepare($query)->execute([$user_id,$_POST['goal'],$_POST['category'],$_POST['description'],$_POST['location'],$_POST['date'], 0]);}
  else {    //else share will be set to 1.
      $pdo->prepare($query)->execute([$user_id,$_POST['goal'],$_POST['category'],$_POST['description'],$_POST['location'],$_POST['date'], $_POST['share']]);
  }

  //take back to display pages
  header("Location:display.php");
  exit();
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Create a goal|welcome</title>
    <link rel="stylesheet" href="css/master.css">
    <script defer src="script/main.js"></script>
  </head>
  <body>
    <!--Content of the page-->
    <div class="container">
      <!--create a goal page-->
      <form id="createGoal" name="createGoal" class="createGoal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h3>Add Goal</h3>
        <fieldset>
          <input type="text" id="goal" name="goal" placeholder="Type your goal here" required="">
        </fieldset>
        <fieldset>
          <select id="category" name="category">
            <option value="">--Please choose category</option>
            <option value="travel">Travel</option>
            <option value="entertainment">Entertainment</option>
            <option value="food">Food</option>
            <option value="Business">Business</option>
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
          <button type="submit" name="button" id="save_createGoal" data-submit="...sending">Save</button>
          <button type="reset" name="button" id="cancel_createGoal" data-submit="...canceling">Cancel</button>
        </fieldset>
        <p class="copyright">Designed by Mansur & Ahmed</p>
      </form>
    </div>
  </body>
</html>
