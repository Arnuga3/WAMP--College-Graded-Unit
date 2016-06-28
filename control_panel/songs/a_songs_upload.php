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
echo "<!--SONGS-->
	<!--SUBNAV-->
	
	<nav class=\"bread_path\">
		<div class=\"bread nav-wrapper\">
			<div class=\"col s12\">
				<a href=\"#!\" class=\"breadcrumb\">Songs</a>
				<a href=\"#!\" class=\"breadcrumb\">$folder</a>
			</div>
		</div>
	</nav>
	
	<div class=\"sub_nav hide-on-med-and-down\">
		<a class=\"a_songs z-depth-1 waves-effect waves-dark\" href=\"#\"><img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" /><span>back</span></a>
	</div>
	
	<div class=\"fixed-action-btn vertical click-to-toggle hide-on-large-only\" style=\"bottom: 24px; right: 24px;\">
		<a class=\"a_songs btn-floating btn-large cyan darken-2\">
			<img class=\"pencil\" src=\"../img/cpIcons/arrow_undo.png\" />
		</a>
	</div>
	
	<div class=\"cp_content\">

		<p class=\"helperText infoMargin\"><img class=\"sm_info\" src=\"../img/cpIcons/information.png\" />Upload file(s) using the form below. Type a new name to create a new album or type a name of existing album to upload selected song(s) into it.</p>
		
		<div id=\"cpCont\" class=\"margBotExtra pad10\">

		
			<form id=\"songsAddForm\" class=\"textCenter\" action=\"\" method=\"\" enctype=\"multipart/form-data\">
				<div class=\"input-field\">
						<i class=\"prefix\"><img src=\"../img/cpIcons/folder_add.png\" /></i>
						<input type=\"text\" id=\"file_upl_alb_name\" name=\"album_name\" class=\"validate\" length=\"100\" placeholder=\"Enter a name to create an album\" value=\"$folder\"/>
					</div>
				<div id=\"ulpBtn\" class=\"file-field input-field margTopL\">
					<div class=\"btn blue-grey lighten-2\">
						<span>songs(s)</span>
						<input type=\"file\" name=\"file[]\" id=\"file\" multiple>
					</div>
					<div class=\"file-path-wrapper\">
						<input class=\"file-path validate\" type=\"text\" placeholder=\"Upload one or more songs\">
					</div>
				</div>
				<button id=\"submitSongsAddForm\" class=\"margTopX btn waves-effect waves-light teal darken-3\" type=\"submit\" name=\"action\">UPLOAD Song(s)</button>
			</form>
				
				
			<p id=\"error\"></p>
		
		</div>
	</div>";

} else {
	//this is required to avoid a blank page when user is loggin out (session is closed) and press a back button, so user is just transfered to the index page
	header("Location: ../index.php");
}