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
	
	//Get values fro the form
	$title = test_input($_POST["title"]);
	$description = test_input($_POST["description"]);
	//url of video embeded from YouTube
	$path = test_input($_POST["path"]);
	
	//create a new db object
	$db = new dbConnection();
	//open connection
	$db->connect();
	//escape values and save in an array (it s a requirement of a db ORM)
	$values = $db->prepareArray($title, $description, $path);
	//update record in a db
	$db->update("video", "video_title, video_descr, video_path", $values, "video_group", "showreel");
	//close connection
	$db->close();
	
	//Error message is displayed on the page if there is any problems with a connection or a query
	echo "";
	
?>