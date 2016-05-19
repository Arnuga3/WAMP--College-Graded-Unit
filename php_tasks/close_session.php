<?php
/*
Author: Arnis Zelcs
Created: 28/03/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: This script close the session and navigate to the first page of the website
*/
	session_start();
	
	//delete session
	session_destroy();
	
	//after log out loading start page
	header("Location: ../index.php");	
?>