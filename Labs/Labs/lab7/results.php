<?php
###########################################
#put session stuff to check for login here
session_start();
if (!isset($_SESSION['user'])) {
  header("Location:login.php");
  exit();
}
############################################


include 'includes/library.php';  //include library file
$pdo = connectdb();//construct database object

//build query to get all reults ordered by most votes

$stmt=$pdo->query("select name,votecount from cois3420_candies order by votecount DESC");

if(!$stmt)
    die("Database pull did not return data");

//build query to get total votes(need to do seperatly since tfoot must come first)
 $stmt2=$pdo->query("select sum(votecount) as total from cois3420_candies");
 $total=$stmt2->fetchColumn(); // will only be one value



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  $PAGE_TITLE = "Super Secret Results";
  include './includes/metadata.php';
  ?>
</head>
<body>
  <?php include './includes/header.php'; ?>
        <main>
          <div id="tablewrap">
          	<table id="results" cellspacing="0">
              	<thead>
                	<tr>
                    <th>Professor</th>
                    <th>Number of Votes</th>
                	</tr>
                </thead>
                <tfoot>
                  <tr>
                  	<td>Total Votes</td>
                    <td><?php echo $total //output total ?></td>
                  </tr>
                </tfoot>
                <tbody>
                  <?php foreach ($stmt as $row):   //loop through result set ?>
                      <tr>
                      	<td><?php echo $row['name']  //output prof name ?></td>
                        <td><?php echo $row['votecount']  //output number of votes ?></td>
                      </tr>

            			<?php endforeach; ?>

                </tbody>
             	</table>
          </div>

        </main><!--Content-->
      <?php include './includes/footer.php'; ?>
</body>
</html>
