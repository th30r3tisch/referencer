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
		var lastNum = parseInt($( "#shortcode_options_form tr:nth-last-child(2) th" ).text());
		var newNum = lastNum + 1;
		
		$( "#shortcode_options_form tbody" ).append(
				'<tr class="dark' + newNum % 2 +'">'+
					'<th scope="row">' + newNum +'. Title</th>'+
					'<td><input name="shortcode_options[tech_Title' + newNum + ']" value=""></td>'+
				'</tr>'+
				'<tr class="dark' + newNum % 2 +'">'+
					'<th scope="row">' + newNum +'. Description</th>'+
					'<td><textarea name="shortcode_options[tech_description' + newNum + ']" value=""></textarea></td>'+
				'</tr>'+
				'<tr class="dark' + newNum % 2 +'">'+
					'<th scope="row">' + newNum +'. Skill</th>'+
					'<td><input name="shortcode_options[tech_skill' + newNum + ']" value=""></td>'+
				'</tr>'+
				'<tr class="dark' + newNum % 2 +'">'+
					'<th></th>'+
					'<td><a class="tech-delete-button">Delete</a></td>'+
				'</tr>'
		);
	});
	
	// removes field from shortcode option
	$("#shortcode_options_form").on("click", ".tech-delete-button", function() {
		var elem = $(this).closest('tr');
		var count = parseInt($(elem).prev().first().text());
		
		$(elem).nextAll().each(function(index) {
			var str = $('th', this).text();
			if (str.indexOf("Title") >= 0){
				$('th', this).text(count + ". Title");
				$('input', this).attr('name', 'shortcode_options[tech_Title' + count + ']');
			}
			if (str.indexOf("Description") >= 0){
				$('th', this).text(count + ". Description");
				$('textarea', this).attr('name', 'shortcode_options[tech_description' + count + ']');
			}
			if (str.indexOf("Skill") >= 0){
				$('th', this).text(count + ". Skill");
				$('input', this).attr('name', 'shortcode_options[tech_skill' + count + ']');
			}
			if(index % 4 === 3){
				count += 1;
			}
		});
		$(elem).prev().prev().prev().remove();
		$(elem).prev().prev().remove();
		$(elem).prev().remove();
		$(elem).remove();
	});
});