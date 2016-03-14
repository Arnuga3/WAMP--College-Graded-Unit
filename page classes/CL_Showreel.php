<?php
	include("CL_Page.php");
	
	class Showreel extends Page {
		
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

	}
?>