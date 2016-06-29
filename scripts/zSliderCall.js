/*
Author: Arnis Zelcs
Created: 13/03/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Sliding gallery plugin call
*/
$(window).load(function() {
	
	// this will fire after the entire page is loaded, including images	
	//param is the navbar height of the page
	$(".sliderImages").slider_z($('.navbar-fixed').height());
	setTimeout(function() {
		$('.preload345').hide();
	}, 1000);
});