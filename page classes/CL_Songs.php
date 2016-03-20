<?php
	include("CL_Page.php");
	
	class Songs extends Page {
		
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

		public function displayMain() {
?>
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