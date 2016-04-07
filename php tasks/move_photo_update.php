<?php

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
	$photos = test_input($_POST["photos"]);
	
	//split into array, use 'p' as separator (as it was passed as a string like p1p2p3p4 ...)
	$photosIDs = explode('p',$photos);

	$db = new dbConnection();
	$db->connect();	
	
	$folderEscaped = $db->escape($folder);

	for ($i=0; $i<count($photosIDs); $i++) {
		$escapedVal = (int)$db->escape($photosIDs[$i]);
		$db->customQuery("UPDATE images SET image_folder = '$folderEscaped' WHERE image_ID = $escapedVal");
	}
	
	$db->close();
	
	//Error message is displayed on the page if there is any
	echo "";
?>