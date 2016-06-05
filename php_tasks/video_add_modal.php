<?php

	//to make work htmlspecialchars() function
	header('Content-Type: text/plain');
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}


	if (isset($_POST["id"])) {
		$id = test_input($_POST["id"]);
		
		//include a database Object-relational mapping class
		include ("../db/db_ORM.php");
		
		//Create DB connection and get data from db
		$db = new dbConnection();
		$db->connect();
		
		$result = $db->customQuery("SELECT video_ID, video_path FROM video WHERE video_ID = ".$id." LIMIT 1");
		
		$db->close();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<!-- Modal Structure -->
					<div id="modal'.$row["video_ID"].'" class="modal">
						<div class="modal-content">
							<h4>Video preview</h4>
							<div class="video-container">
								<iframe width="853" height="480" src="'.$row["video_path"].'" frameborder="0" allowfullscreen></iframe>
							</div>
						</div>
					</div>';
			}
		}

	}

	
?>