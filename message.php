<?php

include_once 'head.php';

if(isset($_SESSION['user']) == '')
{
	header("Location: index.php");
}

//no profile specified in URL
if(!isSet($_GET['user']) || $_GET['user'] === '')
{
	header('Location: home.php');
}
else
{
	$user = mysql_real_escape_string($_GET['user']);
	$user = mysql_query("SELECT * FROM users WHERE loginName = '$user';");
	$user = mysql_fetch_array($user);
	if(!$user)
	{
		//bad URL
		header('Location: home.php');
	}
}

$viewer = $_SESSION['user'];
$viewer = mysql_query("SELECT * FROM users WHERE userID = '$viewer';");
$viewer = mysql_fetch_array($viewer);

if(isset($_POST['btn-send']))
{
	$message = mysql_real_escape_string($viewer['displayName'] . ': ' . $_POST['messageText']);
	$oldMessage = $user['pendingMessages'];
	if($oldMessage != '')
	{
		$message = $oldMessage . '<br />' . $message;
	}
	$userID = $user['userID'];
	$query = mysql_query("UPDATE `users` SET `pendingMessages` = '$message' WHERE `users`.`userID` = $userID;");
	if(!$query)
	{
		?>
		<script>alert('An error occurred while sending your message.');</script>
		<?php
	}
}

?>

<html>
<head>
	<title>Edit account</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
<div id="edit-form">
	<form method="post">
		<?php
			$userName = $user['displayName'];
			echo("<input type=\"text\" name=\"messageText\" style=\"width:500px\" placeholder=\"Enter your message to $userName here\" />");
		?>
		<br />
		<button type="submit" name="btn-send">Send message</button>
	</form>
</div>

</body>
</html>