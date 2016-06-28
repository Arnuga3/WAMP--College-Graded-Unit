<?php
/*
Author: Arnis Zelcs
Created: 3/04/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Create a content of selected album - acting
*/

//start session
session_start();
?>
<?php
//if session is on
if (isset($_SESSION["mrBoss"])) {
	$userID = $_SESSION["mrBoss"]["usr_ID"];
	
	//to make work htmlspecialchars() function
	header('Content-Type: text/plain');
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	$folder = test_input($_GET["folder"]);
	//need to fix that, as it takes space in html
	echo $folder;
	
	//include an Object Related Mapping class for a database
	include ("../../db/db_ORM.php");
	
	//Create DB connection and get data from db
	$db = new dbConnection();
	$db->connect();
	
	//To get existing folders in db
	$res = $db->select("media, video", "media.*, video.*", "media.usr_ID = $userID AND media.video_ID = video.video_ID AND video.video_group = 'acting'");
	
	//THIS CODE GETS UNIQUE NAMES OF FOLDERS AND SAVES THEM INTO INDEXED ARRAY
	$folders = array();
	if ($res->num_rows > 0) {
		while($row = $res->fetch_assoc()) {
			//Place all folder names into new array
			$folders[] = $row["video_folder"];
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
	$albums = $folders_indexed;
	
	//to rename folder
	$escapedFolder = $db->escape($folder);
	$result = $db->select("media, video", "media.*, video.*", "media.usr_ID = $userID AND media.video_ID = video.video_ID AND video.video_folder = '$escapedFolder'");
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
				<a href=\"#!\" class=\"a_act_v breadcrumb\">Acting Videos</a>
				<a href=\"#!\" class=\"sb_rename breadcrumb relative\"><span class=\"sb_rename_folder truncated absolute\">$folder</span><span class=\"aftTrunc absolute grey-text text-darken-2\">Rename</span></a>
			</div>
		</div>
	</nav>
	
	<div class=\"sub_nav hide-on-med-and-down\">
		<a class=\"a_act_v z-depth-1 waves-effect waves-dark\" href=\"#\"><img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" /><span>back</span></a>
		<a class=\"sb_upload z-depth-1 waves-effect waves-dark\" href=\"#\"><img src=\"../img/cpIcons/film_add.png\" /><span>new video(s)</span></a>
		<a class=\"z-depth-1 waves-effect waves-dark\" href=\"#\" onclick=\"checkIfCheckedEditVideo(0)\"><img src=\"../img/cpIcons/film_edit.png\" /><span>edit video</span></a>
		<a class=\"z-depth-1 waves-effect waves-dark\" href=\"#\" onclick=\"checkIfCheckedDelVideo(0)\"><img src=\"../img/cpIcons/film_delete.png\" /><span>delete video</span></a>
		<a class=\"z-depth-1 waves-effect waves-dark .modal-trigger-move\" href=\"#footer_modal\" onclick=\"checkIfChecked()\"><img src=\"../img/cpIcons/film_go.png\" /><span>move video</span></a>
	</div>

	<div class=\"fixed-action-btn vertical click-to-toggle hide-on-large-only\" style=\"bottom: 24px; right: 24px;\">
		<a class=\"fire_dark btn-floating btn-large deep-orange darken-2\">
			<img class=\"pencil\" src=\"../img/cpIcons/pencil.png\" />
		</a>
		<ul>
			<li><span>new video(s)</span><a class=\"sb_upload btn-floating orange\"><img src=\"../img/cpIcons/film_add.png\" /></a></li>
			<li><span>edit video</span><a class=\"btn-floating green\" onclick=\"checkIfCheckedEditVideo(0)\"><img src=\"../img/cpIcons/film_edit.png\" /></a></li>
			<li><span>delete video</span><a class=\"btn-floating blue\" onclick=\"checkIfCheckedDelVideo(0)\"><img src=\"../img/cpIcons/film_delete.png\" /></a></li>
			<li><span>move video</span><a class=\"btn-floating  .modal-trigger-move red\" href=\"#footer_modal\" onclick=\"checkIfChecked()\"><img src=\"../img/cpIcons/film_go.png\" /></a></li>
		</ul>
	</div>
	
	<div class=\"fixed-action-btn vertical click-to-toggle hide-on-large-only\" style=\"bottom: 24px; right: 84px;\">
		<a class=\"a_act_v btn-floating btn-large cyan darken-2\">
			<img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" />
		</a>
	</div>
	
	<div class=\"cp_content\">
	
		<p class=\"helperText infoMargin2\"><img class=\"sm_info\" src=\"../img/cpIcons/information.png\" />Add, Edit or Remove albums or videos.</p>
		
		<div id=\"cpCont\" class=\"margTop margBotXL\">
		<a id=\"selectAllBtn\" class=\"waves-effect waves-light btn-flat blue-grey lighten-2 margLeft10 margBot\">check/uncheck all</a>";

		foreach ($photos as $val) {
					echo "<!--Image Row in Control Panel(checkbox, name, image)-->
						<div class=\"flexVertCenter imgRow\">
							<input type=\"checkbox\" class=\"filled-in checkbox-orange\" id=\"".$val["video_ID"]."\" />
							<label for=\"".$val["video_ID"]."\">
								<div class=\"flexVertCenter\">
									<div>
										<span class=\"infoText truncatedTitle absolute\">".$val["video_title"]."<span class=\"helperText2\">".$val["video_descr"]."</span></span>
									</div>
								</div>
							</label>
							<div class=\"videoPreview\" onclick=\"addModal(".$val["video_ID"].")\">preview</div>
						</div>";
		}
		echo "<p id=\"error\"></p>";
	echo "</div>
	</div>";
	
			echo '<div id="previewModal"></div>';
	
			//FOOTER MODAL
			echo "<div id=\"footer_modal\" class=\"modal bottom-sheet\">
					<div class=\"modal-content col l8 offset-l2 margBotExtra\">
						<h5>Select a folder you want to move videos to:</h5>
						<ul>";
			//Footer modal
			foreach ($albums as $val) {
				echo "		<li><a class=\"foot_mod\" onclick=\"moveVideosAJAX('".$val."', getSelectedItems(), 0)\" href=\"#\">
								<div class=\"flexVertCenter\">
									<img class=\"margLeft10\" width=\"40\" src=\"../img/cpIcons/folder.png\" />
									<span class=\"margLeft infoText\">".$val."</span>
								</div>
							</a></li>";
			}
				echo "		<li><a class=\"foot_mod\" onclick=\"moveToNewAlbumVideo(0)\" href=\"#\">
								<div class=\"flexVertCenter\">
									<img class=\"margLeft10\" width=\"40\" src=\"../img/cpIcons/folder_add.png\" />
									<span class=\"margLeft infoText\">CREATE NEW ALBUM</span>
								</div>
							</a></li>
							<li><a class=\"foot_mod\" onclick=\"moveVideosAJAX('', getSelectedItems(), 0)\" href=\"#\">
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