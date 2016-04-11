<?php
session_start();
?>
<?php

if (isset($_SESSION["mrBoss"])) {
	$userID = $_SESSION["mrBoss"]["usr_ID"];
	include ("../db/db_ORM.php");
	
	//to make work htmlspecialchars() function
	header('Content-Type: text/plain');
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	extract($_POST);
	$newAlbum = test_input($_POST["album_name"]);
	
    $error = array();
    $extension = array("jpeg", "JPEG", "jpg", "JPG", "png", "PNG", "gif", "GIF");
	
	$db = new dbConnection();
	$db->connect();
	
    foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
		$file_name = $_FILES["files"]["name"][$key];
		$file_tmp = $_FILES["files"]["tmp_name"][$key];
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);

		if (in_array($ext, $extension)) {
			
			if (!file_exists("../uploaded_photos/".$file_name)) {
				
				move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../uploaded_photos/".$file_name);
				
				$db->customQuery("INSERT INTO ai_images (ai_ID) VALUES ('')");
				
				$result = $db->customQuery("SELECT ai_ID FROM ai_images ORDER BY ai_ID DESC LIMIT 1");
				if ($result->num_rows == 1) {
					while($row = $result->fetch_assoc()) {
						//Place all folder names into new array
						$lastID = $row["ai_ID"];
						echo $row["ai_ID"];
					}
					
					$userIDDB = $db->escape($userID);
					$db->customQuery("INSERT INTO media (usr_ID, music_ID, video_ID, image_ID) VALUES ('$userIDDB', 0, 0, $lastID)");
					
					$valArr = $db->prepareArray($lastID, $file_name, "", "../uploaded_photos/$file_name", 'acting', $newAlbum);
					$db->insert("images", "image_ID, image_title, image_descr, image_path, image_group, image_folder", $valArr);
					
				} else {
					echo "<p>One result is expected</p>";
				}
				
			} else {
				$filename=basename($file_name,$ext);
				
				$newFileName=$filename.time().".".$ext;
				move_uploaded_file($file_tmp = $_FILES["files"]["tmp_name"][$key],"../uploaded_photos/".$newFileName);
				
				
				$db->customQuery("INSERT INTO ai_images (ai_ID) VALUES ('')");
				
				$result = $db->customQuery("SELECT ai_ID FROM ai_images ORDER BY ai_ID DESC LIMIT 1");
				if ($result->num_rows == 1) {
					while($row = $result->fetch_assoc()) {
						//Place all folder names into new array
						$lastID = $row["ai_ID"];
						echo $row["ai_ID"];
					}
					
					$userIDDB = $db->escape($userID);
					$db->customQuery("INSERT INTO media (usr_ID, music_ID, video_ID, image_ID) VALUES ('$userIDDB', 0, 0, $lastID)");
					
					$valArr = $db->prepareArray($lastID, $newFileName, "", "../uploaded_photos/$newFileName", 'acting', $newAlbum);
					$db->insert("images", "image_ID, image_title, image_descr, image_path, image_group, image_folder", $valArr);
					
				} else {
					echo "<p>One result is expected</p>";
				}					

			}
		} else {
			array_push($error,"$file_name, ");
		}
	}
	
	$db->close();
	
	$_SESSION["uploaded"] = true;
	echo "";
	//header("Location: ../control_panel/cp_showreel.php");
} else {
	//this is required to avoid a blank page when user is loggin out (session is closed) and press a back button, so user is just transfered to the index page
	header("Location: ../index.php");
}
?>