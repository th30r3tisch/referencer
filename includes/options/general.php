<?php
class General {
	
	function __construct($tabUrl) {
		$this->buildPage($tabUrl);
	}
	
		
	function buildPage($tabUrl) {
		
		$hidden_field_name = 'sP_submit_hidden';
		// See if the user changed some informations
		// If they did, this hidden field will be set to 'Y'
		// same db reference in all sections -> if in one section something changes it will see it
		if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
			?>
			<!--  Put a "settings saved" message on the screen	 -->
			<div class="updated">
				<p><strong><?php _e('settings saved', 'menu-test' ); ?></strong></p>
			</div>			
		<?php } ?>
		<form name="general_options_form" id="general_options_form" method="post" action="options.php">
			<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
				<?php
				do_settings_sections( $tabUrl );
				settings_fields( 'general_section' ); 
				submit_button();
				?>
		</form>
		<?php
	}
}

function initialise_general_options(){
	$option_name = 'general_options';
	$tabUrl = 'referencer_theme_options&tab=general';
	$mainSection = 'main_section';
	
	// fetch existing options
	$option_values = get_option($option_name);
	
	// is called to automate saving the values of the fields
	register_setting(
		'general_section',			// A settings group name.
		$option_name				// The name of an option group to save.
	);
	
	$default_values = array(
		'page_title'			=> '',
		'page_description'		=> '',
	);
	
	// parse option value into predefined keys
	$data = shortcode_atts($default_values,$option_values);
	
	add_settings_section(
		$mainSection,							// ID used to identify this section and with which to register options
		'General settings',						// Title to be displayed on the administration page
		'main_callback',						// Callback used to render the description of the section
		$tabUrl									// Page on which to add this section of options
	);  
	
	// add option to change the header background between image and color
	add_settings_field(
		'page_title',
		'Page title (meta)',
		'input_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'page_title',
			'value'			=> esc_attr($data['page_title']),
			'option_name' 	=> $option_name,
			'description'	=> 'Choose a title for your page (max 50-60 chars). It will appear in the header and is <strong>important</strong> to improve your SEO.'
		)
	);
	
	// add option to change the header background between image and color
	add_settings_field(
		'page_description',
		'Page description (meta)',
		'input_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'page_description',
			'value'			=> esc_attr($data['page_description']),
			'option_name' 	=> $option_name,
			'description'	=> 'Choose a description for your page (between 50–300 chars). It will appear in a meta tag in the header and is <strong>important</strong> to improve your SEO.'
		)
	);
}
add_action ('admin_init', 'initialise_general_options');

// displays a description under the main_styling_section
function main_callback(){
	echo '<p>Here you can make some changes that can improve your SEO significantly.</p>';
}

// add option to choose the color of the sidebar
function input_callback($args){
	printf(
			'<div>
				<textarea name="%1$s[%2$s]" value="%3$s">%3$s</textarea>
				<p></p>
				<p class="description">%4$s</p>
			 </div>',
			$args['option_name'],
			$args['name'],
			$args['value'],
			$args['description']
			);
}
