<?php
session_start();

require_once("connect.php");
$username = $_GET['val'];



$sql = "UPDATE `member` SET img = 1 where `Username` = '".$_SESSION['UserID']."'";

if(mysqli_query($con,$sql)){
 echo "Complete";
}else
echo "Error";



?>