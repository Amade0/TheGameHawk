<html>
<head>
	<title>Log in</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<?php
session_start();
include_once 'database.php';

if(isset($_SESSION['user']) != "")
{
	header("Location: index.php");
}
if(isset($_POST['btn-login']))
{
	$loginName = mysql_real_escape_string($_POST['loginName']);
	$upass = md5($_POST['password']);
	$res = mysql_query("SELECT * FROM users WHERE loginName='$loginName'");
	$row = mysql_fetch_array($res);
	if($row['passwordHash'] == $upass)
	{
		$_SESSION['user'] = $row['user_id'];
		header("Location: index.php");
	}
	else
	{
		?>
		<script>alert('Invalid username or password. Please try again.');</script>
		<?php
	}
}
?>

<body>
	<div id="login-form">
		<form method="post">
			<table border="0">
				<tr>
					<td>Login name:</td><td><input type="text" name="loginName" placeholder="Login name" required /></td>
				</tr>
				<tr>
					<td>Password:</td><td><input type="password" name="password" placeholder="••••••••" required /></td>
				</tr>
				<tr>
					<td colspan=2 style="text-align:center"><button type="submit" name="btn-login">Log in</button></td>
				</tr>
			</table>
		</form>
	</div>
	Don't have an account? <a href="./register.php"> Register here!</a><br />
</body>
<html>