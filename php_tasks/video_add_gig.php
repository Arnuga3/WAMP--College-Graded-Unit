<?php
/*
Author: Arnis Zelcs
Created: 10/04/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: This script uploades photo(s) on a server and creates records in database about that photo(s) for acting
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
	
	$newAlbum = isset($_POST["album_name"]) ? test_input($_POST["album_name"]) : "";
	$title = isset($_POST["add_video_title"]) ?  test_input($_POST["add_video_title"]) : "";
	$description = isset($_POST["add_video_descr"]) ? test_input($_POST["add_video_descr"]) : "";
	$path = isset($_POST["add_video_path"]) ? test_input($_POST["add_video_path"]) : "";

	$db = new dbConnection();
	$db->connect();
		
	//create a new id for the file (id is used in other tables)
	$db->customQuery("INSERT INTO ai_video () VALUES ()");
				
	//get that id
	$result = $db->customQuery("SELECT ai_ID FROM ai_video ORDER BY ai_ID DESC LIMIT 1");
	if ($result->num_rows == 1) {
		while($row = $result->fetch_assoc()) {
			//Place all folder names into new array
			$lastID = $row["ai_ID"];
		}
	}
	//Create a database record about this file
	$userIDDB = $db->escape($userID);
	$db->customQuery("INSERT INTO media (usr_ID, music_ID, video_ID, image_ID) VALUES ('$userIDDB', 0, $lastID, 0)");
	
	$valArr = $db->prepareArray($lastID, $title, $description, $path, 'gig', $newAlbum);
	$db->insert("video", "video_ID, video_title, video_descr, video_path, video_group, video_folder", $valArr);

	$db->close();
	//header("Location: ../control_panel/cp_showreel.php");
} else {
	//this is required to avoid a blank page when user is loggin out (session is closed) and press a back button, so user is just transfered to the index page
	header("Location: ../index.php");
}
?>