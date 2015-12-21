<?php

//include_once 'database.php';
include_once 'head.php';
include_once 'platform_functions.php';

//started in head.php
//session_start();

//grab viewer info
if(isSet($_SESSION['user']))
{
	$viewer = $_SESSION['user'];
	$viewer = mysql_query("SELECT * FROM users WHERE userID='$viewer'");
	$viewer = mysql_fetch_array($viewer);
}

//no profile specified in URL
if(!isSet($_GET['user']) || $_GET['user'] === '')
{
	//view the viewer's profile if no profile was specified
	if(isset($viewer))
	{
		$user = $viewer;
	}
	else
	{
		header('Location: index.php');
	}
}
else
{
	$user = mysql_real_escape_string($_GET['user']);
	$user = mysql_query("SELECT * FROM users WHERE loginName = '$user';");
	$user = mysql_fetch_array($user);
	if(!$user)
	{
		//bad URL
		header('Location: index.php');
	}
}


if(isset($_POST['btn-friend']))
{
	$userID = $user['userID'];
	$viewerID = $viewer['userID'];

	$incomingFriendRequests = $user['incomingFriendRequests'] . ' ' . $viewerID;
	$outgoingFriendRequests = $viewer['outgoingFriendRequests'] . ' ' . $userID;

	$query1 = mysql_query("UPDATE `users` SET `incomingFriendRequests` = '$incomingFriendRequests' WHERE `users`.`userID` = $userID;");
	$query2 = mysql_query("UPDATE `users` SET `outgoingFriendRequests` = '$outgoingFriendRequests' WHERE `users`.`userID` = $viewerID;");

	if(!$query1 || !$query2)
	{
		?>
		<script>alert('An error occurred while sending this friend request.');</script>
		<?php
	}
	else
	{
		$loginName = $user['loginName'];
		header("Location: profile.php?user=$loginName");
	}
}
?>

<html>
<head>
	<title><?php echo($user['displayName']); ?>'s profile</title>
	<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>

<body>

<h1><?php echo($user['displayName']) ?>'s profile</h1>
<?php
	if(isset($viewer) && $viewer['userID'] != $user['userID'])
	{
		//check if these users are friends
		$friended = false;
		$friendList = explode(' ', $viewer['friendList']);
		foreach($friendList as $friend)
		{
			if($friend == $user['userID'])
			{
				$friended = true;
				break;
			}
		}
		//check if the viewer sent this user a friend request already
		$requesting = false;
		$outgoingFriendRequests = explode(' ', $viewer['outgoingFriendRequests']);
		foreach($outgoingFriendRequests as $req)
		{
			if($req == $user['userID'])
			{
				$requesting = true;
				break;
			}
		}
		//check if this user sent the viewer a friend request
		$requested = false;
		$incomingFriendRequests = explode(' ', $viewer['incomingFriendRequests']);
		foreach($incomingFriendRequests as $req)
		{
			if($req == $user['userID'])
			{
				$requested = true;
				break;
			}
		}
		if($friended)
		{
			echo('(You are friends with this user)');
		}
		else if($requested)
		{
			echo('(You have a friend request from this user)');
		}
		else if($requesting)
		{
			echo('(Friend request sent)');
		}
		else
		{
			echo('<form method="post"><button type="submit" name="btn-friend">Send friend request</button></form>');
		}
	}
?>

<ul>
	<li>Friends: <?php
		$friendList = explode(' ', $user['friendList']);
		if($friendList == '')
		{
			echo('None');
		}
		else
		{
			$first = true;
			foreach($friendList as $friend)
			{
				if($friend == '')
				{
					continue;
				}
				if($first)
				{
					$first = false;
				}
				else
				{
					echo(', ');
				}
				$friend = mysql_query("SELECT * FROM users WHERE userID='$friend'");
				$friend = mysql_fetch_array($friend);
				$friendLogin = $friend['loginName'];
				$friendName = $friend['displayName'];
				echo("<a href=\"./profile.php?user=$friendLogin\">$friendName</a>");
			}
		}
	?></li>
	<li>Location: <?php echo($user['location']); ?></li>
	<li>Platforms: <?php echo(decode_platformList($user['platformList'])); ?></li>
	<li>Games: <?php echo($user['gameList']); ?></li>
</ul>

<?php
if(isset($viewer) && $viewer['userID'] != $user['userID'] && $friended)
{
	$loginName = $user['loginName'];
	echo("<a href=\"message.php?user=$loginName\">Send message</a><br />");
}
?>

<a href="./home.php">Return to home</a><br />

</body>
</html>