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


//SHOWREEL INFORMATION UPDATE FUNCTIONALITY
function saveShowreelData() {
	
	var title = $('#showrl_title').val();
	var description = $('#showrl_description').val();
	var path = $('#showrl_path').val();
	
	var combined = "title=" + title + "&description=" + description + "&path=" + path;
	saveChanges("../php_tasks/showreel_update.php", combined, function() {
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


//DELETE FILES FUNCTIONALITY (PHOTOS)
function deletePhotosAJAX(folder, photos, typeNr) {
	
	//0 is acting, 1 is gig
	var delTypeURL = ["../php_tasks/delete_photo_act.php", "../php_tasks/delete_photo_gig.php"];
	var afterLoadTypeURL = ["../control_panel/a_act_photos.php", "../control_panel/a_gig_photos.php"];
	var folderTypeURL = ["../control_panel/a_act_folders.php?folder=", "../control_panel/a_gig_folders.php?folder="];
		
	$('.preload346').show();
	
	//outside the folder (main gallery), no span element to read the folder name from, so variable is equal to undefined, leave the empry string will push to save photos in main gallery (no album)
	if (folder == undefined) {
		var folderName = "";
	} else {
		var folderName = folder;
	}
	
	var folderNoSpace = encodeURIComponent(folderName);
	var photos = photos;
	var combined = "folder=" + folderNoSpace + "&photos=" + photos;
	
	//Third parameter is a callback function and is called only after the browser gets a response from server, jQuery approach
	saveChanges(delTypeURL[typeNr], combined, function() {
		if (folderName == "") {
			//acting/gig first ajax screen, depends on typeNr(0-acting, 1-gig)
			photosLoad(typeNr);
			reloadEvents();
			
		} else {
			//acting/gig inside folder ajax screen, depends on typeNr(0-acting, 1-gig)
			photosLoadFolder(typeNr, folderNoSpace);
			reloadEvents();
		}
		
		Materialize.toast('Deleted', 1500, 'rounded');
		if ($('#dark').css('display') == 'block') {
			enableScroll();
			$('#dark').toggle();
		}
	});
}


//MOVE PHOTOS FUNCTIONALITY (PHOTOS)
function movePhotosAJAX(folder, photos, typeNr) {
	
	var moveTypeURL = ["../php_tasks/move_photo_act.php", "../php_tasks/move_photo_gig.php"];
	var afterLoadTypeURL = ["../control_panel/a_act_photos.php", "../control_panel/a_gig_photos.php"];
	var folderTypeURL = ["../control_panel/a_act_folders.php?folder=", "../control_panel/a_gig_folders.php?folder="];
	
	var folderName = folder;
	var folderNoSpace = encodeURIComponent(folderName);

	var photos = photos;
	var combined = "folder=" + folderNoSpace + "&photos=" + photos;
	
	//Third parameter is a callback function and is called only after the browser gets a response from server, jQuery approach
	saveChanges(moveTypeURL[typeNr], combined, function() {
		if (folderName == "") {
			$('#mainContent').load(afterLoadTypeURL[typeNr], function() {
				reloadEvents();
				//FOLDERS add events to the loaded folders
				$('.folder').click(function() {
					var selectedFolder = $(this);
					var folderName = selectedFolder.find('span').text();
					var noSpaceName = encodeURIComponent(folderName);
					$('#mainContent').load(folderTypeURL[typeNr] + noSpaceName, function() {
						reloadEvents();
						actionPhotosDo();
					});
				});
			});
		} else {
			//FOLDERS add events to the loaded folders
			$('#mainContent').load(folderTypeURL[typeNr] + folderNoSpace, function() {
				reloadEvents();
			});
		}
		Materialize.toast('Moved', 1500, 'rounded');
		if ($('#dark').css('display') == 'block') {
			enableScroll();
			$('#dark').toggle();
		}
	});
}


//Get checked photos and prepare an URL string for request
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


//RENAME ALBUM FUNCTIONALITY (PHOTOS)
function renameAlbumAJAX(folder, folderOld, action) {
	
	var folderName = folder;
	var folderNoSpace = encodeURIComponent(folderName);
	var folderOld = folderOld;
	var action = action;
	//use 'photos' is just for not breaking the server code instead of writing another script
	var combined = "folder=" + folderNoSpace + "&photos=" + folderOld + "&actionStr= " + action;
	
	//Third parameter is a callback function and is called only after the browser gets a response from server, jQuery approach
	saveChanges("../php_tasks/move_photo_update.php", combined, function() {
		if (folderName == "") {
			$('#mainContent').load('../control_panel/a_act_photos.php', function() {
				reloadEvents();
				//FOLDERS add events to the loaded folders
				$('.folder').click(function() {
					var selectedFolder = $(this);
					var url = '../control_panel/a_act_folders.php?folder=';
					var folderName = selectedFolder.find('span').text();
					var noSpaceName = encodeURIComponent(folderName);
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

