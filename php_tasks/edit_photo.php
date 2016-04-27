<?php
	include ("../db/db_ORM.php");
		
	//Create DB connection and get data from db
	$db = new dbConnection();
	$db->connect();
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$posts = count($_POST);
		
		foreach ($_POST as $key => $value){
			
			//remove numbers from a string
			$keyName = preg_replace('/\d/', '', $key );
			
			//find a pair
			if ($keyName == "pName") {
				//prepare values for changes
				$id = filter_var($key, FILTER_SANITIZE_NUMBER_INT);
				$title = $value;
				$description = $_POST["pDescr".$id];
				//update records in db
				$val = $db->prepareArray($value, $description);
				$db->update("images", "image_title, image_descr", $val, "image_ID", $id);
			}
		}
	}
	$db->close();
	echo "";
?>