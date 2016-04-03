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
		<a class=\"waves-effect waves-light\" href=\"#\"><img src=\"../img/cpIcons/folder_delete.png\" /><span>delete folder</span></a>
		<a class=\"waves-effect waves-light\" href=\"#\"><img src=\"../img/cpIcons/image_add.png\" /><span>new photo</span></a>
		<a class=\"waves-effect waves-light\" href=\"#\"><img src=\"../img/cpIcons/image_edit.png\" /><span>edit photo</span></a>
		<a class=\"waves-effect waves-light\" href=\"#\"><img src=\"../img/cpIcons/image_delete.png\" /><span>delete photo</span></a>
	</div>

	<div class=\"fixed-action-btn horizontal click-to-toggle hide-on-large-only\" style=\"bottom: 24px; right: 24px;\">
		<a class=\"btn-floating btn-large red\">
			<i class=\"large mdi-navigation-menu\"></i>
		</a>
		<ul>
			<li><a class=\"btn-floating red\"><i class=\"material-icons\">insert_chart</i></a></li>
			<li><a class=\"btn-floating yellow darken-1\"><i class=\"material-icons\">format_quote</i></a></li>
			<li><a class=\"btn-floating green\"><i class=\"material-icons\">publish</i></a></li>
			<li><a class=\"btn-floating blue\"><i class=\"material-icons\">attach_file</i></a></li>
		</ul>
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