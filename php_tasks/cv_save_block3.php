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
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$accents = test_input($_POST["accents"]);
		$skills = test_input($_POST["skills"]);
		
		$db = new dbConnection();
		$db->connect();
		$values = $db->prepareArray($accents, $skills);
		$db->update("cv", "cv_accents, cv_skills", $values, "cv_ID", 1);
		$db->close();
	}

	
	//Error message is displayed on the page if there is any
	echo "";
	
?>