/*
Author: Arnis Zelcs
Created: 22/03/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Control Panel view, plugin calls and event listeners
*/
$(document).ready(function () {
	//collapse menu button for materialize
	$(".button-collapse").sideNav({
			edge: 'left',
			closeOnClick: true
	});	
	// Initialize collapsible
	$('.collapsible').collapsible();
	
		
	//set the height of the side menu once, then changed on window resize event (resize() function)
	//solve the problem of a menu display
	$('#contField').height($(window).height() - 85 );
	
	
////////////
////MENU////
////////////

	//SHOWREEL button click event listener
	$('.a_shwrl').click(function() {
		
		$('.preload346').fadeIn(500);
		
		//load a showreel part of a page
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
	});
	
	//CV button click event listener
	$('.a_cv').click(function() {
		
		$('.preload346').fadeIn(200);
		
		//load a part of a page
		$('#mainContent').load('../control_panel/a_cv.php', function() {
			reloadEvents();		
			CV_events();
			
			//This hardcoding is used to fix unexpected result with the materialize forms loaded using AJAX
			//focus(does the job)
			$('input').focus();
			//focus and unfocus
			$('textarea').focus();
			$('input:first').focus().blur();
			//scroll to the top of the page
			$('body').scrollTop(0);
		
		});
	});

	//ACTING PHOTOS button click event listener
	$('.a_act_p').click(function() {
		
		$('.preload346').fadeIn(200);
			
		//load a part of the page using ajax (folders with photos and photos without folders)
		$('#mainContent').load('../control_panel/acting/a_act_photos.php', function() {
			
			//assign event listeners to new loaded elements
			reloadEvents();
			
			//FOLDERS
			$('.folder').click(function() {

				$('.preload346').fadeIn(200);

				
				//load the images of selected folder using ajax and assign event listeners to them
				var selectedFolder = $(this);
				var folderName = selectedFolder.find('span').text();
				
				//escape the string before passing it in url
				var noSpaceName = encodeURIComponent(folderName);
				$('#mainContent').load("../control_panel/acting/a_act_folders.php?folder=" + noSpaceName, function() {
					reloadEvents();
					
					//RENAME ALBUM - inside as rename option is available only in the folder
					renameAlbum(0);
					photosUploadScr(0, $('.sb_rename_folder').text());
					
					//add event listeners
					reload_photos('.nav-wrapper', 0);
					reload_photos('.sub_nav', 0);
					reload_photos('.fixed-action-btn', 0);
				});
			});
			
			//UPLOAD SCREEN
			photosUploadScr(0, "");
		});
	});
	
	//GIG PHOTOS button click event listener
	$('.a_gig_p').click(function() {

		$('.preload346').fadeIn(200);
		
		//load a part of the page using ajax (folders with photos and photos without folders)
		$('#mainContent').load('../control_panel/gig/a_gig_photos.php', function() {
			
			//assign event listeners to new loaded elements
			reloadEvents();
			
			//FOLDERS
			$('.folder').click(function() {
				
				$('.preload346').fadeIn(200);

				//load the images of selected folder using ajax and assign event listeners to them
				var selectedFolder = $(this);
				var folderName = selectedFolder.find('span').text();
				
				//escape the string before passing it in url
				var noSpaceName = encodeURIComponent(folderName);
				$('#mainContent').load("../control_panel/gig/a_gig_folders.php?folder=" + noSpaceName, function() {
					reloadEvents();
					
					//RENAME ALBUM - inside as rename option is available only in the folder
					renameAlbum(1);
					photosUploadScr(1, $('.sb_rename_folder').text());
					
					//add event listene
					reload_photos('.nav-wrapper', 1);
					reload_photos('.sub_nav', 1);
					reload_photos('.fixed-action-btn', 1);
				});
			});
			
			//UPLOAD SCREEN
			photosUploadScr(1, "");
		});
	});
	
	
	
	
	//ACTING VIDEOS button click event listener
	$('.a_act_v').click(function() {
		
		$('.preload346').fadeIn(200);
		
		//load a part of the page using ajax (folders with photos and photos without folders)
		$('#mainContent').load('../control_panel/acting/a_act_videos.php', function() {
			
			//assign event listeners to new loaded elements
			reloadEvents();
			
			//FOLDERS
			$('.folder').click(function() {

				$('.preload346').fadeIn(200);

				
				//load the images of selected folder using ajax and assign event listeners to them
				var selectedFolder = $(this);
				var folderName = selectedFolder.find('span').text();
				
				//escape the string before passing it in url
				var noSpaceName = encodeURIComponent(folderName);
				$('#mainContent').load("../control_panel/acting/a_act_folders_v.php?folder=" + noSpaceName, function() {
					reloadEvents();
					
					//RENAME ALBUM - inside as rename option is available only in the folder
					renameAlbum(0);
					videoUploadScr(0, $('.sb_rename_folder').text());
					
					//add event listeners
					reload_videos('.nav-wrapper', 0);
					reload_videos('.sub_nav', 0);
					reload_videos('.fixed-action-btn', 0);
				});
			});
			
			//UPLOAD SCREEN
			videoUploadScr(0, "");
		});
	});
	//GIG PHOTOS button click event listener
	$('.a_gig_v').click(function() {

		$('.preload346').fadeIn(200);
		
		//load a part of the page using ajax (folders with photos and photos without folders)
		$('#mainContent').load('../control_panel/gig/a_gig_videos.php', function() {
			
			//assign event listeners to new loaded elements
			reloadEvents();
			
			//FOLDERS
			$('.folder').click(function() {
				
				$('.preload346').fadeIn(200);

				//load the images of selected folder using ajax and assign event listeners to them
				var selectedFolder = $(this);
				var folderName = selectedFolder.find('span').text();
				
				//escape the string before passing it in url
				var noSpaceName = encodeURIComponent(folderName);
				$('#mainContent').load("../control_panel/gig/a_gig_folders_v.php?folder=" + noSpaceName, function() {
					reloadEvents();
					
					//RENAME ALBUM - inside as rename option is available only in the folder
					renameAlbum(1);
					videoUploadScr(1, $('.sb_rename_folder').text());
					
					//add event listene
					reload_photos('.nav-wrapper', 1);
					reload_photos('.sub_nav', 1);
					reload_photos('.fixed-action-btn', 1);
				});
			});
			
			//UPLOAD SCREEN
			videoUploadScr(1, "");
		});
	});
	
	
	
	//reload the main eventlisteners
	reloadEvents();
});


