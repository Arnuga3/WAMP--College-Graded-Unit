<?php
/*
Author: Arnis Zelcs
Created: 4/05/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Add a new theatre record
*/

//start session
session_start();

if (isset($_SESSION["mrBoss"])) {
	$userID = $_SESSION["mrBoss"]["usr_ID"];
	
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
		$year = test_input($_POST["year"]);
		$role = test_input($_POST["role"]);
		$production = test_input($_POST["production"]);
		$director = test_input($_POST["director"]);
		$company = test_input($_POST["company"]);
				
		$db = new dbConnection();
		$db->connect();
				
		$db->customQuery("INSERT INTO ai_theatre (ai_ID) VALUES ('')");
					
		$result = $db->customQuery("SELECT ai_ID FROM ai_theatre ORDER BY ai_ID DESC LIMIT 1");
		if ($result->num_rows == 1) {
			while($row = $result->fetch_assoc()) {
				$lastID = $row["ai_ID"];
			}
			
			$columnsOfTable = $db->getTableColumns("theatre");
			//delete film_tv_ID as It is do not need to be updated
			array_shift($columnsOfTable);
			
			//escape, preapre and put values into an array (prevent injection)
			$valToUpdate = $db->prepareArray($year, $role, $production, $director, $company);
			
			$db->insert("theatre", $columnsOfTable, $valToUpdate);
			
			$userIDDB = $db->escape($userID);
			$db->customQuery("INSERT INTO experience (cv_ID, film_tv_ID, theatre_ID, training_ID) VALUES ('$userIDDB', 0, $lastID, 0)");
			
			$db->close();
			
			//create an HTML element to insert using AJAX
			echo "
				<div class=\"row z-depth-1\" id=\"".str_replace('"',"&quot;", $lastID)."\">
				
					<div class=\"input-field col s12 m6 l4\">
						<input placeholder=\"Year\" name=\"year\" type=\"text\" class=\"validate\" 
							value=\"".str_replace('"',"&quot;", $year)."\" />
						<label>Year</label>
					</div>
					
					<div class=\"input-field col s12 m6 l4\">
						<input placeholder=\"Role\" name=\"role\" type=\"text\" class=\"validate\" 
							value=\"".str_replace('"',"&quot;", $role)."\" />
						<label>Role</label>
					</div>
					
					<div class=\"input-field col s12 m6 l4\">
						<input placeholder=\"Production\" name=\"production\" type=\"text\" class=\"validate\" 
							value=\"".str_replace('"',"&quot;", $production)."\" />
						<label>Production</label>
					</div>
					
					<div class=\"input-field col s12 m6 l4\">
						<input placeholder=\"Director\" name=\"director\" type=\"text\" class=\"validate\" 
							value=\"".str_replace('"',"&quot;", $director)."\" />
						<label>Director</label>
					</div>
					
					<div class=\"input-field col s12 m6 l4\">
						<input placeholder=\"Company\" name=\"company\" type=\"text\" class=\"validate\" 
							value=\"".str_replace('"',"&quot;", $company)."\" />
						<label>Company</label>
					</div>
					
					<div class=\"col s12 margBot pad15\">
						<a class=\"saveTheatre waves-effect waves-light btn green darken-2\">save</a>
						<a class=\"deleteTheatre waves-effect waves-light btn red darken\">delete</a>
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