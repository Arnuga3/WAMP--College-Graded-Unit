<?php
/*
Author: Arnis Zelcs
Created: 13/03/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: ActingShots class
*/

	//include a class
	include("CL_Page.php");
	
	//ActingShots class, inherit from a main page class
	class ActingShots extends Page {
		
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
			$this->displayMain();
			$this->connectJS();
			echo "</body>\n";
			echo "</html>";
		}
		
		//view method, generate a page
		function displayMain() {
?>
		<div class="row">
			<div id="contField" class="col s12 l10 offset-l1 z-depth-4">
				<div class="col s12 l3 center">
					<span id="actLabel" class="bold">ACTING SHOTS</span>
					<a href="#" class="u_act_p bold"><p class="z-depth-2"><i class="fa fa-camera" aria-hidden="true"></i>Photos</p></a>
					<a href="#" class="u_act_v bold"><p class="z-depth-2"><i class="fa fa-youtube-play" aria-hidden="true"></i>Videos</p></a>
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
					<img class="poster" src="img/acting.jpg" />
				</div>
			</div>
		</div>
<?php
		}
	}
?>