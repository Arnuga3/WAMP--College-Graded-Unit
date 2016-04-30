<?php
	include("CL_Page.php");
	
	class GigShots extends Page {
		
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
					<span id="actLabel" class="bold">GIG SHOTS</span>
					<a href="#" class="u_gig_p bold"><p>Photos</p></a>
					<a href="#" class="u_gig_v bold"><p>Videos</p></a>
				</div>
				
				<div class="preload333">
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
				
				<div id="contCont" class="col s12 l9 z-depth-1">
					<div class="row linkDIVs">
						<div class="col s12 m6 flexCenter">
							<a class="u_gig_p" href="#">Photos</a>
						</div>
						<div class="col s12 m6 flexCenter">
							<a class="u_gig_v" href="#">Videos</a>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
		}

	}
?>