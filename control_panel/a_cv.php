<?php
/*
Author: Arnis Zelcs
Created: 30/04/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: CV part - generate an HTML and send back as response
*/

//start session
session_start();
?>
<?php
//if session is on
if (isset($_SESSION["mrBoss"])) {
	$userID = $_SESSION["mrBoss"]["usr_ID"];
	
	include ("../db/db_ORM.php");
	//Create DB connection and get data from db
	$db = new dbConnection();
	$db->connect();
	//Get a main CV information (block1 + block3)
	$result_cv = $db->select("user, cv", "user.usr_ID, user.cv_ID, cv.*", "user.usr_ID = $userID AND user.usr_ID = cv.cv_ID");
	//Get training information (block2)
	$result_tr = $db->select("user, cv, experience, training", 
							"user.usr_ID, user.cv_ID, cv.cv_ID, experience.cv_ID, experience.training_ID, training.*", 
							"user.usr_ID = $userID AND user.usr_ID = cv.cv_ID AND cv.cv_ID = experience.cv_ID AND experience.training_ID = training.training_ID");
	//Get film/tv information (block4)
	$result_flmtv = $db->select("user, cv, experience, films", 
							"user.usr_ID, user.cv_ID, cv.cv_ID, experience.cv_ID, experience.film_tv_ID, films.*", 
							"user.usr_ID = $userID AND user.usr_ID = cv.cv_ID AND cv.cv_ID = experience.cv_ID AND experience.film_tv_ID = films.film_tv_ID ORDER BY films.film_year DESC");
	//Get theatre information (block5)
	$result_thre = $db->select("user, cv, experience, theatre", 
							"user.usr_ID, user.cv_ID, cv.cv_ID, experience.cv_ID, experience.theatre_ID, theatre.*", 
							"user.usr_ID = $userID AND user.usr_ID = cv.cv_ID AND cv.cv_ID = experience.cv_ID AND experience.theatre_ID = theatre.theatre_ID ORDER BY theatre.theatre_year DESC");
	
	$db->close();
	
	//Only one record is expected, just another check for error
	if ($result_cv->num_rows == 1) {
		while($row = $result_cv->fetch_assoc()) {
			$data_cv = $row;
		}
		
	} else {
		echo "Error: one record is expected";
	}
	
	//response
	if (isset($data_cv)) {
		echo "<!--CV GROUP-->
			<!--SUBNAV-->
			
			<nav class=\"bread_path\">
				<div class=\"bread nav-wrapper\">
					<div class=\"col s12\">
						<a href=\"#!\" class=\"breadcrumb\">CV</a>
						<a href=\"#!\" class=\"breadcrumb\"></a>
					</div>
				</div>
			</nav>
			
			<div class=\"sub_nav hide-on-med-and-down\">
				<a class=\"waves-effect waves-dark blue-grey disabled\"></a>
			</div>
			
			<div class=\"cp_content margBotXL\">
					
				<p class=\"helperText infoMargin\"><img class=\"sm_info\" src=\"../img/cpIcons/information.png\" />CV is splitted into few groups what need to be saved individually.</p>
				
				<div class=\"pad5\">
				
					<form id=\"formblock1\" class=\"margTop\" action=\"\" method=\"\">
						
						<h4 class=\"margBotExtra bold center\">Curriculum Vitae:</h4>
						
						<div class=\"flexToRows margTopX margBot\">
							<div class=\"photoNr\">1</div>
							<span class=\"photoTt\">Personal Details:</span>
						</div>
							
						<div class=\"row\">
						
							<div class=\"input-field col s12 m6\">
								<input placeholder=\"Full name\" id=\"full_name\" name=\"name\" type=\"text\" class=\"validate\" 
									value=\"".str_replace('"',"&quot;", $data_cv["cv_name"])."\" />
								<label for=\"full_name\">Full name</label>
							</div>
							
							<div class=\"input-field col s12 m6\">
								<input placeholder=\"Equity\" id=\"Equity\" name=\"equity\" type=\"text\" class=\"validate\" 
									value=\"".str_replace('"',"&quot;", $data_cv["cv_equity"])."\" />
								<label for=\"Equity\">Equity</label>
							</div>
							
						</div>
						
						<div class=\"row\">
							
							<div class=\"input-field col s6 m4 l3\">
								<input placeholder=\"Height\" id=\"height\" name=\"height\" type=\"text\" class=\"validate\" 
									value=\"".str_replace('"',"&quot;", $data_cv["cv_height"])."\" />
								<label for=\"height\">Height</label>
							</div>
							
							<div class=\"input-field col s6 m4 l3\">
								<input placeholder=\"Chest\" id=\"chest\" name=\"chest\" type=\"text\" class=\"validate\" 
									value=\"".str_replace('"',"&quot;", $data_cv["cv_chest"])."\" />
								<label for=\"chest\">Chest</label>
							</div>
							
							<div class=\"input-field col s6 m4 l3\">
								<input placeholder=\"Waist\" id=\"waist\" name=\"waist\" type=\"text\" class=\"validate\" 
									value=\"".str_replace('"',"&quot;", $data_cv["cv_waist"])."\" />
								<label for=\"waist\">Waist</label>
							</div>
							
							<div class=\"input-field col s6 m4 l3\">
								<input placeholder=\"Inside leg\" id=\"inside_leg\" name=\"inside_leg\" type=\"text\" class=\"validate\" 
									value=\"".str_replace('"',"&quot;", $data_cv["cv_inside_leg"])."\" />
								<label for=\"inside_leg\">Inside leg</label>
							</div>
							
							<div class=\"input-field col s6 m4 l3\">
								<input placeholder=\"Eyes\" id=\"eyes\" name=\"eyes\" type=\"text\" class=\"validate\" 
									value=\"".str_replace('"',"&quot;", $data_cv["cv_eyes"])."\" />
								<label for=\"eyes\">Eyes</label>
							</div>
							
							<div class=\"input-field col s6 m4 l3\">
								<input placeholder=\"Hair\" id=\"hair\" name=\"hair\" type=\"text\" class=\"validate\" 
									value=\"".str_replace('"',"&quot;", $data_cv["cv_hair"])."\" />
								<label for=\"hair\">Hair</label>
							</div>
							
							<div class=\"input-field col s6 m4 l3\">
								<input placeholder=\"Build\" id=\"build\" name=\"build\" type=\"text\" class=\"validate\" 
									value=\"".str_replace('"',"&quot;", $data_cv["cv_build"])."\" />
								<label for=\"build\">Build</label>
							</div>
							
							<div class=\"input-field col s6 m4 l3\">
								<input placeholder=\"Playing Age\" id=\"playing_age\" name=\"playing_age\" type=\"text\" class=\"validate\" 
									value=\"".str_replace('"',"&quot;", $data_cv["cv_playing_age"])."\" />
								<label for=\"playing_age\">Playing Age</label>
							</div>
							
						</div>
						
						<div class=\"row\">
						
							<h4>Contacts:</h4>
							
							<div class=\"input-field col s12 m6\">
								<input placeholder=\"Email\" id=\"email\" name=\"email\" type=\"text\" class=\"validate\" 
								value=\"".str_replace('"',"&quot;", $data_cv["cv_email"])."\" />
								<label for=\"email\">Email</label>
							</div>
							
							<div class=\"pad5 col s12\">
								<a class=\"saveBlock1 waves-effect waves-light btn green darken-2\">save</a>
							</div>
							
						</div>
						
					</form>
					
					<form class=\"margTop\" action=\"\" method=\"\">
						
						<div class=\"row\">
						
							<div class=\"flexToRows margTopX margBot\">
								<div class=\"photoNr\">2</div>
								<span class=\"photoTt\">Training:</span>
							</div>
								<div id=\"trainingRecords\">";
							
								if ($result_tr->num_rows > 0) {
									while($row = $result_tr->fetch_assoc()) {
										$data_tr = $row;
										
										echo "
										<div class=\"z-depth-1\">
											<div class=\"input-field col s12\">
												<input placeholder=\"Training\" id=\"".str_replace('"',"&quot;", $data_tr["training_ID"])."\" type=\"text\" class=\"validate\" 
													value=\"".str_replace('"',"&quot;", $data_tr["training"])."\" />
												<label>training</label>
											</div>
											
											<div class=\"margBot pad15\">
												<a class=\"saveTraining waves-effect waves-light btn green darken-2\">save</a>
												<a class=\"deleteTraining waves-effect waves-light btn red darken\">delete</a>
											</div>
										</div>";
									}
								echo "</div>";
									
								} else {
								echo "No records";
							}
							
						echo "<div class=\"addTrainingField z-depth-2 pad5\">
								<div class=\"input-field col s12\">
									<input placeholder=\"Training\" name=\"newTraining\" type=\"text\" class=\"validate\" />
									<label for=\"training\">training</label>
								</div>
								<a class=\"newTrainingBtn waves-effect waves-light btn light-blue darken-4\">add new training</a>
							</div>
							
						</div>
						
					</form>
					
					<form id=\"formblock3\" class=\"margTop\" action=\"\" method=\"\">
						
						<div class=\"row\">
						
							<div class=\"flexToRows margTopX margBot\">
								<div class=\"photoNr\">3</div>
								<span class=\"photoTt\">Other:</span>
							</div>
							
							<div class=\"input-field col s12\">
								<textarea id=\"accents\" type=\"text\" name=\"accents\" class=\"materialize-textarea textareaMATR\">".str_replace('"',"&quot;", $data_cv["cv_accents"])."</textarea>
								<label id=\"matr_descrLb\" for=\"accents\">Accents</label>
							</div>
							
							<div class=\"input-field col s12\">
								<textarea id=\"skills\" type=\"text\" name=\"skills\" class=\"materialize-textarea textareaMATR\">".str_replace('"',"&quot;", $data_cv["cv_skills"])."</textarea>
								<label id=\"matr_descrLb\" for=\"skills\">Skills</label>
							</div>
							
							<div class=\"col s12\">
								<a class=\"saveBlock3 waves-effect waves-light btn green darken-2\">save</a>
							</div>
							
						</div>
						
					</form>
					
					<form class=\"margTop\" action=\"\" method=\"\">
						
						<div class=\"row\">
						
							<div class=\"flexToRows margTopX margBot\">
								<div class=\"photoNr\">4</div>
								<span class=\"photoTt\">Film and Television Experience:</span>
							</div>
							
								<div id=\"filmRecords\">";
							
								if ($result_flmtv->num_rows > 0) {
									while($row = $result_flmtv->fetch_assoc()) {
										$data_flmtv = $row;
										
										echo "
										<div class=\"row z-depth-1\" id=\"".str_replace('"',"&quot;", $data_flmtv["film_tv_ID"])."\">
										
											<div class=\"input-field col s12 m6 l4\">
												<input placeholder=\"Year\" name=\"year\" type=\"text\" class=\"validate\" 
													value=\"".str_replace('"',"&quot;", $data_flmtv["film_year"])."\" />
												<label>Year</label>
											</div>
											
											<div class=\"input-field col s12 m6 l4\">
												<input placeholder=\"Role\" name=\"role\" type=\"text\" class=\"validate\" 
													value=\"".str_replace('"',"&quot;", $data_flmtv["film_role"])."\" />
												<label>Role</label>
											</div>
											
											<div class=\"input-field col s12 m6 l4\">
												<input placeholder=\"Production\" name=\"production\" type=\"text\" class=\"validate\" 
													value=\"".str_replace('"',"&quot;", $data_flmtv["film_production"])."\" />
												<label>Production</label>
											</div>
											
											<div class=\"input-field col s12 m6 l4\">
												<input placeholder=\"Director\" name=\"director\" type=\"text\" class=\"validate\" 
													value=\"".str_replace('"',"&quot;", $data_flmtv["film_director"])."\" />
												<label>Director</label>
											</div>
											
											<div class=\"input-field col s12 m6 l4\">
												<input placeholder=\"Company\" name=\"company\" type=\"text\" class=\"validate\" 
													value=\"".str_replace('"',"&quot;", $data_flmtv["film_company"])."\" />
												<label>Company</label>
											</div>
											
											<div class=\"col s12 margBot pad15\">
												<a class=\"saveFilm waves-effect waves-light btn green darken-2\">save</a>
												<a class=\"deleteFilm waves-effect waves-light btn red darken\">delete</a>
											</div>
										</div>";
									}
									echo "</div>";
									
								} else {
									
								echo "No records";
							}
							
						echo "
							<div class=\"addFilmField z-depth-2 pad5 row\" id=\"\">
							
								<div class=\"input-field col s12\">
									<input placeholder=\"Year\" name=\"year\" type=\"text\" class=\"validate\" 
										value=\"\" />
									<label>Year</label>
								</div>
								
								<div class=\"input-field col s12\">
									<input placeholder=\"Role\" name=\"role\" type=\"text\" class=\"validate\" 
										value=\"\" />
									<label>Role</label>
								</div>
								
								<div class=\"input-field col s12\">
									<input placeholder=\"Production\" name=\"production\" type=\"text\" class=\"validate\" 
										value=\"\" />
									<label>Production</label>
								</div>
								
								<div class=\"input-field col s12\">
									<input placeholder=\"Director\" name=\"director\" type=\"text\" class=\"validate\" 
										value=\"\" />
									<label>Director</label>
								</div>
								
								<div class=\"input-field col s12\">
									<input placeholder=\"Company\" name=\"company\" type=\"text\" class=\"validate\" 
										value=\"\" />
									<label>Company</label>
								</div>
								
								<a class=\"newFilmgBtn waves-effect waves-light btn light-blue darken-4\">add new film/tv exp</a>
								
							</div>
					
						</div>
						
					</form>
					
					<form class=\"margTop\" action=\"\" method=\"\">
						
						<div class=\"row\">
						
							<div class=\"flexToRows margTopX margBot\">
								<div class=\"photoNr\">5</div>
								<span class=\"photoTt\">Theatre Experience:</span>
							</div>
							
								<div id=\"theatreRecords\">";
							
								if ($result_thre->num_rows > 0) {
									while($row = $result_thre->fetch_assoc()) {
										$data_thre = $row;
										
										echo "
										<div class=\"row z-depth-1\" id=\"".str_replace('"',"&quot;", $data_thre["theatre_ID"])."\">
										
											<div class=\"input-field col s12 m6 l4\">
												<input placeholder=\"Year\" name=\"year\" type=\"text\" class=\"validate\" 
													value=\"".str_replace('"',"&quot;", $data_thre["theatre_year"])."\" />
												<label>Year</label>
											</div>
											
											<div class=\"input-field col s12 m6 l4\">
												<input placeholder=\"Role\" name=\"role\" type=\"text\" class=\"validate\" 
													value=\"".str_replace('"',"&quot;", $data_thre["theatre_role"])."\" />
												<label>Role</label>
											</div>
											
											<div class=\"input-field col s12 m6 l4\">
												<input placeholder=\"Production\" name=\"production\" type=\"text\" class=\"validate\" 
													value=\"".str_replace('"',"&quot;", $data_thre["theatre_production"])."\" />
												<label>Production</label>
											</div>
											
											<div class=\"input-field col s12 m6 l4\">
												<input placeholder=\"Director\" name=\"director\" type=\"text\" class=\"validate\" 
													value=\"".str_replace('"',"&quot;", $data_thre["theatre_director"])."\" />
												<label>Director</label>
											</div>
											
											<div class=\"input-field col s12 m6 l4\">
												<input placeholder=\"Company\" name=\"company\" type=\"text\" class=\"validate\" 
													value=\"".str_replace('"',"&quot;", $data_thre["theatre_company"])."\" />
												<label>Company</label>
											</div>
											
											<div class=\"col s12 margBot pad15\">
												<a class=\"saveTheatre waves-effect waves-light btn green darken-2\">save</a>
												<a class=\"deleteTheatre waves-effect waves-light btn red darken\">delete</a>
											</div>
										</div>";
									}
									echo "</div>";
									
								} else {
									
								echo "No records";
							}
							
						echo "
							<div class=\"addTheatreField z-depth-2 pad5 row\" id=\"\">
							
								<div class=\"input-field col s12\">
									<input placeholder=\"Year\" name=\"year\" type=\"text\" class=\"validate\" 
										value=\"\" />
									<label>Year</label>
								</div>
								
								<div class=\"input-field col s12\">
									<input placeholder=\"Role\" name=\"role\" type=\"text\" class=\"validate\" 
										value=\"\" />
									<label>Role</label>
								</div>
								
								<div class=\"input-field col s12\">
									<input placeholder=\"Production\" name=\"production\" type=\"text\" class=\"validate\" 
										value=\"\" />
									<label>Production</label>
								</div>
								
								<div class=\"input-field col s12\">
									<input placeholder=\"Director\" name=\"director\" type=\"text\" class=\"validate\" 
										value=\"\" />
									<label>Director</label>
								</div>
								
								<div class=\"input-field col s12\">
									<input placeholder=\"Company\" name=\"company\" type=\"text\" class=\"validate\" 
										value=\"\" />
									<label>Company</label>
								</div>
								
								<a class=\"newTheatregBtn waves-effect waves-light btn light-blue darken-4\">add new theatre exp</a>
								
							</div>
					
						</div>
						
					</form>
					
				</div>
				
			</div>";
	}
		
} else {
	//this is required to avoid a blank page when user is loggin out (session is closed) and press a back button, so user is just transfered to the index page
	header("Location: ../index.php");
}
?>