<!--==========================================================MYLIST PAGE==================================================================
Student names: Ahmed Ahmed & Mansur Mansur
       COURSE: COIS 3420H
       PURPOSE: This is the myList page, that contains:
                I- Html part, that list the bucketlist of the user in a table, and allows edit/delete fucntionality
                II- PHP code that lists all the content of the user's backetlist from the database table in the Html table.
-->
<?php
   include('includes/database.php'); //requres database connection
   //connect to the database
   $pdo = connectDB();
   //session_start
   session_start();
   //check if the user has logged in
   if(!isset($_SESSION['user'])){
     //user has not logged
     header("Location:Login.php");  //redirect the user back to login
     exit();
   }

   //get all the values in the users_lists
   $statement = $pdo->prepare("SELECT * FROM users_lists WHERE user_id = ?");
   $statement->execute([$_SESSION['userid']]);

   //a while loop to store all the results from the above query in an array
   while ($results = $statement->fetch()){
     if(!empty($results)){
     //an array list to store all the content of the bukcetlist
     $List[] = array('id' => $results['id'], 'goal' => $results['goal'], 'category' => $results['category'], 'description' => $results['description'], 'location' => $results['location'], 'goalDate' => $results['goalDate']);}
   }
 ?><!--END OF PHP CODE-->

 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Display|welcome</title>
  <link rel="stylesheet" href="css/master.css">
  <script defer src="script/main.js"></script>
</head>
<body id="myList">
	<div>
    <div class="list">Hello <?php echo $_SESSION['user']?>!<br/>
      Your list information can be found in the table bellow</div>
		<table id="table">
			<tr class="tr1">
			<td>Goal</td>
			<td>Category</td>
			<td>Description</td>
			<td>Location</td>
			<td>Date</td>
			<td>Edit/Delete</td>
			</tr>
			<tr class="tr2">
        <!--foreach loop to list all the lists of the user and their content-->
        <?php foreach ($List as $myList): ?>
				<td><?php echo $myList['goal']; ?></td>
				<td><?php echo $myList['category']; ?></td>
				<td><?php echo $myList['description']; ?></td>
				<td><?php echo $myList['location']; ?></td>
				<td><?php echo $myList['goalDate']; ?></td>
        <?php $id = $myList['id']; ?><!--a php code to store the id of each list in order to allow edit/delete fucntionality-->
				<td><button name="edit"><a href="edit.php?id=<?=$id ?>">Edit</a></button> &nbsp;
           <button name="delete"><a href="deleteList.php?id=<?=$id?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a></button>
         </td>
			</tr>
    <?php endforeach; //end of foreach loop?>
		</table>
</div>
</body></html>
