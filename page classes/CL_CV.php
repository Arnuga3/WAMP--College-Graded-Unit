<?php
/*
Author: Arnis Zelcs
Created: 13/03/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: CV class
*/

	//include a class
	include("CL_Page.php");
	
	//CV class, inherit from a main page class
	class CV extends Page {		
	
		//constructor function to get parameters passed to a class
		public function __construct($cv_result, $tr_result, $flmtv_result, $th_result) {
			$this->cv_result = $cv_result;
			$this->tr_result = $tr_result;
			$this->flmtv_result = $flmtv_result;
			$this->th_result = $th_result;
		}
		
		//main method
		public function displayPage() {
			echo "<!DOCTYPE html>";
			echo "<html>\n";
			echo "<head>\n";
			$this->displayPageInfo();
			$this->connectCSS();
			echo "</head>\n";
			echo "<body>\n";
			$this->displayNavbar();
			$this->displayMain($this->cv_result, $this->tr_result, $this->flmtv_result, $this->th_result);
			$this->connectJS();
			echo "</body>\n";
			echo "</html>";
		}

		//view method, generate the main content of a page using the data fetched from a database
		function displayMain($cv_result, $tr_result, $flmtv_result, $th_result) {
			
			//loop through the mySQLi object
			if ($cv_result->num_rows == 1) {
				while($row = $cv_result->fetch_assoc()) {
					$data_cv = $row;
				}
				
			}
?>
		<div class="row">
			<div id="contField" class="col s12 l10 offset-l1 z-depth-4">
				<div class="row">
					<div class="col s12 m7 u_cv_name"><?php echo $data_cv["cv_name"]; ?></div>
					<div class="col s12 m5 u_cv_equity">Equity: &nbsp <?php echo $data_cv["cv_equity"]; ?></div>
					<div class="col s12 u_cv_email">Email: &nbsp <?php echo $data_cv["cv_email"]; ?></div>
					
					<div class="col s12 m7"><img id="cv_img" src="img/cv_img.png" /></div>
					
					<div class="col s12 m5"><h4 class="margTopL">Personal Details:</h4></div>
					<div class="col s12 m5"><span class="cv_per_det">Height:</span><?php echo $data_cv["cv_height"]; ?></div>
					<div class="col s12 m5"><span class="cv_per_det">Chest:</span><?php echo $data_cv["cv_chest"]; ?></div>
					<div class="col s12 m5"><span class="cv_per_det">Waist:</span><?php echo $data_cv["cv_waist"]; ?></div>
					<div class="col s12 m5"><span class="cv_per_det">Inside leg:</span><?php echo $data_cv["cv_inside_leg"]; ?></div>
					<div class="col s12 m5"><span class="cv_per_det">Eyes:</span><?php echo $data_cv["cv_eyes"]; ?></div>
					<div class="col s12 m5"><span class="cv_per_det">Hair:</span><?php echo $data_cv["cv_hair"]; ?></div>
					<div class="col s12 m5"><span class="cv_per_det">Build:</span><?php echo $data_cv["cv_build"]; ?></div>
					<div class="col s12 m5"><span class="cv_per_det">Playing Age:</span><?php echo $data_cv["cv_playing_age"]; ?></div>
					
					<div class="col s12"><h4 class="margTopL">Training:</h4></div>
<?php
					//loop through the mySQLi object
					if ($tr_result->num_rows > 0) {
						while($row = $tr_result->fetch_assoc()) {
							$data_tr = $row;
?>
							<div class="col s12 cv_training"><?php echo $data_tr["training"]; ?></div>
<?php						
						}
						
					}
?>
					<div class="col s12 margTopL"><span class="cv_per_det bold">Accents:</span><br/><?php echo $data_cv["cv_accents"]; ?></div>
					<div class="col s12 margTop"><span class="cv_per_det bold">Skills:</span><br/><?php echo $data_cv["cv_skills"]; ?></div>
					
					<div class="col s12 m5"><h4 class="margTopL">Film and Television Experience:</h4></div>
					
					<table class="col s12 responsive-table">
						<thead>
							<tr>
								<th>Year</th>
								<th>Role</th>
								<th>Production</th>
								<th>Director</th>
								<th>Company</th>
							</tr>
						</thead>

						<tbody>
<?php
					//loop through the mySQLi object
					if ($flmtv_result->num_rows > 0) {
						while($row = $flmtv_result->fetch_assoc()) {
							$data_flmtv = $row;
?>
							<tr>
								<td><?php echo $data_flmtv["film_year"]; ?></td>
								<td><?php echo $data_flmtv["film_role"]; ?></td>
								<td><?php echo $data_flmtv["film_production"]; ?></td>
								<td><?php echo $data_flmtv["film_director"]; ?></td>
								<td><?php echo $data_flmtv["film_company"]; ?></td>
							</tr>
<?php						
						}
						
					}
?>
						</tbody>
					</table>
										
					<div class="col s12 hide-on-large-only flexCenter"><img src="img/cpIcons/token_lookaround.png" /><span class="swipe">SWIPE</span></div>
					
					
					<div class="col s12 m5"><h4 class="margTopL">Theatre Experience:</h4></div>
					<table class="col s12 responsive-table">
						<thead>
							<tr>
								<th>Year</th>
								<th>Role</th>
								<th>Production</th>
								<th>Director</th>
								<th>Company</th>
							</tr>
						</thead>

						<tbody>
<?php
					//loop through the mySQLi object
					if ($th_result->num_rows > 0) {
						while($row = $th_result->fetch_assoc()) {
							$data_th = $row;
?>
							<tr>
								<td><?php echo $data_th["theatre_year"]; ?></td>
								<td><?php echo $data_th["theatre_role"]; ?></td>
								<td><?php echo $data_th["theatre_production"]; ?></td>
								<td><?php echo $data_th["theatre_director"]; ?></td>
								<td><?php echo $data_th["theatre_company"]; ?></td>
							</tr>
<?php						
						}
						
					}
?>
						</tbody>
					</table>	
					
					<div class="col s12 hide-on-large-only flexCenter"><img src="img/cpIcons/token_lookaround.png" /><span class="swipe">SWIPE</span></div>
					
					
				</div>
			</div>
		</div>
<?php
		}
	}
?>