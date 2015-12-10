<?php

include_once 'database.php';

?>

<html>
<head>
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
	<div id="search-form">
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
	$name = $_POST['name'];
	header("Location: searchResults.php?name=$name");
}

?>

</body>
</html>