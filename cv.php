<?php
	include("page classes/CL_CV.php");
	
	include ("db/db_ORM.php");
	//Create DB connection and get data from db
	$db = new dbConnection();
	$db->connect();
	$cv_result = $db->select("cv");
	$db->close();
	
	if ($cv_result->num_rows == 1) {
		while($row = $cv_result->fetch_assoc()) {
			$cv_data = $row;
		}	
		
		$cvPage = new CV($cv_data);
		$cvPage -> title = "Jamie Rodden";
		$cvPage -> description = "Jamie Rodden";
		$cvPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
		$cvPage->displayPage();
		
	} else {
		echo "Error: one record is expected";
	}
	

?>