//resize the height of the side menu on big screens dynamically as it is fixed and scroll need to be allowed to access all links
function resize() {
	$('#contField').height($(window).height() - 85 );
}

//add event listeners to elements
function reload_photos(elem, nr) {
	
	var nr = nr;
	var type = ['.a_act_p', '.a_gig_p'];
	var typeURL = ['../control_panel/acting/a_act_photos.php', '../control_panel/gig/a_gig_photos.php'];
	var typeURLF = ["../control_panel/acting/a_act_folders.php?folder=", "../control_panel/gig/a_gig_folders.php?folder="];
	
	$(elem).find(type[nr]).click(function() {
		
		$('.preload346').fadeIn(200);
			
		//load part of the page using ajax (folders with photos and photos without folders)
		$('#mainContent').load(typeURL[nr], function() {
			//assign event listeners to new loaded elements
			reloadEvents();
			
			//FOLDERS
			$('.folder').click(function() {

				$('.preload346').fadeIn(200);

				
				//load the images of selected folder using ajax and assign event listeners to them
				var selectedFolder = $(this);
				var folderName = selectedFolder.find('span').text();
				//escape the string before passing it in url
				var noSpaceName = encodeURIComponent(folderName);
				$('#mainContent').load(typeURLF[nr] + noSpaceName, function() {
					reloadEvents();
					//RENAME ALBUM - inside as rename option is available only in the folder
					renameAlbum(nr);
					photosUploadScr(nr, $('.sb_rename_folder').text());
					
					reload_photos('.nav-wrapper', nr);
					reload_photos('.sub_nav', nr);
					reload_photos('.fixed-action-btn', nr);
				});
			});
			
			//UPLOAD SCREEN
			photosUploadScr(nr, "");
		});
	});
}



//add event listeners to elements
function reload_videos(elem, nr) {
	
	var nr = nr;
	var type = ['.a_act_v', '.a_gig_v'];
	var typeURL = ['../control_panel/acting/a_act_videos.php', '../control_panel/gig/a_gig_videos.php'];
	var typeURLF = ["../control_panel/acting/a_act_folders_v.php?folder=", "../control_panel/gig/a_gig_folders_v.php?folder="];
	
	$(elem).find(type[nr]).click(function() {
		
		$('.preload346').fadeIn(200);
			
		//load part of the page using ajax (folders with photos and photos without folders)
		$('#mainContent').load(typeURL[nr], function() {
			//assign event listeners to new loaded elements
			reloadEvents();
			
			//FOLDERS
			$('.folder').click(function() {

				$('.preload346').fadeIn(200);

				
				//load the images of selected folder using ajax and assign event listeners to them
				var selectedFolder = $(this);
				var folderName = selectedFolder.find('span').text();
				//escape the string before passing it in url
				var noSpaceName = encodeURIComponent(folderName);
				$('#mainContent').load(typeURLF[nr] + noSpaceName, function() {
					reloadEvents();
					//RENAME ALBUM - inside as rename option is available only in the folder
					renameAlbum(nr);
					videoUploadScr(nr, $('.sb_rename_folder').text());
					
					reload_videos('.nav-wrapper', nr);
					reload_videos('.sub_nav', nr);
					reload_videos('.fixed-action-btn', nr);
				});
			});
			
			//UPLOAD SCREEN
			videoUploadScr(nr, "");
		});
	});
}



