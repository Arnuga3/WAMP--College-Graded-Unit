<?php
/*
Author: Arnis Zelcs
Created: 6/04/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: This script move a photo, edit database record
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

	$folder = test_input($_POST["folder"]);
	$videos = test_input($_POST["videos"]);
	if (isset($_POST["actionStr"])) {
		$actionStr = test_input($_POST["actionStr"]);
	}
	
	//This option is added to give an option to rename an album
	if (isset($actionStr) && $actionStr == 'sysRenamearnuga3') {

		$db = new dbConnection();
		$db->connect();	
		
		$folderEscaped = $db->escape($folder);
		//use 'videos' is just for not breaking the server code instead of writing another script
		$OldFolderEscaped = $db->escape($videos);
		$db->customQuery("UPDATE video SET video_folder = '$folderEscaped' WHERE video_folder LIKE '%$OldFolderEscaped%'");
		$db->close();
		
	} else {
		//split into array, use 'p' as separator (as it was passed as a string like p1p2p3p4 ...)
		$photosIDs = explode('p',$videos);

		$db = new dbConnection();
		$db->connect();	
		
		$folderEscaped = $db->escape($folder);

		for ($i=0; $i<count($photosIDs); $i++) {
			$escapedVal = (int)$db->escape($photosIDs[$i]);
			$db->customQuery("UPDATE video SET video_folder = '$folderEscaped' WHERE video_ID = $escapedVal");
		}
		
		$db->close();
	}
	
	//Error message is displayed on the page if there is any
	echo "";
?>