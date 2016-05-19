<?php
/*
Author: Arnis Zelcs
Created: 21/03/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: This script validates admin's username and password
*/

//start a session
session_start();
?>
<?php
	//include a database Object-relational mapping class
	include ("../db/db_ORM.php");
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		if (isset($_POST["adminName"]) && isset($_POST["adminPassword"])) {
			
			//take data submitted on login
			$userName = $_POST["adminName"];
			$userPassword = $_POST["adminPassword"];
			
			
			//Create DB connection and get data from db
			$db = new dbConnection();
			$db->connect();
			$result = $db->select("user");
			$db->close();
			
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					if ($row["usr_name"] == $userName and crypt($userPassword, $row["usr_psswd"]) == $row["usr_psswd"]) {
						//I do transfer to another file here to prevent the form resubmission when back and forward buttons are pressed, like pages A B and C, this is a page B and it is used for this purpose
						
						//create a main session record about the logged in user
						$_SESSION["mrBoss"] = $row;
						
						//go to a control panel
						header("Location: ../control_panel/cp.php");
					} else {
						echo "Invalid data. Login failed.";
					}
				}
			}
		} else {
			echo "Error, data wasn't received. Login failed.";
		}
		
	}
	
?>