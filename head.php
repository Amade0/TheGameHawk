<html>
<?php
session_start();

include_once 'database.php';

if(!isSet($_SESSION['user']))
{
	echo('<a href="./register.php">Register</a> // ');
	echo('<a href="./login.php">Log in</a>');
}
else
{
	echo('<a href="./home.php">Home</a> // ');
	echo('<a href="./profile.php">My profile</a> // ');
	echo('<a href="./logout.php">Log out</a>');
	//check for friend requests
	$user = $_SESSION['user'];
	$user = mysql_query("SELECT * FROM users WHERE userID='$user'");
	$user = mysql_fetch_array($user);
	if($user['incomingFriendRequests'])
	{
		echo(' // <a href="./friendRequests.php">Pending friend request(s)</a>');
	}
	//... and messages
	if($user['pendingMessages'])
	{
		echo(' // <a href="./message.php">Unread message(s)</a>');
	}
	//just in case?
	//unset($user);
}

?>
<hr />
</html>