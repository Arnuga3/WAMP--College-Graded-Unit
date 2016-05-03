<?php
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
				
		$db->customQuery("INSERT INTO ai_exp (ai_ID) VALUES ('')");
					
		$result = $db->customQuery("SELECT ai_ID FROM ai_exp ORDER BY ai_ID DESC LIMIT 1");
		if ($result->num_rows == 1) {
			while($row = $result->fetch_assoc()) {
				$lastID = $row["ai_ID"];
			}
			
			$escNewTraining = $db->escape($newTraining);
			$db->customQuery("INSERT INTO training (training_ID, training) VALUES ($lastID, '$escNewTraining')");
			
			$userIDDB = $db->escape($userID);
			$db->customQuery("INSERT INTO experience (cv_ID, film_tv_ID, theatre_ID, training_ID) VALUES ('$userIDDB', 0, 0, $lastID)");
			
			$db->close();
			
		} else {
			echo "<p>One result is expected</p>";
		}
	} else {
		echo "Not post";
	}
} else {
	echo "Session is not defined";
}

?>