//////////////////////////////
////RELOAD EVENT LISTENERS////
//////////////////////////////
function reloadEvents() {
	
	
////////////
////MAIN////
////////////

	$('.preload346').hide();
	
	//parallax
	$('.parallax').parallax();
	
	//materialbox
	$('.materialboxed').materialbox();
	
	//modal
	$('.modal-trigger').leanModal();
	$('.modal-trigger-move').leanModal();
	
	//footer modal in CP
	$('.foot_mod').click(function() {
		$('#footer_modal').closeModal();
	});
	
	//characterCounter
	$('input#showrl_title, textarea#showrl_description, textarea#showrl_path').characterCounter();
	
	
//////////////////////	
////DARK BG EFFECT////
//////////////////////
	
	//to make bg darker when mobile menu is open
	$('.fire_dark').click(function() {
		$('#dark').css({'opacity':'0.9', 'z-index':'200'});
		$('#dark').toggle();
		if ($('#dark').css('display') == 'block') {
			disableScroll();
		} else {
			enableScroll();
		}
	});
	
	//remove the darken bg and enable scrolling
	$('.a_act_p, .sb_delete, .sb_upload, .sb_edit').click(function() {
		if ($('#dark').css('display') == 'block') {
			enableScroll();
			$('#dark').toggle();
		}
	});
	
	//check/uncheck all checkboxes event
	$('#selectAllBtn').click(function() {
		if ($("input[type='checkbox']").is( ":checked" )) {
			$("input[type='checkbox']").prop({
			  checked: false
			});
		} else {
			$("input[type='checkbox']").prop({
			  checked: true
			});
		}
	});
}

//RENAME ALBUM OPTION
function renameAlbum(typeNr) {
		
	//RENAME BTN 
	$('.sb_rename').click(function() {
		var newName = prompt('Enter a new name for the album:');
		if (newName != "" && newName != undefined) {
			
			//param 2 - to define action on server
			renameAlbumAJAX(newName, $('.sb_rename_folder').text(), 'sysRenamearnuga3', typeNr);
		} else {
			alert("Error. A new name is not provided.");
		}
	});
}

//LOADS PHOTOS FIRST SCREEN
function photosLoad(typeNr) {

	$('.preload346').fadeIn(200);

	
	var afterLoadTypeURL = ["../control_panel/acting/a_act_photos.php", "../control_panel/gig/a_gig_photos.php"];
	var afterLoadTypeFolder = ["../control_panel/acting/a_act_folders.php?folder=", "../control_panel/gig/a_gig_folders.php?folder="];
	
	//load part of the page using ajax (folders with photos and photos without folders)
	$('#mainContent').load(afterLoadTypeURL[typeNr], function() {
		reloadEvents();
		photosUploadScr(typeNr, "");

		//FOLDERS
		$('.folder').click(function() {

			$('.preload346').fadeIn(200);

			
			//load the images of selected folder using ajax and assign event listeners to them
			var selectedFolder = $(this);
			var folderName = selectedFolder.find('span').text();
			//escape the string before passing it in url
			var noSpaceName = encodeURIComponent(folderName);
			$('#mainContent').load(afterLoadTypeFolder[typeNr] + noSpaceName, function() {
				reloadEvents();
				//RENAME ALBUM - inside as rename option is available only in the folder
				renameAlbum(typeNr);
				photosUploadScr(typeNr, noSpaceName);
				
				reload_photos('.nav-wrapper', typeNr);
				reload_photos('.sub_nav', typeNr);
				reload_photos('.fixed-action-btn', typeNr);
			});
		});
	});
}



//LOADS VIDEOS FIRST SCREEN
function videosLoad(typeNr) {

	$('.preload346').fadeIn(200);

	
	var afterLoadTypeURL = ["../control_panel/acting/a_act_videos.php", "../control_panel/gig/a_gig_videos.php"];
	var afterLoadTypeFolder = ["../control_panel/acting/a_act_folders_v.php?folder=", "../control_panel/gig/a_gig_folders_v.php?folder="];
	
	//load part of the page using ajax (folders with photos and photos without folders)
	$('#mainContent').load(afterLoadTypeURL[typeNr], function() {
		reloadEvents();
		videoUploadScr(typeNr, "");

		//FOLDERS
		$('.folder').click(function() {

			$('.preload346').fadeIn(200);

			
			//load the images of selected folder using ajax and assign event listeners to them
			var selectedFolder = $(this);
			var folderName = selectedFolder.find('span').text();
			//escape the string before passing it in url
			var noSpaceName = encodeURIComponent(folderName);
			$('#mainContent').load(afterLoadTypeFolder[typeNr] + noSpaceName, function() {
				reloadEvents();
				//RENAME ALBUM - inside as rename option is available only in the folder
				renameAlbum(typeNr);
				videoUploadScr(typeNr, noSpaceName);
				
				reload_videos('.nav-wrapper', typeNr);
				reload_videos('.sub_nav', typeNr);
				reload_videos('.fixed-action-btn', typeNr);
			});
		});
	});
}


