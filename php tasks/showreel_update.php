<?php

	include ("../db/db_ORM.php");
		
	//to make work htmlspecialchars() function
	header('Content-Type: text/plain');

	//Test input for special characters, slashes, white spaces
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$title = test_input($_POST["title"]);
	$description = test_input($_POST["description"]);
	$path = test_input($_POST["path"]);
	
	$db = new dbConnection();
	$db->connect();
	$values = $db->prepareArray($title, $description, $path);
	$db->update("video", "video_title, video_descr, video_path", $values, "video_group", "showreel");
	$db->close();
	
	//Error message is displayed on the page if there is any
	echo "";
	
?>