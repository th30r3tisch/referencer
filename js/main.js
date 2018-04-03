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
		}
	});
});

function ajaxCall(pageName, obj){
	"use strict";
	jQuery.ajax({
				url: ajaxurl,
				data: {
				  'action' : 'fetch_modal_content',
				  'pageName' : pageName
				},
				context: obj,
				success:function(data) {
					if(jQuery("#ajax-content").length === 0){
						jQuery(this).closest('li').append(data);
						//var newUrl = window.location.href + pageName;
						//window.history.pushState("object or string", "Title", newUrl);
					}
				},
				error: function () {
				  alert("error");
				}
			});
}