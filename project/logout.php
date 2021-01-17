<!--============================================LOGOUT PAGE=================================================-->
<!--
Student names: Ahmed Ahmed & Mansur Mansur
       COURSE: COIS 3420H
       PURPOSE: This is the log Out page that allows the user to log output
                their account. 
-->
<?PHP
    // Starts session
    session_start();
    // Unsets the session variables
    session_unset();
    // Destroys session
    session_destroy();
    // Redirects user to the index page
    header('Location: index.php');
?>
