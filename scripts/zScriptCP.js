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