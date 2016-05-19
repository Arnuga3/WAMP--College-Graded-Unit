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
	if (isset($_POST["photos"])) {
		$photos = test_input($_POST["photos"]);
		
		$db = new dbConnection();
		$db->connect();	
		
		//split into array, use 'p' as separator (as it was passed as a string like p1p2p3p4 ...)
		$photosIDs = explode('p',$photos);
		
		//delete first value (empty value what is created before the first separator)
		array_shift($photosIDs);
		
		//to store the location of the files on the server need to be deleted
		$photoPaths = array();
		for ($i=0; $i<count($photosIDs); $i++) {
			
			$escapedVal = $db->escape($photosIDs[$i]);
			$result = $db->customQuery("SELECT image_ID,image_path FROM images WHERE image_ID = $escapedVal");
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					//Place all folder names into new array
					$photoPaths[] = $row["image_path"];
				}
			}
		}
		
		//delete records from database and files from a server
		for ($i=0; $i<count($photosIDs); $i++) {
			
			$db->delete("images", "image_ID", $photosIDs[$i]);
			$db->delete("media", "image_ID", $photosIDs[$i]);
			$db->delete("ai_images", "ai_ID", $photosIDs[$i]);
			
			$file = $photoPaths[$i];
			unlink($file);
		}
		
		$db->close();
	}
	//Error message is displayed on the page if there is any
	echo "";
?>