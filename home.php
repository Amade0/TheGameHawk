<?php
session_start();

if(isset($_SESSION['user']) == "")
{
	header("Location: index.php");
}

$user = $_SESSION['user'];
include_once 'database.php';

?>

<html>
<head>
	<title>The Game Hawk: Home</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>
	<a href="./edit.php">Edit account</a><br />
	<a href="./search.php">Search</a><br />
	<a href="./logout.php">Log out</a>
</body>
<html>