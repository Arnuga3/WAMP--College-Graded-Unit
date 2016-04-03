<?php
	session_start();
?>
<?php
	include("../page classes/CL_ControlPanel.php");
	
	if (isset($_SESSION["mrBoss"])) {
		$userID = $_SESSION["mrBoss"]["usr_ID"];
		
		include ("../db/db_ORM.php");
		//Create DB connection and get data from db
		$db = new dbConnection();
		$db->connect();
		//Get a showreel video information
		$result = $db->select("media, images", "media.*, images.*", "media.usr_ID = $userID AND media.image_ID = images.image_ID AND images.image_group = 'acting'");
		$db->close();

		//Passing information to class constructor
		$controlPage = new ControlPanel();
		$controlPage -> title = "Jamie Rodden";
		$controlPage -> description = "Jamie Rodden";
		$controlPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
		$controlPage -> displayPage();

	} else {
		//this is required to avoid a blank page when user is loggin out (session is closed) and press a back button, so user is just transfered to the index page
		header("Location: ../index.php");
	}
?>