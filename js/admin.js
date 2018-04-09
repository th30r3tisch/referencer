// JavaScript Document

(function( $ ) {
 
    // Add Color Picker to all inputs that have 'color-field' class
    $(function() {
        $('.color-field').wpColorPicker();
    });
     
})( jQuery );


// choose ONE picture from the wordpress media libary
jQuery(document).ready(function ($) {

	var mediaUploader;

	$('.upload-button').click(function (e) {
		e.preventDefault();

		//grab the ID of the input field prior to the button where we want the url value stored
		target_input = $(this).next().attr('id');
		image_input = $( '#' + target_input ).next().attr('id');

		// If the uploader object has already been created, reopen the dialog
		if (mediaUploader) {
			mediaUploader.open();
			return;
		}
		// Extend the wp.media object
		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose Image',
			button: {
				text: 'Choose Image'
			},
			multiple: false
		});

		// When a file is selected, grab the URL and set it as the text field's value and in the image preview
		mediaUploader.on('select', function () {
			attachment = mediaUploader.state().get('selection').first().toJSON();
			//Added target_input variable to grab ID and add URL
        	$( '#' + target_input ).val(attachment.url);
			$( '#' + image_input ).attr("src", attachment.url);
		});
		// Open the uploader dialog
		mediaUploader.open();
	});
});