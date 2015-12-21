<?php

include_once 'head.php';

if(isset($_SESSION['user']) == "")
{
	header("Location: index.php");
}

//include_once 'database.php';

$user = $_SESSION['user'];

?>

<html>
<head>
	<title>The Game Hawk: Home</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
	<a href="./edit.php">Edit account</a><br />
	<a href="./search.php">Search</a>
</body>
<html>