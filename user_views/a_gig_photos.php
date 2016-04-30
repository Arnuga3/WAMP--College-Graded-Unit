<?php

	include ("../db/db_ORM.php");
	//Create DB connection and get data from db
	$db = new dbConnection();
	$db->connect();

	$result = $db->select("images", "*", "image_group = 'gig'");
	$db->close();
	
	//THIS CODE GETS UNIQUE NAMES OF FOLDERS AND SAVES THEM INTO INDEXED ARRAY
	$folders = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			//Place all folder names into new array
			$folders[] = $row["image_folder"];
		}
	}
	//Save only unique names of folders
	$folder_list = array_unique($folders);
	//Remove all indexes with NULL value and move all unique values to the beginning of the array
	$folders_indexed = array();
	foreach ($folder_list as $i) {
		if ($i != NULL) {
			$folders_indexed[] = $i;
		}
	}
	//END


	
	echo "<div class=\"row\">";
	
	//Display folders
	foreach ($folders_indexed as $val) {
		echo "<div class=\"folder col s12 m6 valign-wrapper\">
				<img width=\"100\" src=\"img/folder.png\" />
				<p>$val</p>
			</div>";
	}

	mysqli_data_seek($result, 0);
	//Display photos without folders
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