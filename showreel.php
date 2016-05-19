<?php
/*
Author: Arnis Zelcs
Created: 12/03/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Generates a showreel page
*/

	//include a class
	include("page classes/CL_Showreel.php");
	
	//include an Object Related Mapping class for a database
	include ("db/db_ORM.php");
	
	//create a new instance
	$db = new dbConnection();
	
	//connect to the database
	$db->connect();
	
	//get data
	$result = $db->select("video", "*", "video.video_group = 'showreel'");
	
	//close the connection to the database
	$db->close();
	
	//check for amount of records fetched
	if ($result->num_rows == 1) {
		while($row = $result->fetch_assoc()) {
			$data = $row;
		}	
		
		//create a new instance and pass parameters 
		$showreelPage = new Showreel($data);
		
		//assign values to properties
		$showreelPage -> title = "Jamie Rodden";
		$showreelPage -> description = "Jamie Rodden";
		$showreelPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
		
		//display a page in a browser
		$showreelPage->displayPage();
		
	} else {
		echo "Error: one record is expected";
	}
?>