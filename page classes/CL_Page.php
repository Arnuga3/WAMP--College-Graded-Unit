<?php
/*
Author: Arnis Zelcs
Created: 12/03/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Main class
*/

	//create a class
	class Page {
		
		//properties
		public $title = "Web Portfolio";
		public $description = "default";
		public $keywords = "default";
		
		//main method
		public function displayPage() {
			echo "<!DOCTYPE HTML>";
			echo "<html>\n";
			echo "<head>\n";
			$this->displayPageInfo();
			$this->connectCSS();
			echo "</head>\n";
			echo "<body>\n";
			$this->displayNavbar();
			$this->connectJS();
			echo "</body>\n";
			echo "</html>";
		}
		
		//add meta data 
		public function displayPageInfo() {
			echo "<title>".$this->title."</title>
			<meta charset=\"UTF-8\">
			<meta name=\"description\" content=\"".$this->description."\">
			<meta name=\"keywords\" content=\"".$this->keywords."\">
			<meta name=\"author\" content=\"Arnis%20Zelcs\">\n";
		}
		
		//add external files and resources
		public function connectCSS() {
?>
			<!--GOOGLE Fonts-->
			<link href='https://fonts.googleapis.com/css?family=Great+Vibes' rel='stylesheet' type='text/css'>
			<link href='https://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>
			<link href='https://fonts.googleapis.com/css?family=Montez' rel='stylesheet' type='text/css'>
			
			<!--Import materialize.css-->
			<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
			<link type="text/css" rel="stylesheet" href="frameworks/materialize-v0.97.5/materialize/css/materialize.min.css"  media="screen,projection"/>
			
			<!--Was here as Materialize suggestion-->
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
			
			<!--Font Awesome Icons, Styles-->
			<link type="text/css" rel="stylesheet" href="frameworks/font-awesome-4.4.0/css/font-awesome.min.css" />
			
			<!--JQ-UI-->
			<link type ="text/css" rel="stylesheet" href="frameworks/jquery-ui-1.11.4/jquery-ui.theme.min.css">
			
			<!--Css-->
			<link type="text/css" rel="stylesheet" href="css/styles.css" />
			
<?php
		}
		//add navbar
		public function displayNavbar() {
?>
			<div class="navbar-fixed">
				<nav>
				
					<!--Dropdown Structure-->
					<ul id="dropdown1" class="dropdown-content">
						<li><a href="acting.php">ACTING SHOTS</a></li>
						<li><a href="gig.php">GIG SHOTS</a></li>
					</ul><!-- End of Dropdown -->
						
					<div class="nav-wrapper">
						<a href="index.php" class="brand-logo left"><span id="logo" class="bold">Jamie Rodden</span></a>
						<ul class="right hide-on-med-and-down">
							<li><a class="menu_link waves-effect waves-light" href="showreel.php">SHOWREEL</a></li>
							<li><a class="menu_link waves-effect waves-light" href="cv.php">CV</a></li>
							<li><a class="dropdown-button" href="#!" data-activates="dropdown1">MEDIA<i class="material-icons right">arrow_drop_down</i></a></li>
							<li><a class="menu_link waves-effect waves-light" href="songs.php">SONGS</a></li>
							<li><a class="menu_link modal-trigger" href="#modal1"><i class="fa fa-lock"></i></a></li>
						</ul>
						
						<!--Mobile sliding menu-->
						<ul id="slide-out" class="side-nav">
							<li><a class="menu_link waves-effect waves-light" href="showreel.php"><i class="fa fa-youtube-play"></i>SHOWREEL</a></li>
							<li><a class="menu_link waves-effect waves-light" href="cv.php"><i class="fa fa-file-text"></i>CV</a></li>
							<hr />
							<li><a class="menu_link waves-effect waves-light" href="acting.php"><i class="fa fa-video-camera"></i>ACTING SHOTS</a></li>
							<li><a class="menu_link waves-effect waves-light" href="gig.php"><i class="fa fa-video-camera"></i>GIG SHOTS</a></li>
							<hr />
							<li><a class="menu_link waves-effect waves-light" href="songs.php"><i class="fa fa-music"></i>SONGS</a></li>
							<li><a class="menu_link waves-effect waves-light  modal-trigger" href="#modal1"><i class="fa fa-lock"></i></a></li>
						</ul>
						<a href="#" data-activates="slide-out" class="button-collapse right"><i class="mdi-navigation-menu"></i></a>
					</div>
				</nav>
			</div>
	
			<!-- Modal Structure -->
			<div id="modal1" class="modal">
				<!-- Form for submission of admin name and password -->
				<form action="php_tasks/admin_login.php" method="post">
					<div class="modal-content">
						<div class="form col s12">
							<p>Admin Panel:</p>
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="Name" id="adminName" name="adminName" type="text" value="#onlyAdmin">
								</div>
							</div>
							<div class="row">
								<div class="input-field col s12">
									<input placeholder="Password" id="adminPass" name="adminPassword" type="password" value="cpAdmin01&JR">
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" class="modal-action modal-close waves-effect waves-dark btn grey darken-4">Login</button>
					</div>
				</form><!-- End of Form -->
			</div><!-- End of Modal -->
<?php
		}
		//add scripts and libraries
		public function connectJS() {
			echo "
			<!--Materialize requires jQuery, so first to include jQuery, than Materialize js file-->
			<script type=\"text/javascript\" src=\"frameworks/jquery-2.1.4.min.js\"></script>
			<script type=\"text/javascript\" src=\"frameworks/materialize-v0.97.5/materialize/js/materialize.min.js\"></script>
			<script src=\"frameworks/jquery-ui-1.11.4/jquery-ui.min.js\"></script>
			<!--Scripts-->
			<script src=\"scripts/zScript.js\"></script>
			";
		}
	}