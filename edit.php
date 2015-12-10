<?php
session_start();

if(isset($_SESSION['user']) == "")
{
	header("Location: index.php");
}

$user = $_SESSION['user'];
include_once 'database.php';

if(isset($_POST['btn-save']))
{
	$emailAddress = mysql_real_escape_string($_POST['emailAddress']);
	$displayName = mysql_real_escape_string($_POST['displayName']);
	$location = mysql_real_escape_string($_POST['location']);
	$gameList = mysql_real_escape_string($_POST['gameList']);
	$password = $_POST['password'];
	if($password != '')
	{
		$passwordHash = md5($password);
		$query = mysql_query("UPDATE `users` SET `emailAddress` = '$emailAddress', `passwordHash` = '$passwordHash', `displayName` = '$displayName', `location` = '$location', `gameList` = '$gameList' WHERE `users`.`userID` = $user;");
	}
	else
	{
		$query = mysql_query("UPDATE `users` SET `emailAddress` = '$emailAddress', `displayName` = '$displayName', `location` = '$location', `gameList` = '$gameList' WHERE `users`.`userID` = $user;");
	}
	if(!$query)
	{
		?>
		<script>alert('An error occurred while updating your profile.');</script>
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
		<table border="0">
			<tr>
				<td>Login name:</td>
				<td>
					<?php
					//display login name
					$res = mysql_query("SELECT * FROM users WHERE userID='$user'");
					$row = mysql_fetch_array($res);
					echo($row['loginName']);
					?>
				</td>
			</tr>
			<tr>
				<td>Email address:</td>
				<td>
					<?php
					$emailAddress = $row['emailAddress'];
					echo("<input type=\"email\" name=\"emailAddress\" value=\"$emailAddress\" />");
					?>
				</td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password" placeholder="••••••••"/></td>
			</tr>
			<tr>
				<td>Display name:</td>
				<td>
					<?php
					$displayName = $row['displayName'];
					echo("<input type=\"text\" name=\"displayName\" value=\"$displayName\" />");
					?>
				</td>
			</tr>
			<tr>
				<td>Location:</td>
				<td>
					<?php
					$location = $row['location'];
					echo("<input type=\"text\" name=\"location\" value=\"$location\" />");
					?>
				</td>
			</tr>
			<tr>
				<td>Games:</td>
				<td>
					<?php
					$gameList = $row['gameList'];
					echo("<input type=\"text\" name=\"gameList\" value=\"$gameList\" />");
					?>
				</td>
			</tr>
			<tr>
				<td colspan=2>
					<button type="submit" name="btn-save">Save changes</button>
				</td>
			</tr>
		</table>
	</form>
</div>

<a href="./home.php">Back to home</a>

</body>
</html>