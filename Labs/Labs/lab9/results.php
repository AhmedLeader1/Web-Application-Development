<?php
session_start();
require "./includes/library.php";

/* If they're not logged in... */
if (!isset($_SESSION['username'])) {
  /* Redirect them */
  header("Location: login.php");
}

$pdo = connectDB();

$query = "SELECT name, votecount FROM `cois3420_candies`";
$statement = $pdo->prepare($query);

$statement->execute([]);

$results = $statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  $PAGE_TITLE = "Wonka Voting Results";
  include "./includes/metadata.php";
  ?>
</head>
<body>
  <?php include "./includes/header.php" ?>
  <main>
    <h1>Results</h1>
    <table>
      <thead>
        <th>Candy Name</th>
        <th>Votes</th>
      </thead>
      <tbody>
        <?php foreach ($results as $row): ?>
          <tr>
            <td><?= $row['name'] ?></td>
            <td class="number"><?= $row['votecount'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>
  <?php include"./includes/footer.php" ?>
</body>
</html>