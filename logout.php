<?php
	require_once("configsetup.php");
	session_destroy();
	header("Location:index.php");
?>