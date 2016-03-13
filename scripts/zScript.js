$(document).ready(function () {

	//collapse menu button for materialize
	$(".button-collapse").sideNav({
			edge: 'right',
			closeOnClick: true
	});
	
	// Initialize collapsible (uncomment the line below if you use the dropdown variation)
	$('.collapsible').collapsible();
	
	//parallax
	$('.parallax').parallax();
	
	//sliding gallery
	$(window).load(function() {
		// this will fire after the entire page is loaded, including images	
		//param is the navbar height of the page
		$(".sliderImages").slider_z(65);
	});
});

$(window).resize(function(){
	location.reload();
});
	