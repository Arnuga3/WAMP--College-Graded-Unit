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
	$result = $db->select("video", "*", "video_group = 'acting'");
	
	//close the connection to the database
	$db->close();
	
	//that block of code get unique names of folders and save them into an indexed array
	$folders = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			
			//place all folder names into new array
			$folders[] = $row["video_folder"];
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
		echo "<div class=\"folder valign-wrapper\">
				<img width=\"100\" src=\"img/folder.png\" />
				<p>$val</p>
			</div>";
	}
	
	//reset a pointer for allowing to loop the query result again
	mysqli_data_seek($result, 0);
	
	//display photos without folders
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if (!in_array($row["video_folder"], $folders_indexed)) {
				
				echo '<span class="videoTitle col s12"><i class="fa fa-play" aria-hidden="true"></i>'.$row["video_title"].'</span>
					<br>
					<span class="videoDescr">'.$row["video_descr"].'</span>
					<div class="video-container">
						<div class="video col s12">
							<iframe width="250" src="'.$row["video_path"].'" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>';
			}
		}
	}
	echo "
		</div>
		<p id=\"error\"></p>";

?>