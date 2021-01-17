    <?php
    /*
    // Get All page
    //  Student Name: Ahmed Ahmed
    //         Student #: 0632851

    //            Course: COIS 3420H
    //      Assignment #: Assignment 2 Question 3


               Purpose: In this qusestion I am required to create an API
                        that retrieves information form a database using GET request and print the
                        infromation in JSON format
    */

    // include database connection
    require_once "includes/db.php";
    // create an API class
    class API{
      // create a method 'select' to get the stuff fromt the database
      function select(){
      // create a database connection with PDO
      $pdo=connectdb();
      // create a 'quote' array to store all the table's info
      $quotes = array();
      // build a query to select all the quotes from the database
      $query = ("SELECT * FROM quotes");
      // prepare the above query
      $stmt=$pdo->prepare($query);
      // execute the above query
      $stmt->execute();
    // use a while loop to store all the associated info from the table in the database
    while($output = $stmt->fetch(PDO::FETCH_ASSOC))
      {
         // prepare the array to store the different stuff in the table
          $quotes[$output['id']] = array(
           // for all the id's in the table
          'id' => $output['id'],
          // for the quores formt he table
          'quote' => $output['quote'],
          // for all the authors
          'author' => $output['author'],
          //for all the tags (quote types)
           'tag' => $output['tag']
        );
      }
      // returon the data in JSON fromat
      return json_encode($quotes);
    }
  }

  $API = new API;
  // prepare the header in JSON
  header('Content-Type: application/json');
  // ehco out all the data in the select method
  echo $API->Select();

    ?>
