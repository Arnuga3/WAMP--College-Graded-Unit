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
				<nav class="light-blue darken-4">
					<div class="nav-wrapper">
						<a href="index.php" class="brand-logo center"><span class="bold">Admin Control Panel</span></a>
						<ul class="right hide-on-med-and-down">
							<li><a class="menu_link waves-effect waves-light" href="showreel.php">LOG OUT</a></li>
						</ul>
						
						<!--Mobile sliding menu-->
						<ul id="slide-out" class="side-nav">
							<li><a class="menu_link waves-effect waves-light" href="#"><i class="fa fa-youtube-play"></i>SHOWREEL</a></li>
							<li><a class="menu_link waves-effect waves-light" href="#"><i class="fa fa-file-text"></i>CV</a></li>
							<hr />
							<li><a class="menu_link waves-effect waves-light" href="#"><i class="fa fa-picture-o"></i>ACTING PHOTOS</a></li>
							<li><a class="menu_link waves-effect waves-light" href="#"><i class="fa fa-video-camera"></i>ACTING VIDEOS</a></li>
							<li><a class="menu_link waves-effect waves-light" href="#"><i class="fa fa-picture-o"></i>GIG PHOTOS</a></li>
							<li><a class="menu_link waves-effect waves-light" href="#"><i class="fa fa-video-camera"></i>GIG VIDEOS</a></li>
							<hr />
							<li><a class="menu_link waves-effect waves-light" href="#"><i class="fa fa-music"></i>SONGS</a></li>
						</ul>
						<a href="#" class="hide-on-large-only right"><i class="fa fa-sign-out"></i></a>
						<a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
					</div>
				</nav>
			</div>
<?php
		}
	
		public function displayMain() {
?>
			
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