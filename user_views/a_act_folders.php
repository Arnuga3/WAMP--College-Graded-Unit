<?php
	//to make work htmlspecialchars() function
	header('Content-Type: text/plain');
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	$folder = test_input($_GET["folder"]);
	
	include ("../db/db_ORM.php");
	//Create DB connection and get data from db
	$db = new dbConnection();
	$db->connect();
	
	//To get existing folders in db
	$res = $db->select("images", "*", "image_group = 'acting'");
	
	//THIS CODE GETS UNIQUE NAMES OF FOLDERS AND SAVES THEM INTO INDEXED ARRAY
	$folders = array();
	if ($res->num_rows > 0) {
		while($row = $res->fetch_assoc()) {
			//Place all folder names into new array
			$folders[] = $row["image_folder"];
		}
	}
	//Save only unique names of folders
	$folder_list = array_unique($folders);
	//Remove all indexes with NULL value and move all unique values to the beginning of the array
	$folders_indexed = array();
	foreach ($folder_list as $i) {
		if ($i != NULL) {
			$folders_indexed[] = $i;
		}
	}
	$albums = $folders_indexed;
	
	//to rename folder
	$escapedFolder = $db->escape($folder);
	$result = $db->select("images", "*", "image_folder = '$escapedFolder'");
	$db->close();
	
	$photos = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			//Place all folder names into new array
			$photos[] = $row;
		}
	}
	
	echo "<div class=\"row\">";

	foreach ($photos as $val) {
		echo "
		<div class=\"col s12 m6 valign-wrapper\">
			<div class=\"z-depth-2 valign-wrapper\">
				<img class=\"materialboxed valign\" width=\"100\" data-caption=\"".$val["image_descr"]."\" src=\"user_views/".$val["image_path"]."\" />
			</div>
			<p>".$val["image_title"]."</p>
		</div>";
	}
	echo "
		<div>
		<p id=\"error\"></p>";
	
?>