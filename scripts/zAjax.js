/////////////////////////
////Multiuse Function////
/////////////////////////
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




function checkIfChecked() {
	if ($('input:checked').length > 0) {
		$('#footer_modal').openModal();
		enableScroll();
	} else {
		alert("Please select photo(s) before moving!");
	}
}

function checkIfCheckedDel(typeNr) {
	if ($('input:checked').length > 0) {
		deletePhotosAJAX($('.bread span:first').text(), getSelectedPhotos(), typeNr);
	} else {
		alert("Please select photo(s) you want to delete!");
	}
}

function checkIfCheckedEdit(typeNr) {
	if ($('input:checked').length > 0) {
		editPhotosAJAX($('.bread span:first').text(), getSelectedPhotos(), typeNr);
	} else {
		alert("Please select photo(s) you want to edit!");
	}
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

function moveToNewAlbum(typeNr) {
	var newName = prompt('New album name');
	if (newName != undefined && newName != "") {
		movePhotosAJAX(newName, getSelectedPhotos(), typeNr);
		console.log("move to a new album operation successful");
	} else {
		console.log("move to a new album operation canceled");
	}
}




////////////////////////
////Custom Functions////
////////////////////////

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


//EDIT PHOTOS FUNCTIONALITY
function editPhotosAJAX(folder, photos, typeNr) {
	
	//0 is acting, 1 is gig
	var editTypeURL = ["../control_panel/edit_photo_act.php", "../control_panel/edit_photo_gig.php"];
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
	var combined = {folder: folderNoSpace, photos: photos};
	
	//Sending data via POST using load() function
	$('#mainContent').load(editTypeURL[typeNr], combined, function() {
		reloadEvents();
		
		//This hardcoding is used to fix unexpected result with the materialize forms loaded using AJAX
		//focus(does the job)
		$('input').focus().blur();
		$('input:first').focus();
		//scroll to the top of the page
		$('body').scrollTop(0);
		
		//to remove dark background
		if ($('#dark').css('display') == 'block') {
			enableScroll();
			$('#dark').toggle();
		}
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
		} else {
			//acting/gig inside folder ajax screen, depends on typeNr(0-acting, 1-gig)
			photosLoadFolder(typeNr, folderNoSpace);
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
						renameAlbum(typeNr);
					});
				});
			});
		} else {
			//FOLDERS add events to the loaded folders
			$('#mainContent').load(folderTypeURL[typeNr] + folderNoSpace, function() {
				reloadEvents();
				renameAlbum(typeNr);
			});
		}
		Materialize.toast('Moved', 1500, 'rounded');
		if ($('#dark').css('display') == 'block') {
			enableScroll();
			$('#dark').toggle();
		}
	});
}


//SAVE PHOTO EDITS AJAX
function saveChangesEdit(typeNr) {
	
	var editPhotoDetails = ["../php_tasks/save_edit_act.php", "../php_tasks/save_edit_gig.php"];
	
	$('#photoEditForm').on('submit', function(e) {
		//prevent default form submission
		e.preventDefault();
		
		var formData = new FormData(document.getElementById("photoEditForm"));
		
		//send formdata to server-side
		$.ajax({
			url: editPhotoDetails[typeNr], // php file
			type: 'post',
			data: formData,
			dataType: 'html', // return html from php file
			async: true,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			success : function(data) {
				//on success load the acting pictures part of the page again with new album and/or files
				photosLoad(typeNr);
				Materialize.toast('Saved', 1500, 'rounded');
				if ($('#dark').css('display') == 'block') {
					enableScroll();
					$('#dark').toggle();
				}
			},
			error : function(request) {
				console.log(request.responseText);
			}
		});
	});
	$('#photoEditForm').submit();
}


//RENAME ALBUM FUNCTIONALITY (PHOTOS)
function renameAlbumAJAX(folder, folderOld, action, typeNr) {
	
	var albumRenameURL = ["../php_tasks/move_photo_act.php", "../php_tasks/move_photo_gig.php"];
	var afterLoadTypeURL = ["../control_panel/a_act_photos.php", "../control_panel/a_gig_photos.php"];
	var folderTypeURL = ["../control_panel/a_act_folders.php?folder=", "../control_panel/a_gig_folders.php?folder="];
	
	var folderName = folder;
	var folderNoSpace = encodeURIComponent(folderName);
	var folderOld = folderOld;
	var action = action;
	//use 'photos' is just for not breaking the server code instead of writing another script
	var combined = "folder=" + folderNoSpace + "&photos=" + folderOld + "&actionStr= " + action;
	
	//Third parameter is a callback function and is called only after the browser gets a response from server, jQuery approach
	saveChanges(albumRenameURL[typeNr], combined, function() {
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
					});
				});
			});
		} else {
			//FOLDERS add events to the loaded folders
			$('#mainContent').load(folderTypeURL[typeNr] + folderNoSpace, function() {
				reloadEvents();
			});
		}
		Materialize.toast('Renamed', 1500, 'rounded');
		if ($('#dark').css('display') == 'block') {
			enableScroll();
			$('#dark').toggle();
		}
	});
}

