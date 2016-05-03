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
			//resize() function is used to reside a side menu on large screens to allow scrolling if not fit in window height
			echo "<body onresize=\"resize()\">\n";
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
			<link type="text/css" rel="stylesheet" href="../frameworks/materialize-v0.97.5/materialize/css/materialize.min.css"  media="screen,projection"/>
			
			<!--Was here as Materialize suggestion-->
			<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
			
			<!--Font Awesome Icons, Styles-->
			<link type="text/css" rel="stylesheet" href="../frameworks/font-awesome-4.4.0/css/font-awesome.min.css" />
			
			<!--JQ-UI-->
			<link type ="text/css" rel="stylesheet" href="../frameworks/jquery-ui-1.11.4/jquery-ui.theme.min.css">
			
			<!--Css-->
			<link type="text/css" rel="stylesheet" href="../css/stylesCP.css" />
			
<?php
		}
		
		public function displayNavbar() {
?>	
			<div id="dark"></div>
		  
			<div class="navbar-fixed">
				<nav class="blue-grey darken-4">
					<div class="nav-wrapper">
						<a href="#" class="brand-logo center"><span>Control Panel</span></a>
						<ul class="right hide-on-med-and-down">
							<li><a class="menu_link waves-effect waves-light" href="../php_tasks/close_session.php">LOG OUT</a></li>
						</ul>
						
						<!--Mobile sliding menu-->
						<ul id="slide-out" class="side-nav">
							<li><a class="a_shwrl menu_link waves-effect waves-light" href="#"><img src="../img/cpIcons/movies.png" />Showreel</a></li>
							<hr />
							<li><a class="a_cv menu_link waves-effect waves-light" href="#"><img src="../img/cpIcons/document_yellow.png" />CV</a></li>
							<hr />
							<p class="lightText">ACTING SHOTS:</p>
							<li><a class="a_act_p menu_link waves-effect waves-light" href="#"><img src="../img/cpIcons/images.png" />Acting photos</a></li>
							<li><a class="menu_link waves-effect waves-light" href="#"><img src="../img/cpIcons/video.png" />Acting videos</a></li>
							<hr />
							<p class="lightText">GIG SHOTS:</p>
							<li><a class="a_gig_p menu_link waves-effect waves-light" href="#"><img src="../img/cpIcons/images.png" />Gig photos</a></li>
							<li><a class="menu_link waves-effect waves-light" href="#"><img src="../img/cpIcons/video.png" />Gig videos</a></li>
							<hr />
							<li><a class="menu_link waves-effect waves-light" href="#"><img src="../img/cpIcons/music.png" />Songs</a></li>
						</ul>
						<a href="../php_tasks/close_session.php" class="hide-on-large-only right"><i class="material-icons">input</i></a>
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
					<a class="a_shwrl waves-effect waves-yellow" href="#"><img src="../img/cpIcons/movies.png" /><span>Showreel</span></a>
					<hr />
					<a class="a_cv waves-effect waves-yellow" href="#"><img src="../img/cpIcons/document_yellow.png" /><span>CV</span></a>
					<hr />
					<p class="lightText">ACTING SHOTS:</p>
					<a class="a_act_p waves-effect waves-yellow" href="#"><img src="../img/cpIcons/images.png" /><span>Acting photos</span></a>
					<a class="waves-effect waves-yellow" href="#"><img src="../img/cpIcons/video.png" /><span>Acting videos</span></a>
					<hr />
					<p class="lightText">GIG SHOTS:</p>
					<a class="a_gig_p waves-effect waves-yellow" href="#"><img src="../img/cpIcons/images.png" /><span>Gig photos</span></a>
					<a class="waves-effect waves-yellow" href="#"><img src="../img/cpIcons/video.png" /><span>Gig videos</span></a>
					<hr />
					<a class="waves-effect waves-yellow" href="#"><img src="../img/cpIcons/music.png" /><span>Songs</span></a>
				</div>
			</div>
			
			<div class="preload346">
				<div class="preloader-wrapper big active">
				
					<div class="spinner-layer spinner-blue">
						<div class="circle-clipper left">
							<div class="circle"></div>
						</div>
						<div class="gap-patch">
							<div class="circle"></div>
						</div>
						<div class="circle-clipper right">
							<div class="circle"></div>
						</div>
					</div>
					
					<div class="spinner-layer spinner-red">
						<div class="circle-clipper left">
							<div class="circle"></div>
						</div>
						<div class="gap-patch">
							<div class="circle"></div>
						</div>
						<div class="circle-clipper right">
							<div class="circle"></div>
						</div>
					</div>
					
					<div class="spinner-layer spinner-yellow">
						<div class="circle-clipper left">
							<div class="circle"></div>
						</div>
						<div class="gap-patch">
							<div class="circle"></div>
						</div>
						<div class="circle-clipper right">
							<div class="circle"></div>
						</div>
					</div>
						
				</div>
			</div>
			
			<div id="mainContent" class="col s12 l9 offset-l3">

				<div class="pad15 textJustify">Welcome to the Control Panel! Here you can change the content of the ... website. Please read the information below what is providing the detailed documentation. All the content is separated in different groups and is available in the main menu. </div>
			</div>
		</div>
<?php
		}
		
		public function connectJS() {
			echo "
			<!--Materialize requires jQuery, so first to include jQuery, than Materialize js file-->
			<script type=\"text/javascript\" src=\"../frameworks/jquery-2.1.4.min.js\"></script>
			<script type=\"text/javascript\" src=\"../frameworks/materialize-v0.97.5/materialize/js/materialize.min.js\"></script>
			<script src=\"../frameworks/jquery-ui-1.11.4/jquery-ui.min.js\"></script>
			<!--Scripts-->
			<script src=\"../scripts/zScriptCP.js\"></script>
			<script src=\"../scripts/zAjax.js\"></script>
			";
		}
	}
?>