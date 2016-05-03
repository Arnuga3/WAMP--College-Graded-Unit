<?php

	include ("../../db/db_ORM.php");

	$db = new dbConnection();
	$db->connect();
	$result = $db->select("training");
	$db->close();

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data_tr = $row;
			
			echo "
			<div class=\"input-field col s12\">
				<input placeholder=\"Training\" id=\"".str_replace('"',"&quot;", $data_tr["training_ID"])."\" type=\"text\" class=\"validate\" 
					value=\"".str_replace('"',"&quot;", $data_tr["training"])."\" />
				<label for=\"training\">training</label>
			</div>
			
			<div class=\"margBot pad15\">
				<a class=\"saveTraining waves-effect waves-light btn green darken-2\">save</a>
				<a class=\"deleteTraining waves-effect waves-light btn red darken\">delete</a>
			</div>";
		}
									
	} else {
		//Error message is displayed on the page if there is any
		echo "No records";
	}
?>