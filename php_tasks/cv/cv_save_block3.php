<?php
/*
Author: Arnis Zelcs
Created: 2/05/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Save an accents/skills record
*/

	//include an Object Related Mapping class for a database
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
		
		//get values
		$accents = test_input($_POST["accents"]);
		$skills = test_input($_POST["skills"]);
		
		$db = new dbConnection();
		$db->connect();
		$values = $db->prepareArray($accents, $skills);
		$db->update("cv", "cv_accents, cv_skills", $values, "cv_ID", 1);
		$db->close();
		
		echo "Saved";
	} else {
		//Error message is displayed on the page if there is any
		echo "Error";
	}
	
?>