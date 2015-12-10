<?php

if(!isSet($_GET['user']) || $_GET['user'] === '')
{
	header('Location: home.php');
}

include_once 'database.php';

$user = mysql_real_escape_string($_GET['user']);
$user = mysql_query("SELECT * FROM users WHERE loginName = '$user';");
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