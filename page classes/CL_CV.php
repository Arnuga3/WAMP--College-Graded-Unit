<?php
	include("CL_Page.php");
	
	class CV extends Page {		
	
	
		public function __construct($cv_result) {
			$this->cv_result = $cv_result;
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
			$this->displayMain($this->cv_result);
			$this->connectJS();
			echo "</body>\n";
			echo "</html>";
		}

		
		function displayMain($cv_result) {
			
?>
		<div class="row">
			<div id="contField" class="col s12 l10 offset-l1 z-depth-4">
				<form action="" method="">
					<div class="input-field col s12">
						<input placeholder="Full name" id="full_name" type="text" class="validate" value="<?php echo $cv_result["cv_name"]; ?>">
						<label for="full_name">Full name</label>
					</div>
				</form>
			</div>
		</div>
<?php
		}
	}
?>