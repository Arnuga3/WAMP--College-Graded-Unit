<?php
/*
Author: Arnis Zelcs
Created: 3/05/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Delete a training record
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
		$trainingID = test_input($_POST["trainingID"]);
		
		$db = new dbConnection();
		$db->connect();	

		$db->delete("training", "training_ID", $trainingID);
		$db->delete("experience", "training_ID", $trainingID);
		$db->delete("ai_training", "ai_ID", $trainingID);

		$db->close();
		
		echo "Deleted";
		
	} else {
		//Error message is displayed on the page if there is any
		echo "";
	}
?>