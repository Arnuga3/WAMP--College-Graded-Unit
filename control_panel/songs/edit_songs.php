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
	if (isset($_POST["songs"])) {
		$songs = test_input($_POST["songs"]);
	}

	//split into array, use 'p' as separator (as it was passed as a string like p1p2p3p4 ...)
	$songsIDs = explode('p',$songs);
	array_shift($songsIDs);
		
	$db = new dbConnection();
	$db->connect();
	
	echo "<!--Songs-->
		<!--SUBNAV-->
		
		<nav class=\"bread_path\">
			<div class=\"bread nav-wrapper\">
				<div class=\"col s12\">
					<a href=\"#!\" class=\"breadcrumb\">Songs</a>
					<a href=\"#!\" class=\"breadcrumb\"></a>
				</div>
			</div>
		</nav>
		
		<div class=\"sub_nav hide-on-med-and-down\">
			<a class=\"a_songs z-depth-1 waves-effect waves-dark\" href=\"#\"><img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" /><span>back</span></a>
			<a class=\"waves-effect waves-dark z-depth-1\" onclick=\"\"><img src=\"../img/cpIcons/diskette.png\" /><span>save</span></a>
		</div>
		
		<div class=\"sub_nav hide-on-med-and-down\">
			<a class=\"waves-effect waves-dark z-depth-1\" onclick=\"saveChangesEditSongs()\"><img src=\"../img/cpIcons/diskette.png\" /><span>save</span></a>
		</div>
		
		<!--SAVE BTN MOB-->
		<div class=\"fixed-action-btn hide-on-large-only\" style=\"bottom: 24px; right: 24px;\">
			<a class=\"btn-floating btn-large waves-effect waves-light deep-orange darken-2\" onclick=\"saveChangesEditSongs()\"><img class=\"pencil\" src=\"../img/cpIcons/diskette.png\" /></a>
		</div>
		
		<!--BACK BTN MOB-->
		<div class=\"fixed-action-btn vertical click-to-toggle hide-on-large-only\" style=\"bottom: 24px; right: 84px;\">
			<a class=\"a_songs btn-floating btn-large cyan darken-2\">
				<img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" />
			</a>
		</div>
		
		<div class=\"cp_content\">

			<p class=\"helperText infoMargin\"><img class=\"sm_info\" src=\"../img/cpIcons/information.png\" />Edit name(s) and/or description(s) of the song(s) below.</p>
			
			<div id=\"cp\" class=\"margBotExtra pad10\">";

		//get the information of selected images from db using ids
		$songsInfo = array();
		for ($i=0; $i<count($songsIDs); $i++) {
			
			$escapedVal = $db->escape($songsIDs[$i]);
			$result = $db->customQuery("SELECT music_ID,music_title,music_descr,music_path FROM music WHERE music_ID = $escapedVal");
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$songsInfo[] = $row;
				}
			}
		}
		//form to submit changes for selected images
		echo "<form id=\"songsEditForm\" action=\"\" method=\"\">";
		for ($i=0; $i<count($songsInfo); $i++) {
			
			//to remove 1 whitespace
			if ($songsInfo[$i]["music_descr"] == " ") {
				$songsInfo[$i]["music_descr"] = null;
			}
			
			$counter = $i + 1;
			
			//label
			echo "<p class=\"margTopX photoNrEdit\">SONG  $counter </p>
			
				<!-- Song name -->
				<div class=\"input-field margTopL\">
						<input id=\"song_title$i\" type=\"text\" name=\"pName".str_replace('"',"&quot;", $songsInfo[$i]["music_ID"])."\" 
						value=\"".str_replace('"',"&quot;", $songsInfo[$i]["music_title"])."\" \>
						<label for=\"song_title$i\">Song title</label>
					</div>
				
				<!-- Song description -->
				<div class=\"input-field\">
						<input id=\"song_descr$i\" type=\"text\" name=\"pDescr".str_replace('"',"&quot;", $songsInfo[$i]["music_ID"])."\" 
						value=\"".str_replace('"',"&quot;", $songsInfo[$i]["music_descr"])."\" \>
						<label for=\"song_descr$i\">Song description</label>
					</div>
					
					
				<audio id=\"music\" controls=\"controls\">
					<source src='audio/".$songsInfo[$i]["music_path"]."' type='audio/mpeg' />
					<source src='audio/".$songsInfo[$i]["music_path"]."' type='audio/ogg' />
				</audio>";
		}
		
echo 		"</form>
			<p id=\"error\"></p>
			
			</div>
		</div>";
	
		$db->close();

	//Error message is displayed on the page if there is any
	echo "";
?>