//LOADS PHOTOS IN FOLDER
function photosLoadFolder(typeNr, folderNoSpace) {
	
	$('.preload346').fadeIn(200);

	var afterLoadTypeURL = ["../control_panel/acting/a_act_photos.php", "../control_panel/gig/a_gig_photos.php"];
	var folderTypeURL = ["../control_panel/acting/a_act_folders.php?folder=", "../control_panel/gig/a_gig_folders.php?folder="];
	
	$('#mainContent').load(folderTypeURL[typeNr] + folderNoSpace, function() {
		//if no photos left in a folder load the first screen
		if ($('#cpCont div').length == false) {
			
			$('.preload346').fadeIn(200);

			//load part of the page using ajax (folders with photos and photos without folders)
			$('#mainContent').load(afterLoadTypeURL[typeNr], function() {
				reloadEvents();
				photosUploadScr(typeNr, "");
				
			});
		} else {
			reloadEvents();
			photosUploadScr(typeNr, folderNoSpace);
			
			reload_photos('.nav-wrapper', typeNr);
			reload_photos('.sub_nav', typeNr);
			reload_photos('.fixed-action-btn', typeNr);
		}
	});
}



//LOADS VIDEOS IN FOLDER
function videosLoadFolder(typeNr, folderNoSpace) {
	
	$('.preload346').fadeIn(200);

	var afterLoadTypeURL = ["../control_panel/acting/a_act_videos.php", "../control_panel/gig/a_gig_videos.php"];
	var folderTypeURL = ["../control_panel/acting/a_act_folders_v.php?folder=", "../control_panel/gig/a_gig_folders_v.php?folder="];
	
	$('#mainContent').load(folderTypeURL[typeNr] + folderNoSpace, function() {
		//if no photos left in a folder load the first screen
		if ($('#cpCont div').length == false) {
			
			$('.preload346').fadeIn(200);

			//load part of the page using ajax (folders with photos and photos without folders)
			$('#mainContent').load(afterLoadTypeURL[typeNr], function() {
				reloadEvents();
				videoUploadScr(typeNr, "");
				
			});
		} else {
			reloadEvents();
			videoUploadScr(typeNr, folderNoSpace);
			
			reload_videos('.nav-wrapper', typeNr);
			reload_videos('.sub_nav', typeNr);
			reload_videos('.fixed-action-btn', typeNr);
		}
	});
}


//LOADS THE UPLOAD SCREEN
function photosUploadScr(typeNr, folderNoSpace) {
	
	var uplTypeURL = ["../control_panel/acting/a_act_upload.php?folder=", "../control_panel/gig/a_gig_upload.php?folder="];

	//UPLOAD BTN
	$('.sb_upload').click(function() {

		$('.preload346').fadeIn(200);

		//load the file upload part of the page using ajax and assign event listeners
		$('#mainContent').load(uplTypeURL[typeNr] + folderNoSpace, function() {
			reloadEvents();
			
			reload_photos('.nav-wrapper', typeNr);
			reload_photos('.sub_nav', typeNr);
			reload_photos('.fixed-action-btn', typeNr);
			
			$('#submitFormUpl').click(function() {
				$('.preload346').fadeIn(200);
			});
			
			//0 is acting
			fileUploadSubm(typeNr);
		});
	});
}

//LOADS THE UPLOAD SCREEN
function videoUploadScr(typeNr, folderNoSpace) {
	
	var uplTypeURL = ["../control_panel/acting/a_act_upload_v.php?folder=", "../control_panel/gig/a_gig_upload_v.php?folder="];

	//UPLOAD BTN
	$('.sb_upload').click(function() {

		$('.preload346').fadeIn(200);

		//load the file upload part of the page using ajax and assign event listeners
		$('#mainContent').load(uplTypeURL[typeNr] + folderNoSpace, function() {
			reloadEvents();
			
			reload_videos('.nav-wrapper', typeNr);
			reload_videos('.sub_nav', typeNr);
			reload_videos('.fixed-action-btn', typeNr);
			
			$('#submitVideoAddForm').click(function() {
				$('.preload346').fadeIn(200);
			});
			
			//0 is acting
			videoUploadSubm(typeNr);
		});
	});
}

//PHOTOS UPLOAD
function fileUploadSubm(typeNr) {
	
	var uplTypeURL = ["../php_tasks/file_upload_act.php", "../php_tasks/file_upload_gig.php"];
	
	//submission of the files to upload, using formData object and jQuery ajax function
	$('#fileUploadForm').on('submit', function(e) {
		//prevent default form submission
		e.preventDefault();
		
		var formData = new FormData();
		
		//add the album name to the formData object(accessed using $_POST in PHP file)
		formData.append('album_name', document.getElementById('file_upl_alb_name').value);
		
		//for each entry, add to formdata to later access via $_FILES["file" + i]
		for (var i = 0, len = document.getElementById('file').files.length; i < len; i++) {
			formData.append("file" + i, document.getElementById('file').files[i]);
		}
		
		//send formdata to server-side
		$.ajax({
			url: uplTypeURL[typeNr], // php file
			type: 'post',
			data: formData,
			dataType: 'html', // return html from php file
			async: true,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			success : function() {
				//on success load the acting pictures part of the page again with new album and/or files
				photosLoad(typeNr);
			},
			error : function(request) {
				console.log(request.responseText);
			}
		});
	});
}


