<?php
	session_start();
?>
<?php
if (isset($_SESSION["mrBoss"])) {
	$userID = $_SESSION["mrBoss"]["usr_ID"];
	
	$albums = $_SESSION["AllAlbums"];
	
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
		<a class=\"z-depth-1 a_act_p waves-effect waves-dark\" href=\"#\"><img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" /><span>back</span></a>
		<a class=\"z-depth-1 waves-effect waves-dark\" href=\"#\"><img src=\"../img/cpIcons/folder_delete.png\" /><span>delete album</span></a>
		<a class=\"z-depth-1 waves-effect waves-dark\" href=\"#\"><img src=\"../img/cpIcons/image_add.png\" /><span>new photo</span></a>
		<a class=\"z-depth-1 waves-effect waves-dark\" href=\"#\"><img src=\"../img/cpIcons/image_edit.png\" /><span>edit photo</span></a>
		<a class=\"z-depth-1 waves-effect waves-dark\" href=\"#\"><img src=\"../img/cpIcons/image_delete.png\" /><span>delete photo</span></a>
		<a class=\"z-depth-1 waves-effect waves-dark .modal-trigger-move\" href=\"#footer_modal\" onclick=\"checkIfChecked()\"><img src=\"../img/cpIcons/scale_image.png\" /><span>move photo</span></a>
	</div>

	<div class=\"fixed-action-btn vertical click-to-toggle hide-on-large-only\" style=\"bottom: 24px; right: 24px;\">
		<a class=\"fire_dark btn-floating btn-large deep-orange darken-2\">
			<img class=\"pencil\" src=\"../img/cpIcons/pencil.png\" />
		</a>
		<ul>
			<li><span>delete album</span><a class=\"btn-floating blue\"><img src=\"../img/cpIcons/folder_delete.png\" /></a></li>
			<li><span>new photo</span><a class=\"btn-floating orange\"><img src=\"../img/cpIcons/image_add.png\" /></a></li>
			<li><span>edit photo</span><a class=\"btn-floating green\"><img src=\"../img/cpIcons/image_edit.png\" /></a></li>
			<li><span>delete photo</span><a class=\"btn-floating blue\"><img src=\"../img/cpIcons/image_delete.png\" /></a></li>
			<li><span>move photo</span><a class=\"btn-floating  .modal-trigger-move red\" href=\"#footer_modal\" onclick=\"checkIfChecked()\"><img src=\"../img/cpIcons/scale_image.png\" /></a></li>
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
		echo "<p id=\"error\"></p>";
	echo "</div>
	</div>";
	
			//FOOTER MODAL
			echo "<div id=\"footer_modal\" class=\"modal bottom-sheet\">
					<div class=\"modal-content col l8 offset-l2 margBotExtra\">
						<h5>Select a folder you want to move images to:</h5>
						<ul>";
			//Footer modal
			foreach ($albums as $val) {
				echo "		<li><a class=\"foot_mod\" onclick=\"movePhotosAJAX('".$val."', getSelectedPhotos())\" href=\"#\">
								<div class=\"flexVertCenter\">
									<img class=\"margLeft10\" width=\"40\" src=\"../img/cpIcons/folder.png\" />
									<span class=\"margLeft infoText\">".$val."</span>
								</div>
							</a></li>";
			}
				echo "		<li><a class=\"foot_mod\" onclick=\"movePhotosAJAX(prompt('Name the album'), getSelectedPhotos())\" href=\"#\">
								<div class=\"flexVertCenter\">
									<img class=\"margLeft10\" width=\"40\" src=\"../img/cpIcons/folder_add.png\" />
									<span class=\"margLeft infoText\">CREATE NEW ALBUM</span>
								</div>
							</a></li>
							<li><a class=\"foot_mod\" onclick=\"movePhotosAJAX('', getSelectedPhotos())\" href=\"#\">
								<div class=\"flexVertCenter\">
									<img class=\"margLeft10\" width=\"40\" src=\"../img/cpIcons/folder_go.png\" />
									<span class=\"margLeft infoText\">MAIN GALLERY (without album)</span>
								</div>
							</a></li>";
			echo "		</ul>
					</div>
				</div>";
			//FOOTER MODAL END	

} else {
	//this is required to avoid a blank page when user is loggin out (session is closed) and press a back button, so user is just transfered to the index page
	header("Location: ../index.php");
}
?>