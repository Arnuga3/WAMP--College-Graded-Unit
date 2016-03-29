<?php
/*
This script close the session and navigate to the first page of the website
*/
	session_start();
	session_destroy();
	header("Location: ../index.php");	//after log out loading start page
?>