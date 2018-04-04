// JavaScript Document


var flag;
var ajaxElementID = "ajax-content";

jQuery( document ).ready(function() {
	"use strict";
	
	// click on burger menu
	jQuery('.menu button').click(function(){
		if(jQuery('.visible-menu').length === 0){ // if menu is not visible
			burgerToCross();
			
			if(contentIsVisible()){ // content is displayed
				jQuery('#menu').animate({ // fades in the menu
				left: 0
				}, 500);
				var menuItemNum = jQuery('#menu ul li').length;
				var windowWidth = parseInt(jQuery(window).width());
				jQuery("#ajax-content").animate({ // shrinks the content container
				width: windowWidth - (menuItemNum * 30) + 'px'
				}, 500);
				
			}else{ // no content is visible
				openMenu();
			}
			
		}else{ // if menu is visible
			crossToBurger();
			
			if(contentIsVisible()){ // content is displayed
				openContentAnimation(jQuery("#" + ajaxElementID));
			}else{// no content is visible
				closeMenu(); 
			}
		}
	});
	
	
	// click on menu item
	jQuery('#menu a.nav-link, #menu a.dropdown-item').click(function(e){
		if(!jQuery(this).parent().hasClass('menu-item-has-children')){
			e.preventDefault();
			var pageName = jQuery(this).attr('href').match(/[^/]+(?=\/$|$)/);
			
			switchPage(pageName,this);
			window.history.pushState(pageName, null, pageName);
		}
	});
});

function switchPage(pageName, obj){
	if(!contentIsVisible()){
		crossToBurger();
		openContentAnimation(obj);
		flag = pageName;
		ajaxCall(pageName, obj); // inserts the content
	}else{
		if(flag.toString() !== pageName.toString()){
			crossToBurger();
			flag = pageName;
			jQuery("#" + ajaxElementID).empty();
			jQuery("#" + ajaxElementID).animate({ // shrinks the content container
				width: '0px'
				}, 500, function(){
				jQuery("#" + ajaxElementID).remove(); // removes the content container
				openContentAnimation(obj);
				ajaxCall(pageName, obj); // inserts the content
			});
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
				jQuery('#ajax-content').html(data);
		},
		error: function () {
		  alert("error");
		}
	});
}

// animates the appearing pages
function openContentAnimation(obj){
	"use strict";
	var windowWidth = parseInt(jQuery(window).width());
	jQuery('#menu').animate({
		left: -30 * nextMenuItemPosition(obj)
		}, 500);
	jQuery('#' + ajaxElementID).animate({
		width: windowWidth - 30 + 'px'
		}, 500);
}

//walks through the history
window.addEventListener('popstate', function(e){
	"use strict";
    var page = e.state;

    if (page === null) {
		burgerToCross();
		jQuery("#" + ajaxElementID).empty(); // removes the content
		jQuery('#menu').animate({ // fades in the menu
			left: 0
			}, 500);
		jQuery("#" + ajaxElementID).animate({ // shrinks the content container
			width: '0px'
			}, 500, function(){
			jQuery("#" + ajaxElementID).remove(); // removes the content container
		});
    } else {
		var obj = jQuery("#menu li a:contains('" + page + "')");
		switchPage(page, obj);
    }
});




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
	jQuery('.nav-link').addClass('collapse-side').delay(400).queue(function(next){ // animates appearing menu
		jQuery('.nav-link').addClass('fade-text');
		next();
	});
}
// animates closing menu
function closeMenu(){
	jQuery('.nav-link').removeClass('fade-text');
	jQuery('.nav-link').removeClass('collapse-side').delay(400).queue(function(next){
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
	var closestLi = jQuery(obj).closest('li');
	if(!contentIsVisible()){
		jQuery(closestLi).append('<div id="' + ajaxElementID + '"></div>');
	}
	var elementPositionLeft = jQuery(closestLi).index(); // element position in the menu from the left
	return elementPositionLeft;
}