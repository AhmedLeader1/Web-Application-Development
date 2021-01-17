<?php
require './includes/library.php';
$pdo = connectDB();

// Prepare the query
$query = "SELECT id, name FROM cois3420_candies";
$statement = $pdo->prepare($query);


// Execute the query with a list of parameters (0 '?' in this case)
$statement->execute([]);

// Get results
$results = $statement->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php
  $PAGE_TITLE = "Vote for Wonka's Next Candy!";
  include "./includes/metadata.php";
  ?>
</head>
<body>
  <?php include "./includes/header.php"; ?>
  <main>
    <h1>Vote for Wonka's<sup>&reg;</sup> next candy!</h1>
    <form id="main-form" action="./processvote.php" method="post">
      <div>
        <label for="name">Name:</label>
        <input id="name" name="name" type="text" placeholder="John Smith">
      </div>
      <div>
        <label for="email">Email Address:</label>
        <input id="email" name="email" type="text" placeholder="john.smith@gmail.com">
      </div>
      <fieldset>
        <legend>Perspective</legend>
        <div>
          <input id="radio-customer" name="perspective" type="radio" value="customer">
          <label for="radio-customer">Customer</label>
        </div>
        <div>
          <input id="radio-reseller" name="perspective" type="radio" value="reseller">
          <label for="radio-reseller">Reseller</label>
        </div>
        <div>
          <input id="radio-oompa" name="perspective" type="radio" value="oompa">
          <label for="radio-oompa">Oompa-Loompa</label>
        </div>
      </fieldset>
      <div>
        <label for="choice">Product Choice:</label>
        <select id="choice" name="choice">
          <option value="-1" selected>Select an option</option>
          <!-- Loop through the results of the SELECT query up above: -->
          <?php foreach ($results as $row): ?>
              <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
            <?php endforeach; ?>
        </select>
      </div>
      <div>
        <input id="agree" type="checkbox" name="agree">
        <label for="agree">I agree to the <a href="">Terms and Conditions</a>.</label>
      </div>
      <button id="submit" name="submit" class="centered">Submit Vote</button>
    </form>
  </main>
  <?php include "./includes/footer.php"; ?>
</body>

</html>
