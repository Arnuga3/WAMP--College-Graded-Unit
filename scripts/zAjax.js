/*            Multiuse Function             */
function saveChanges(url, vars, callback) {

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
			
			//Callback function is called only after response is get from the server
			if (typeof callback == "function") {
				callback();
			}
		}
	}

	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(vars);
}


/*             Custom Functions               */


//Showreel variables for ajax post request, to save any changes in showreel group
function saveShowreelData() {
	var title = $('#showrl_title').val();
	var description = $('#showrl_description').val();
	var path = $('#showrl_path').val();
	
	var combined = "title=" + title + "&description=" + description + "&path=" + path;
	saveChanges("../php tasks/showreel_update.php", combined, function() {
		//RELOAD PAGE TO SHOW CHANGES
		$('#mainContent').load('../control_panel/a_showreel.php', function() {
			reloadEvents();
			//This hardcoding is used to fix unexpected result with the materialize forms loaded using AJAX
			//focus(does the job)
			$('input:first').focus();
			//focus and unfocus
			$('textarea').focus().blur();
			//scroll to the top of the page
			$('body').scrollTop(0);
		});
		//END RELOAD
		
		Materialize.toast('Saved', 1500, 'rounded');
	});
}


//MOVE PHOTOS FUNCTIONALITY, prepare and send ajax
function movePhotosAJAX(folder, photos) {
	var folderName = folder;
	var folderNoSpace = folderName.replace(" ", "+");

	var photos = photos;
	var combined = "folder=" + folderNoSpace + "&photos=" + photos;
	
	//Third parameter is a callback function and is called only after the browser gets a response from server, jQuery approach
	saveChanges("../php tasks/move_photo_update.php", combined, function() {
		if (folderName == "") {
			$('#mainContent').load('../control_panel/a_act_photos.php', function() {
				reloadEvents();
				//FOLDERS add events to the loaded folders
				$('.folder').click(function() {
					var selectedFolder = $(this);
					var url = '../control_panel/a_act_folders.php?folder=';
					var folderName = selectedFolder.find('span').text();
					var noSpaceName = escape(folderName);
					$('#mainContent').load( url + noSpaceName, function() {
						reloadEvents();
						actionPhotosDo();
					});
				});
			});
		} else {
			//FOLDERS add events to the loaded folders
			var url = '../control_panel/a_act_folders.php?folder=';
			$('#mainContent').load( url + folderNoSpace, function() {
				reloadEvents();
				actionPhotosDo();
			});
		}
		Materialize.toast('Moved', 1500, 'rounded');
		if ($('#dark').css('display') == 'block') {
			enableScroll();
			$('#dark').toggle();
		}
	});
	
	
}
//Checked photos
function getSelectedPhotos() {
	var checked = [];
	var toStr = "";
	$('input:checked').each(function() {
		checked.push($(this).attr("id"));
	});
	for (var i=0; i<checked.length; i++) {
		toStr += "p" + checked[i];
	}
	return toStr;
}


//RENAME ALBUM FUNCTIONALITY, prepare and send ajax
function renameAlbumAJAX(folder, folderOld, action) {
	var folderName = folder;
	var folderNoSpace = escape(folderName);

	var folderOld = folderOld;
	var action = action;
	//use 'photos' is just for not breaking the server code instead of writing another script
	var combined = "folder=" + folderNoSpace + "&photos=" + folderOld + "&actionStr= " + action;
	
	//Third parameter is a callback function and is called only after the browser gets a response from server, jQuery approach
	saveChanges("../php tasks/move_photo_update.php", combined, function() {
		if (folderName == "") {
			alert("empty");
			$('#mainContent').load('../control_panel/a_act_photos.php', function() {
				reloadEvents();
				//FOLDERS add events to the loaded folders
				$('.folder').click(function() {
					var selectedFolder = $(this);
					var url = '../control_panel/a_act_folders.php?folder=';
					var folderName = selectedFolder.find('span').text();
					var noSpaceName = escape(folderName);
					$('#mainContent').load( url + noSpaceName, function() {
						reloadEvents();
						actionPhotosDo();
					});
				});
			});
		} else {
			//FOLDERS add events to the loaded folders
			var url = '../control_panel/a_act_folders.php?folder=';
			$('#mainContent').load( url + folderNoSpace, function() {
				reloadEvents();
				actionPhotosDo();
			});
		}
		Materialize.toast('Album Renamed', 1500, 'rounded');
		if ($('#dark').css('display') == 'block') {
			enableScroll();
			$('#dark').toggle();
		}
	});
	
	
}

