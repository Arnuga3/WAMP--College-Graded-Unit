<?php
/*
Author: Arnis Zelcs
Created: 4/05/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Save a film/TV record
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
		$filmID = test_input($_POST["filmID"]);
		$year = test_input($_POST["year"]);
		$role = test_input($_POST["role"]);
		$production = test_input($_POST["production"]);
		$director = test_input($_POST["director"]);
		$company = test_input($_POST["company"]);
		
		$db = new dbConnection();
		$db->connect();
		
		$columnsOfTable = $db->getTableColumns("films");
		//delete film_tv_ID as It is do not need to be updated
		array_shift($columnsOfTable);
		
		$valToUpdate = $db->prepareArray($year, $role, $production, $director, $company);
		
		$db->update("films", $columnsOfTable, $valToUpdate, "film_tv_ID", $filmID);
		$db->close();
		
		echo "Saved";
		
	} else {
		//Error message is displayed on the page if there is any
		echo "Error";
	}
	
?>