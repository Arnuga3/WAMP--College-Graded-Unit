/*
Author: Arnis Zelcs
Created: 30/03/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Main AJAX functions
*/

/////////////////////////
////Reusable Function////
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
			
			//Callback function is called only after response is received from a server
			if (typeof callback == "function") {
				callback();
			}
		}
	}

	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(vars);
}


//check if any photos are selected before moving
function checkIfChecked() {
	
	//open modal with other options to select
	if ($('input:checked').length > 0) {
		$('#footer_modal').openModal();
		enableScroll();
	} else {
		alert("Please select photo(s) before moving!");
	}
}

//check if any photos are selected to delete
function checkIfCheckedDel(typeNr) {
	
	if ($('input:checked').length > 0) {
		
		//param 1 - folder name or "" if main gallery
		//param 2 - ids of selected photos
		//param 3 - acting is 0, gig is 1
		deletePhotosAJAX($('.bread span:first').text(), getSelectedPhotos(), typeNr);
	} else {
		alert("Please select photo(s) you want to delete!");
	}
}

//check if any photos are selected to edit
function checkIfCheckedEdit(typeNr) {
	
	if ($('input:checked').length > 0) {
		
		//param 1 - folder name or "" if main gallery
		//param 2 - ids of selected photos
		//param 3 - acting is 0, gig is 1
		editPhotosAJAX($('.bread span:first').text(), getSelectedPhotos(), typeNr);
	} else {
		alert("Please select photo(s) you want to edit!");
	}
}


//get checked photos and prepare an URL string for a request
function getSelectedPhotos() {
	
	//to store checked element ids
	var checked = [];
	
	//to save ids in a string using a separator "p", used to combine data
	var toStr = "";
	$('input:checked').each(function() {
		checked.push($(this).attr("id"));
	});
	for (var i=0; i<checked.length; i++) {
		toStr += "p" + checked[i];
	}
	//return a result
	return toStr;
}



//MOVE TO NEW ALBUM FUNCTIONALITY
function moveToNewAlbum(typeNr) {
	var newName = prompt('New album name');
	
	//if a name is given
	if (newName != undefined && newName != "") {

		//param 1 - a new folder name
		//param 2 - ids of selected photos
		//param 3 - acting is 0, gig is 1
		movePhotosAJAX(newName, getSelectedPhotos(), typeNr);
		console.log("move to a new album operation successful");
	} else {
		console.log("move to a new album operation canceled");
	}
}


//SHOWREEL INFORMATION UPDATE FUNCTIONALITY
function saveShowreelData() {

	$('.preload346').show();
	
	//get values from input fields
	var title = $('#showrl_title').val();
	var description = $('#showrl_description').val();
	
	//video url
	var path = $('#showrl_path').val();
	
	
	//prepare for GET request
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
		
		//Toast
		Materialize.toast('Saved', 1500, 'rounded');
	});
}


//EDIT PHOTOS FUNCTIONALITY
function editPhotosAJAX(folder, photos, typeNr) {
	
	//index 0 is acting, index 1 is gig
	//urls to php scripts
	var editTypeURL = ["../control_panel/acting/edit_photo_act.php", "../control_panel/gig/edit_photo_gig.php"];
	var afterLoadTypeURL = ["../control_panel/acting/a_act_photos.php", "../control_panel/gig/a_gig_photos.php"];
	var folderTypeURL = ["../control_panel/acting/a_act_folders.php?folder=", "../control_panel/gig/a_gig_folders.php?folder="];
		
	$('.preload346').show();

	//outside the folder (main gallery), no span element to read the folder name from, so variable is equal to undefined, leave the empry string will push to save photos in main gallery (no album)
	if (folder == undefined) {
		var folderName = "";
	} else {
		var folderName = folder;
	}
	
	//prepare for GET request
	var folderNoSpace = encodeURIComponent(folderName);
	var photos = photos;
	
	//prepare data need to be send
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
	
	//index 0 is acting, index 1 is gig
	//urls to php scripts
	var delTypeURL = "../php_tasks/delete_photo.php";
	var afterLoadTypeURL = ["../control_panel/acting/a_act_photos.php", "../control_panel/gig/a_gig_photos.php"];
	var folderTypeURL = ["../control_panel/acting/a_act_folders.php?folder=", "../control_panel/gig/a_gig_folders.php?folder="];
		
	$('.preload346').show();

	
	//outside the folder (main gallery), no span element to read the folder name from, so variable is equal to undefined, leave the empry string will push to save photos in main gallery (no album)
	if (folder == undefined) {
		var folderName = "";
	} else {
		var folderName = folder;
	}
	
	//prepare for GET request
	var folderNoSpace = encodeURIComponent(folderName);
	var photos = photos;
	var combined = "folder=" + folderNoSpace + "&photos=" + photos;
	
	//Third parameter is a callback function and is called only after the browser gets a response from server, similar to jQuery approach
	saveChanges(delTypeURL, combined, function() {
		if (folderName == "") {
			//acting/gig first ajax screen, depends on typeNr(0-acting, 1-gig)
			photosLoad(typeNr);
		} else {
			//acting/gig inside folder ajax screen, depends on typeNr(0-acting, 1-gig)
			photosLoadFolder(typeNr, folderNoSpace);
		}
		
		//Toast
		Materialize.toast('Deleted', 1500, 'rounded');
		
		//Mobile view (small screens), remove dark background and enable scrolling
		if ($('#dark').css('display') == 'block') {
			enableScroll();
			$('#dark').toggle();
		}
	});
}


