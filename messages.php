<?php

include_once 'head.php';

if(isset($_SESSION['user']) == '')
{
	header("Location: index.php");
}

$user = $_SESSION['user'];
$user = mysql_query("SELECT * FROM users WHERE userID = '$user';");
$user = mysql_fetch_array($user);

$messages = $user['pendingMessages'];

if(isset($_POST['btn-delete']))
{
	$userID = $user['userID'];
	$query = mysql_query("UPDATE `users` SET `pendingMessages` = '' WHERE `users`.`userID` = $userID;");
	$messages = '';
}

?>

<html>
<head>
	<title>Edit account</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
Messages:<br />
<br />
<?php
if($messages == '')
{
	echo('No messages.');
}
else
{
	echo($messages);
}
?>
<br />
<br />
<div id="edit-form">
	<form method="post">
		<button type="submit" name="btn-delete">Delete messages</button>
	</form>
</div>

</body>
</html>