//VIDEO UPLOAD
function videoUploadSubm(typeNr) {
	
	var uplTypeURL = ["../php_tasks/video_add_act.php", "../php_tasks/video_add_gig.php"];
	
	//submission of the files to upload, using formData object and jQuery ajax function
	$('#videoAddForm').on('submit', function(e) {
		//prevent default form submission
		e.preventDefault();
		
		var formData = new FormData();
		
		//send formdata to server-side
		$.ajax({
			url: uplTypeURL[typeNr], // php file
			type: 'post',
			data: formData,
			dataType: 'html', // return html from php file
			async: true,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			success : function() {
				//on success load the acting pictures part of the page again with new album and/or files
				videosLoad(typeNr);
			},
			error : function(request) {
				console.log(request.responseText);
			}
		});
	});
}


function CV_events() {
	block1Event();
	block3Event();
	
	//Training Block2
	addTraining();
	deleteTrainingID();
	saveTrainingByID();
	
	//Film/TV Block4
	addFilm();
	deleteFilmID();
	saveFilmByID();
	
	//Theatre Block5
	addTheatre();
	deleteTheatreID();
	saveTheatreByID();
}

function block1Event() {
	//CV Block 1 SAVE
	$('.saveBlock1').click(function() {
		
		var formData = new FormData(document.getElementById("formblock1"));
		
		//send formdata to server-side
		$.ajax({
			url: "../php_tasks/cv/cv_save_block1.php", // php file
			type: 'post',
			data: formData,
			dataType: 'html', // return html from php file
			async: true,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			success : function(data) {
				
				Materialize.toast(data, 1500, 'rounded');
				if ($('#dark').css('display') == 'block') {
					enableScroll();
					$('#dark').toggle();
				}
				
			}
		});
		
	});
}

function block3Event() {
	//CV Block 1 SAVE
	$('.saveBlock3').on('click', function() {
	
		var formData = new FormData(document.getElementById("formblock3"));
		
		//send formdata to server-side
		$.ajax({
			url: "../php_tasks/cv/cv_save_block3.php", // php file
			type: 'post',
			data: formData,
			dataType: 'html', // return html from php file
			async: true,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			success : function(data) {
				
				Materialize.toast(data, 1500, 'rounded');
				if ($('#dark').css('display') == 'block') {
					enableScroll();
					$('#dark').toggle();
				}
				
			}
		});
		
	});
}


//////////////////////
///////Training///////
//////////////////////


function saveTrainingByID() {
	
	//save training button click
	$('.saveTraining').on('click', function() {
		
		//get the parent to find an id
		var input = $(this).parent().prev().find('input');
		var id = input.attr('ID');
		var value = input.val();
		
		//new formData object
		var formData = new FormData();
		
		//add values
		formData.append('trainingID', id);
		formData.append('trainingIDVal', value);
		
		//send formdata to a server
		$.ajax({
			url: "../php_tasks/cv/cv_save_traing.php", // php file
			type: 'post',
			data: formData,
			dataType: 'html', // return html from php file
			async: true,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			success : function(data) {
				
				//Toast
				Materialize.toast(data, 1500, 'rounded');
				if ($('#dark').css('display') == 'block') {
					enableScroll();
					$('#dark').toggle();
				}
				
			}
		});
	});
}

function deleteTrainingID() {
	
	//delete button click
	$('.deleteTraining').on('click', function() {
		
		//get the parent to find an id
		var parentDiv = $(this).parent().parent();
		var input = $(this).parent().prev().find('input');
		var id = input.attr('ID');
		
		var formData = new FormData();
		formData.append('trainingID', id);
		
		//send formdata to server-side
		$.ajax({
			url: "../php_tasks/cv/cv_delete_traing.php", // php file
			type: 'post',
			data: formData,
			dataType: 'html', // return html from php file
			async: true,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			success : function(data) {

				//Hide after deletion in database
				parentDiv.fadeOut(1000);
				
				//Toast
				Materialize.toast(data, 1500, 'rounded');
				if ($('#dark').css('display') == 'block') {
					enableScroll();
					$('#dark').toggle();
				}
				
			}
		});
	});
}

