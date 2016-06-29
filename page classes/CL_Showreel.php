<?php
/*
Author: Arnis Zelcs
Created: 13/03/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Showreel class
*/

	//include a class
	include("CL_Page.php");
	
	//Showreel class, inherit from a main page class
	class Showreel extends Page {
		
		//constructor function
		public function __construct($result) {
			$this->result = $result;
		}
		
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
			$this->displayMain($this->result);
			$this->connectJS();
			echo "</body>\n";
			echo "</html>";
		}
		//view method
		public function displayMain($result) {
?>
			<p id="shwrl_ui_title" class="center-align textShadow"><?php echo $result["video_title"]; ?></p>
			<p id="shwrl_ui_title_helper" class="center-align textShadow"><?php echo $result["video_descr"]; ?></p>
			
			<!--Video embedded from YouTube-->
			<div class="video-container">
				<iframe width="853" height="480" src="<?php echo $result["video_path"]; ?>" frameborder="0" allowfullscreen></iframe>
			</div>
<?php
		}
	}
?>