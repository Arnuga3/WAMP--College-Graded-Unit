<?php
/*
Author: Arnis Zelcs
Created: 10/04/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: This script uploades song(s) on a server and creates records in database about that song(s)
*/

session_start();
?>
<?php

//if session is on
if (isset($_SESSION["mrBoss"])) {
	$userID = $_SESSION["mrBoss"]["usr_ID"];
	
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
	
	//get data
	extract($_POST);
	
	if (isset($_POST["album_name"])) {
		$newAlbum = test_input($_POST["album_name"]);
	} else {
		$newAlbum = "";
	}
	
	//allowed file extensions
    $extension = array("mp3", "m4a");
	
	$db = new dbConnection();
	$db->connect();
	
	//get information about each file
    foreach ($_FILES as $index => $file) {
		$file_name = $file["name"];
		$file_tmp = $file["tmp_name"];
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		
		if (in_array($ext, $extension)) {
			
			//if a file with the same name is not already existing
			if (!file_exists("../songs/".$file_name)) {
				
				move_uploaded_file($file_tmp, "../songs/".$file_name);
				
				$filenameNoExt = basename($file_name, ".".$ext);
				
				//create a new id for the file (id is used in other tables)
				$db->customQuery("INSERT INTO ai_music (ai_ID) VALUES ('')");
				
				//get that id
				$result = $db->customQuery("SELECT ai_ID FROM ai_music ORDER BY ai_ID DESC LIMIT 1");
				if ($result->num_rows == 1) {
					while($row = $result->fetch_assoc()) {
						//Place all folder names into new array
						$lastID = $row["ai_ID"];
					}
					
					//Create a database record about this file
					$userIDDB = $db->escape($userID);
					$db->customQuery("INSERT INTO media (usr_ID, music_ID, video_ID, image_ID) VALUES ('$userIDDB', $lastID, 0, 0)");
					
					$valArr = $db->prepareArray($lastID, $filenameNoExt, " ", "../../songs/$file_name", " ", $newAlbum);
					$db->insert("music", "music_ID, music_title, music_descr, music_path, music_group, music_folder", $valArr);
					
				} else {
					echo "<p>One result is expected</p>";
				}
			
			//if a file with the same name is already existing
			} else {
				
				$filename = basename($file_name, $ext);
				
				//create a new name for the file (using time function, so it is always unique)
				$newFileName = $filename.time().".".$ext;
				
				move_uploaded_file($file_tmp, "../songs/".$newFileName);
				
				//same logic here as in a first block of if statement
				$filenameNoExt = basename($file_name, ".".$ext);
				
				$db->customQuery("INSERT INTO ai_music () VALUES ('')");
				
				$result = $db->customQuery("SELECT ai_ID FROM ai_music ORDER BY ai_ID DESC LIMIT 1");
				if ($result->num_rows == 1) {
					while($row = $result->fetch_assoc()) {
						//Place all folder names into new array
						$lastID = $row["ai_ID"];
					}
					
					$userIDDB = $db->escape($userID);
					$db->customQuery("INSERT INTO media (usr_ID, music_ID, video_ID, image_ID) VALUES ('$userIDDB', $lastID, 0, 0)");
					
					$valArr = $db->prepareArray($lastID, $filenameNoExt, " ", "../../songs/$newFileName", " ", $newAlbum);
					$db->insert("music", "music_ID, music_title, music_descr, music_path, music_group, music_folder", $valArr);
					
				} else {
					echo "<p>One result is expected</p>";
				}					

			}
			
		}
	}
	
	$db->close();
	//header("Location: ../control_panel/cp_showreel.php");
} else {
	//this is required to avoid a blank page when user is loggin out (session is closed) and press a back button, so user is just transfered to the index page
	header("Location: ../index.php");
}
?>