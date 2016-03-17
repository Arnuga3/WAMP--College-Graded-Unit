<?php
	include("page classes/CL_ActingShots.php");
	
	$actingPage = new ActingShots();
	$actingPage -> title = "Jamie Rodden";
	$actingPage -> description = "Jamie Rodden";
	$actingPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
	$actingPage->displayPage();
?>