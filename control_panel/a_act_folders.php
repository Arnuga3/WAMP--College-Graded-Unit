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
	
	<div class=\"sub_nav hide-on-med-and-down\">
		<a class=\"a_act_p waves-effect waves-light\" href=\"#\"><img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" /><span>back</span></a>
		<a class=\"waves-effect waves-light\" href=\"#\"><img src=\"../img/cpIcons/folder_delete.png\" /><span>delete folder</span></a>
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
			<li><span>delete folder</span><a class=\"btn-floating blue\"><img src=\"../img/cpIcons/folder_delete.png\" /></a></li>
			<li><span>new photo</span><a class=\"btn-floating orange\"><img src=\"../img/cpIcons/image_add.png\" /></a></li>
			<li><span>edit photo</span><a class=\"btn-floating green\"><img src=\"../img/cpIcons/image_edit.png\" /></a></li>
			<li><span>delete photo</span><a class=\"btn-floating blue\"><img src=\"../img/cpIcons/image_delete.png\" /></a></li>
			<li><span>move photo</span><a class=\"btn-floating red\"><img src=\"../img/cpIcons/scale_image.png\" /></a></li>
		</ul>
	</div>
	
	<div class=\"fixed-action-btn vertical click-to-toggle hide-on-large-only\" style=\"bottom: 24px; right: 84px;\">
		<a class=\"a_act_p btn-floating btn-large cyan darken-2\">
			<img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" />
		</a>
	</div>
	
	<div class=\"cp_content\">
	
		<p class=\"helperText infoMargin2\"><img class=\"sm_info\" src=\"../img/cpIcons/information.png\" />Add, Edit or Remove albums or images.</p>
		
		<div id=\"cpCont\" class=\"margTop margBotXL\">";

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