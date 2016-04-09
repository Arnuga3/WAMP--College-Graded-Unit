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

	$db->close();
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
	</div>
	
	<div class=\"fixed-action-btn vertical click-to-toggle hide-on-large-only\" style=\"bottom: 24px; right: 24px;\">
		<a class=\"a_act_p btn-floating btn-large cyan darken-2\">
			<img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" />
		</a>
	</div>
	
	<div class=\"cp_content\">

		<p class=\"helperText infoMargin\"><img class=\"sm_info\" src=\"../img/cpIcons/information.png\" />Upload file(s) using the form below.</p>
		
		<div id=\"cpCont\" class=\"margTop margBotXL pad10\">

		
			<form action=\"create_album.php\" method=\"post\" enctype=\"multipart/form-data\">
				<div class=\"file-field input-field\">
					<div class=\"btn grey\">
						<span>choose</span>
						<input type=\"file\" name=\"files[]\" multiple>
					</div>
					<div class=\"file-path-wrapper\">
						<input class=\"file-path validate\" type=\"text\" placeholder=\"Upload one or more files\">
					</div>
				</div>
				<button class=\"margTop btn waves-effect waves-light orange\" type=\"submit\" name=\"action\">UPLOAD</button>
			</form>
				
				
			<p id=\"error\"></p>
		
		</div>
	</div>";

} else {
	//this is required to avoid a blank page when user is loggin out (session is closed) and press a back button, so user is just transfered to the index page
	header("Location: ../index.php");
}