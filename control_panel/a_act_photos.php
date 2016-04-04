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
	
	<nav class=\"bread_path\">
		<div class=\"bread nav-wrapper\">
			<div class=\"col s12\">
				<a href=\"#!\" class=\"breadcrumb\">Acting Photos</a>
				<a href=\"#!\" class=\"breadcrumb\"></a>
			</div>
		</div>
	</nav>
	
	<div class=\"sub_nav hide-on-med-and-down\">
		<a class=\"waves-effect waves-light grey disabled\" href=\"#\"><img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" /><span>back</span></a>
		<a class=\"waves-effect waves-light\" href=\"#\"><img src=\"../img/cpIcons/folder_add.png\" /><span>new folder</span></a>
		<a class=\"waves-effect waves-light\" href=\"#\"><img src=\"../img/cpIcons/image_add.png\" /><span>new photo</span></a>
		<a class=\"waves-effect waves-light\" href=\"#\"><img src=\"../img/cpIcons/image_edit.png\" /><span>edit photo</span></a>
		<a class=\"waves-effect waves-light\" href=\"#\"><img src=\"../img/cpIcons/image_delete.png\" /><span>delete photo</span></a>
		<a class=\"waves-effect waves-light\" href=\"#\"><img src=\"../img/cpIcons/scale_image.png\" /><span>move photo</span></a>
	</div>

	<div class=\"fixed-action-btn vertical click-to-toggle hide-on-large-only\" style=\"bottom: 24px; right: 24px;\">
		<a class=\"fire_dark btn-floating btn-large deep-orange darken-2\">
			<img class=\"pencil\" src=\"../img/cpIcons/pencil.png\" />
		</a>
		<ul>
			<li><span>new folder</span><a class=\"btn-floating blue\"><img src=\"../img/cpIcons/folder_add.png\" /></a></li>
			<li><span>new photo</span><a class=\"btn-floating orange\"><img src=\"../img/cpIcons/image_add.png\" /></a></li>
			<li><span>edit photo</span><a class=\"btn-floating green\"><img src=\"../img/cpIcons/image_edit.png\" /></a></li>
			<li><span>delete photo</span><a class=\"btn-floating blue\"><img src=\"../img/cpIcons/image_delete.png\" /></a></li>
			<li><span>move photo</span><a class=\"btn-floating red\"><img src=\"../img/cpIcons/scale_image.png\" /></a></li>
		</ul>
	</div>
	
	<div class=\"fixed-action-btn vertical click-to-toggle hide-on-large-only\" style=\"bottom: 24px; right: 84px;\">
		<a class=\"btn-floating btn-large yellow disabled\">
			<img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" />
		</a>
	</div>
	
	<div class=\"cp_content\">

		<p class=\"helperText infoMargin\"><img class=\"sm_info\" src=\"../img/cpIcons/information.png\" />Add, Edit or Remove albums or images.</p>
		
		<div id=\"cpCont\" class=\"margTop margBotXL\">";

			//Display folders
			foreach ($folders_indexed as $val) {

			echo "<!--Folder Row in Control Panel(image, name)-->
				<a class=\"folder flexVertCenter waves-effect waves-light\" href=\"#\">
					<div class=\"flexVertCenter\">
						<img class=\"margLeft10\" width=\"40\" src=\"../img/cpIcons/folder_image.png\" />
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