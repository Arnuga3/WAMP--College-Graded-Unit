<?php
/*
Author: Arnis Zelcs
Created: 27/04/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: This script delete song record from a database and delete a song from a server
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
	if (isset($_POST["songs"])) {
		$songs = test_input($_POST["songs"]);
		
		$db = new dbConnection();
		$db->connect();	
		
		//split into array, use 'p' as separator (as it was passed as a string like p1p2p3p4 ...)
		$songsIDs = explode('p',$songs);
		
		//delete first value (empty value what is created before the first separator)
		array_shift($songsIDs);
		
		//to store the location of the files on the server need to be deleted
		$songsPaths = array();
		for ($i=0; $i<count($songsIDs); $i++) {
			
			$escapedVal = $db->escape($songsIDs[$i]);
			$result = $db->customQuery("SELECT music_ID,music_path FROM music WHERE music_ID = $escapedVal");
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					//Place all folder names into new array
					$songsPaths[] = $row["music_path"];
				}
			}
		}
		
		//delete records from database and files from a server
		for ($i=0; $i<count($songsIDs); $i++) {
			
			$db->delete("music", "music_ID", $songsIDs[$i]);
			$db->delete("media", "music_ID", $songsIDs[$i]);
			$db->delete("ai_music", "ai_ID", $songsIDs[$i]);
			
			//to remove ../ from the path address, what is needed for the play, weird part
			$file = substr($songsPaths[$i], 3);
			unlink($file);
		}
		
		$db->close();
	}
	//Error message is displayed on the page if there is any
	echo "";
?>