// JavaScript Document


var flag;
var ajaxElementID = "firefoxScroller";
var ajaxInnerContainer = "ajax-content";

jQuery( window ).resize(function() {
	if(jQuery('.visible-menu').length === 0){
  		jQuery('#' + ajaxElementID).closest('li').css("width", getWindowWidth() + 'px');
	}else{
		jQuery('#' + ajaxElementID).closest('li').css("width", getWindowWidth() - (jQuery('#menu > ul').children('li').length * 30) + 30 + 'px');
	}
});

// scrolls the modal to the info part
jQuery('#modal').on('click', '.downToInfo', function(){
	jQuery('#modal').animate({
        scrollTop: jQuery(".picPostInfo").offset().top
    }, 1000);
});

jQuery( document ).ready(function() {
	"use strict";
	// click on menu close button
	jQuery('#menuCloseBtn').click(function(){
		closeContent();
	});
	
	animateCircle();

	// click on burger menu
	jQuery('.menu button').click(function(){
		if(jQuery('.visible-menu').length === 0){ // if menu is not visible
			burgerToCross();
			if(contentIsVisible()){ // content is displayed
				fadeInMenu();
				var menuItemNum = jQuery('#menu > ul').children('li').length;
				jQuery('#' + ajaxElementID).closest('li').css("width", getWindowWidth() - (menuItemNum * 30) + 30 + 'px'); // shrinks the content container
				
			}else{ // no content is visible
				openMenu();
			}
		}else{ // if menu is visible
			crossToBurger();
			if(contentIsVisible()){ // content is displayed
				openContentAnimation(jQuery("#" + ajaxElementID).closest('li'));
			}else{// no content is visible
				closeMenu(); 
			}
		}
	});
	
	slideTile();
	
	// click on menu item
	jQuery('#menu a.nav-link, #menu a.dropdown-item').click(function(e){
		if(!jQuery(this).parent().hasClass('menu-item-has-children')){
			jQuery('.entry-content-page').empty();
			jQuery('.entry-content-page').css("background", "rgba(1,1,1,0)");
			jQuery('#startpage').remove();
			jQuery('.logo a').css("opacity", 1);
			e.preventDefault();
			var pageUrl = jQuery(this).attr('href');
			var pageName = jQuery(this).attr('href').match(/[^/]+(?=\/$|$)/);
			switchPage(pageName,jQuery(this).closest('li'));
			window.history.pushState(pageName, null, pageUrl);
		}else{
			e.preventDefault();
		}
	});
	
});

function switchPage(pageName, obj){
	if(!contentIsVisible()){
		openMenu(); // just relevant for history
		crossToBurger();
		openContentAnimation(obj);
		flag = pageName;
		ajaxCall(pageName, obj); // inserts the content
	}else{
		if(flag.toString() !== pageName.toString()){
			crossToBurger();
			flag = pageName;
			removeContent();
			openContentAnimation(obj);
			ajaxCall(pageName, obj); // inserts the content
		}
	}
}

function ajaxCall(pageName, obj){
	"use strict";
	jQuery.ajax({
		url: ajaxurl,
		data: {
		  'action' : 'fetch_page_content',
		  'pageName' : pageName
		},
		context: obj,
		success:function(data) { // inserst the content in the div inserted before
				jQuery('#footer').hide();
				jQuery("#" + ajaxInnerContainer).html(data);
				jQuery("#" + ajaxInnerContainer).delay(500).animate({
					opacity: '1'
					}, 500);
				slideTile();
				animateCircle();
		},
		error: function () {
		  alert("error");
		}
	});
}


jQuery('#content').on("click", '.image-tile', function(e) {
	e.preventDefault();
  	var postID = jQuery(this).attr('id');

  	jQuery.ajax({
    	url: ajaxurl,
    	data: {
      		'action' : 'fetch_modal_content',
      		'postID' : postID
      	},
    	success:function(data) {
      		jQuery('#modal_target').html(data);
      		jQuery('#modal').modal('show');
    	}
  	});
});

