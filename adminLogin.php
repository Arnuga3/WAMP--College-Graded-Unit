<?php
/*
This script validates admin's username and password.
*/
?>
<?php
	include ("db/db_ORM.php");
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		
		$userName = $_POST["adminName"];
		$userPassword = $_POST["adminPassword"];
		
		
		//Create DB connection and get data from db
		$db = new dbConnection();
		$db->connect();
		$result = $db->select("user");
		$db->close();
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo $row["usr_name"]."   ".$userName."\n";
				echo $row["usr_psswd"]."   ".$userPassword."\n";
				if ($row["usr_name"] == $userName and crypt($userPassword, $row["usr_psswd"]) == $row["usr_psswd"]) {
					//I do transfer to another file here to prevent the form resubmission when back and forward buttons are pressed, like pages A B and C, this is a page B and it is used for this purpose
					header("Location: control_panel.php");
				} else {
					echo "Invalid data. Login failed.";
				}
			}
		}
	}
	
?>