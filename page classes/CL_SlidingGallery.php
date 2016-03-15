<?php
	include("CL_Page.php");
	
	class SlidingGallery extends Page {
		
		public function displayPage() {
			echo "<!DOCTYPE HTML>";
			echo "<html>\n";
			echo "<head>\n";
			$this->displayPageInfo();
			$this->connectCSS();
			echo "</head>\n";
			echo "<body>\n";
			$this->displayNavbar();
			$this->displaySlidingGallery();
			$this->connectJS();
			echo "</body>\n";
			echo "</html>";
		}
		
		public function connectCSS() {
?>
			<!--GOOGLE Fonts-->
			
			<!--Import materialize.css-->
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
		
		public function displaySlidingGallery() {
?>
			<div class="sliderContainer">
				<div class="sliderImages">
					<img id="img1" src="img/1.jpg" />
					<img id="img2" src="img/2.jpg" />
					<img id="img3" src="img/3.jpg" />
					<img id="img4" src="img/4.jpg" />
				</div>
				<div class="sliderControl"></div>
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
			<script src=\"scripts/zSliderCall.js\"></script>	<!--REQUIRE FOR SLIDING GALLERY-->
			<script src=\"scripts/zSliderPlugin.js\"></script>	<!--REQUIRE FOR SLIDING GALLERY-->
			<script src=\"scripts/zScript.js\"></script>
			";
		}
	}
?>
