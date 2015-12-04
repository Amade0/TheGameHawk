<!-- adapted from http://www.codingcage.com/2015/01/user-registration-and-login-script-using-php-mysql.html -->
<?php
session_start();

if(!isset($_SESSION['user']))
{
	header("Location: index.php");
}
else if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}

if(isset($_GET['logout']))
{
	session_destroy();
	unset($_SESSION['user']);
	header("Location: index.php");
}
?>