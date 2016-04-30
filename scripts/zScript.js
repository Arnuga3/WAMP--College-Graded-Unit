$(document).ready(function () {

	//collapse menu button for materialize
	$(".button-collapse").sideNav({
			edge: 'right',
			closeOnClick: true
	});

	reloadEvents();

});

function reloadEvents() {
	
	$('.preload333').hide();
		
	// Initialize collapsible (uncomment the line below if you use the dropdown variation)
	$('.collapsible').collapsible();
	
	//parallax
	$('.parallax').parallax();
	
	//materialbox
	$('.materialboxed').materialbox();
	
	//modal
	$('.modal-trigger').leanModal();
	
	
	$('.u_act_p').click(function() {
		$('#contCont').load('user_views/a_act_photos.php', function() {
			reloadEvents();
			
			//FOLDERS
			$('.folder').click(function() {
				
				$('*').unbind('load');
				$('.preload333').show();

				
				//load the images of selected folder using ajax and assign event listeners to them
				var selectedFolder = $(this);
				var folderName = selectedFolder.find('p').text();
				//escape the string before passing it in url
				var noSpaceName = encodeURIComponent(folderName);
				$('#contCont').load("user_views/a_act_folders.php?folder=" + noSpaceName, function() {
					reloadEvents();
				});
			});
		});
	});
	
	$('.u_gig_p').click(function() {
		$('#contCont').load('user_views/a_gig_photos.php', function() {
			reloadEvents();
			
			//FOLDERS
			$('.folder').click(function() {
				
				$('*').unbind('load');
				$('.preload333').show();

				
				//load the images of selected folder using ajax and assign event listeners to them
				var selectedFolder = $(this);
				var folderName = selectedFolder.find('p').text();
				//escape the string before passing it in url
				var noSpaceName = encodeURIComponent(folderName);
				$('#contCont').load("user_views/a_gig_folders.php?folder=" + noSpaceName, function() {
					reloadEvents();
				});
			});
		});
	});
}

