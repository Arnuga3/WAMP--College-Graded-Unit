<?php
	session_start();
?>
<?php
	include("page classes/CL_ControlPanel.php");
	
	if (isset($_SESSION["mrBoss"])) {
		$userID = $_SESSION["mrBoss"]["usr_ID"];
		
		include ("db/db_ORM.php");
		//Create DB connection and get data from db
		$db = new dbConnection();
		$db->connect();
		$result = $db->select("media, video", "media.*, video.*", "media.usr_ID = $userID AND media.video_ID = video.video_ID AND video.video_group = 'showreel'");
		$db->close();
		
		if ($result->num_rows == 1) {
			while($row = $result->fetch_assoc()) {
				$data = $row;
			}
			
			$controlPage = new ControlPanel($data);
			$controlPage -> title = "Jamie Rodden";
			$controlPage -> description = "Jamie Rodden";
			$controlPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
			$controlPage -> displayPage();
			
		} else {
			echo "Error: one record is expected";
		}
	}
?>