
<?php
/*
// Get by id page
//  Student Name: Ahmed Ahmed
//         Student #: 0632851

//            Course: COIS 3420H
//      Assignment #: Assignment 2 Question 3


           Purpose: In this qusestion I am required to create an API
                    that retrieves information form a database using GET request and print the
                    infromation in JSON format
*/

// include database connection
require "includes/db.php";

// method to process the GET request based on id
function get_Id($id)
{
  // create database connection
  $pdo = connectdb();
  // build the query to select stuff from the database based on author name
  $query = ("SELECT * FROM quotes WHERE id=?");
  //prepare the above query
  $stmt=$pdo->prepare($query);
  //execute the above query
  $stmt->execute([$id]);
  //fech all the info associated in the query passed
  $output=$stmt->fetchAll();
  return $output; //returns the output fromt the database
}
// checks if the GET request is not empty
if(!empty($_GET['id']))
{
    // prepare a GET request and store in $Year variable
    $id = $_GET['id'];
      // store the GET query in $info
    $info = get_Id($id);
    //checks whether the $info varaible is empty
    if(empty($info))
    {
         // if the GET request is empty print this
         response(200,"SORRY the request is empty",NULL);
       }
            else{
                //if the GET request is valid and has value print this
               response(200,"The GET request found is:",$info);
             }
}
           else{
               // prints this if the request is not valid
               response(400,"Invalid Request",NULL);
             }

                 // mehod/function to print the above responses
                 function response($status,$status_message,$data)
                   {
                           // prepare header in JSON and HTTP format
                           header("Content-Type:application/json");
                           header("HTTP/1.1 ".$status);
                           // check if the data is found based on the GET request
                           if (!$data)
                           {
                             //if the data is not in recored print an ERROR message
                             echo json_encode("ERROR!, There is no such id in record");
                             exit();
                           }
                           else
                           // print the data in JSON format
                            $json_response = json_encode($data);
                            echo $json_response;
                 }


?>
