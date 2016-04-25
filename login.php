<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/reset.css">

    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

        <link rel="stylesheet" href="css/style.css">
	<title>GHost++</title>
</head>
<body>
<?php

session_start();
require_once("connect.php");

//if(!isset($_SESSION['UserID']))
//{
//header ("Location: login.php");
//exit();
//}
if(!isset($_SESSION['UserID']))
{

}else{header("Lacation: login.php");}

?>

<div>
	
	<center>
	<form name="formlogin" method="post" action="checklogin.php" >
	Username : 
	<input name="txtusername" id="txtusername" required="*"></input>
	Password : 
	<input name="txtpassword" id="txtpassword" required="*"></input>

	<button name="submit" id="submit">Login</button>
	</form>
	</center>
</div>


</body>
<script>
	


</script>
</html>