<?php
	include("page classes/CL_Media.php");
	
	$mediaPage = new Media();
	$mediaPage -> title = "Jamie Rodden";
	$mediaPage -> description = "Jamie Rodden";
	$mediaPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
	$mediaPage->displayPage();
?>