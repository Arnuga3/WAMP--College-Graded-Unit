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
		
				
		//constructor function
		public function __construct($songs) {
			$this->songs = $songs;
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
			$this->displayMain($this->songs);
			$this->connectJS();
			echo "</body>\n";
			echo "</html>";
		}

		
		//view method
		public function displayMain($result) {
?>	
			<!--That is just a template of a view-->
			<div class="row">
				<div id="contField_s" class="col s12 l10 offset-l1 z-depth-4">
					<div class="col s12 l3">
						<span id="actLabel" class="bold">SONGS</span>
					</div>
					<div id="contCont_s" class="col s12 l9 z-depth-1">
						<div class="row">
					
					
<?php	
						//that block of code get unique names of folders and save them into an indexed array
						$folders = array();
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								
								//place all folder names into new array
								$folders[] = $row["music_folder"];
							}
						}
						//save only unique names of folders
						$folder_list = array_unique($folders);
						
						//remove all indexes with NULL value and move all unique values to the beginning of the array
						$folders_indexed = array();
						foreach ($folder_list as $i) {
							if ($i != NULL) {
								$folders_indexed[] = $i;
							}
						}
						
						echo "<div class=\"row\">";
						
						//display folders
						foreach ($folders_indexed as $val) {
							echo "<div class=\"folder col s12 m6 valign-wrapper\">
									<img width=\"100\" src=\"img/folder.png\" />
									<p>$val</p>
								</div>";
						}
						
						//reset a pointer for allowing to loop the query result again
						mysqli_data_seek($result, 0);
						
						//display photos without folders
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								if (!in_array($row["music_folder"], $folders_indexed)) {
									
									$correctPath = substr($row["music_path"], 3);
									
									echo '<div class="col s12">
											<div class="song_player">
												<p><i class="fa fa-music" aria-hidden="true"></i>'.$row["music_title"].'</p>
												<span class="videoDescr">'.$row["music_descr"].'</span><br>
												<audio id="music" controls="controls">
													<source src="songs/'.$correctPath.'" type="audio/ogg" />
													<source src="songs/'.$correctPath.'" type="audio/mpeg" />
												</audio>
											</div>
										</div>';
								}
							}
						}

?>		
						</div>
					</div>
				</div>
			</div>
<?php
		}
		
	}
?>