function addTraining() {
	
	//add a new training button click
	$('.newTrainingBtn').on('click', function() {

		var input = $(this).prev().find('input');
		var attr = input.attr('NAME');
		var value = input.val();
		
		var formData = new FormData();
		formData.append(attr, value);
		
		//send formdata to server-side
		$.ajax({
			url: "../php_tasks/cv/cv_add_trainig.php", // php file
			type: 'post',
			data: formData,
			dataType: 'html', // return html from php file
			async: true,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			success : function(data) {

				//add new training record with supporting buttons to HTML
				var newRecord = $(data).insertBefore('.addTrainingField').hide();
				
				//slowly appear
				newRecord.fadeIn(1000);
				
				//apply styles to a new element
				newRecord.css({
					'background-color': 'rgba(0,0,0,.1)',
					'border-radius': '5px'
				});
				
				
				//This hardcoding is used to fix unexpected result with the materialize forms loaded using AJAX
				//focus/focusout(does the job)
				newRecord.find('input').focus().blur();
				
				//add eventlistener to a new save button related to the added record
				newRecord.find('.saveTraining').on('click', function() {
					var input = $(this).parent().prev().find('input');
					var id = input.attr('ID');
					var value = input.val();
					
					var formData = new FormData();
					formData.append('trainingID', id);
					formData.append('trainingIDVal', value);
					
					//send formdata to server-side
					$.ajax({
						url: "../php_tasks/cv/cv_save_traing.php", // php file
						type: 'post',
						data: formData,
						dataType: 'html', // return html from php file
						async: true,
						processData: false,  // tell jQuery not to process the data
						contentType: false,   // tell jQuery not to set contentType
						success : function(data) {
							
							Materialize.toast(data, 1500, 'rounded');
							if ($('#dark').css('display') == 'block') {
								enableScroll();
								$('#dark').toggle();
							}
							
						}
					});
				});
				
				//add eventlistener to a new delete button related to the added record
				newRecord.find('.deleteTraining').on('click', function() {
					var parentDiv = $(this).parent().parent();
					var input = $(this).parent().prev().find('input');
					var id = input.attr('ID');
					
					var formData = new FormData();
					formData.append('trainingID', id);
					
					//send formdata to server-side
					$.ajax({
						url: "../php_tasks/cv/cv_delete_traing.php", // php file
						type: 'post',
						data: formData,
						dataType: 'html', // return html from php file
						async: true,
						processData: false,  // tell jQuery not to process the data
						contentType: false,   // tell jQuery not to set contentType
						success : function(data) {

							//Hide after deletion in DB
							parentDiv.fadeOut(1000);
							
							Materialize.toast(data, 1500, 'rounded');
							if ($('#dark').css('display') == 'block') {
								enableScroll();
								$('#dark').toggle();
							}
							
						}
					});
				});
				
				//clear the input field
				$('.addTrainingField div input').val('');
				
				//Toast
				Materialize.toast('Added', 1500, 'rounded');
				if ($('#dark').css('display') == 'block') {
					enableScroll();
					$('#dark').toggle();
				}
				
			}
		});
	});
}


///////////////////////////
/////////Films/TV//////////
///////////////////////////


function saveFilmByID() {
	
	//save a filt/TV record button click
	$('.saveFilm').on('click', function() {
		
		//find a main DIV
		var parentDiv = $(this).parent().parent();
		
		//get data from the main DIV
		var id = parentDiv.attr('ID');
		var year = parentDiv.find("input[name*='year']").val();
		var role = parentDiv.find("input[name*='role']").val();
		var production = parentDiv.find("input[name*='production']").val();
		var director = parentDiv.find("input[name*='director']").val();
		var company = parentDiv.find("input[name*='company']").val();
		
		//ad data to the formData object
		var formData = new FormData();
		formData.append('filmID', id);
		formData.append('year', year);
		formData.append('role', role);
		formData.append('production', production);
		formData.append('director', director);
		formData.append('company', company);
		
		//send formdata to server-side
		$.ajax({
			url: "../php_tasks/cv/cv_save_film_tv.php", // php file
			type: 'post',
			data: formData,
			dataType: 'html', // return html from php file
			async: true,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			success : function(data) {
				
				//Toast
				Materialize.toast(data, 1500, 'rounded');
				if ($('#dark').css('display') == 'block') {
					enableScroll();
					$('#dark').toggle();
				}
				
			}
		});
	});
}

function deleteFilmID() {
	
	//delete a filt/TV record button click
	$('.deleteFilm').on('click', function() {
		
		//find a main DIV
		var parentDiv = $(this).parent().parent();
		
		//get data from the main DIV
		var id = parentDiv.attr('ID');
		
		var formData = new FormData();
		formData.append('filmID', id);
		
		//send formdata to server-side
		$.ajax({
			url: "../php_tasks/cv/cv_delete_film_tv.php", // php file
			type: 'post',
			data: formData,
			dataType: 'html', // return html from php file
			async: true,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			success : function(data) {

				//Hide after deletion in DB
				parentDiv.fadeOut(1000);
				
				//Toast
				Materialize.toast(data, 1500, 'rounded');
				if ($('#dark').css('display') == 'block') {
					enableScroll();
					$('#dark').toggle();
				}
				
			}
		});
	});
}

