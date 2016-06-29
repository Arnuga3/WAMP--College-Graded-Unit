<?php
/*
Author: Arnis Zelcs
Created: 23/04/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Create an edit photo(s) screen - acting
*/
	//include an Object Related Mapping class for a database
	include ("../../db/db_ORM.php");
		
	//to make work htmlspecialchars() function
	header('Content-Type: text/plain');

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if (isset($_POST["folder"])) {
		$folder = test_input($_POST["folder"]);
	}
	if (isset($_POST["videos"])) {
		$videos = test_input($_POST["videos"]);
	}

	//split into array, use 'p' as separator (as it was passed as a string like p1p2p3p4 ...)
	$videosIDs = explode('p',$videos);
	array_shift($videosIDs);
		
	$db = new dbConnection();
	$db->connect();
	
	echo "<!--ACTING videos-->
		<!--SUBNAV-->
		
		<nav class=\"bread_path\">
			<div class=\"bread nav-wrapper\">
				<div class=\"col s12\">
					<a href=\"#!\" class=\"breadcrumb\">Acting Videos</a>
					<a href=\"#!\" class=\"breadcrumb\"></a>
				</div>
			</div>
		</nav>
		
		<div class=\"sub_nav hide-on-med-and-down\">
			<a class=\"a_act_v z-depth-1 waves-effect waves-dark\" href=\"#\"><img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" /><span>back</span></a>
			<a class=\"waves-effect waves-dark z-depth-1\" onclick=\"\"><img src=\"../img/cpIcons/diskette.png\" /><span>save</span></a>
		</div>
		
		<div class=\"sub_nav hide-on-med-and-down\">
			<a class=\"waves-effect waves-dark z-depth-1\" onclick=\"saveChangesEditVideo(0)\"><img src=\"../img/cpIcons/diskette.png\" /><span>save</span></a>
		</div>
		
		<!--SAVE BTN MOB-->
		<div class=\"fixed-action-btn hide-on-large-only\" style=\"bottom: 24px; right: 24px;\">
			<a class=\"btn-floating btn-large waves-effect waves-light deep-orange darken-2\" onclick=\"saveChangesEditVideo(0)\"><img class=\"pencil\" src=\"../img/cpIcons/diskette.png\" /></a>
		</div>
		
		<!--BACK BTN MOB-->
		<div class=\"fixed-action-btn vertical click-to-toggle hide-on-large-only\" style=\"bottom: 24px; right: 84px;\">
			<a class=\"a_act_v btn-floating btn-large cyan darken-2\">
				<img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" />
			</a>
		</div>
		
		<div class=\"cp_content\">

			<p class=\"helperText infoMargin\"><img class=\"sm_info\" src=\"../img/cpIcons/information.png\" />Edit name(s) and/or description(s) of the video(s) below.</p>
			
			<div id=\"cp\" class=\"margBotExtra pad10\">";

		//get the information of selected images from db using ids
		$videoInfo = array();
		for ($i=0; $i<count($videosIDs); $i++) {
			
			$escapedVal = $db->escape($videosIDs[$i]);
			$result = $db->customQuery("SELECT video_ID,video_title,video_descr,video_path FROM video WHERE video_ID = $escapedVal");
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$videoInfo[] = $row;
				}
			}
		}
		//form to submit changes for selected images
		echo "<form id=\"videoEditForm\" action=\"\" method=\"\">";
		for ($i=0; $i<count($videoInfo); $i++) {
			
			//to remove 1 whitespace
			if ($videoInfo[$i]["video_descr"] == " ") {
				$videoInfo[$i]["video_descr"] = null;
			}
			
			$counter = $i + 1;
			
			//label
			echo "<p class=\"margTopX photoNrEdit\">VIDEO  $counter </p>
			
				<!-- Video name -->
				<div class=\"input-field margTopL\">
						<input id=\"img_title$i\" type=\"text\" name=\"pName".str_replace('"',"&quot;", $videoInfo[$i]["video_ID"])."\" 
						value=\"".str_replace('"',"&quot;", $videoInfo[$i]["video_title"])."\" \>
						<label for=\"img_title$i\">Video title</label>
					</div>
				
				<!-- Video description -->
				<div class=\"input-field\">
						<input id=\"img_descr$i\" type=\"text\" name=\"pDescr".str_replace('"',"&quot;", $videoInfo[$i]["video_ID"])."\" 
						value=\"".str_replace('"',"&quot;", $videoInfo[$i]["video_descr"])."\" \>
						<label for=\"img_descr$i\">Video description</label>
					</div>
					
				<!-- Video path -->
				<div class=\"input-field\">
						<input id=\"img_path$i\" type=\"text\" name=\"pPath".str_replace('"',"&quot;", $videoInfo[$i]["video_ID"])."\" 
						value=\"".str_replace('"',"&quot;", $videoInfo[$i]["video_path"])."\" \>
						<label for=\"img_path$i\">Video url</label>
					</div>";
		}
		
echo 		"</form>
			<p id=\"error\"></p>
			
			</div>
		</div>";
	
		$db->close();

	//Error message is displayed on the page if there is any
	echo "";
?>