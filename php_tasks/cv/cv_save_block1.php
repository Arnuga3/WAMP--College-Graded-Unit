<?php

	include ("../../db/db_ORM.php");
		
	//to make work htmlspecialchars() function
	header('Content-Type: text/plain');

	//Test input for special characters, slashes, white spaces
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$name = test_input($_POST["name"]);
		$equity = test_input($_POST["equity"]);
		$email = test_input($_POST["email"]);
		$height = test_input($_POST["height"]);
		$chest = test_input($_POST["chest"]);
		$waist = test_input($_POST["waist"]);
		$inside_leg = test_input($_POST["inside_leg"]);
		$eyes = test_input($_POST["eyes"]);
		$hair = test_input($_POST["hair"]);
		$build = test_input($_POST["build"]);
		$playing_age = test_input($_POST["playing_age"]);
		
		$db = new dbConnection();
		$db->connect();
		$values = $db->prepareArray($name, $equity, $email, $height, $chest, $waist, $inside_leg, $eyes, $hair, $build, $playing_age);
		$db->update("cv", "cv_name, cv_equity, cv_email, cv_height, cv_chest, cv_waist, cv_inside_leg, cv_eyes, cv_hair, cv_build, cv_playing_age", $values, "cv_ID", 1);
		$db->close();
		
		echo "Saved";
	} else {
			
		//Error message is displayed on the page if there is any
		echo "Error";
	}


	
?>