//MOVE PHOTOS FUNCTIONALITY (PHOTOS)
function movePhotosAJAX(folder, photos, typeNr) {
	
	$('.preload346').show();
	
	//index 0 is acting, index 1 is gig
	//urls to php scripts
	var moveTypeURL = "../php_tasks/move_photo.php";
	var afterLoadTypeURL = ["../control_panel/acting/a_act_photos.php", "../control_panel/gig/a_gig_photos.php"];
	var folderTypeURL = ["../control_panel/acting/a_act_folders.php?folder=", "../control_panel/gig/a_gig_folders.php?folder="];

	//prepare for GET request	
	var folderName = folder;
	var folderNoSpace = encodeURIComponent(folderName);

	var photos = photos;
	var combined = "folder=" + folderNoSpace + "&photos=" + photos;
	
	//Third parameter is a callback function and is called only after the browser gets a response from server, jQuery approach
	saveChanges(moveTypeURL, combined, function() {
		if (folderName == "") {
			$('#mainContent').load(afterLoadTypeURL[typeNr], function() {
				reloadEvents();
				//FOLDERS add events to the loaded folders
				$('.folder').click(function() {

					$('.preload346').show();
					
					//get folder name
					var selectedFolder = $(this);
					var folderName = selectedFolder.find('span').text();
					
					//prepare for GET request
					var noSpaceName = encodeURIComponent(folderName);
				
					//load content
					$('#mainContent').load(folderTypeURL[typeNr] + noSpaceName, function() {
						
						//add event listeners
						reloadEvents();
						renameAlbum(typeNr);
					});
				});
			});
		} else {
			//FOLDERS add events to the loaded folders
			$('#mainContent').load(folderTypeURL[typeNr] + folderNoSpace, function() {
				
				//add event listeners
				reloadEvents();
				renameAlbum(typeNr);
				
				reload_photos('.nav-wrapper', typeNr);
				reload_photos('.sub_nav', typeNr);
				reload_photos('.fixed-action-btn', typeNr);
			});
		}
		
		//Toast
		Materialize.toast('Moved', 1500, 'rounded');
		
		//Mobile view (small screens), remove dark background and enable scrolling
		if ($('#dark').css('display') == 'block') {
			enableScroll();
			$('#dark').toggle();
		}
	});
}


//SAVE PHOTO EDITS AJAX
function saveChangesEdit(typeNr) {
	
	$('.preload346').show();
	
	//script for editing a photo(s)
	var editPhotoDetails = "../php_tasks/edit_photo.php";
	
	$('#photoEditForm').on('submit', function(e) {
		//prevent default form submission
		e.preventDefault();
		
		//create a new formData object with values of the form
		var formData = new FormData(document.getElementById("photoEditForm"));
		
		//send formdata to a server
		$.ajax({
			//a php file
			url: editPhotoDetails,
			type: 'post',
			data: formData,
			//return html from a php file
			dataType: 'html',
			async: true,
			//tell jQuery not to process the data
			processData: false,
			//tell jQuery not to set contentType
			contentType: false,
			success : function(data) {
				
				//on success load the acting pictures part of the page again with new album and/or files
				photosLoad(typeNr);
				
				//Toast
				Materialize.toast('Saved', 1500, 'rounded');
				
				//Mobile view (small screens), remove dark background and enable scrolling		
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
	
	//submit a form
	$('#photoEditForm').submit();
}


//RENAME ALBUM FUNCTIONALITY (PHOTOS)
function renameAlbumAJAX(folder, folderOld, action, typeNr) {

	$('.preload346').show();

	//index 0 is acting, index 1 is gig
	//urls to php scripts
	var albumRenameURL = ["../php_tasks/move_photo.php", "../php_tasks/move_photo.php"];
	var afterLoadTypeURL = ["../control_panel/acting/a_act_photos.php", "../control_panel/gig/a_gig_photos.php"];
	var folderTypeURL = ["../control_panel/acting/a_act_folders.php?folder=", "../control_panel/gig/a_gig_folders.php?folder="];
	
	//prepare for GET request
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

					$('.preload346').show();

					var selectedFolder = $(this);
					var folderName = selectedFolder.find('span').text();
					var noSpaceName = encodeURIComponent(folderName);
					
					//load content
					$('#mainContent').load(folderTypeURL[typeNr] + noSpaceName, function() {
						reloadEvents();
					});
				});
			});
		} else {
			//FOLDERS add events to the loaded folders
			$('#mainContent').load(folderTypeURL[typeNr] + folderNoSpace, function() {
				
				//add event listeners
				reloadEvents();
				
				reload_photos('.nav-wrapper', typeNr);
				reload_photos('.sub_nav', typeNr);
				reload_photos('.fixed-action-btn', typeNr);
			});
		}
		
		//Toast
		Materialize.toast('Renamed', 1500, 'rounded');
		if ($('#dark').css('display') == 'block') {
			enableScroll();
			$('#dark').toggle();
		}
	});
}

