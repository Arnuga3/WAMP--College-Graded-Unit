<?php
	include("page classes/CL_Showreel.php");
	
	$showreelPage = new Showreel();
	$showreelPage -> title = "Jamie Rodden";
	$showreelPage -> description = "Jamie Rodden";
	$showreelPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
	$showreelPage->displayPage();
?>