<?php

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
		
		$trainingID = test_input($_POST["trainingID"]);
		
		$db = new dbConnection();
		$db->connect();	

		$db->delete("training", "training_ID", $trainingID);
		$db->delete("experience", "training_ID", $trainingID);
		$db->delete("ai_exp", "ai_ID", $trainingID);

		$db->close();
		
		echo "Deleted";
		
	} else {
		//Error message is displayed on the page if there is any
		echo "";
	}
?>