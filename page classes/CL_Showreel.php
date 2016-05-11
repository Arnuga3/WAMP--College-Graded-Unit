<?php
	include("CL_Page.php");
	
	class Showreel extends Page {
		
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

		public function displayMain($result) {
?>
			<p id="shwrl_ui_title" class="center-align textShadow"><?php echo $result["video_title"]; ?></p>
			<p id="shwrl_ui_title_helper" class="center-align textShadow"><?php echo $result["video_descr"]; ?></p>
			<div class="video-container">
				<iframe width="853" height="480" src="<?php echo $result["video_path"]; ?>" frameborder="0" allowfullscreen></iframe>
			</div>
<?php
		}
	}
?>