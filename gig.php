<?php
/*
Author: Arnis Zelcs
Created: 16/03/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Generates a gig shots page
*/

	//include a class
	include("page classes/CL_GigShots.php");
	
	//create a new instance
	$gigPage = new GigShots();
	
	//assign values to properties
	$gigPage -> title = "Jamie Rodden";
	$gigPage -> description = "Jamie Rodden";
	$gigPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
	
	//display a page in a browser
	$gigPage->displayPage();
?>