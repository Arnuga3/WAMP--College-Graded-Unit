<?php
	session_start();
?>
<?php
if (isset($_SESSION["mrBoss"])) {
	$userID = $_SESSION["mrBoss"]["usr_ID"];
	
	include ("../db/db_ORM.php");
	//Create DB connection and get data from db
	$db = new dbConnection();
	$db->connect();
	//Get a showreel video information
	$result_cv = $db->select("user, cv", "user.usr_ID, user.cv_ID, cv.*", "user.usr_ID = $userID AND user.usr_ID = cv.cv_ID");
	$result_tr = $db->select("user, cv, experience, training", 
							"user.usr_ID, user.cv_ID, cv.cv_ID, experience.cv_ID, experience.training_ID, training.*", 
							"user.usr_ID = $userID AND user.usr_ID = cv.cv_ID AND cv.cv_ID = experience.cv_ID AND experience.training_ID = training.training_ID");
	
	$db->close();
	
	//Only one record is expected, just another check for error
	if ($result_cv->num_rows == 1) {
		while($row = $result_cv->fetch_assoc()) {
			$data_cv = $row;
		}
		
	} else {
		echo "Error: one record is expected";
	}
	
	
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
						<div class=\"row\">
						
							<h4 class=\"margBotExtra bold\">Curriculum Vitae:</h4>
							<p class=\"photoNr margTopX\">Block 1</p>
						
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
						
							<h4>Contacts:</h4>
							
							<div class=\"input-field col s12 m6\">
								<input placeholder=\"Email\" id=\"email\" name=\"email\" type=\"text\" class=\"validate\" 
								value=\"".str_replace('"',"&quot;", $data_cv["cv_email"])."\" />
								<label for=\"email\">Email</label>
							</div>
							
						</div>
						
						<div class=\"row\">
						
							<h4>Personal Details:</h4>
							
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
							
							<div class=\"pad5\">
								<a class=\"saveBlock1 waves-effect waves-light btn green darken-2\">save</a>
							</div>
							
						</div>
						
					</form>
					
					<form class=\"margTop\" action=\"\" method=\"\">
						
						<div class=\"row\">
						
							<p class=\"photoNr margTopX\">Block 2</p>
							<h4>Training:</h4>
								<div id=\"trainingRecords\">";
							
								if ($result_tr->num_rows > 0) {
									while($row = $result_tr->fetch_assoc()) {
										$data_tr = $row;
										
										echo "
										<div class=\"input-field col s12\">
											<input placeholder=\"Training\" id=\"".str_replace('"',"&quot;", $data_tr["training_ID"])."\" type=\"text\" class=\"validate\" 
												value=\"".str_replace('"',"&quot;", $data_tr["training"])."\" />
											<label for=\"training\">training</label>
										</div>
										
										<div class=\"margBot pad15\">
											<a class=\"saveTraining waves-effect waves-light btn green darken-2\">save</a>
											<a class=\"deleteTraining waves-effect waves-light btn red darken\">delete</a>
										</div>";
									}
								echo "</div>";
									
								} else {
								echo "Error: no records";
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
						
							<p class=\"photoNr margTopX\">Block 3</p>
							<h4>Other:</h4>
							
							<div class=\"input-field col s12\">
								<textarea id=\"accents\" type=\"text\" name=\"accents\" class=\"materialize-textarea textareaMATR\">".str_replace('"',"&quot;", $data_cv["cv_accents"])."</textarea>
								<label id=\"matr_descrLb\" for=\"accents\">Accents</label>
							</div>
							
							<div class=\"input-field col s12\">
								<textarea id=\"skills\" type=\"text\" name=\"skills\" class=\"materialize-textarea textareaMATR\">".str_replace('"',"&quot;", $data_cv["cv_skills"])."</textarea>
								<label id=\"matr_descrLb\" for=\"skills\">Skills</label>
							</div>
							
							<div class=\"\">
								<a class=\"saveBlock3 waves-effect waves-light btn green darken-2\">save</a>
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