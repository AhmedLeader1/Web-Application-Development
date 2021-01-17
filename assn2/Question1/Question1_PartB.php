<!--  Part B page
      Student Name: Ahmed Ahmed
         Student #: 0632851

            Course: COIS 3420H
      Assignment #: Assignment 2 Question 1 Part B

           Purpose: In Question 1 Part B , I am required to implement a php code that allows a user to specify a range, and then
                    generated a Multiplication table based on the range specified by the user.
-->
<!DOCTYPE html>
<html lang='en'>
    <head>
    <title>Question 1 Part B | Multiplication Table</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body> <!--start of the main body -->
      <div id="container">
      <h1>Welcome to Multiplication Wesite</h1>
      <form method="post">
         Please Enter the Low range:
        <input type="number" name="lowRange"/><br><br>
        Please Enter the High range:
        <input type="number" name="highRange"/><br><br>
        <input type="submit" name="submit" value="Create the Multiplication Table">
      </form> <br/>

        <table> <!--start of the table -->
            <?php


        // Check if the user's preses the submit button
        if(isset($_POST['submit']))

        {
          // assign low to the user's input for the low range value
          $low = $_POST['lowRange'];

        // assign low to the user's input for the high range value
          $high = $_POST['highRange'];
        // make sure the user does not print a multiplication table with more rows
        if ($_POST['lowRange'] >= $_POST['highRange'])
        {
          // print an ERROR message if the low value is greater than the high range value
          echo "ERROR! THE LOW RANGE CANNOT BE LARGER THAN THE HIGH RANGE";
        }

        // restrict the user not to print a multiplication table that exceeds the space (no one wants 1000 X 1000)
        else if ($low > 40 || $high > 41)
        {
          // print an ERROR message if the the ranges are larger than 45
          echo "ERROR! THAT IS A VERY LARGE TABLE";
        }
        else {
        // Print the caption ontop of the table and tell the what the table is all about
        echo "<caption>This table shows the Multiplication of numbers 1 to $low X 1 to $high</caption>";
        // a for loop to for the low range values
        for( $i = 1; $i <=$_POST['lowRange']; $i++)
        {
        echo "<tr>";
            // a for loop for the hihg rang values
            for( $j= 1; $j<=$_POST['highRange']; $j++)
            {
            // assign variables for the color stylings
            ($j==$i) ? $bc = "equal" : $bc = "different";
            // print the multiplication table
            echo "<td class='$bc'><a href='#' title='$i x $j = ". $i * $j .  "  ' >" . $i*$j . "</a></td>" ;
            }
        echo  "</tr>";
        }
      }
    }
  ?>
   </div>
 </table> <!--end of the table -->
</body> <!--end of the main body -->
</html> <!--end of the thml page -->
