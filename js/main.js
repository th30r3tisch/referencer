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

//detects if the bottom of the page is visible
jQuery('.entry-content-page').scroll(function(){
        //console.log(jQuery(this).scrollTop()+' + '+ jQuery(this).height() +' = '+ (jQuery(this).scrollTop() + jQuery(this).height() + 83)   +' _ '+ jQuery(this)[0].scrollHeight );
        detectScroll(this);
    });


jQuery( document ).ready(function() {
	"use strict";
	jQuery(document).ajaxComplete(function( event, xhr, settings ) {
  		if(jQuery('#' + ajaxInnerContainer)[0].scrollHeight < jQuery('#content').height()){ 
			jQuery('#footer').css('display', 'inline-flex');
		}else{
			document.addEventListener('scroll', function (event) {
				if (event.target.id === 'ajax-content') { // or any other filtering condition 
					detectScroll(event.target);
				}
			}, true /*Capture event*/);
		}
	});
	detectScroll(jQuery('.entry-content-page'));
	// click on menu close button
	jQuery('#menuCloseBtn').click(function(){
		closeContent();
	});

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
	
	
	// click on menu item
	jQuery('#menu a.nav-link, #menu a.dropdown-item').click(function(e){
		if(!jQuery(this).parent().hasClass('menu-item-has-children')){
			jQuery('.entry-content-page').empty();
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
		  'action' : 'fetch_modal_content',
		  'pageName' : pageName
		},
		context: obj,
		success:function(data) { // inserst the content in the div inserted before
				jQuery("#" + ajaxInnerContainer).html(data);
				jQuery('#footer').css('display', 'none');
				jQuery("#" + ajaxInnerContainer).delay(500).animate({
					opacity: '1'
					}, 500);
		},
		error: function () {
		  alert("error");
		}
	});
}

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

//
function detectScroll(scrollObj){
	if(jQuery(scrollObj).scrollTop() + jQuery(scrollObj).height() + 135 >= jQuery(scrollObj)[0].scrollHeight - 50){
            jQuery('#footer').css('display', 'inline-flex');
        }else{jQuery('#footer').hide();}
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