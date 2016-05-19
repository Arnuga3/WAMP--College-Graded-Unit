<?php
/*
Author: Arnis Zelcs
Created: 4/05/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Delete a theatre record
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
		$theatreID = test_input($_POST["theatreID"]);
		
		$db = new dbConnection();
		$db->connect();	

		$db->delete("theatre", "theatre_ID", $theatreID);
		$db->delete("experience", "theatre_ID", $theatreID);
		$db->delete("ai_theatre", "ai_ID", $theatreID);

		$db->close();
		
		echo "Deleted";
		
	} else {
		//Error message is displayed on the page if there is any
		echo "";
	}
?>