<?php
 $file = 'file.txt';
 if (!unlink($file)) {
	 echo "<p>Not deleted!</p>";
 } else {
	 echo "<p>File deleted!</p>";
 }
?>