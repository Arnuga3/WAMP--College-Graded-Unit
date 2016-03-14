<?php
	include("page classes/CL_CV.php");
	
	$cvPage = new CV();
	$cvPage -> title = "Jamie Rodden";
	$cvPage -> description = "Jamie Rodden";
	$cvPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
	$cvPage->displayPage();
?>