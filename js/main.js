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
	
	jQuery('#menu a.nav-link').click(function(){
		var parentElement = jQuery(this).parent();
		if(!parentElement.hasClass('extended') && !parentElement.hasClass('menu-item-has-children')){
			parentElement.addClass('extended');
			parentElement.append( "<p>Test</p>" );
		}else{
			parentElement.removeClass('extended');
		}
	});
});