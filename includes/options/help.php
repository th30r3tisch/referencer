<?php
class Help {
	
	function __construct($tabUrl) {
		$this->buildPage($tabUrl);
	}
	
		
	function buildPage($tabUrl) {
		?><div id="help-tab"><?php
		do_settings_sections( $tabUrl );
		settings_fields( 'help_section' );
		?></div><?php
	}
}

function intialize_help_options() {

		$option_name = 'help_options';
		$tabUrl = 'referencer_theme_options&tab=help'; // same like the param in the constructor
		$socialSection = 'main_section';
		
		// Fetch existing options.
		$option_values = get_option( $option_name );

		//is called to automate saving the values of the fields
		register_setting(
			'help_section', 		// A settings group name.
			$option_name 			// The name of an option group to save.
		);

		$default_values = array(
			'issues'							=> '',
			'reference-pictures-shortcode' 		=> '',
			'startpage'							=> '',
			'reference-shortcode'				=> ''
		);

		// Parse option values into predefined keys, throw the rest away.
		$data = shortcode_atts( $default_values, $option_values );


		/**---------------------------------------------------------------------------
		 * help infos
		 *---------------------------------------------------------------------------**/

		//is used to display the section heading and description.
		add_settings_section(
			$socialSection, 				// ID used to identify this section and with which to register options
			'Help / Information',			// Title to be displayed on the administration page
			'help_options_callback', 		// Callback used to render the description of the section
			$tabUrl 						// Page on which to add this section of options
		);

		//adds the option to insert a facebooklink
		add_settings_field(
			'issues', 								// ID used to identify the field throughout the theme
			'Known issues', 						// The label to the left of the option interface element
			'help_callback', 						// The name of the function responsible for rendering the option interface
			$tabUrl, 								// The page on which this option will be displayed
			$socialSection, 						// The name of the section to which this field belongs
			array( 									// The array of arguments to pass to the callback
				'name' => 'issues', 				// value for 'name' attribute
				'option_name' => $option_name,
				'description'	=> 'This theme is still in develpment.</br>
				There are some known issues you should consider until they are fixed.</br>
				<strong>1.</strong> Do not make a link to the home page and don\'t insert a page twice in the menu. This will messup the ajax page load.</br>
				<strong>2.</strong> Take care when making a new page. The page name (topic) has to be the exact same like in the page link. (eg. : Page-name -> /page-name)
				If not the page wont load in the menu.</br>
				<strong>3.</strong> This theme requires an imprint as well as a privacy policy. Just make a page "Datenschutzerklärung" and "Impressum" 
				(the names are important because atm the link is just hardcoded!). This pages are automatically linked in the footer.'
			)
		);
	
		//adds the option to insert a facebooklink
		add_settings_field(
			'reference_pictures_shortcode', 					
			'Picutre gallery shortcode', 					
			'help_callback', 				
			$tabUrl, 								
			$socialSection, 						
			array( 									
				'name' => 'reference_pictures_shortcode',
				'option_name' => $option_name,
				'description'	=> 'You can use this shortcode by writing [picture-gallery] in the content field of a page.</br>
				It will take all posts with the category "picture-gallery" and display its featured image as thumbnail and its tags in a responsive grid.'
			)
		);
	
		//adds the option to insert a facebooklink
		add_settings_field(
			'startpage', 					
			'Startpage', 					
			'help_callback', 				
			$tabUrl, 								
			$socialSection, 						
			array( 									
				'name' => 'startpage',
				'option_name' => $option_name,
				'description'	=> 'If you want to use the startpage of the theme you can enter you text in the theme options in the "General" tab.</br>
				Then just make a new page and choose the startpage template. </br>
				In the settings of WordPress select in the "Read" category "Static frontpage" and choose your page in the "Homepage" dropdown."'
			)
		);
	
		//adds the option to insert a facebooklink
		add_settings_field(
			'reference-shortcode', 					
			'Reference shortcode', 					
			'help_callback', 				
			$tabUrl, 								
			$socialSection, 						
			array( 									
				'name' => 'reference-shortcode',
				'option_name' => $option_name,
				'description'	=> 'To use this shortcode write [references] in the content field of a page.</br>
				The settings can be found in the theme options at the "Shortcode" tab. All your abilities will be displayed at the page with the shortcode.'
			)
		);

		
	}
	add_action( 'admin_init', 'intialize_help_options' );

	// description for the social options section
	function help_options_callback() {
		echo '<p>Here you find some information about the theme and how to use it.</br>
		If you have more questions, issues or just need help feel free to ask <a href="https://github.com/th30r3tisch/referencer/issues">here</a>.</p>';
	}

	// callbacks for every social network
	function help_callback( $args ) {

		// Render the output
		printf(
			'<div id="%2$s">%3$s</div>',
			$args[ 'option_name' ],
			$args[ 'name' ],
			$args[ 'description' ]
		);
	}