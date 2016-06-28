<?php
/*
Author: Arnis Zelcs
Created: 16/03/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Generates an acting shots page (commmit)
*/

	//include a class
	include("page classes/CL_ActingShots.php");
	
	//create a new instance
	$actingPage = new ActingShots();
	
	//assign values to properties
	$actingPage -> title = "Jamie Rodden";
	$actingPage -> description = "Jamie Rodden";
	$actingPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
	
	//display a page in a browser
	$actingPage->displayPage();
?>