<?php
	include("page classes/CL_Songs.php");
	
	$songsPage = new Songs();
	$songsPage -> title = "Jamie Rodden";
	$songsPage -> description = "Jamie Rodden";
	$songsPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
	$songsPage->displayPage();
?>