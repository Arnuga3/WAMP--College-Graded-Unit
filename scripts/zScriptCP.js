$(document).ready(function () {
	//collapse menu button for materialize
	$(".button-collapse").sideNav({
			edge: 'left',
			closeOnClick: true
	});	
	// Initialize collapsible (uncomment the line below if you use the dropdown variation)
	$('.collapsible').collapsible();
	
		
	//set the height of the side menu once, then changed on window resize event (resize() function)
	$('#contField').height($(window).height() - 85 );
	
	//reload the main eventlisteners
	reloadEvents();
});

//resize the height of the side menu on big screens dynamically as it is fixed and scroll need to be allowed to access all links
function resize() {
	$('#contField').height($(window).height() - 85 );
}

function reloadEvents() {

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
	//to remove the darken bg and enable scrolling if back button is pressed
	$('.a_act_p').click(function() {
		if ($('#dark').css('display') == 'block') {
			enableScroll();
			$('#dark').toggle();
		}
	});
	//rename album function event listener
	$('.sb_rename').click(function() {
		var newName = prompt('Enter new name for the album:');
		if (newName != "" && newName != undefined) {
			renameAlbumAJAX(newName, $('.sb_rename_folder').text(), 'sysRenamearnuga3');
		}
	});
}


function checkIfChecked() {
	if ($('input:checked').length > 0) {
		$('#footer_modal').openModal();
		enableScroll();
	} else {
		alert("Please select photo(s) before moving!");
	}
}
function checkIfCheckedDel() {
	if ($('input:checked').length > 0) {
		deletePhotosAJAX($('.bread span').text(), getSelectedPhotos());
	} else {
		alert("Please select photo(s) you want to delete!");
	}
}


//////////////////////////////////////////////////////////////////////////////////////////////////
//jQuery AJAX function with a callback function to make plugins working with new loaded elements//
//////////////////////////////////////////////////////////////////////////////////////////////////

//CONTROL PANEL MENU

$('.a_shwrl').click(function() {
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

//loading the acting pictures part of the page using ajax and assigns eventlisteners to the loaded elements
function actPhotosLoad() {
	
	//load part of the page using ajax (folders with photos and photos without folders)
	$('#mainContent').load('../control_panel/a_act_photos.php', function() {
		//assign event listeners to new loaded elements
		reloadEvents();	
		
		//FOLDERS add events to the loaded folders
		$('.folder').click(function() {
			//load the images of selected folder using ajax and assign event listeners to them
			var selectedFolder = $(this);
			var url = '../control_panel/a_act_folders.php?folder=';
			var folderName = selectedFolder.find('span').text();
			//escape the string before passing it in url
			var noSpaceName = encodeURIComponent(folderName);
			$('#mainContent').load( url + noSpaceName, function() {
				reloadEvents();
				actionPhotosDo();
			});
		});
		//UPLOAD BTN IN SUB MENU EVENT REGISTRATION
		$('.sb_upload').click(function() {
			//make sure mobile button is closed and dark bg is hidden
			if ($('#dark').css('display') == 'block') {
				enableScroll();
				$('#dark').toggle();
			}
			//load the file upload part of the page using ajax and assign event listeners
			$('#mainContent').load('../control_panel/a_files_upload.php', function() {
				reloadEvents();
				actionPhotosDo();
				
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
						url: "../php tasks/file_upload.php", // php file
						type: 'post',
						data: formData,
						dataType: 'html', // return html from php file
						async: true,
						processData: false,  // tell jQuery not to process the data
						contentType: false,   // tell jQuery not to set contentType
						success : function() {
							//on success load the acting pictures part of the page again with new album and/or files
							actPhotosLoad();
						},
						error : function(request) {
							console.log(request.responseText);
						}
					});
				});
			});
		});
		//DELETE BTN IN SUB MENU EVENT REGISTRATION
		$('.sb_delete').click(function() {
			if ($('#dark').css('display') == 'block') {
				enableScroll();
				$('#dark').toggle();
			}
			$('#mainContent').load('../control_panel/a_delete_file.php', function() {
				reloadEvents();
				actionPhotosDo();
			});
		});
	});
}


function actionPhotosDo() {
	//click the acting photos button in the main menu
	$('.a_act_p').click(function() {
		//load part of the page using ajax (folders with photos and photos without folders)
		$('#mainContent').load('../control_panel/a_act_photos.php', function() {
			//assign event listeners to new loaded elements
			reloadEvents();	
			//FOLDERS add events to the loaded folders
			$('.folder').click(function() {
				//load the images of selected folder using ajax and assign event listeners to them
				var selectedFolder = $(this);
				var url = '../control_panel/a_act_folders.php?folder=';
				var folderName = selectedFolder.find('span').text();
				//escape the string before passing it in url
				var noSpaceName = encodeURIComponent(folderName);
				$('#mainContent').load( url + noSpaceName, function() {
					reloadEvents();
					actionPhotosDo();
				});
			});
			//UPLOAD BTN IN SUB MENU EVENT REGISTRATION
			$('.sb_upload').click(function() {
				//make sure mobile button is closed and dark bg is hidden
				if ($('#dark').css('display') == 'block') {
					enableScroll();
					$('#dark').toggle();
				}
				//load the file upload part of the page using ajax and assign event listeners
				$('#mainContent').load('../control_panel/a_files_upload.php', function() {
					reloadEvents();
					actionPhotosDo();
					
					$('#submitFormUpl').click(function() {
						$('.preload346').show();
					});
					
					$('#fileUploadForm').on('submit', function(e) {
						e.preventDefault();
						
						var formData = new FormData();
						
						formData.append('album_name', document.getElementById('file_upl_alb_name').value);
						
						//for each entry, add to formdata to later access via $_FILES["file" + i]
						for (var i = 0, len = document.getElementById('file').files.length; i < len; i++) {
							formData.append("file" + i, document.getElementById('file').files[i]);
						}
						
						//send formdata to server-side
						$.ajax({
							url: "../php tasks/file_upload.php", //php file
							type: 'post',
							data: formData,
							dataType: 'html', //return html from php file
							async: true,
							processData: false,  // tell jQuery not to process the data
							contentType: false,   // tell jQuery not to set contentType
							success : function() {
								actPhotosLoad();
							},
							error : function(request) {
								console.log(request.responseText);
							}
						});
					});
				});
			});
			//DELETE BTN IN SUB MENU EVENT REGISTRATION
			$('.sb_delete').click(function() {
				if ($('#dark').css('display') == 'block') {
					enableScroll();
					$('#dark').toggle();
				}
				$('#mainContent').load('../control_panel/a_delete_file.php', function() {
					reloadEvents();
					actionPhotosDo();
				});
			});
		});
	});
	
	//UPLOAD BTN IN SUB MENU EVENT REGISTRATION
	$('.sb_upload').click(function() {
		if ($('#dark').css('display') == 'block') {
			enableScroll();
			$('#dark').toggle();
		}
		$('#mainContent').load('../control_panel/a_files_upload.php', function() {
			reloadEvents();
			actionPhotosDo();
		});
	});
	//DELETE BTN IN SUB MENU EVENT REGISTRATION
	$('.sb_delete').click(function() {
		if ($('#dark').css('display') == 'block') {
			enableScroll();
			$('#dark').toggle();
		}
		$('#mainContent').load('../control_panel/a_delete_file.php', function() {
			reloadEvents();
			actionPhotosDo();
		});
	});
}
actionPhotosDo();


//////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////Disable scrolling//////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////

// left: 37, up: 38, right: 39, down: 40,
// spacebar: 32, pageup: 33, pagedown: 34, end: 35, home: 36

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