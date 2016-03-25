<?php
	include("CL_Page.php");
	
	class ControlPanel extends Page {
		
		public function displayPage() {
			echo "<!DOCTYPE HTML>";
			echo "<html>\n";
			echo "<head>\n";
			$this->displayPageInfo();
			$this->connectCSS();
			echo "</head>\n";
			echo "<body>\n";
			$this->displayNavbar();
			$this->displayMain();
			$this->connectJS();
			echo "</body>\n";
			echo "</html>";
		}

		public function connectCSS() {
?>
			<!--GOOGLE Fonts-->
			<link href='https://fonts.googleapis.com/css?family=Noto+Sans' rel='stylesheet' type='text/css'>
			
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
			<link type="text/css" rel="stylesheet" href="css/stylesCP.css" />
			
<?php
		}
		
		public function displayNavbar() {
?>	
			<div class="navbar-fixed">
				<nav class="indigo darken-4">
					<div class="nav-wrapper">
						<a href="index.php" class="brand-logo center"><span>Control Panel</span></a>
						<ul class="right hide-on-med-and-down">
							<li><a class="menu_link waves-effect waves-light" href="index.php">LOG OUT</a></li>
						</ul>
						
						<!--Mobile sliding menu-->
						<ul id="slide-out" class="side-nav">
							<li><a class="menu_link waves-effect waves-light" href="#"><img src="img/cpIcons/movie-clapperboard-icon.png" />Showreel</a></li>
							<hr />
							<li><a class="menu_link waves-effect waves-light" href="#"><img src="img/cpIcons/File_Text.png" />CV</a></li>
							<hr />
							<p>ACTING SHOTS:</p>
							<li><a class="menu_link waves-effect waves-light" href="#"><img src="img/cpIcons/Photo-icon.png" />Acting photos</a></li>
							<li><a class="menu_link waves-effect waves-light" href="#"><img src="img/cpIcons/movies-icon.png" />Acting videos</a></li>
							<hr />
							<p>GIG SHOTS:</p>
							<li><a class="menu_link waves-effect waves-light" href="#"><img src="img/cpIcons/Photo-icon.png" />Gig photos</a></li>
							<li><a class="menu_link waves-effect waves-light" href="#"><img src="img/cpIcons/movies-icon.png" />Gig videos</a></li>
							<hr />
							<li><a class="menu_link waves-effect waves-light" href="#"><img src="img/cpIcons/song_icon.png" />Songs</a></li>
						</ul>
						<a href="index.php" class="hide-on-large-only right"><img src="img/cpIcons/door-in-icon.png" /></a>
						<a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
					</div>
				</nav>
			</div>
<?php
		}
	
		function displayMain() {
?>
		<div class="row">
			<div id="contField" class="col l3 hide-on-med-and-down">
				<div id="desktop_flex">
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/movie-clapperboard-icon.png" /><span>Showreel</span></a>
					<hr />
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/File_Text.png" /><span>CV</span></a>
					<hr />
					<p>ACTING SHOTS:</p>
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/Photo-icon.png" /><span>Acting photos</span></a>
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/movies-icon.png" /><span>Acting videos</span></a>
					<hr />
					<p>GIG SHOTS:</p>
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/Photo-icon.png" /><span>Gig photos</span></a>
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/movies-icon.png" /><span>Gig videos</span></a>
					<hr />
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/song_icon.png" /><span>Songs</span></a>
				</div>
			</div>
			<div id="mainContent" class="col s12 l9 offset-l3">
				<div id="desktop_flex_top">
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/Add.png" /><span>add new</span></a>
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/Trash.png" /><span>delete</span></a>
				</div>
				<hr />
				<h4>Selected Group:</h4>
			</div>
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
			<script src=\"scripts/zScriptCP.js\"></script>
			";
		}
	}
?>