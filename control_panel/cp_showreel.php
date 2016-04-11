<?php
	session_start();
?>
<?php
	include("../page classes/CL_ControlPanel.php");
	
	if (isset($_SESSION["mrBoss"])) {
		$userID = $_SESSION["mrBoss"]["usr_ID"];

		//Passing information to class constructor
		$controlPage = new ControlPanel();
		$controlPage -> title = "Jamie Rodden";
		$controlPage -> description = "Jamie Rodden";
		$controlPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
		
		if (isset($_SESSION["uploaded"])) {
			//will output appropriate message if set to true(used after file uploads)
			$controlPage -> uploads = $_SESSION["uploaded"];
		}
		
		$controlPage -> displayPage();
		
		if (isset($_SESSION["uploaded"])) {
			$_SESSION["uploaded"] = false;
		}
	} else {
		//this is required to avoid a blank page when user is loggin out (session is closed) and press a back button, so user is just transfered to the index page
		header("Location: ../index.php");
	}
?>