function addFilm() {
	
	//add a new filt/TV record button click
	$('.newFilmgBtn').on('click', function() {
		
		//find a main DIV
		var parentDiv = $(this).parent();
		var year = parentDiv.find("input[name*='year']").val();
		var role = parentDiv.find("input[name*='role']").val();
		var production = parentDiv.find("input[name*='production']").val();
		var director = parentDiv.find("input[name*='director']").val();
		var company = parentDiv.find("input[name*='company']").val();
		
		//ad data to the formData object
		var formData = new FormData();
		formData.append('year', year);
		formData.append('role', role);
		formData.append('production', production);
		formData.append('director', director);
		formData.append('company', company);
		
		//send formdata to server-side
		$.ajax({
			url: "../php_tasks/cv/cv_add_film_tv.php", // php file
			type: 'post',
			data: formData,
			dataType: 'html', // return html from php file
			async: true,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			success : function(data) {

				//add new training record with supporting buttons to HTML
				var newRecord = $(data).insertBefore('.addFilmField').hide();
				
				//slowly appear
				newRecord.fadeIn(1000);
				
				//apply styles to a new element
				newRecord.css({
					'background-color': 'rgba(0,0,0,.1)',
					'border-radius': '5px'
				});
				
				
				//This hardcoding is used to fix unexpected result with the materialize forms loaded using AJAX
				//focus/focusout(does the job)
				newRecord.find('input').focus().blur();
				
				//add eventlistener to a new save button related to the added record
				newRecord.find('.saveFilm').on('click', function() {
					
					//find a main DIV
					var parentDiv = $(this).parent().parent();
					
					//get data from the main DIV
					var id = parentDiv.attr('ID');
					var year = parentDiv.find("input[name*='year']").val();
					var role = parentDiv.find("input[name*='role']").val();
					var production = parentDiv.find("input[name*='production']").val();
					var director = parentDiv.find("input[name*='director']").val();
					var company = parentDiv.find("input[name*='company']").val();
					
					//ad data to the formData object
					var formData = new FormData();
					formData.append('filmID', id);
					formData.append('year', year);
					formData.append('role', role);
					formData.append('production', production);
					formData.append('director', director);
					formData.append('company', company);
					
					//send formdata to server-side
					$.ajax({
						url: "../php_tasks/cv/cv_save_film_tv.php", // php file
						type: 'post',
						data: formData,
						dataType: 'html', // return html from php file
						async: true,
						processData: false,  // tell jQuery not to process the data
						contentType: false,   // tell jQuery not to set contentType
						success : function(data) {
							
							//Toast
							Materialize.toast(data, 1500, 'rounded');
							if ($('#dark').css('display') == 'block') {
								enableScroll();
								$('#dark').toggle();
							}
							
						}
					});
				});
				
				//add eventlistener to a new delete button related to the added record
				newRecord.find('.deleteFilm').on('click', function() {
					
					//find a main DIV
					var parentDiv = $(this).parent().parent();
					
					//get data from the main DIV
					var id = parentDiv.attr('ID');
					
					var formData = new FormData();
					formData.append('filmID', id);
					
					//send formdata to server-side
					$.ajax({
						url: "../php_tasks/cv/cv_delete_film_tv.php", // php file
						type: 'post',
						data: formData,
						dataType: 'html', // return html from php file
						async: true,
						processData: false,  // tell jQuery not to process the data
						contentType: false,   // tell jQuery not to set contentType
						success : function(data) {

							//Hide after deletion in DB
							parentDiv.fadeOut(1000);
							
							Materialize.toast(data, 1500, 'rounded');
							if ($('#dark').css('display') == 'block') {
								enableScroll();
								$('#dark').toggle();
							}
							
						}
					});
				});
				
				//clear form fields here
				
				Materialize.toast('Added', 1500, 'rounded');
				if ($('#dark').css('display') == 'block') {
					enableScroll();
					$('#dark').toggle();
				}
				
			}
		});
	});
}



///////////////////////////
//////////Theatre//////////
///////////////////////////


function saveTheatreByID() {
	
	$('.saveTheatre').on('click', function() {
		
		//find a main DIV
		var parentDiv = $(this).parent().parent();
		
		//get data from the main DIV
		var id = parentDiv.attr('ID');
		var year = parentDiv.find("input[name*='year']").val();
		var role = parentDiv.find("input[name*='role']").val();
		var production = parentDiv.find("input[name*='production']").val();
		var director = parentDiv.find("input[name*='director']").val();
		var company = parentDiv.find("input[name*='company']").val();
		
		//ad data to the formData object
		var formData = new FormData();
		formData.append('theatreID', id);
		formData.append('year', year);
		formData.append('role', role);
		formData.append('production', production);
		formData.append('director', director);
		formData.append('company', company);
		
		//send formdata to server-side
		$.ajax({
			url: "../php_tasks/cv/cv_save_theatre.php", // php file
			type: 'post',
			data: formData,
			dataType: 'html', // return html from php file
			async: true,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			success : function(data) {
				
				Materialize.toast(data, 1500, 'rounded');
				if ($('#dark').css('display') == 'block') {
					enableScroll();
					$('#dark').toggle();
				}
				
			}
		});
	});
}

function deleteTheatreID() {
	$('.deleteTheatre').on('click', function() {
		
		//find a main DIV
		var parentDiv = $(this).parent().parent();
		
		//get data from the main DIV
		var id = parentDiv.attr('ID');
		
		var formData = new FormData();
		formData.append('theatreID', id);
		
		//send formdata to server-side
		$.ajax({
			url: "../php_tasks/cv/cv_delete_theatre.php", // php file
			type: 'post',
			data: formData,
			dataType: 'html', // return html from php file
			async: true,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			success : function(data) {

				//Hide after deletion in DB
				parentDiv.fadeOut(1000);
				
				Materialize.toast(data, 1500, 'rounded');
				if ($('#dark').css('display') == 'block') {
					enableScroll();
					$('#dark').toggle();
				}
				
			}
		});
	});
}

