<?php

function initialise_style_content_options(){
	$option_name = 'content_style_options';
	$tabUrl = 'referencer_theme_options&tab=styling';
	$mainSection = 'content_style_section';
	
	// fetch existing options
	$option_values = get_option($option_name);
	
	// is called to automate saving the values of the fields
	register_setting(
		'style_section',					// A settings group name.
		$option_name						// The name of an option group to save.
	);
	
	$default_values = array(

	);
	
	// parse option value into predefined keys
	$data = shortcode_atts($default_values,$option_values);
	
	add_settings_section(
		$mainSection,							// ID used to identify this section and with which to register options
		'Content',								// Title to be displayed on the administration page
		'style_content_callback',				// Callback used to render the description of the section
		$tabUrl									// Page on which to add this section of options
	); 
}
add_action ('admin_init', 'initialise_style_content_options');


// displays a description under the main_styling_section
function style_content_callback(){
	echo '<p>Here you can change the style of the contents.</p>';
}