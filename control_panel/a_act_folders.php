<?php
	session_start();
?>
<?php
if (isset($_SESSION["mrBoss"])) {
	$userID = $_SESSION["mrBoss"]["usr_ID"];
	
	$folder = $_GET["folder"];
	echo $folder;
	
	include ("../db/db_ORM.php");
	//Create DB connection and get data from db
	$db = new dbConnection();
	$db->connect();
	//Get a showreel video information
	$result = $db->select("media, images", "media.*, images.*", "media.usr_ID = $userID AND media.image_ID = images.image_ID AND images.image_folder = '$folder'");
	$db->close();
	
	$photos = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			//Place all folder names into new array
			$photos[] = $row;
		}
	}
	
	echo "<!--ACTING PHOTOS-->
	<!--SUBNAV-->
	<nav class=\"bread_path\">
		<div class=\"bread nav-wrapper\">
			<div class=\"col s12\">
				<a href=\"#!\" class=\"a_act_p breadcrumb\">Acting Photos</a>
				<a href=\"#!\" class=\"breadcrumb\">$folder</a>
			</div>
		</div>
	</nav>
	
	<div class=\"sub_nav\">
		<a class=\"waves-effect waves-light\" href=\"#\"><img src=\"../img/cpIcons/pencil_add.png\" /><span>add new</span></a>
		<a class=\"waves-effect waves-light\" href=\"#\"><img src=\"../img/cpIcons/pencil.png\" /><span>edit</span></a>
		<a class=\"waves-effect waves-light\" href=\"#\"><img src=\"../img/cpIcons/pencil_delete.png\" /><span>delete</span></a>
	</div>

	<div class=\"cp_content margTopXL2\">
	
		<p class=\"helperText infoMargin2\"><img class=\"sm_info\" src=\"../img/cpIcons/information.png\" />Add, Edit or Remove albums or images.</p>
		
		<div id=\"cpCont\" class=\"margTop\">";

		foreach ($photos as $val) {
			echo "<!--Image Row in Control Panel(checkbox, name, image)-->
				<div class=\"flexVertCenter imgRow\">
					<input type=\"checkbox\" class=\"filled-in checkbox-orange\" id=\"".$val["image_ID"]."\" />
					<label for=\"".$val["image_ID"]."\">
						<div class=\"flexVertCenter\">
							<div>
								<span class=\"infoText\">".$val["image_title"]."</span>
							</div>
						</div>
					</label>
					<img class=\"materialboxed\" data-caption=\"".$val["image_descr"]."\" width=\"60\" src=\"".$val["image_path"]."\" />
				</div>";
		}
	echo "</div>
	</div>";
} else {
	//this is required to avoid a blank page when user is loggin out (session is closed) and press a back button, so user is just transfered to the index page
	header("Location: ../index.php");
}
?>