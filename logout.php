<!-- adapted from http://www.codingcage.com/2015/01/user-registration-and-login-script-using-php-mysql.html -->
<?php
session_start();
session_destroy();
unset($_SESSION['user']);
header("Location: index.php");
?>