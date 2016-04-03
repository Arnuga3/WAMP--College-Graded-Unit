<?php
	session_start();
?>
<?php
if (isset($_SESSION["mrBoss"])) {
	$userID = $_SESSION["mrBoss"]["usr_ID"];
	
	include ("../db/db_ORM.php");
	//Create DB connection and get data from db
	$db = new dbConnection();
	$db->connect();
	//Get a showreel video information
	$result = $db->select("media, images", "media.*, images.*", "media.usr_ID = $userID AND media.image_ID = images.image_ID AND images.image_group = 'acting'");
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

	echo "<!--ACTING PHOTOS-->
	<!--SUBNAV-->
	<div class=\"sub_nav\">
		<a class=\"waves-effect waves-light\" href=\"#\"><img src=\"../img/cpIcons/pencil_add.png\" /><span>add new</span></a>
		<a class=\"waves-effect waves-light\" href=\"#\"><img src=\"../img/cpIcons/pencil.png\" /><span>edit</span></a>
		<a class=\"waves-effect waves-light\" href=\"#\"><img src=\"../img/cpIcons/pencil_delete.png\" /><span>delete</span></a>
	</div>
	<nav id=\"bread_path\">
		<div class=\"bread margTopL margBot nav-wrapper\">
			<div class=\"col s12\">
				<a href=\"#!\" class=\"breadcrumb\">Acting Photos</a>
				<a href=\"#!\" class=\"breadcrumb\"></a>
			</div>
		</div>
	</nav>
	<div class=\"cp_content\">

		<p class=\"helperText margTop\"><img class=\"sm_info\" src=\"../img/cpIcons/information.png\" />Add, Edit or Remove albums or images.</p>
		
		<div id=\"cpCont\" class=\"margTop\">";

			//Display folders
			foreach ($folders_indexed as $val) {

			echo "<!--Folder Row in Control Panel(image, name)-->
				<a class=\"folder flexVertCenter waves-effect waves-light\" href=\"#\">
					<div class=\"flexVertCenter\">
						<img class=\"margLeft10\" width=\"40\" src=\"../img/cpIcons/folder_picture.png\" />
						<span class=\"margLeft infoText\">".$val."</span>
					</div>
				</a>";
			}
			mysqli_data_seek($result, 0);
			//Display photos without folders
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					if (!in_array($row["image_folder"], $folders_indexed)) {
						
					echo "<!--Image Row in Control Panel(checkbox, name, image)-->
						<div class=\"flexVertCenter imgRow\">
							<input type=\"checkbox\" class=\"filled-in checkbox-orange\" id=\"".$row["image_ID"]."\" />
							<label for=\"".$row["image_ID"]."\">
								<div class=\"flexVertCenter\">
									<div>
										<span class=\"infoText\">".$row["image_title"]."</span>
									</div>
								</div>
							</label>
							<img class=\"materialboxed\" data-caption=\"".$row["image_descr"]."\" width=\"60\" src=\"".$row["image_path"]."\" />
						</div>";
					}
				}
			}
	echo "</div>
	</div>";
} else {
	//this is required to avoid a blank page when user is loggin out (session is closed) and press a back button, so user is just transfered to the index page
	header("Location: ../index.php");
}
?>