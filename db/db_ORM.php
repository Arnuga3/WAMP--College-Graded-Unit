<?php
/*
Developed by Arnis Zelcs
Created: 21/03/2016

This is a DB Class based on procedural mysqli and is written in php.
Methods are developed to simplify the work with DB and for automation of some of the parts in PHP/MySQL projects.

To use this class you have to specify the servername, db name, username and password you are using.
	
	
METHODS:
	
	connect()
	close()
	select()
	insert()
	update()
	delete()
	customQuery()
	prepareArray()
	getTableColumns()
	escape()
	

	
METHODS DESCRIPTION AND USAGE:
	
	
	connect() - create a connection to a database
	
	close() - close connection to a database
	
	select() - get the data from the database
		Usage: select(table_name(mandatory), column(s)_name(mandatory if 'where' or 'order_by' are also set), where(optional), order_by(optional));
				Note: if only table_name is passed everything is selected from this table '*' or set specific column if data just from this column is needed
				
	insert() - insert data to a database
		Usage: insert(table_name(mandatory), columns(mandatory), values(mandatory));
				Note: columns and values can be passed as arrays or as a strings, but if values are passed as a string, 
					  each value have to be escaped for special characters and set into single qoutes before passing to the method
					  
					  Example:
					  
					    $title = test_input($_POST["title"]);
						$url = test_input($_POST["url"]);
						
						//Create DB connection and insert input field values to projects table
						$db = new dbConnection();
						$db->connect();
						
						//Values can be passed to as a string with variables, but they have to be escaped before passing and be in single quotes
						$title = $db->escape($title);
						$url = $db->escape($url);
						
						$db->insert("projects","title_col, url_col", "'$title', '$url'");
						
	update() - change a record values in specific columns of a database by specific column value
		Usage: update(table_name(mandatory), column(s)(mandatory), targetColumn(mandatory), targetValue(mandatory));
	
	delete() - delete a record by specific column value
		Usage: delete(table_name(mandatory), targetColumn(mandatory), targetValue(mandatory));
		
	customQuery()
	
	prepareArray() - accept values, escape special characters and return them in an array, this method is using private method escape()
		Usage: prepareArray(val1, val2, .., valn);
	
	getTableColumns() - return an array of column names of the passed table
		Usage: getTableColumns(table_name);
		
	escape() - escape special characters, characters encoded are NUL (ASCII 0), \n, \r, \, ', ", and Control-Z.
		Usage: getTableColumns(string);
	
*/
////////////////////////////////////////////////
///////////   DB Connection Class   ////////////
////////////////////////////////////////////////
	
	
	class dbConnection {
		
		private $servername = "localhost";
		private $db = "jrdb";
		private $username = "arnuga3";
		private $password = "codeStudent3";
		private $myConn;
		private $result;
		
//ESCAPE SPECIAL CHARACTERS
		public function escape($str) {
			return mysqli_real_escape_string($this->myConn, $str);
		}
		
		
		
//CONNECT
		public function connect() {
			$conn = new mysqli($this->servername, $this->username, $this->password, $this->db);					// Create connection
			if ($conn->connect_error) {																			// Check connection
				die("Connection failed: " . $conn->connect_error);
			} else {
				$this->myConn = $conn;
				return $this->myConn;
			}
		}
		
		
		
//CLOSE
		public function close() {
			$this->myConn->close();
		}
		
		
		
//SELECT
		public function select($table, $column = '*', $where = null, $orderBy = null) {
			$query = 'SELECT '.$column.' FROM '.$table;
			if ($where != null) {
				$query .= ' WHERE '.$where;
			}
			if ($orderBy != null) {
				$query .= ' ORDER BY '.$orderBy;
			}
			return $this->myConn->query($query);
		}
		
		
		
		
		/*************THIS METHOD NEED TO BE UPDATED: SKIP COLUMNS(LIKE: INSERT INTO table_name VALUES(...)),
		(public function insert($table, $columns = null, $values))
		add a check 
			if ($columns != null) {
				$query .= "($columns)";
			}
		*********************/
//INSERT
		public function insert($table, $columns, $values) {
			
			$error = false;
			//Convert to string
			if (is_array($columns)) {				
				$columnsNew = implode(", ", $columns);
				$columns = $columnsNew;
			}
			
			$query = 'INSERT INTO '.$table.' ('.$columns;
			
			//Single quotes for each value to insert, convert to string
			if (is_array($values)) {

				$valuesNew = implode("', '", $values);
				$values = $valuesNew;	
				
				//if values is array
				//Every string have to be in single quotes'' to make it work(values passed)
				$query .= ") VALUES ('".$values."')";
				
			} else {
				echo "Error inserting record: Values have to be passed in array, use prepareArray() method before passing values.";
				$error = true;
			}
			
			if (!$error) {
				$this->result = $this->myConn->query($query);
			}
			
			if ($this->result === TRUE) {
				//echo "Saved";
			} else {
				echo "Error inserting record: " . $this->myConn->error;
			}
		}
		
		
		
//UPDATE
		public function update($table, $columns, $values, $targetCol, $targetVal) {
			
			$error = false;
			//if string need to clean and save in array
			if (is_string($columns)) {
				
				//delete spaces if found
				$noSpaceStr = str_replace(", ", ",", $columns);
				//split into array
				$arrColumns = explode(",", $noSpaceStr);
				
			//if not a string save to variable used in query
			} else {
				$arrColumns = $columns;
			}
			
			if (is_string($values)) {
				
				echo "Error inserting record: Values have to be passed in array, use prepareArray() method before passing.";
				$error = true;
				
			} else {
				
				$arrValues = $values;
				//Check if the amount of columns passed is the same as the amount of values
				if (count($arrColumns) != count($arrValues)) {
					
					echo "Error updating record: Amount of columns and values do not match.";
					$error = true;

				} else {
					
					//string of pairs(column=value)
					$colValStr = "";
					for ($i=0; $i<count($arrColumns); $i++) {
						
						/*$value = mysqli_real_escape_string($this-myConn, $arrValues[$i]);*/
						if ($i == count($arrColumns)-1) {
							
							//after last pair do not need comma
							$colValStr .= $arrColumns[$i]."='".$arrValues[$i]."'";
							
						} else {
							$colValStr .= $arrColumns[$i]."='".$arrValues[$i]."', ";
						}
					}
					
					if (is_string($targetVal)) {
						$query = "UPDATE ".$table." SET ".$colValStr." WHERE ".$targetCol." LIKE '%".$targetVal."%'";
					} else {
						$query = "UPDATE ".$table." SET ".$colValStr." WHERE ".$targetCol."=".$targetVal;
					}
				}
			}
			
			if (!$error) {
				$this->result = $this->myConn->query($query);
			}
		
			if ($this->result === TRUE) {
				//echo "Updated";
			} else {
				echo "Error updating record: " . $this->myConn->error;
			}
		}
		
		
		
//DELETE
		public function delete($table, $column, $data) {
			
			$query = "DELETE FROM ".$table." WHERE ".$column." = ".$data;
			
			$this->result = $this->myConn->query($query);

			if ($this->result === TRUE) {
				//echo "Deleted";
			} else {
				echo "Error deleting record: " . $this->myConn->error;
			}
		}
		
		
		
//CUSTOM
		public function customQuery($query) {

			$this->result = $this->myConn->query($query);
			return $this->result;
		}
		
		

//PREPARE ARRAY(FOR VALUES)
		public function prepareArray() {
			
			//Get number of arguments passed
			$numargs = func_num_args();
			
			//Get array of arguments
			$arg_list = func_get_args();
			for ($i = 0; $i < $numargs; $i++) {
				
				//Escape special characters
				$value = $this->escape($arg_list[$i]);
				//Rewrite
				$arg_list[$i] = $value;
			}
			//Return prepared array
			return $arg_list;
		}
		
		
		
//GET COLUMNS OF A TABLE
		public function getTableColumns($table) {
			
			$columns = array();
			$query = 'DESCRIBE '.$table;
			$result = $this->myConn->query($query);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					//Get column name and save to an array
					$columns[] = $row["Field"];
				}
			}
			//Return array of table columns
			return $columns;
		}
		
		
		
		//ALTER TABLE projects AUTO_INCREMENT = 1
		//ALTER TABLE skills AUTO_INCREMENT = 1
	}
?>