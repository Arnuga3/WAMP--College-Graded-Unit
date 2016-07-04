<?php
/*
Author: Arnis Zelcs
Created: 6/04/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: This script move a song, edit database record
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
	$songs = test_input($_POST["songs"]);
	if (isset($_POST["actionStr"])) {
		$actionStr = test_input($_POST["actionStr"]);
	}
	
	//This option is added to give an option to rename an album
	if (isset($actionStr) && $actionStr == 'sysRenamearnuga3') {

		$db = new dbConnection();
		$db->connect();	
		
		$folderEscaped = $db->escape($folder);
		//use 'songs' is just for not breaking the server code instead of writing another script
		$OldFolderEscaped = $db->escape($songs);
		$db->customQuery("UPDATE music SET music_folder = '$folderEscaped' WHERE music_folder LIKE '%$OldFolderEscaped%'");
		$db->close();
		
	} else {
		//split into array, use 'p' as separator (as it was passed as a string like p1p2p3p4 ...)
		$songsIDs = explode('p',$songs);

		$db = new dbConnection();
		$db->connect();	
		
		$folderEscaped = $db->escape($folder);

		for ($i=0; $i<count($songsIDs); $i++) {
			$escapedVal = (int)$db->escape($songsIDs[$i]);
			$db->customQuery("UPDATE music SET music_folder = '$folderEscaped' WHERE music_ID = $escapedVal");
		}
		
		$db->close();
	}
	
	//Error message is displayed on the page if there is any
	echo "";
?>