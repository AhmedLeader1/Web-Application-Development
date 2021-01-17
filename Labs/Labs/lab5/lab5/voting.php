<!DOCTYPE html>
<html lang="en">

<?php $PAGE_TITLE="voting";
 include 'includes/head_includes.php'
 ?>

<body>
    <img src="./img/wonka.png" width="300" height="230" alt="">
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
          <option value="0">Piglets</option>
          <option value="1">Snowballs</option>
          <option value="2">Yumyums</option>
          <option value="3">Puffs</option>
          <option value="4">Yahoos</option>
          <option value="5">Doodles</option>
        </select>
      </div>
      <div>
        <input id="agree" type="checkbox" name="agree">
        <label for="agree">I agree to the <a href="">Terms and Conditions</a>.</label>
      </div>
      <button id="submit" name="submit" class="centered">Submit Vote</button>
    </form>
  </main>

<?php include 'includes/footer.php'?>

  <!-- Fix for Chrome bug, leave this. https://stackoverflow.com/a/42969608 -->
  <script> </script>
</body>

</html>
