<?php
if(isset($_SESSION['user'])!=)
{
	header("Location: home.php");
}

$message = "Typr your message here";
echo "<script type='text/javascript'>alert('$message');</script>";