function addTheatre() {
	$('.newTheatregBtn').on('click', function() {
		
		//find a main DIV
		var parentDiv = $(this).parent();
		var year = parentDiv.find("input[name*='year']").val();
		var role = parentDiv.find("input[name*='role']").val();
		var production = parentDiv.find("input[name*='production']").val();
		var director = parentDiv.find("input[name*='director']").val();
		var company = parentDiv.find("input[name*='company']").val();
		
		//ad data to the formData object
		var formData = new FormData();
		formData.append('year', year);
		formData.append('role', role);
		formData.append('production', production);
		formData.append('director', director);
		formData.append('company', company);
		
		//send formdata to server-side
		$.ajax({
			url: "../php_tasks/cv/cv_add_theatre.php", // php file
			type: 'post',
			data: formData,
			dataType: 'html', // return html from php file
			async: true,
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			success : function(data) {

				//add new training record with supporting buttons to HTML
				var newRecord = $(data).insertBefore('.addTheatreField').hide();
				
				//slowly appear
				newRecord.fadeIn(1000);
				newRecord.css({
					'background-color': 'rgba(0,0,0,.1)',
					'border-radius': '5px'
				});
				
				
				//This hardcoding is used to fix unexpected result with the materialize forms loaded using AJAX
				//focus/focusout(does the job)
				newRecord.find('input').focus().blur();
				
				//add eventlistener to a new save button related to the added record
				newRecord.find('.saveTheatre').on('click', function() {
					//find a main DIV
					var parentDiv = $(this).parent().parent();
					//get data from the main DIV
					var id = parentDiv.attr('ID');
					var year = parentDiv.find("input[name*='year']").val();
					var role = parentDiv.find("input[name*='role']").val();
					var production = parentDiv.find("input[name*='production']").val();
					var director = parentDiv.find("input[name*='director']").val();
					var company = parentDiv.find("input[name*='company']").val();
					
					//ad data to the formData object
					var formData = new FormData();
					formData.append('theatreID', id);
					formData.append('year', year);
					formData.append('role', role);
					formData.append('production', production);
					formData.append('director', director);
					formData.append('company', company);
					
					//send formdata to server-side
					$.ajax({
						url: "../php_tasks/cv/cv_save_theatre.php", // php file
						type: 'post',
						data: formData,
						dataType: 'html', // return html from php file
						async: true,
						processData: false,  // tell jQuery not to process the data
						contentType: false,   // tell jQuery not to set contentType
						success : function(data) {
							
							Materialize.toast(data, 1500, 'rounded');
							if ($('#dark').css('display') == 'block') {
								enableScroll();
								$('#dark').toggle();
							}
							
						}
					});
				});
				
				//add eventlistener to a new delete button related to the added record
				newRecord.find('.deleteTheatre').on('click', function() {
					
					//find a main DIV
					var parentDiv = $(this).parent().parent();
					
					//get data from the main DIV
					var id = parentDiv.attr('ID');
					
					var formData = new FormData();
					formData.append('theatreID', id);
					
					//send formdata to server-side
					$.ajax({
						url: "../php_tasks/cv/cv_delete_theatre.php", // php file
						type: 'post',
						data: formData,
						dataType: 'html', // return html from php file
						async: true,
						processData: false,  // tell jQuery not to process the data
						contentType: false,   // tell jQuery not to set contentType
						success : function(data) {

							//Hide after deletion in DB
							parentDiv.fadeOut(1000);
							
							Materialize.toast(data, 1500, 'rounded');
							if ($('#dark').css('display') == 'block') {
								enableScroll();
								$('#dark').toggle();
							}
							
						}
					});
				});
				
				//clear form fields here
				
				Materialize.toast('Added', 1500, 'rounded');
				if ($('#dark').css('display') == 'block') {
					enableScroll();
					$('#dark').toggle();
				}
				
			}
		});
	});
}




///////////////////////////
/////Disable scrolling/////
///////////////////////////

/*
left: 37, up: 38, right: 39, down: 40
spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36
*/

var keys = {37: 1, 38: 1, 39: 1, 40: 1};

function preventDefault(e) {
	e = e || window.event;
	if (e.preventDefault)
		e.preventDefault();
		e.returnValue = false;  
}

function preventDefaultForScrollKeys(e) {
    if (keys[e.keyCode]) {
        preventDefault(e);
        return false;
    }
}

function disableScroll() {
	if (window.addEventListener) // older FF
		window.addEventListener('DOMMouseScroll', preventDefault, false);
		window.onwheel = preventDefault; // modern standard
		window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
		window.ontouchmove  = preventDefault; // mobile
		document.onkeydown  = preventDefaultForScrollKeys;
}

function enableScroll() {
    if (window.removeEventListener)
        window.removeEventListener('DOMMouseScroll', preventDefault, false);
		window.onmousewheel = document.onmousewheel = null; 
		window.onwheel = null; 
		window.ontouchmove = null;  
		document.onkeydown = null;  
}
//End of Disable scrolling