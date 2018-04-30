<?php
	ob_start();
	session_start();
	require_once 'db.php';
	$connection->logout();
	header("location:index.php");
?>