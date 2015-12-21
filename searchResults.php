<?php

if(isSet($_GET['name']))
{
	$searchName = $_GET['name'];
}
else
{
	$searchName = '';
}

if(isSet($_GET['games']))
{
	$games = $_GET['games'];
}
else
{
	$games = '';
}

if(isSet($_GET['location']))
{
	$location = $_GET['location'];
}
else
{
	$location = '';
}

include_once 'head.php';
//include_once 'database.php';
include_once 'platform_functions.php';

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
	$location = mysql_real_escape_string($location);
	if($searchName == '' && $games == '' && $location == '')
	{
		//no specifications, send back to search form
		header('Location: search.php');
	}
	$results = mysql_query("SELECT * FROM users WHERE displayName LIKE '%$searchName%' AND gameList LIKE '%$games%' AND location LIKE '%$location%'");
	$i = 0;
	while($i < 50 && $row = mysql_fetch_assoc($results))
	{
		$i++;
		$loginName = $row['loginName'];
		$name = $row['displayName'];
		$games = $row['gameList'];	
		$platformList = decode_platformList($row['platformList']);
		$location = $row['location'];
		$link = "./profile.php?user=$loginName";
		echo("<li><a href=\"$link\">$name</a> is in $location, plays $games, and owns these platforms: $platformList</li>");
	}
	echo('</ol>');
	if($i == 0)
	{
		echo('No results.<br />');
	}
	else if($i == 50)
	{
		echo('More than 50 results for this search. Only the first 50 are displayed.<br />');
	}
?>
<a href="./search.php">Search again</a><br />

</body>
</html>