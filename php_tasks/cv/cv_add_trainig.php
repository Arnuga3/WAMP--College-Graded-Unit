<?php
/*
Author: Arnis Zelcs
Created: 3/05/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Add a new theatre record
*/

//start session
session_start();

if (isset($_SESSION["mrBoss"])) {
	$userID = $_SESSION["mrBoss"]["usr_ID"];
	
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
		
		$newTraining = test_input($_POST["newTraining"]);
				
		$db = new dbConnection();
		$db->connect();
		
		//create records in database	
		$db->customQuery("INSERT INTO ai_training (ai_ID) VALUES ('')");
					
		$result = $db->customQuery("SELECT ai_ID FROM ai_training ORDER BY ai_ID DESC LIMIT 1");
		if ($result->num_rows == 1) {
			while($row = $result->fetch_assoc()) {
				$lastID = $row["ai_ID"];
			}
			
			$escNewTraining = $db->escape($newTraining);
			$db->customQuery("INSERT INTO training (training_ID, training) VALUES ($lastID, '$escNewTraining')");
			
			$userIDDB = $db->escape($userID);
			$db->customQuery("INSERT INTO experience (cv_ID, film_tv_ID, theatre_ID, training_ID) VALUES ('$userIDDB', 0, 0, $lastID)");
			
			$db->close();
			
			//create an HTML element to insert using AJAX
			echo "<div>
					<div class=\"input-field col s12\">
						<input placeholder=\"Training\" id=\"".str_replace('"',"&quot;", $lastID)."\" type=\"text\" class=\"validate\" 
							value=\"".str_replace('"',"&quot;", $escNewTraining)."\" />
						<label for=\"training\">training</label>
					</div>
					
					<div class=\"margBot pad15\">
						<a class=\"saveTraining waves-effect waves-light btn green darken-2\">save</a>
						<a class=\"deleteTraining waves-effect waves-light btn red darken\">delete</a>
					</div>
				</div>";
			
		} else {
			echo "<p>One result is expected</p>";
		}
	} else {
		echo "POST request is not defined";
	}
} else {
	echo "Session is not defined";
}

?>