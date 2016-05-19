<?php
/*
Author: Arnis Zelcs
Created: 13/03/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Songs class
*/

	//include a class
	include("CL_Page.php");
	
	//Songs class, inherit from a main page class
	class Songs extends Page {
		
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
		//view method
		public function displayMain() {
?>	
			<!--That is just a template of a view-->
			<div class="row">
				<div id="contField_s" class="col s12 l10 offset-l1 z-depth-4">
					<div class="col s12 l3">
						<span id="actLabel" class="bold">Songs</span>
					</div>
					<div id="contCont_s" class="col s12 l9 z-depth-1">
						<div class="row">
							<div class="col s12">
								<div class="song_icon">
									<img src="img/notka.png" />
								</div>
								<div class="song_player">
									<p>Song title goes here</p>
									<audio id="music" controls="controls">
										<source src="#" type="audio/ogg" />
										<source src="audio/5.mp3" type="audio/mpeg" />
									</audio>
								</div>
							</div>
							<div class="col s12">
								<div class="song_icon">
									<img src="img/notka.png" />
								</div>
								<div class="song_player">
									<p>Song title goes here</p>
									<audio id="music" controls="controls">
										<source src="#" type="audio/ogg" />
										<source src="#" type="audio/mpeg" />
									</audio>
								</div>
							</div>
							<div class="col s12">
								<div class="song_icon">
									<img src="img/notka.png" />
								</div>
								<div class="song_player">
									<p>Song title goes here</p>
									<audio id="music" controls="controls">
										<source src="#" type="audio/ogg" />
										<source src="#" type="audio/mpeg" />
									</audio>
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