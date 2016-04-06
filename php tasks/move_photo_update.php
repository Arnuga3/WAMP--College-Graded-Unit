<?php
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$folder = test_input($_POST["folder"]);
	$photos = test_input($_POST["photos"]);
	
	echo $folder;
	echo $photos;
?>