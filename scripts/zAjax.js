/*            Multiuse Function             */
function saveChanges(url, vars) {

	var url = url;
	var vars = vars;
	
	//new request to the server
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();						// code for IE7+, Firefox, Chrome, Opera, Safari
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");	// code for IE6, IE5
	}
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			
			//display an error if any, update is working on the background
			$('#error').html(xmlhttp.responseText);
		}
	}

	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(vars);
}


/*             Custom Functions               */


//Showreel variables for ajax post request
function getShowreelData() {
	var title = $('#showrl_title').val();
	var description = $('#showrl_description').val();
	var path = $('#showrl_path').val();
	
	var combined = "title=" + title + "&description=" + description + "&path=" + path;
	return combined;
}