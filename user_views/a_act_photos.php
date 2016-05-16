<?php
/*
Author: Arnis Zelcs
Created: 27/04/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Generates an acting photos part of the page
*/

	//include an Object Related Mapping class for a database
	include ("../db/db_ORM.php");
	
	//create a new instance
	$db = new dbConnection();
	
	//connect to the database
	$db->connect();
	
	//get data
	$result = $db->select("images", "*", "image_group = 'acting'");
	
	//close the connection to the database
	$db->close();
	
	//that block of code get unique names of folders and save them into an indexed array
	$folders = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			
			//place all folder names into new array
			$folders[] = $row["image_folder"];
		}
	}
	//save only unique names of folders
	$folder_list = array_unique($folders);
	
	//remove all indexes with NULL value and move all unique values to the beginning of the array
	$folders_indexed = array();
	foreach ($folder_list as $i) {
		if ($i != NULL) {
			$folders_indexed[] = $i;
		}
	}
	
	echo "<div class=\"row\">";
	
	//display folders
	foreach ($folders_indexed as $val) {
		echo "<div class=\"folder col s12 m6 valign-wrapper\">
				<img width=\"100\" src=\"img/folder.png\" />
				<p>$val</p>
			</div>";
	}
	
	//reset a pointer for allowing to loop the query result again
	mysqli_data_seek($result, 0);
	
	//display photos without folders
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if (!in_array($row["image_folder"], $folders_indexed)) {
				
				echo "
				<div class=\"col s12 m6 valign-wrapper\">
					<div class=\"z-depth-2 valign-wrapper\">
						<img class=\"materialboxed valign\" width=\"100\" data-caption=\"".$row["image_descr"]."\" src=\"user_views/".$row["image_path"]."\" />
					</div>
					<p>".$row["image_title"]."</p>
				</div>";
			}
		}
	}
	echo "
		</div>
		<p id=\"error\"></p>";

?>