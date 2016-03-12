<?php
/*
This script creates the first page of the website.
*/
	include ("CL_Page.php");
	
	$landingPage = new Page();
	$landingPage -> title = "Jamie Rodden";
	$landingPage -> description = "Jamie Rodden";
	$landingPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
	$landingPage->displayPage();
?>