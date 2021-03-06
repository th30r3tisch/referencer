<?php

function initialise_style_footer_options(){
	$option_name = 'footer_style_options';
	$tabUrl = 'referencer_theme_options&tab=styling';
	$mainSection = 'footer_style_section';
	
	// fetch existing options
	$option_values = get_option($option_name);
	
	// is called to automate saving the values of the fields
	register_setting(
		'style_section',					// A settings group name.
		$option_name						// The name of an option group to save.
	);
	
	$default_values = array(
		'color_letters'		=> '',
		'color_social'		=> '',
		'color_mediabar'	=> ''
	);
	
	// parse option value into predefined keys
	$data = shortcode_atts($default_values,$option_values);
	
	add_settings_section(
		$mainSection,							// ID used to identify this section and with which to register options
		'Footer',								// Title to be displayed on the administration page
		'style_footer_callback',				// Callback used to render the description of the section
		$tabUrl									// Page on which to add this section of options
	); 
	
	// add option to change the header background between image and color
	add_settings_field(
		'color_letters',
		'Letter color',
		'color_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'color_letters',
			'value'			=> esc_attr($data['color_letters']),
			'option_name' 	=> $option_name,
			'description'	=> 'Choose the color of the text in the footer.'
		)
	);
	
	// add option to change the header background between image and color
	add_settings_field(
		'color_social',
		'Social icon color',
		'color_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'color_social',
			'value'			=> esc_attr($data['color_social']),
			'option_name' 	=> $option_name,
			'description'	=> 'Choose the color of the social icons in the media bar.'
		)
	);
	
	// add option to change the header background between image and color
	add_settings_field(
		'color_mediabar',
		'Media bar color',
		'color_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'color_mediabar',
			'value'			=> esc_attr($data['color_mediabar']),
			'option_name' 	=> $option_name,
			'description'	=> 'Choose the color of the media bar.'
		)
	);
	
}
add_action ('admin_init', 'initialise_style_footer_options');
