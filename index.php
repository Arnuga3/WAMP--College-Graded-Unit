<?php
/*
This script creates the first page of the website.
*/
	include ("page classes/CL_SlidingGallery.php");
	
	$landingPage = new SlidingGallery();
	$landingPage -> title = "Jamie Rodden";
	$landingPage -> description = "Jamie Rodden";
	$landingPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
	$landingPage->displayPage();
?>