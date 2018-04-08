<?php
class General {
	
	function __construct($tabUrl) {
		$this->buildPage($tabUrl);
	}
	
		
	function buildPage($tabUrl) {
		
		$hidden_field_name = 'sP_submit_hidden';
		
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
	$tabUrl = 'referencer_theme_options&tab=general'; // same like the param in the constructor
	$mainSection = 'main_section';
	
	// fetch existing options
	$option_values = get_option($option_name);
	
	// is called to automate saving the values of the fields
	register_setting(
		'general_section',			// A settings group name.
		$option_name				// The name of an option group to save.
	);
	
	$default_values = array(
		'page_description'		=> '',
		'headerTitle'			=> '',
		'welcomeTitle'			=> '',
		'welcomeSubtitle'		=> ''
	);
	
	// parse option value into predefined keys
	$data = shortcode_atts($default_values,$option_values);
	
	add_settings_section(
		$mainSection,							// ID used to identify this section and with which to register options
		'General settings',						// Title to be displayed on the administration page
		'main_callback',						// Callback used to render the description of the section
		$tabUrl									// Page on which to add this section of options
	);  
	
	// add option for meta description
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
	// add option for the title
	add_settings_field(
		'headerTitle',
		'Page title (logo)',
		'title_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'headerTitle',
			'value'			=> esc_attr($data['headerTitle']),
			'option_name' 	=> $option_name,
			'description'	=> 'Choose a title. It is displayed at the page header like a logo'
		)
	);
	// add option for the title
	add_settings_field(
		'welcomeTitle',
		'Welcome title',
		'title_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'welcomeTitle',
			'value'			=> esc_attr($data['welcomeTitle']),
			'option_name' 	=> $option_name,
			'description'	=> 'Choose the welcome title. It is displayed just at the start page in the middle, right.'
		)
	);
	// add option for the title
	add_settings_field(
		'welcomeSubtitle',
		'Welcome subtitle',
		'title_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'welcomeSubtitle',
			'value'			=> esc_attr($data['welcomeSubtitle']),
			'option_name' 	=> $option_name,
			'description'	=> 'Choose the welcome subtitle. It is displayed just at the start page below the welcome title'
		)
	);
}
add_action ('admin_init', 'initialise_general_options');

// displays a description under the main_styling_section
function main_callback(){
	echo '<p>Here you can make some general changes</p>';
}

// option to change meta description
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

// option to change the title of the page
function title_callback($args){
	printf(
			'<div>
				<input name="%1$s[%2$s]" value="%3$s">
				<p></p>
				<p class="description">%4$s</p>
			 </div>',
			$args['option_name'],
			$args['name'],
			$args['value'],
			$args['description']
			);
}
