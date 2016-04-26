<?php
	include ("../db/db_ORM.php");
		
	//Create DB connection and get data from db
	$db = new dbConnection();
	$db->connect();
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$posts = count($_POST);
		
		foreach ($_POST as $key => $value){
			
			$keyName = preg_replace('/\d/', '', $key );
			  
			if ($keyName == "pName") {
				$id = filter_var($key, FILTER_SANITIZE_NUMBER_INT);
				$title = $value;
				$description = $_POST["pDescr".$id];
				
				$val = $db->prepareArray($value, $description);
				$db->update("images", "image_title, image_descr", $val, "image_ID", $id);
			}
		}
	}
	echo "";
?>