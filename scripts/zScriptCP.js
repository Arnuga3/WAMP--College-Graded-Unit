$(document).ready(function () {
	//collapse menu button for materialize
	$(".button-collapse").sideNav({
			edge: 'left',
			closeOnClick: true
	});	
	// Initialize collapsible (uncomment the line below if you use the dropdown variation)
	$('.collapsible').collapsible();
	reloadEvents();
});

function reloadEvents() {

	//parallax
	$('.parallax').parallax();
	
	//materialbox
	$('.materialboxed').materialbox();
	
	//modal
	$('.modal-trigger').leanModal();
	
	//characterCounter
	$('input#showrl_title, textarea#showrl_description, textarea#showrl_path').characterCounter();
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

function actionPhotosDo() {
	$('.a_act_p').click(function() {
		$('#mainContent').load('../control_panel/a_act_photos.php', function() {
			reloadEvents();
			
			
			//FOLDERS add events to the loaded folders
			$('.folder').click(function() {
				var selectedFolder = $(this);
				var url = '../control_panel/a_act_folders.php?folder=';
				var folderName = selectedFolder.find('span').text();
				var noSpaceName = folderName.replace(" ", "+");
				$('#mainContent').load( url + noSpaceName, function() {
					reloadEvents();
					actionPhotosDo();
				});
			});
		});
	});
}
actionPhotosDo();