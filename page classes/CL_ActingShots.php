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
					<a href="#" class="bold"><p>Photos</p></a>
					<a href="#" class="bold"><p>Videos</p></a>
				</div>
				<div id="contCont" class="col s12 l9 z-depth-1">
					<div class="row">
						<div class="col s12 m6 valign-wrapper">
							<img width="100" src="img/Places-folder-black-icon.png" />
						</div>
						<div class="col s12 m6 valign-wrapper">
							<div class="valign-wrapper">
								<img class="materialboxed valign" data-caption="Black and white picture!" width="100" src="img/2.jpg" />
							</div>
						</div>
						<div class="col s12 m6 valign-wrapper">
							<div class="valign-wrapper">
								<img class="materialboxed valign" width="100" src="img/3.jpg" />
							</div>	
						</div>
						<div class="col s12 m6 valign-wrapper">
							<div class="valign-wrapper">
								<img class="materialboxed valign" width="100" src="img/4.jpg" />
							</div>	
						</div>
						<div class="col s12 m6 valign-wrapper">
							<div class="valign-wrapper">
								<img class="materialboxed valign" width="100" src="img/5.jpg" />
							</div>	
						</div>
						<div class="col s12 m6 valign-wrapper">
							<div class="valign-wrapper">
								<img class="materialboxed valign" width="100" src="img/2.jpg" />
							</div>	
						</div>
						<div class="col s12 m6 valign-wrapper">
							<div class="valign-wrapper">
								<img class="materialboxed valign" width="100" src="img/3.jpg" />
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
		}
	}
?>