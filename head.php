<html>
<?php
session_start();

if(isset($_SESSION['user']) == "")
{
	echo('<a href="./register.php">Register</a> // ');
	echo('<a href="./login.php">Log in</a>');
}
else
{
	echo('<a href="./home.php">Home</a> // ');
	echo('<a href="./profile.php">My profile</a> // ');
	echo('<a href="./logout.php">Log out</a>');
}

?>
<hr />
</html>