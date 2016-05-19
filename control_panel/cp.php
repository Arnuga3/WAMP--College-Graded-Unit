<?php
/*
Author: Arnis Zelcs
Created: 27/04/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Index page for a Control Panel
*/

//start session
session_start();
?>
<?php
	//add a class
	include("../page classes/CL_ControlPanel.php");
	
	//if session is on
	if (isset($_SESSION["mrBoss"])) {
		$userID = $_SESSION["mrBoss"]["usr_ID"];

		//Passing information to class constructor
		$controlPage = new ControlPanel();
		$controlPage -> title = "Jamie Rodden";
		$controlPage -> description = "Jamie Rodden";
		$controlPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
		$controlPage -> displayPage();

	} else {
		//this is required to avoid a blank page when user is loggin out (session is closed) and press a back button, so user is just transfered to the index page
		header("Location: ../index.php");
	}
?>