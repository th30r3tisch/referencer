// JavaScript Document


jQuery( document ).ready(function() {
	
	jQuery('.menu button').click(function(){
		if(!jQuery(this).hasClass('visible-menu')){
			jQuery(this).addClass('visible-menu');
			jQuery('.nav-link').addClass('collapse-side').delay(400).queue(function(next){
				jQuery('.nav-link').addClass('fade-text');
				next();
			});
		}else{
			jQuery(this).removeClass('visible-menu');
			jQuery('.nav-link').removeClass('fade-text');
			jQuery('.nav-link').removeClass('collapse-side').delay(400).queue(function(next){
				jQuery('.nav-link').removeClass('fade-text');
				next();
			});
		}
	});
	
	jQuery('#menu a.nav-link, #menu a.dropdown-item').click(function(e){
		if(!jQuery(this).parent().hasClass('menu-item-has-children')){
			e.preventDefault();

			var pageName = jQuery(this).attr('href').match(/[^/]+(?=\/$|$)/);
			
			ajaxCall(pageName, this);
			window.history.pushState(pageName, null, pageName);
		}
	});
});

var flag;

function ajaxCall(pageName, obj){
	"use strict";
	var ajaxElementID = "ajax-content";
	jQuery.ajax({
				url: ajaxurl,
				data: {
				  'action' : 'fetch_modal_content',
				  'pageName' : pageName
				},
				context: obj,
				beforeSend:function(){
					if(jQuery("#" + ajaxElementID).length === 0){
						ajaxAnimation(this, ajaxElementID);
						flag = pageName;
					}else{
						if(flag === pageName){
							jQuery("#" + ajaxElementID).remove();
							ajaxAnimation(this, ajaxElementID);
						}
					}
				},
				success:function(data) {
						jQuery('#ajax-content').html(data);
				},
				error: function () {
				  alert("error");
				}
			});
}

function ajaxAnimation(obj, ajaxElementID){
	"use strict";
	var closestLi = jQuery(obj).closest('li');
	jQuery(closestLi).append('<div id="' + ajaxElementID + '"></div>');
	var elementPositionLeft = jQuery(closestLi).index(); // element position in the menu from the left
	var windowWidth = parseInt(jQuery(window).width());
	jQuery('#menu').animate({
		left: -30 * elementPositionLeft
		}, 500);
	jQuery('#' + ajaxElementID).animate({
		width: windowWidth - 30 + 'px'
		}, 500);
}

  window.addEventListener('popstate', function(e){
    var page = e.state;

    if (page === null) {
		jQuery("#ajax-content").empty();
		jQuery('#menu').animate({
			left: 0
			}, 500);
		jQuery("#ajax-content").animate({
			width: '120px'
			}, 500, function(){
			jQuery("#ajax-content").remove();
		});
    } else {
		var obj = jQuery("#menu li a:contains('" + page + "')");
		ajaxCall(page, obj);
    }
  });

jQuery.expr[':'].contains = function(a, i, m) {
 return jQuery(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
};
