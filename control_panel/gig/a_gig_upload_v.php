<?php
/*
Author: Arnis Zelcs
Created: 9/04/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Create an upload files screen
*/

//start session
session_start();
?>
<?php
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
	
	if (isset($_GET["folder"])) {
		$folder = test_input($_GET["folder"]);
	} else {
		$folder = "";
	}
	//include an Object Related Mapping class for a database
	include ("../../db/db_ORM.php");
	
	//Create DB connection and get data from db
	$db = new dbConnection();
	$db->connect();

	$db->close();
echo "<!--Gig PHOTOS-->
	<!--SUBNAV-->
	
	<nav class=\"bread_path\">
		<div class=\"bread nav-wrapper\">
			<div class=\"col s12\">
				<a href=\"#!\" class=\"breadcrumb\">Gig Videos</a>
				<a href=\"#!\" class=\"breadcrumb\">$folder</a>
			</div>
		</div>
	</nav>
	
	<div class=\"sub_nav hide-on-med-and-down\">
		<a class=\"a_gig_v z-depth-1 waves-effect waves-dark\" href=\"#\"><img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" /><span>back</span></a>
	</div>
	
	<div class=\"fixed-action-btn vertical click-to-toggle hide-on-large-only\" style=\"bottom: 24px; right: 24px;\">
		<a class=\"a_gig_v btn-floating btn-large cyan darken-2\">
			<img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" />
		</a>
	</div>
	
	<div class=\"cp_content\">

		<p class=\"helperText infoMargin\"><img class=\"sm_info\" src=\"../img/cpIcons/information.png\" />Add a new video using the form below. Type a name to create a new album or type a name of existing album to add a new video into.</p>
		
		<div id=\"cpCont\" class=\"margBotExtra pad10\">

		
			<form id=\"videoAddForm\" class=\"textCenter\" action=\"\" method=\"\">
				<div class=\"input-field\">
					<i class=\"prefix\"><img src=\"../img/cpIcons/folder_add.png\" /></i>
					<input type=\"text\" id=\"file_upl_alb_name\" name=\"album_name\" class=\"validate\" length=\"100\" placeholder=\"Enter a name to create an album\" value=\"$folder\"/>
				</div>
				<div class=\"input-field\">
					<input type=\"text\" id=\"add_video_title\" name=\"add_video_title\" class=\"validate\" length=\"100\" placeholder=\"video title\" />
					<label for=\"add_video_title\">Title</label>
				</div>
				<div class=\"input-field\">
					<input type=\"text\" id=\"add_video_descr\" name=\"add_video_descr\" class=\"validate\" length=\"100\" placeholder=\"video description\" />
					<label for=\"add_video_descr\">Description</label>
				</div>
				<div class=\"input-field\">
					<input type=\"text\" id=\"add_video_path\" name=\"add_video_path\" class=\"validate\" length=\"100\" placeholder=\"video URL address\" />
					<label for=\"add_video_path\">URL address</label>
				</div>
				<button id=\"submitVideoAddForm\" class=\"margTopX btn waves-effect waves-light teal darken-3\" type=\"submit\" name=\"action\">Add video</button>
			</form>
				
				
			<p id=\"error\"></p>
		
		</div>
	</div>";

} else {
	//this is required to avoid a blank page when user is loggin out (session is closed) and press a back button, so user is just transfered to the index page
	header("Location: ../index.php");
}