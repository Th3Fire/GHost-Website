<?php
	session_start();

	require_once("connect.php");

	session_destroy();
	header("location:login.php");
?>