// animates the appearing pages
function openContentAnimation(obj){
	"use strict";
	jQuery('#menu').animate({
		left: -30 * nextMenuItemPosition(obj)
		}, 250);
	jQuery(obj).css("width", "100vw");
	showBackBtn();
}

//walks through the history
window.addEventListener('popstate', function(e){
	"use strict";
    var page = e.state;

    if (page === null) {
		closeContent();
    } else {
		var obj = jQuery("#menu li a:contains('" + page + "')").closest('li');
		switchPage(page, obj);
    }
});

// opens the text in the reference shortcode on click
jQuery('#content').on('click', '.ref-wrapper i', function(){
	var targetContainer = jQuery(this).closest('.ref-wrapper');
	jQuery('div:nth-of-type(1)', targetContainer).toggle('slow');
	jQuery('.circle', targetContainer).toggle("slow");
});

// slides in the image tiles
function slideTile(){
	jQuery('.image-tile').each(function(index){
		jQuery(this).delay(50*index).animate({
			marginTop: '3px'
			}, 1000);
	});
}

// shrinks the content element and removes the content
function closeContent(){
	burgerToCross();
	hideBackBtn();
	fadeInMenu();
	removeContent();
}
// hides the button to close the menu
function hideBackBtn(){
	jQuery('#menuCloseBtn').css("display", "none");
}
// displays the button to close the menu
function showBackBtn(){
	jQuery('#menuCloseBtn').css("display", "block");
}
// makes jquery contains selector case insensitive
jQuery.expr[':'].contains = function(a, i, m) {
	return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
};
// returns whether content is displayed
function contentIsVisible(){
	return jQuery("#" + ajaxElementID).length;
}

 // animates appearing menu
function openMenu(){
	jQuery('.menu-item').addClass('collapse-side').delay(400).queue(function(next){ // animates appearing menu
		jQuery('.nav-link').addClass('fade-text');
		next();
	});
}
// animates closing menu
function closeMenu(){
	jQuery('.nav-link').removeClass('fade-text');
	jQuery('.menu-item').removeClass('collapse-side').delay(400).queue(function(next){
		jQuery('.nav-link').removeClass('fade-text');
		next();
	});
}

// changes burger menu to cross
function burgerToCross(){
	jQuery('.menu button').addClass('visible-menu'); 
}
// changes menu cross to burger menu
function crossToBurger(){
	jQuery('.menu button').removeClass('visible-menu');
}

//returns the next menu item position depenting on the element parameter
function nextMenuItemPosition(obj){
	if(!contentIsVisible()){
		jQuery(obj).append('<div id="' + ajaxElementID + '"><div id="' + ajaxInnerContainer + '"></div></div>');
	}
	var elementPositionLeft = jQuery(obj).index(); // element position in the menu from the left
	return elementPositionLeft;
}
//gets the width of the window
function getWindowWidth(){
	return parseInt(jQuery(window).width());
}
// fade in the menu
function fadeInMenu(){
	jQuery('#menu').animate({ left: 0 }, 500); // fades in the menu
}
// content remove animation
function removeContent(){
	jQuery("#" + ajaxElementID).closest('li').css("width", "30px"); // shrinks the content container
	jQuery("#" + ajaxElementID).remove(); // removes the content container
}
// animates the circles#
function animateCircle(){
	jQuery('.ref-wrapper').each(function(index){
		var techvalue = parseInt(jQuery('span:nth-of-type(1)', this).text())/100;
		var colorvalue = jQuery('span:nth-of-type(2)', this).text();
		var circle = jQuery('>.circle', this).circleProgress({
			value: 0,
			size: 120,
			thickness: 8,
			fill: {
				gradient: ["rgba(136,240,  0,1)", "rgba(  0,139,191,1)"] 
			}
		});
		circle.on('circle-animation-progress', function(e, p, v) {
		  jQuery(this).children('.value').text((100 * v).toFixed() + "%");
		});
		setTimeout(() => circle.circleProgress('value', techvalue), 250*index+500);
	});
}