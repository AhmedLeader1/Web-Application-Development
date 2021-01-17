<!--firstpage-index page-->
<!--  Student Name: Ahmed Ahmed
         Student #: 0632851

            Course: COIS 3420H
      Assignment #: Assignment 2 Question 3


           Purpose: In this qusestion I am required to create an API
                    that retrieves information form a database using GET request and print the
                    infromation in JSON format
-->

<!--HTML starts-->
<!DOCTYPE html>

<html lang="en">
<head>
<!--link to metadata -->
  <?php
  $PAGE_TITLE = "HOME |Welcome";
  include './includes/metadata.php';
   ?>
</head>
<body>
  <!--link to the heade page-->
    <?php include './includes/header.php'; ?>
  <main>
    <div class="container">

        <!--header and welcoming message that tells what this API can do-->
      <h1>Welcome to my API server</h1>
      <p> In my API project, I am creating an API that allows the user to play with the most popular quotes in the world</p>
        <ul>
          <li><strong>This API allows the user to: </strong></li>
          <li><strong>Generalte all the Quotes from the database at once in JSON format </strong></li>
          <li><strong>Randomly search Quotes based on Ids</strong></li>
          <li><strong>Randomly search Quotes based on year publihsed</strong></li>
            <li><strong>Randomly search Quotes based Author name</strong></li>

        </ul>

        <div>

            <!--link to the different API pages-->
          <a href="GetAll.php" class="start">Get all the quotes</a>
          <a href="apiId.php?id=" class="start">Get by Ids</a>
          <a href="apiYear.php?Year=2000"class="start">Get by Year</a>
            <a href="apiAuth.php?author=mae west"class="start">Get by Author</a>
        </div>

</div><br/>
</main>

  <!--link to the footer page-->
  <?php include './includes/footer.php'; ?>
</body>
</html>
