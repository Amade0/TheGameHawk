<!-- adapted from http://www.codingcage.com/2015/01/user-registration-and-login-script-using-php-mysql.html -->
<?php
if(!mysql_connect("localhost","root",""))
{
     die('oops connection problem ! --> '.mysql_error());
}
if(!mysql_select_db("TheGameHawk"))
{
     die('oops database selection problem ! --> '.mysql_error());
}
?>