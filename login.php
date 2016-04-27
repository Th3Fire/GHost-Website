<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="css/mycss/mystyle.css">
</head>
<body>

<?php

session_start();
require_once("connect.php");

	echo '
	<form name="formlogin" method="post" action="checklogin.php" >
	Username : 
	<input type="text" name="txtUsername" id="txtUsername" required="*"></input>
	Password : 
	<input type="password" name="txtPassword" id="txtPassword" required="*"></input>
	<input type="submit" id="submit" value="Login" class="myButton"></input>
	
	</form>
	';
?>

</body>
</html>

