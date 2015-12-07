<?php
session_start();

if(isset($_SESSION['user']) == "")
{
	header("Location: index.php");
}

$user = $_SESSION['user'];
include_once 'database.php';

if(isset($_POST['btn-change-email']))
{
	$emailAddress = mysql_real_escape_string($_POST['emailAddress']);
	mysql_query("UPDATE `users` SET `emailAddress` = '$emailAddress' WHERE `users`.`userID` = $user;");
}

if(isset($_POST['btn-change-password']))
{
	$passwordHash = md5($_POST['password']);
	mysql_query("UPDATE `users` SET `passwordHash` = '$passwordHash' WHERE `users`.`userID` = $user;");
}

if(isset($_POST['btn-change-display-name']))
{
	$displayName = mysql_real_escape_string($_POST['displayName']);
	mysql_query("UPDATE `users` SET `displayName` = '$displayName' WHERE `users`.`userID` = $user;");
}

if(isset($_POST['btn-change-location']))
{
	$location = mysql_real_escape_string($_POST['location']);
	mysql_query("UPDATE `users` SET `location` = '$location' WHERE `users`.`userID` = $user;");
}

if(isset($_POST['btn-change-game-list']))
{
	$gameList = mysql_real_escape_string($_POST['gameList']);
	mysql_query("UPDATE `users` SET `gameList` = '$gameList' WHERE `users`.`userID` = $user;");
}

?>

<html>
<head>
	<title>Edit account</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>

<?php
echo('<div id="edit-form">
	<form method="post">
		<table border="0">
			<tr>
				<td>Login name:</td><td colspan=2>');
					//display login name
					$res = mysql_query("SELECT * FROM users WHERE userID='$user'");
					$row = mysql_fetch_array($res);
					echo($row['loginName']);
				echo('</td>
			</tr>
			<tr>
				<td>Email address:</td><td><input type="email" name="emailAddress" placeholder="');
					echo($row['emailAddress']);
				echo('" /></td><td><button type="submit" name="btn-change-email">Change</button></td>
			</tr>
			<tr>
				<td>Password:</td><td><input type="password" name="password" placeholder="••••••••"/></td><td><button type="submit" name="btn-change-password">Change</button></td>
			</tr>
			<tr>
				<td>Display name:</td><td><input type="text" name="displayName" placeholder="');
					echo($row['displayName']);
				echo('" /></td><td><button type="submit" name="btn-change-display-name">Change</button></td>
			</tr>
			<tr>
				<td>Location:</td><td><input type="text" name="location" placeholder="');
					echo($row['location']);
			echo('" /></td><td><button type="submit" name="btn-change-location">Change</button></td>
			</tr>
			<tr>
				<td>Games:</td><td><input type="text" name="gameList" placeholder="');
					echo($row['gameList']);
				echo('" /></td><td><button type="submit" name="btn-change-game-list">Change</button></td>
			</tr>
		</table>
	</form>
</div>');
?>

<a href="./home.php">Back to home</a>

</body>
</html>