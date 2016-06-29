<?php
/*
Author: Arnis Zelcs
Created: 27/04/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: This script delete photo record from a database and delete a photo from a server
*/

	//include a database Object-relational mapping class
	include ("../db/db_ORM.php");
		
	//to make work htmlspecialchars() function
	header('Content-Type: text/plain');

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	if (isset($_POST["folder"])) {
		$folder = test_input($_POST["folder"]);
	}
	if (isset($_POST["videos"])) {
		$videos = test_input($_POST["videos"]);
		
		$db = new dbConnection();
		$db->connect();	
		
		//split into array, use 'p' as separator (as it was passed as a string like p1p2p3p4 ...)
		$videosIDs = explode('p',$videos);
		
		//delete first value (empty value what is created before the first separator)
		array_shift($videosIDs);
		
		//delete records from database and files from a server
		for ($i=0; $i<count($videosIDs); $i++) {
			
			$db->delete("video", "video_ID", $videosIDs[$i]);
			$db->delete("media", "video_ID", $videosIDs[$i]);
			$db->delete("ai_video", "ai_ID", $videosIDs[$i]);

		}
		
		$db->close();
	}
	//Error message is displayed on the page if there is any
	echo "";
?>