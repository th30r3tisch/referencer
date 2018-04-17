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
	
	// adds field to shortcode option
	$( ".tech-add-button" ).click(function() {
		var lastNum = parseInt($( "#shortcode_options_form tbody:last th" ).text());
		var newNum = lastNum + 1;
		
		$( "#shortcode_options_form tbody:last" ).after(
  			'<tbody>'+
				'<tr>'+
					'<th scope="row">' + newNum +'. Title</th>'+
					'<td><input name="shortcode_options[tech_Title' + newNum + ']" value="" size="50"></td>'+
				'</tr>'+
				'<tr>'+
					'<th scope="row">' + newNum +'. Description</th>'+
					'<td><textarea name="shortcode_options[tech_description' + newNum + ']" value=""></textarea></td>'+
				'</tr>'+
				'<tr>'+
					'<th scope="row">' + newNum +'. Skill</th>'+
					'<td><input name="shortcode_options[tech_skill' + newNum + ']" value="" size="6"></td>'+
				'</tr>'+
				'<tr>'+
					'<th></th>'+
					'<td><a class="tech-delete-button">Delete</a></td></tr>'+
			'</tbody>'
		);
	});
	
	// removes field from shortcode option
	$("#shortcode_options_form").on("click", ".tech-delete-button", function() {
		var count = 0;
		$(this).closest('tbody').remove();
		$("#shortcode_options_form tbody").each(function() {
			count += 1;
			$('tr:nth-child(1) th', this).text(count + ". Title");
			$('tr:nth-child(2) th', this).text(count + ". Description");
			$('tr:nth-child(3) th', this).text(count + ". Skill");
			$('tr:nth-child(1) input', this).attr('name', 'shortcode_options[tech_Title' + count + ']');
			$('tr:nth-child(2) textarea', this).attr('name', 'shortcode_options[tech_description' + count + ']');
			$('tr:nth-child(3) input', this).attr('name', 'shortcode_options[tech_skill' + count + ']');
		});
	});
});