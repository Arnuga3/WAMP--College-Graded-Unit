<?php
	include("CL_Page.php");
	
	class ActingShots extends Page {
		
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
		
		function displayMain() {
?>
		<div class="row">
			<div id="contField" class="col s12 l10 offset-l1 z-depth-4">
				<div class="col s12 l3">
					<span id="actLabel" class="bold">ACTING SHOTS</span>
					<a href="#" class="u_act_p bold"><p>Photos</p></a>
					<a href="#" class="u_act_v bold"><p>Videos</p></a>
				</div>
				<div id="contCont" class="col s12 l9 z-depth-1">
					<p>Select group</p>
				</div>
			</div>
		</div>
<?php
		}
	}
?>