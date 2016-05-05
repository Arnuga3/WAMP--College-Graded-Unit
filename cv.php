<?php
	include("page classes/CL_CV.php");
	
	include ("db/db_ORM.php");
	//Create DB connection and get data from db
	$db = new dbConnection();
	$db->connect();
	$cv_result = $db->select("cv", "*", "cv_ID = 1");
	$tr_result = $db->select("cv, experience, training", 
							"cv.cv_ID, experience.cv_ID, experience.training_ID, training.*", 
							"cv.cv_ID = 1 AND cv.cv_ID = experience.cv_ID AND experience.training_ID = training.training_ID");
	$flmtv_result = $db->select("cv, experience, films", 
							"cv.cv_ID, experience.cv_ID, experience.film_tv_ID, films.*", 
							"cv.cv_ID = 1 AND cv.cv_ID = experience.cv_ID AND experience.film_tv_ID = films.film_tv_ID ORDER BY films.film_year DESC");
	$th_result = $db->select("cv, experience, theatre", 
							"cv.cv_ID, experience.cv_ID, experience.theatre_ID, theatre.*", 
							"cv.cv_ID = 1 AND cv.cv_ID = experience.cv_ID AND experience.theatre_ID = theatre.theatre_ID ORDER BY theatre.theatre_year DESC");
	$db->close();
	
	$cvPage = new CV($cv_result, $tr_result, $flmtv_result, $th_result);
	$cvPage -> title = "Jamie Rodden";
	$cvPage -> description = "Jamie Rodden";
	$cvPage -> keywords = "Jamie, Rodden, actor, musician, singer, web portfolio";
	$cvPage -> displayPage();

?>