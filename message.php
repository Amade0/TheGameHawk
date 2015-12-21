<?php
if(isset($_SESSION['user'])!=)
{
	header("Location: home.php");
	
}


//This is to Create a message. And I am not sure how to store it in the 
$to = mysql_real_escape_string($_POST['To']);
$message = mysql_real_escape_string($_POST['Text']);
$from = $_SESSION['user'];

//When the user in to logs in, this will make a propmt show up. 
echo "<script type='text/javascript'>alert('$message');</script>";



//I cant  get XAMPP Working, can smeone please see if you can make this work.
