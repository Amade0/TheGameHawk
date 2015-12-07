<?php

include_once 'database.php';

?>

<html>
<head>
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
	<div id="login-form">
		<form method="post">
			<table border="0">
				<tr>
					<td>Search by name:</td><td><input type="text" name="name" placeholder="Display name" required /></td><td><button type="submit" name="btn-search">Search</button</td>
				</tr>
			</table>
		</form>
	</div>
	<a href="./home.php">Back to home</a><br /><br />

<?php

if(isset($_POST['btn-search']))
{
	$name = mysql_real_escape_string($_POST['name']);
	$res = mysql_query("SELECT * FROM users WHERE displayName='$name'");
	$row = mysql_fetch_array($res);
	if($row == "")
	{
		echo("No results");
	}
	else
	{
		$name = $row['displayName'];
		$games = $row['gameList'];
		$location = $row['location'];
		echo("1: $name is in $location and owns $games");
	}
}

?>

</body>
</html>