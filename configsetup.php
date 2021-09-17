<?php
	require_once("database/databaseclass.php");
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
	$dbname = 'payouts';
	$database = new db($dbhost, $dbuser, $dbpass, $dbname);
?>