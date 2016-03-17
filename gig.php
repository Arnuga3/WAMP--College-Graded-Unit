<?php
	include("page classes/CL_GigShots.php");
	
	$gigPage = new GigShots();
	$gigPage -> title = "Jamie Rodden";
	$gigPage -> description = "Jamie Rodden";
	$gigPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
	$gigPage->displayPage();
?>