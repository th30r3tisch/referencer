// JavaScript Document


jQuery( document ).ready(function() {
	
	jQuery('.menu button').click(function(){
		if(!jQuery(this).hasClass('visible-menu')){
			jQuery(this).addClass('visible-menu');
		}else{
			jQuery(this).removeClass('visible-menu');
		}
	});
	
});