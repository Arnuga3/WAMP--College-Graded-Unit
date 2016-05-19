/*
Author: Arnis Zelcs
Created: 12/03/2016

Graded Unit Project - Web Portfolio for Jamie Rodden

Script: Sliding gallery plugin
*/
$.fn.slider_z = function(navbarHeight) {

	$('body').css({'overflow-x': 'hidden'});
	$('.sliderContainer').css({'overflow-x': 'auto', 'padding-bottom': '20px'});
	$('.sliderImages').css({'overflow-x': 'auto', 'z-index': '9'});
	
	//Number of images
	var imgAmount = $(this).children().length;
	var screenWidth = $(window).width();
	var screenHeight = $(window).height();
	
	//Define gallery width variable(.5 is set as there is a strange behaviour in mobile browsers)
	var galleryWidth = .5;
	
	//Height of controller
	var controllerHeight = 80;
	
	//Width of scrollbar (tested in chrome)
	var scrollBar = 20;
	var currentOnScreen = 0;
	var scrollSpeed = 800;
	var navbarHeight = navbarHeight;
	var imgArr = [];
	
	function Slide(left, width) {
		this.left = left;
		this.width = width;
	}
	
		
	//Set Controller
	$('.sliderControl').css({"position": "absolute", "z-index": "10",
	"padding-left": "20px", "width": "100%", "height": controllerHeight + "px"});
	
	//Set the height of gallery to the window height minus controller width
	$(this).children().css({"height": (screenHeight - controllerHeight - navbarHeight) + "px", "float": "left"});
	//$(this).children(':last').css({'box-shadow': '5px 5px 1px 3px #111'});
	
	//Read the width of each picture and make up the gallery width
	$(this).children().each(function() {
		var width = $(this).width();
		galleryWidth += width;
	});
	
	//Set the gallery container
	$(this).css({"width": galleryWidth + "px"});
	
	//Add ids to images and place them in array
	$(this).children().each(function(ind, val) {
		
		var img = $(this).attr('id', img + (ind + 1));
		var width = $(this).width();
		var leftPosition = $(this).position().left;
		
		var imgPath = $(this).attr('src');
		$('.sliderControl').append("<img class='sd23423sdfsd' id='imgControl" + (ind + 1) + "' src='" + imgPath + "' />");

		imgArr.push(new Slide(leftPosition, width));
	});
	
/*////////////////////////////
///////    CONTORLS    ///////
////////////////////////////*/
	
	//CSS settings
	$('.sliderControl img').css({'float': 'left', 'height': '60px', 'max-width': '25%', 'margin': '10px -2px',
		'transform': 'skewX(-15deg)', 'border-top': '2px solid #ccc', 'border-bottom': '2px solid #ccc'});
	$('.sliderControl img:first-child').css({'border-top-left-radius': '10px', 'border-left': '2px solid #ccc'});
	$('.sliderControl img:last-child').css({'border-bottom-right-radius': '10px', 'border-right': '2px solid #ccc'});
		
	//Small picture scrolling control
	$(".sd23423sdfsd").on('click touchstart', function() {
		var id = $(this).attr('id');
		var num = parseInt(id.replace( /^\D+/g, ''));
		currentOnScreen = num;
		//Center the image
		var widthDiff = screenWidth - imgArr[num - 1].width;
		var correction = widthDiff / 2;

		$('.sliderContainer').stop().animate({scrollLeft: (imgArr[num - 1].left - correction) + "px"}, scrollSpeed);
	});

};