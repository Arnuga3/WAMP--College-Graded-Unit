<?php
/*
Author: Arnis Zelcs
Created: 12/03/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Generates a songs page - !!! UNDER DEVELOPMENT !!!
*/

	//include a class
	include("page classes/CL_Songs.php");
	
	//create a new instance
	$songsPage = new Songs();
	
	//assign values to properties
	$songsPage -> title = "Jamie Rodden";
	$songsPage -> description = "Jamie Rodden";
	$songsPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
	
	//display a page in a browser
	$songsPage->displayPage();
?>