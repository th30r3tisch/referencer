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
		'color_welcomeTitle'		=> '',
		'color_welcomeSubTitle'		=> '',
		'background_image'			=> ''
	);
	
	// parse option value into predefined keys
	$data = shortcode_atts($default_values,$option_values);
	
	add_settings_section(
		$mainSection,							// ID used to identify this section and with which to register options
		'Content',								// Title to be displayed on the administration page
		'style_content_callback',				// Callback used to render the description of the section
		$tabUrl									// Page on which to add this section of options
	); 
	
	// add option to change the header background between image and color
	add_settings_field(
		'color_welcomeTitle',
		'Title color',
		'color_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'color_welcomeTitle',
			'value'			=> esc_attr($data['color_welcomeTitle']),
			'option_name' 	=> $option_name,
			'description'	=> 'Choose the color of the title.'
		)
	);
	
	// add option to change the header background between image and color
	add_settings_field(
		'color_welcomeSubTitle',
		'Subtitle Color',
		'color_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'color_welcomeSubTitle',
			'value'			=> esc_attr($data['color_welcomeSubTitle']),
			'option_name' 	=> $option_name,
			'description'	=> 'Choose the color of the subtitle.'
		)
	);
	
	// add option to  upload a picture from the wordpress mediathek
	add_settings_field(
		'background_image',
		'Background picture',
		'backgroundPicUpload_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'background_image',
			'value'			=> esc_attr($data['background_image']),
			'option_name' 	=> $option_name,
			'description'	=> 'Select the background image behind the content.'
		)
	);
}
add_action ('admin_init', 'initialise_style_content_options');


// displays a description under the main_styling_section
function style_content_callback(){
	echo '<p>Here you can change the style of the contents.</p>';
}

// add option to  upload a picture from the wordpress mediathek
function backgroundPicUpload_callback($args){
	printf(
			'<div id="imageDialog">
				<input class="upload-button" type="button" class="button" value="Choose Image" />
				<input id="%1$s" type="text" name="%1$s[%2$s]" value="%3$s" size="62"/>
				<p></p>
				<p class="description">%4$s</p>
			 </div>',
			$args['option_name'],
			$args['name'],
			$args['value'],
			$args['description']
			);
}