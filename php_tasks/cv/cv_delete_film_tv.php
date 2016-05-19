<?php
/*
Author: Arnis Zelcs
Created: 4/05/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Delete a film/TV record
*/

	//include an Object Related Mapping class for a database
	include ("../../db/db_ORM.php");
		
	//to make work htmlspecialchars() function
	header('Content-Type: text/plain');

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		//get id
		$filmID = test_input($_POST["filmID"]);
		
		$db = new dbConnection();
		$db->connect();	

		$db->delete("films", "film_tv_ID", $filmID);
		$db->delete("experience", "film_tv_ID", $filmID);
		$db->delete("ai_films", "ai_ID", $filmID);

		$db->close();
		
		echo "Deleted";
		
	} else {
		//Error message is displayed on the page if there is any
		echo "";
	}
?>