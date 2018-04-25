<?php
class Social {
	
	function __construct($tabUrl) {
		$this->buildPage($tabUrl);
	}
	
		
	function buildPage($tabUrl) {
		
		$hidden_field_name = 'sP_submit_hidden';
		
		if ( isset( $_POST[ $hidden_field_name ] ) && $_POST[ $hidden_field_name ] == 'Y' ) {
			?>
			<!--  Put a "settings saved" message on the screen	 -->
			<div class="updated">
				<p><strong><?php _e('settings saved', 'menu-test' ); ?></strong></p>
			</div>
			<?php } ?>
			<form name="social_form" id="social_form" method="post" action="options.php">
				<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
				<?php
				do_settings_sections( $tabUrl );
				settings_fields( 'social_section' ); 
				submit_button();
				?>
			</form>
			<?php
		}
}

function intialize_social_options() {

		$option_name = 'social_options';
		$tabUrl = 'referencer_theme_options&tab=social_links'; // same like the param in the constructor
		$socialSection = 'main_section';
		
		// Fetch existing options.
		$option_values = get_option( $option_name );

		//is called to automate saving the values of the fields
		register_setting(
			'social_section', 		// A settings group name.
			$option_name 			// The name of an option group to save.
		);

		$default_values = array(
			'facebook' 		=> '',
			'xing' 			=> '',
			'linkedin' 		=> '',
			'google' 		=> '',
			'twitter' 		=> '',
			'youtube' 		=> '',
			'github'		=> ''
		);

		// Parse option values into predefined keys, throw the rest away.
		$data = shortcode_atts( $default_values, $option_values );


		/**---------------------------------------------------------------------------
		 * make social options
		 *---------------------------------------------------------------------------**/

		//is used to display the section heading and description.
		add_settings_section(
			$socialSection, 				// ID used to identify this section and with which to register options
			'Social Options', 				// Title to be displayed on the administration page
			'social_options_callback', 		// Callback used to render the description of the section
			$tabUrl 						// Page on which to add this section of options
		);

		//adds the option to insert a facebooklink
		add_settings_field(
			'facebook', 					// ID used to identify the field throughout the theme
			'Facebook', 					// The label to the left of the option interface element
			'social_callback', 				// The name of the function responsible for rendering the option interface
			$tabUrl, 						// The page on which this option will be displayed
			$socialSection, 				// The name of the section to which this field belongs
			array( 							// The array of arguments to pass to the callback
				'name' => 'facebook', 		// value for 'name' attribute
				'value' => esc_attr( $data[ 'facebook' ] ),
				'option_name' => $option_name
			)
		);

		//adds the option to insert a linkedinlink
		add_settings_field(
			'linkedin',
			'LinkedIn',
			'social_callback',
			$tabUrl,
			$socialSection,
			array(
				'name' => 'linkedin',
				'value' => esc_attr( $data[ 'linkedin' ] ),
				'option_name' => $option_name
			)
		);

		//adds the option to insert a xinglink
		add_settings_field(
			'xing',
			'Xing',
			'social_callback',
			$tabUrl,
			$socialSection,
			array(
				'name' => 'xing',
				'value' => esc_attr( $data[ 'xing' ] ),
				'option_name' => $option_name
			)
		);

		//adds the option to insert a google+link
		add_settings_field(
			'google',
			'Google+',
			'social_callback',
			$tabUrl,
			$socialSection,
			array(
				'name' => 'google',
				'value' => esc_attr( $data[ 'google' ] ),
				'option_name' => $option_name
			)
		);

		//adds the option to insert a youtubelink
		add_settings_field(
			'youtube',
			'Youtube',
			'social_callback',
			$tabUrl,
			$socialSection,
			array(
				'name' => 'youtube',
				'value' => esc_attr( $data[ 'youtube' ] ),
				'option_name' => $option_name
			)
		);

		//adds the option to insert a twitterlink
		add_settings_field(
			'twitter',
			'Twitter',
			'social_callback',
			$tabUrl,
			$socialSection,
			array(
				'name' => 'twitter',
				'value' => esc_attr( $data[ 'twitter' ] ),
				'option_name' => $option_name
			)
		);
	
		//adds the option to insert a twitterlink
		add_settings_field(
			'github',
			'Github',
			'social_callback',
			$tabUrl,
			$socialSection,
			array(
				'name' => 'github',
				'value' => esc_attr( $data[ 'github' ] ),
				'option_name' => $option_name
			)
		);
	}
	add_action( 'admin_init', 'intialize_social_options' );

	// description for the social options section
	function social_options_callback() {
		echo '<p>Here you can insert the links to you social media accounts. </br>
			  For each filled input an icon will appear on the website. Empty fields are not displayed.</p>';
	}

	// callbacks for every social network
	function social_callback( $args ) {

		// Render the output
		printf(
			'<input type="text" name="%1$s[%2$s]" id="%2$s" value="%3$s" size="75">',
			$args[ 'option_name' ],
			$args[ 'name' ],
			$args[ 'value' ]
		);
	}