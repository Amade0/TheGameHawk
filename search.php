<?php

include_once 'database.php';
include_once 'head.php';

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
					<td>
						Search by name:
					</td>
					<td>
						<input type="text" name="name" placeholder="Display name" />
					</td>
				</tr>
				<tr>
					<td>
						Search by games:
					</td>
					<td>
						<input type="text" name="games" placeholder="Owned games" />
					</td>
				</tr>
				<tr>
					<td>
						Search by location:
					</td>
					<td>
						<input type="text" name="location" placeholder="Location" />
					</td>
				</tr>
				<tr>
					<td rowspan=2>
						<button type="submit" name="btn-search">Search</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	<a href="./home.php">Back to home</a><br /><br />

<?php

if(isset($_POST['btn-search']))
{
	$name = $_POST['name'];
	$games = $_POST['games'];
	$location = $_POST['location'];
	if($name == '' && $games == '' && $location == '')
	{
		?>
		<script>alert('Please enter something into one or more of the search fields.');</script>
		<?php
	}
	else
	{
		header("Location: searchResults.php?name=$name&games=$games&location=$location");
	}
}

?>

</body>
</html>