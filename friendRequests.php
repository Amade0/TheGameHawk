<?php

include_once 'head.php';

if(isset($_SESSION['user']) == '')
{
	header("Location: index.php");
}

if(isSet($_GET['accept']) && $_GET['accept'] != '')
{
	$accept = mysql_real_escape_string($_GET['accept']);
	accept($accept);
}
if(isSet($_GET['decline']) && $_GET['decline'] != '')
{
	$decline = mysql_real_escape_string($_GET['decline']);
	decline($decline);
}

function accept($loginName)
{
	$user = $_SESSION['user'];
	$user = mysql_query("SELECT * FROM users WHERE userID='$user'");
	$user = mysql_fetch_array($user);
	$other = mysql_query("SELECT * FROM users WHERE loginName='$loginName'");
	$other = mysql_fetch_array($other);
	//remove this user from the request sender's outgoing friend requests
	$outgoingFriendRequests = explode(' ', $other['outgoingFriendRequests']);
	$newOutgoingFriendRequests = array();
	foreach($outgoingFriendRequests as $req)
	{
		if($req != $user['userID'])
		{
			$newOutgoingFriendRequests[] = $req;
		}
	}
	$newOutgoingFriendRequests = implode(' ', $newOutgoingFriendRequests);
	$otherID = $other['userID'];
	$query = mysql_query("UPDATE `users` SET `outgoingFriendRequests` = '$newOutgoingFriendRequests' WHERE `users`.`userID` = $otherID;");
	//remove other user from this user's incoming friend requests
	$incomingFriendRequests = explode(' ', $user['incomingFriendRequests']);
	$newIncomingFriendRequests = array();
	foreach($incomingFriendRequests as $req)
	{
		if($req != $other['userID'])
		{
			$newIncomingFriendRequests[] = $req;
		}
	}
	$newIncomingFriendRequests = implode(' ', $newIncomingFriendRequests);
	$userID = $user['userID'];
	$query = mysql_query("UPDATE `users` SET `incomingFriendRequests` = '$newIncomingFriendRequests' WHERE `users`.`userID` = $userID;");
	//add each user to the other's friends list
	$userFriends = $user['friendList'] . ' ' . $otherID;
	$query = mysql_query("UPDATE `users` SET `friendList` = '$userFriends' WHERE `users`.`userID` = $userID;");
	$otherFriends = $other['friendList'] . ' ' . $userID;
	$query = mysql_query("UPDATE `users` SET `friendList` = '$otherFriends' WHERE `users`.`userID` = $otherID;");
	//reload the page
	//header('Location: friendRequests.php');
}

function decline($loginName)
{
	$user = $_SESSION['user'];
	$user = mysql_query("SELECT * FROM users WHERE userID='$user'");
	$user = mysql_fetch_array($user);
	$other = mysql_query("SELECT * FROM users WHERE loginName='$loginName'");
	$other = mysql_fetch_array($other);
	//remove this user from the request sender's outgoing friend requests
	$outgoingFriendRequests = explode(' ', $other['outgoingFriendRequests']);
	$newOutgoingFriendRequests = array();
	foreach($outgoingFriendRequests as $req)
	{
		if($req != $user['userID'])
		{
			$newOutgoingFriendRequests[] = $req;
		}
	}
	$newOutgoingFriendRequests = implode(' ', $newOutgoingFriendRequests);
	$otherID = $other['userID'];
	$query = mysql_query("UPDATE `users` SET `outgoingFriendRequests` = '$newOutgoingFriendRequests' WHERE `users`.`userID` = $otherID;");
	//remove other user from this user's incoming friend requests
	$incomingFriendRequests = explode(' ', $user['incomingFriendRequests']);
	$newIncomingFriendRequests = array();
	foreach($incomingFriendRequests as $req)
	{
		if($req != $other['userID'])
		{
			$newIncomingFriendRequests[] = $req;
		}
	}
	$newIncomingFriendRequests = implode(' ', $newIncomingFriendRequests);
	$userID = $user['userID'];
	$query = mysql_query("UPDATE `users` SET `incomingFriendRequests` = '$newIncomingFriendRequests' WHERE `users`.`userID` = $userID;");
	//reload the page
	//header('Location: friendRequests.php');
}

?>

<html>
<head>
	<title>Friend requests</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>

<?php
$user = $_SESSION['user'];
$user = mysql_query("SELECT * FROM users WHERE userID='$user'");
$user = mysql_fetch_array($user);
$friendRequests = $user['incomingFriendRequests'];
if(!$friendRequests)
{
	echo('No incoming friend requests');
}
else
{
	echo('<table border="0">');
	$friendRequests = explode(' ', $friendRequests);
	foreach($friendRequests as $req)
	{
		if($req == '')
		{
			continue;
		}
		$reqUser = mysql_query("SELECT * FROM users WHERE userID='$req'");
		$reqUser = mysql_fetch_array($reqUser);
		echo('<tr><td>');
		$loginName = $reqUser['loginName'];
		$displayName = $reqUser['displayName'];
		echo("<a href=\"./profile.php?user=$loginName\">$displayName</a></td>");
		echo("<td><a href=\"./friendRequests.php?accept=$loginName\">Accept</a></td>");
		echo("<td><a href=\"./friendRequests.php?decline=$loginName\">Decline</a></td>");
		echo('</td></tr>');
	}
	echo('</table>');
}
?>

</body>
</html>