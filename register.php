<!-- adapted from http://www.codingcage.com/2015/01/user-registration-and-login-script-using-php-mysql.html -->

<?php

session_start();

if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}
include_once 'database.php';

if(isset($_POST['btn-signup']))
{
	$loginName = mysql_real_escape_string($_POST['loginName']);
	$emailAddress = mysql_real_escape_string($_POST['emailAddress']);
	$passwordHash = md5($_POST['password']);
	$displayName = mysql_real_escape_string($_POST['displayName']);
 
	if(mysql_query("INSERT INTO users(loginName,emailAddress,passwordHash,displayName) VALUES('$loginName','$emailAddress','$passwordHash','$displayName')"))
	{
		?>
		<script>alert('Registration successful!');</script>
		<?php
		//grab the new user's info from database
		$res = mysql_query("SELECT * FROM users WHERE loginName='$loginName'");
		$row = mysql_fetch_array($res);
		//start session
		$_SESSION['user'] = $row['user_id'];
		//redirect
		header("Location: edit.php");
	}
	else
	{
		?>
		<script>alert('Error during registration.');</script>
		<?php
	}
}
?>

<html>
<head>
	<title>Registration</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>

Fields marked with a * are required.
<div id="login-form">
	<form method="post">
		<table border="0">
			<tr>
				<td>Login name*:</td><td><input type="text" name="loginName" placeholder="login name" required /></td>
			</tr>
			<tr>
				<td>Email address:</td><td><input type="email" name="emailAddress" placeholder="name@domain.com" /></td>
			</tr>
			<tr>
				<td>Password*:</td><td><input type="password" name="password" placeholder="••••••••" required /></td>
			</tr>
			<tr>
				<td>Display name*:</td><td><input type="text" name="displayName" placeholder="First Last" required /></td>
			</tr>
			<tr>
				<td colspan=2 style="text-align:center"><button type="submit" name="btn-signup">Register</button></td>
			</tr>
		</table>
	</form>
</div>

</body>
<html>