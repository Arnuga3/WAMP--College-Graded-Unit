<?php
	include ("../db/db_ORM.php");
		
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
	if (isset($_POST["photos"])) {
		$photos = test_input($_POST["photos"]);
	}

	//split into array, use 'p' as separator (as it was passed as a string like p1p2p3p4 ...)
	$photosIDs = explode('p',$photos);
	array_shift($photosIDs);
		
	$db = new dbConnection();
	$db->connect();
	
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
			<a class=\"a_act_p z-depth-1 waves-effect waves-dark\" href=\"#\"><img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" /><span>back</span></a>
			<a class=\"waves-effect waves-dark z-depth-1\" onclick=\"\"><img src=\"../img/cpIcons/diskette.png\" /><span>save</span></a>
		</div>
		
		<div class=\"sub_nav hide-on-med-and-down\">
			<a class=\"waves-effect waves-dark z-depth-1\" onclick=\"saveChangesEdit(0)\"><img src=\"../img/cpIcons/diskette.png\" /><span>save</span></a>
		</div>
		
		<!--SAVE BTN MOB-->
		<div class=\"fixed-action-btn hide-on-large-only\" style=\"bottom: 24px; right: 24px;\">
			<a class=\"btn-floating btn-large waves-effect waves-light deep-orange darken-2\" onclick=\"saveChangesEdit(0)\"><img class=\"pencil\" src=\"../img/cpIcons/diskette.png\" /></a>
		</div>
		
		<!--BACK BTN MOB-->
		<div class=\"fixed-action-btn vertical click-to-toggle hide-on-large-only\" style=\"bottom: 24px; right: 84px;\">
			<a class=\"a_act_p btn-floating btn-large cyan darken-2\">
				<img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" />
			</a>
		</div>		
		
		<div class=\"fixed-action-btn hide-on-large-only\" style=\"bottom: 24px; right: 24px;\">
			<a class=\"btn-floating btn-large waves-effect waves-light deep-orange darken-2\" onclick=\"\"><img class=\"pencil\" src=\"../img/cpIcons/diskette.png\" /></a>
		</div>
		
		<div class=\"cp_content\">

			<p class=\"helperText infoMargin\"><img class=\"sm_info\" src=\"../img/cpIcons/information.png\" />Edit name(s) and/or description(s) of the image(s) below.</p>
			
			<div id=\"cp\" class=\"margBotExtra pad10\">";


		$photoInfo = array();
		for ($i=0; $i<count($photosIDs); $i++) {
			
			$escapedVal = $db->escape($photosIDs[$i]);
			$result = $db->customQuery("SELECT image_ID,image_title,image_descr FROM images WHERE image_ID = $escapedVal");
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$photoInfo[] = $row;
				}
			}
		}
		
		echo "<form id=\"photoEditForm\" action=\"\" method=\"\">";
		for ($i=0; $i<count($photoInfo); $i++) {
			
			//to remove 1 whitespace
			if ($photoInfo[$i]["image_descr"] == " ") {
				$photoInfo[$i]["image_descr"] = null;
			}
			
			$counter = $i + 1;
			
			echo "<p class=\"margTopX photoNr\">PHOTO  $counter </p>
				<div class=\"input-field margTopL\">
						<input id=\"img_title$i\" type=\"text\" name=\"pName".$photoInfo[$i]["image_ID"]."\" value=\"".$photoInfo[$i]["image_title"]."\" \>
						<label for=\"img_title$i\">Image title</label>
					</div>
				<div class=\"input-field\">
						<input id=\"img_descr$i\" type=\"text\" name=\"pDescr".$photoInfo[$i]["image_ID"]."\" value=\"".$photoInfo[$i]["image_descr"]."\" \>
						<label for=\"img_descr$i\">Image description</label>
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