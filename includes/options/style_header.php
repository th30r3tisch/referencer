<?php

function initialise_style_header_options(){
	$option_name = 'header_style_options';
	$tabUrl = 'referencer_theme_options&tab=styling';
	$mainSection = 'header_style_section';
	
	// fetch existing options
	$option_values = get_option($option_name);
	
	// is called to automate saving the values of the fields
	register_setting(
		'style_section',				// A settings group name.
		$option_name					// The name of an option group to save.
	);
	
	$default_values = array(
		'color_header'		=> '',
		'color_title'		=> '',
		'color_burger'		=> '',
		'shadow_flag'		=> '',
		'translatable'		=> '',
		'header_line'		=> '',
		'color_header_line' => '',
		'headerLogo_image' 	=> ''
	);
	
	// parse option value into predefined keys
	$data = shortcode_atts($default_values,$option_values);
	
	add_settings_section(
		$mainSection,							// ID used to identify this section and with which to register options
		'Header',								// Title to be displayed on the administration page
		'header_style_callback',				// Callback used to render the description of the section
		$tabUrl									// Page on which to add this section of options
	);  
	
	// add option to change the header background between image and color
	add_settings_field(
		'color_header',
		'Header Color',
		'color_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'color_header',
			'value'			=> esc_attr($data['color_header']),
			'option_name' 	=> $option_name,
			'description'	=> 'Choose the color of the header.'
		)
	);
	// add option to change the header background between image and color
	add_settings_field(
		'color_title',
		'Title Color',
		'color_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'color_title',
			'value'			=> esc_attr($data['color_title']),
			'option_name' 	=> $option_name,
			'description'	=> 'Choose the color of the title in the header.'
		)
	);
	add_settings_field(
		'color_burger',
		'Menu burger color',
		'color_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'color_burger',
			'value'			=> esc_attr($data['color_burger']),
			'option_name' 	=> $option_name,
			'description'	=> 'Choose the color of the burger menu in the header.'
		)
	);
	// display header line
	add_settings_field(
		'header_line',
		'Header bottom line',
		'radio_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'header_line',
			'value'			=> esc_attr($data['header_line']),
			'option_name' 	=> $option_name,
			'description'	=> 'Should be there a line below the header?'
		)
	);
	add_settings_field(
		'color_header_line',
		'Bottom line color',
		'color_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'color_header_line',
			'value'			=> esc_attr($data['color_header_line']),
			'option_name' 	=> $option_name,
			'description'	=> 'Choose the color of the line below the header.',
			'dependency'	=> esc_attr($data['header_line'])
		)
	);
	// display flags?
	add_settings_field(
		'translatable',
		'Flags',
		'radio_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'translatable',
			'value'			=> esc_attr($data['translatable']),
			'option_name' 	=> $option_name,
			'description'	=> 'If you want to translate your page this should be "Yes" otherwhise "No"'
		)
	);
	// display flags?
	add_settings_field(
		'shadow_flag',
		'Flag shadow',
		'radio_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'shadow_flag',
			'value'			=> esc_attr($data['shadow_flag']),
			'option_name' 	=> $option_name,
			'description'	=> 'Do you want a shadow behind the flags?',
			'dependency'	=> esc_attr($data['translatable'])
		)
	);
	
	// add option to  upload a picture from the wordpress mediathek
	add_settings_field(
		'headerLogo_image',
		'Header logo image',
		'picUpload_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'headerLogo_image',
			'value'			=> esc_attr($data['headerLogo_image']),
			'option_name' 	=> $option_name,
			'description'	=> 'Select the image (logo -> <strong>90x90px</strong>) to display instead of the Title at small devices.'
		)
	);

}
add_action ('admin_init', 'initialise_style_header_options');

