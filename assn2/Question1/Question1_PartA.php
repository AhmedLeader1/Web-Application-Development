<!--  Part A page  
      Student Name: Ahmed Ahmed
         Student #: 0632851

            Course: COIS 3420H
      Assignment #: Assignment 2 Question 1 Part A

           Purpose: In this Question, I am supposed to implement a php code that manipulates a list of names in
                    array according to the insturctions indicated bellow.
-->
<!DOCTYPE html>
<html lang='en'>
<head>

  <!-- Title for the Question 1 Part A -->
  <title>Assignment 2 Question 1 Part A</title>

  <!-- Link to CSS file-->
  <link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div id="partA">
<!-- Heading for the Question 1 Part A -->
<h1>This is Assignment2 Question 1 Part A</h1>

<?php
// Use the names given in the following string
  $names="Harry Potter, ron Weasley, Hermione Granger, lavender brown, Pavarti patil, NEVILLE
          Longbottom, Seamus FiNNegan, Dean Thomas";

// Split the string into Array Called $arrayNames
   $arrayNames = explode (",",$names);

// Add draco Malfoy to the end of the array
   $arrayNames []='draco Malfoy';

// Do a case-insensitive sort of the names in the array
   natcasesort($arrayNames);
/* Use a loop to traverse $arrayNames and for each value make sure 1st letter fo the 1st
  and last name is capitalized, and output the names in an unordered list, and use the house color calsses
  defined in the CSS below and modify the loop/list item output so that if the name doesn't contain the letter
  "h/H" the list item appears  .rav{color: #000066;}, otherwise .griff{color: #660000;}
*/
foreach ($arrayNames as $value)
{
  if(stripos($value,"h") !== false)
  {
    // assigning a variable for color stylings of the names with "h/H"
     $h = "withH";
    echo "<li class='$h'>"; // put in class '$h'
    // make sure only the only first letter of every name is capitalized
    echo (ucwords(strtolower($value)));
    echo "</li>";
  } else
      {

    // assigning a variable for color stylings of the names without "h/H"
     $oth ="others";
      echo "<li class='$oth'>";  // put in class '$oth'
    // make sure only the only first letter of every name is capitalized
      echo (ucwords(strtolower($value)));
      echo"</li>";
      }
}

?> <!-- End of the PHP -->
</div>
</body>
</html>
