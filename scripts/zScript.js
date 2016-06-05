/*
Author: Arnis Zelcs
Created: 12/03/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: User view, plugin calls and event listeners
*/
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
		
	// Initialize collapsible
	$('.collapsible').collapsible();
	
	//parallax
	$('.parallax').parallax();
	
	//materialbox
	$('.materialboxed').materialbox();
	
	//modal
	$('.modal-trigger').leanModal();
	
	//user view acting photo click event listener
	$('.u_act_p').click(function() {
		$('#contCont').load('user_views/a_act_photos.php', function() {
			reloadEvents();
			
			//FOLDERS
			$('.folder').click(function() {
				
				
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
	
	//user view acting video click event listener
	$('.u_act_v').click(function() {
		$('#contCont').load('user_views/a_act_videos.php', function() {
			reloadEvents();
			
			//FOLDERS
			$('.folder').click(function() {
				
				
				$('.preload333').show();

				
				//load the images of selected folder using ajax and assign event listeners to them
				var selectedFolder = $(this);
				var folderName = selectedFolder.find('p').text();
				//escape the string before passing it in url
				var noSpaceName = encodeURIComponent(folderName);
				$('#contCont').load("user_views/a_act_folders_v.php?folder=" + noSpaceName, function() {
					reloadEvents();
				});
			});
		});
	});
	
	//user view gig photo click event listener
	$('.u_gig_p').click(function() {
		$('#contCont').load('user_views/a_gig_photos.php', function() {
			reloadEvents();
			
			//FOLDERS
			$('.folder').click(function() {
				
				
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
	
	//user view acting video click event listener
	$('.u_gig_v').click(function() {
		$('#contCont').load('user_views/a_gig_videos.php', function() {
			reloadEvents();
			
			//FOLDERS
			$('.folder').click(function() {
				
				
				$('.preload333').show();

				
				//load the images of selected folder using ajax and assign event listeners to them
				var selectedFolder = $(this);
				var folderName = selectedFolder.find('p').text();
				//escape the string before passing it in url
				var noSpaceName = encodeURIComponent(folderName);
				$('#contCont').load("user_views/a_gig_folders_v.php?folder=" + noSpaceName, function() {
					reloadEvents();
				});
			});
		});
	});
}

