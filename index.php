<?php
/*
Author: Arnis Zelcs
Created: 12/03/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Generates a sliding gallery page (index page)
*/

	//include a class
	include ("page classes/CL_SlidingGallery.php");
	
	//create a new instance
	$landingPage = new SlidingGallery();
	
	//assign values to properties
	$landingPage -> title = "Jamie Rodden";
	$landingPage -> description = "Jamie Rodden";
	$landingPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
	
	//display a page in a browser
	$landingPage->displayPage();
?>