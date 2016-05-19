<?php
/*
Author: Arnis Zelcs
Created: 24/04/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: This script uploades photo(s) on a server and creates records in database about that photo(s) for gig
*/

session_start();
?>
<?php

//if session is on
if (isset($_SESSION["mrBoss"])) {
	$userID = $_SESSION["mrBoss"]["usr_ID"];
	
	//include a database Object-relational mapping class
	include ("../db/db_ORM.php");
	
	//to make work htmlspecialchars() function
	header('Content-Type: text/plain');
	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	//get data
	extract($_POST);
	
	if (isset($_POST["album_name"])) {
		$newAlbum = test_input($_POST["album_name"]);
	} else {
		$newAlbum = "";
	}
	
	//allowed file extensions
    $extension = array("jpeg", "JPEG", "jpg", "JPG", "png", "PNG", "gif", "GIF");
	
	$db = new dbConnection();
	$db->connect();
	
	//get information about each file
    foreach ($_FILES as $index => $file) {
		$file_name = $file["name"];
		$file_tmp = $file["tmp_name"];
		$ext = pathinfo($file_name, PATHINFO_EXTENSION);
		$size = $file["size"];
		
		if (in_array($ext, $extension)) {
			
			// Create image from file
			switch (strtolower($file['type'])) {
				case 'image/jpeg':
					$image = imagecreatefromjpeg($file['tmp_name']);
					break;
				case 'image/png':
					$image = imagecreatefrompng($file['tmp_name']);
					break;
				case 'image/gif':
					$image = imagecreatefromgif($file['tmp_name']);
					break;
				default:
					exit('Unsupported type: '.$file['type']);
			}
			
			//max sizes for a new photo
			$max_width = 800;
			$max_height = 600;
			$max_file_size = 400000;

			//get current dimensions
			$old_width  = imagesx($image);
			$old_height = imagesy($image);

			//calculate a scaling is needed to fit the image inside a frame
			$scale = min($max_width/$old_width, $max_height/$old_height);

			//get a new dimensions
			$new_width  = ceil($scale*$old_width);
			$new_height = ceil($scale*$old_height);
			
			//create a new empty image
			$new = imagecreatetruecolor($new_width, $new_height);

			imagecolortransparent($new, $black);
			
			//resize old image into new
			imagecopyresampled($new, $image, 0, 0, 0, 0, $new_width, $new_height, $old_width, $old_height);
			
			
			//if a file with the same name is not already existing
			if (!file_exists("../uploaded_photos/".$file_name)) {
				
				//if file size is smaller than the limit, upload original
				if ($size < $max_file_size) {
					move_uploaded_file($file_tmp, "../uploaded_photos/".$file_name);
				
				} else {		
					//upload resized		
					imagepng($new, "../uploaded_photos/".$file_name);
				}
				
				$filenameNoExt = basename($file_name, ".".$ext);
				
				//create a new id for the file (id is used in other tables)
				$db->customQuery("INSERT INTO ai_images (ai_ID) VALUES ('')");
				
				//get that id
				$result = $db->customQuery("SELECT ai_ID FROM ai_images ORDER BY ai_ID DESC LIMIT 1");
				if ($result->num_rows == 1) {
					while($row = $result->fetch_assoc()) {
						//Place all folder names into new array
						$lastID = $row["ai_ID"];
					}
					
					//Create a database record about this file
					$userIDDB = $db->escape($userID);
					$db->customQuery("INSERT INTO media (usr_ID, music_ID, video_ID, image_ID) VALUES ('$userIDDB', 0, 0, $lastID)");
					
					$valArr = $db->prepareArray($lastID, $filenameNoExt, " ", "../uploaded_photos/$file_name", 'gig', $newAlbum);
					$db->insert("images", "image_ID, image_title, image_descr, image_path, image_group, image_folder", $valArr);
					
				} else {
					echo "<p>One result is expected</p>";
				}
			
			//if a file with the same name is already existing
			} else {
				
				$filename = basename($file_name, $ext);
				
				//create a new name for the file (using time function, so it is always unique)
				$newFileName = $filename.time().".".$ext;
				
				//if file size is smaller than the limit, upload original
				if ($size < $max_file_size) {
					move_uploaded_file($file_tmp, "../uploaded_photos/".$newFileName);
				
				} else {		
					//upload resized image			
					imagepng($new, "../uploaded_photos/".$newFileName);
				}
				
				//same logic here as in a first block of if statement
				$filenameNoExt = basename($file_name, ".".$ext);
				
				$db->customQuery("INSERT INTO ai_images (ai_ID) VALUES ('')");
				
				$result = $db->customQuery("SELECT ai_ID FROM ai_images ORDER BY ai_ID DESC LIMIT 1");
				if ($result->num_rows == 1) {
					while($row = $result->fetch_assoc()) {
						//Place all folder names into new array
						$lastID = $row["ai_ID"];
					}
					
					$userIDDB = $db->escape($userID);
					$db->customQuery("INSERT INTO media (usr_ID, music_ID, video_ID, image_ID) VALUES ('$userIDDB', 0, 0, $lastID)");
					
					$valArr = $db->prepareArray($lastID, $filenameNoExt, " ", "../uploaded_photos/$newFileName", 'gig', $newAlbum);
					$db->insert("images", "image_ID, image_title, image_descr, image_path, image_group, image_folder", $valArr);
					
				} else {
					echo "<p>One result is expected</p>";
				}					

			}
			
		}
		//destroy a temporary image		
		imagedestroy($new);
	}
	
	$db->close();
	//header("Location: ../control_panel/cp_showreel.php");
} else {
	//this is required to avoid a blank page when user is loggin out (session is closed) and press a back button, so user is just transfered to the index page
	header("Location: ../index.php");
}
?>