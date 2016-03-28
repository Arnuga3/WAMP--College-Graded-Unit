<?php
	include("CL_Page.php");
	
	class ControlPanel extends Page {
		
		public function __construct($result) {
			$this->result = $result;
		}
		
		public function displayPage() {
			echo "<!DOCTYPE HTML>";
			echo "<html>\n";
			echo "<head>\n";
			$this->displayPageInfo();
			$this->connectCSS();
			echo "</head>\n";
			echo "<body>\n";
			$this->displayNavbar();
			$this->displayMain($this->result);
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
							<li><a class="menu_link waves-effect waves-light" href="php_tasks/close_session.php">LOG OUT</a></li>
						</ul>
						
						<!--Mobile sliding menu-->
						<ul id="slide-out" class="side-nav">
							<li><a class="menu_link waves-effect waves-light" href="#"><img src="img/cpIcons/movie-clapperboard-icon.png" />Showreel</a></li>
							<hr />
							<li><a class="menu_link waves-effect waves-light" href="#"><img src="img/cpIcons/File_Text.png" />CV</a></li>
							<hr />
							<p class="lightText">ACTING SHOTS:</p>
							<li><a class="menu_link waves-effect waves-light" href="#"><img src="img/cpIcons/Photo-icon.png" />Acting photos</a></li>
							<li><a class="menu_link waves-effect waves-light" href="#"><img src="img/cpIcons/movies-icon.png" />Acting videos</a></li>
							<hr />
							<p class="lightText">GIG SHOTS:</p>
							<li><a class="menu_link waves-effect waves-light" href="#"><img src="img/cpIcons/Photo-icon.png" />Gig photos</a></li>
							<li><a class="menu_link waves-effect waves-light" href="#"><img src="img/cpIcons/movies-icon.png" />Gig videos</a></li>
							<hr />
							<li><a class="menu_link waves-effect waves-light" href="#"><img src="img/cpIcons/song_icon.png" />Songs</a></li>
						</ul>
						<a href="php_tasks/close_session.php" class="hide-on-large-only right"><i class="material-icons">input</i></a>
						<a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
					</div>
				</nav>
			</div>
<?php
		}
	
		function displayMain($result) {
?>
		<div class="row">
			<div id="contField" class="col l3 hide-on-med-and-down">
				<div id="desktop_flex">
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/movie-clapperboard-icon.png" /><span>Showreel</span></a>
					<hr />
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/File_Text.png" /><span>CV</span></a>
					<hr />
					<p class="lightText">ACTING SHOTS:</p>
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/Photo-icon.png" /><span>Acting photos</span></a>
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/movies-icon.png" /><span>Acting videos</span></a>
					<hr />
					<p class="lightText">GIG SHOTS:</p>
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/Photo-icon.png" /><span>Gig photos</span></a>
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/movies-icon.png" /><span>Gig videos</span></a>
					<hr />
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/song_icon.png" /><span>Songs</span></a>
				</div>
			</div>
			<div id="mainContent" class="col s12 l9 offset-l3">
				<!--
				<div id="desktop_flex_top">
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/Add.png" /><span>add new</span></a>
					<a class="waves-effect waves-light" href="#"><img src="img/cpIcons/Trash.png" /><span>delete</span></a>
				</div>
				<hr />
				-->
				<h5 class="titleText">Selected Group:<span class="margLeft"><?php echo $result["video_group"]; ?></span></h5>
				
				<p class="infoText margTop">Video preview</p>
				<div class="row">
					<div class="col s12 l10">
						<div class="video-container margTop">
							<iframe width="853" height="480" src="<?php echo $result["video_path"]; ?>" frameborder="0" allowfullscreen></iframe>
						</div>
					</div>
				</div>
				
				<p class="helperText"><img id="shwrl_warn" src="img/cpIcons/Warning_2.png" />Only 1 video is allowed in this group.</p>
				<p class="helperText"><img id="shwrl_pencil" src="img/cpIcons/Pencil_2.png" />Just add, change or remove the information below and click a "save" button.</p>
				
				<p class="infoText margTop">Video information</p>
				
				<form id="showreel">

					<div class="input-field">
						<input id="showrl_title" type="text" name="showrl_title" class="validate" length="255" value="<?php echo str_replace('"',"&quot;", $result["video_title"]);?>" />
						<label for="showrl_title">video title</label>
					</div>
					<div class="input-field">
						<textarea id="showrl_description" name="showrl_description" class="materialize-textarea" length="1000"><?php echo $result["video_descr"];?></textarea>
						<label id="matr_descrLb" for="showrl_description">video description</label>
					</div>
					<div class="input-field">
						<textarea id="showrl_path" type="text" name="showrl_path" class="materialize-textarea" length="255"><?php echo str_replace('"',"&quot;", $result["video_path"]);?></textarea>
						<label id="matr_descrLb" for="showrl_path">video path</label>
					</div>
					
					<div id="error"></div>
					
					<!-- Showreel SAVE button, LOGIC: Toast is shown on a screen for 2 sec with SAVED message, AJAX is updating a record in DB, page is refreshed to apply changes-->
					<div class="center margTop">
						<a class="waves-effect waves-light btn indigo darken-4 margBotExtra" onclick="Materialize.toast('Saved', 2000, 'rounded', 
							function() {
								saveChanges('php_tasks/showreel_update.php', getShowreelData());
								$('#showreel').submit();
							})">save</a>
					</div>
				</form>
				
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
			<script src=\"scripts/zAjax.js\"></script>
			";
		}
	}
?>