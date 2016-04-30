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
	$result = $db->select("user, cv", "user.usr_ID, user.cv_ID, cv.*", "user.usr_ID = $userID AND user.usr_ID = cv.cv_ID");
	$db->close();
	
	//Only one record is expected, just another check for error
	if ($result->num_rows == 1) {
		while($row = $result->fetch_assoc()) {
			$data = $row;
		}
			
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
				
				<form class=\"margTop\" action=\"\" method=\"\">
					<div class=\"row\">
					
						<div class=\"input-field col s12 m6\">
							<input placeholder=\"Full name\" id=\"full_name\" name=\"name\" type=\"text\" class=\"validate\" 
								value=\"".str_replace('"',"&quot;", $data["cv_name"])."\" />
							<label for=\"full_name\">Full name</label>
						</div>
						
						<div class=\"input-field col s12 m6\">
							<input placeholder=\"Equity\" id=\"Equity\" name=\"equity\" type=\"text\" class=\"validate\" 
								value=\"".str_replace('"',"&quot;", $data["cv_equity"])."\" />
							<label for=\"Equity\">Equity</label>
						</div>
						
						<div class=\"input-field col s12 m6\">
							<input placeholder=\"Email\" id=\"email\" name=\"email\" type=\"text\" class=\"validate\" 
							value=\"".str_replace('"',"&quot;", $data["cv_email"])."\" />
							<label for=\"email\">Email</label>
						</div>
						
						<div class=\"input-field col s12\">
							<textarea id=\"accents\" type=\"text\" name=\"accents\" class=\"materialize-textarea textareaMATR\">".str_replace('"',"&quot;", $data["cv_accents"])."</textarea>
							<label id=\"matr_descrLb\" for=\"accents\">Accents</label>
						</div>
						
						<div class=\"input-field col s12\">
							<textarea id=\"skills\" type=\"text\" name=\"skills\" class=\"materialize-textarea textareaMATR\">".str_replace('"',"&quot;", $data["cv_skills"])."</textarea>
							<label id=\"matr_descrLb\" for=\"skills\">Skills</label>
						</div>
						
					</div>
				</form>
				
			</div>";
		
	} else {
		echo "Error: one record is expected";
	}
} else {
	//this is required to avoid a blank page when user is loggin out (session is closed) and press a back button, so user is just transfered to the index page
	header("Location: ../index.php");
}
?>