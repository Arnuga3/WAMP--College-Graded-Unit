<?php
	class Page {
		
		public $title = "Web Portfolio";
		public $description = "default";
		public $keywords = "default";
		
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
		
		
//Functions included in main function

		public function displayPageInfo() {
			echo "<title>".$this->title."</title>
			<meta charset=\"UTF-8\">
			<meta name=\"description\" content=\"".$this->description."\">
			<meta name=\"keywords\" content=\"".$this->keywords."\">
			<meta name=\"author\" content=\"Arnis%20Zelcs\">\n";
		}
		
		public function connectCSS() {
?>
			<!--GOOGLE Fonts-->
			
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
			
			<!--JQ-UI-->
			<link type ="text/css" rel="stylesheet" href="Frameworks/jquery-ui-1.11.4/jquery-ui.theme.min.css">
<?php
		}
		
		public function displayNavbar() {
?>
			<div class="navbar-fixed">
				<nav>
					<ul id="dropdown1" class="dropdown-content">
						<li><a href="acting_shots.php">ACTING SHOTS</a></li>
						<li><a href="gig_shots.php">GIG SHOTS</a></li>
					</ul>
					<div class="nav-wrapper">
						<a href="index.php" class="brand-logo left"><span class="bold">Jamie Rodden</span></a>
						<ul class="right hide-on-med-and-down">
							<li><a class="menu_link waves-effect waves-light" href="showreel.php">SHOWREEL</a></li>
							<li><a class="menu_link waves-effect waves-light" href="cv.php">CV</a></li>
							<li><a class="dropdown-button" href="#!" data-activates="dropdown1">MEDIA<i class="material-icons right">arrow_drop_down</i></a></li>
							<li><a class="menu_link waves-effect waves-light" href="songs.php">SONGS</a></li>
						</ul>
						<ul id="slide-out" class="side-nav">
							<li><a class="menu_link waves-effect waves-light" href="showreel.php"><i class="fa fa-youtube-play"></i>SHOWREEL</a></li>
							<li><a class="menu_link waves-effect waves-light" href="cv.php"><i class="fa fa-file-text"></i>CV</a></li>
							<li><span><i class="fa fa-video-camera"></i>MEDIA :</i></span></li>
							<li><a class="menu_link waves-effect waves-light" href="acting_shots.php"><i class="fa fa-arrow-right"></i>ACTING SHOTS</a></li>
							<li><a class="menu_link waves-effect waves-light" href="gig_shots.php"><i class="fa fa-arrow-right"></i>GIG SHOTS</a></li>
							<li><a class="menu_link waves-effect waves-light" href="songs.php"><i class="fa fa-music"></i>SONGS</a></li>
						</ul>
						<a href="#" data-activates="slide-out" class="button-collapse right paddingSide"><i class="mdi-navigation-menu"></i></a>
					</div>
				</nav>
			</div>
<?php
		}
		
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