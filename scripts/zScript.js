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
	
	$(".sliderImages img:last").load(function() {
		$(".sliderImages").slider_z();
	});
});