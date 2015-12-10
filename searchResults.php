<?php

if(!isSet($_GET['name']) || $_GET['name'] === '')
{
	header('Location: search.php');
}

$searchName = $_GET['name'];

$games = $_GET['games'];

include_once 'database.php';

?>

<html>
<head>
	<title>Search</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>

<ol>
<?php
	$searchName = mysql_real_escape_string($searchName);
	$games = mysql_real_escape_string($games);
	$results = mysql_query("SELECT * FROM users WHERE displayName LIKE '%$searchName%' AND gameList LIKE '%$games%'");
	$i = 0;
	while($row = mysql_fetch_assoc($results))
	{
		$i++;
		$loginName = $row['loginName'];
		$name = $row['displayName'];
		$games = $row['gameList'];	
		$location = $row['location'];
		$link = "./profile.php?user=$loginName";
		echo("<li><a href=\"$link\">$name</a> is in $location and owns $games</li>");
	}
	if($i == 0)
	{
		echo('No results.');
	}
?>
</ol>
<a href="./search.php">Search again</a><br />
<a href="./home.php">Return to home</a><br />

</body>
</html>