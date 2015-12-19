<?php

include_once 'database.php';
include_once 'head.php';

//session_start();

if(!isSet($_GET['user']) || $_GET['user'] === '')
{
	if(isset($_SESSION['user']) != "")
	{
		$user = $_SESSION['user'];
		$user = mysql_query("SELECT * FROM users WHERE userID='$user'");
	}
	else
	{
		header('Location: index.php');
	}
}
else
{
	$user = mysql_real_escape_string($_GET['user']);
	$user = mysql_query("SELECT * FROM users WHERE loginName = '$user';");
}


$user = mysql_fetch_array($user);

?>

<html>
<head>
	<title><?php echo($user['displayName']); ?>'s profile</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>

<h1><?php echo($user['displayName']) ?>'s profile</h1>

<ul>
	<li>Location: <?php echo($user['location']); ?></li>
	<li>Games: <?php echo($user['gameList']); ?></li>
</ul>

<a href="./home.php">Return to home</a><br />

</body>
</html>