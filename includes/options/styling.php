<?php
class Styling {
	
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
		<form name="style_options_form" id="style_options_form" method="post" action="options.php">
			<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
				<?php
				do_settings_sections( $tabUrl );
				settings_fields( 'style_section' ); 
				submit_button();
				?>
		</form>
		<?php
	}
}

function initialise_style_options(){
	$option_name = 'style_options';
	$tabUrl = 'referencer_theme_options&tab=styling'; // same like the param in the constructor
	$mainSection = 'main_style_section';
	
	// fetch existing options
	$option_values = get_option($option_name);
	
	// is called to automate saving the values of the fields
	register_setting(
		'style_section',			// A settings group name.
		$option_name				// The name of an option group to save.
	);
	
	$default_values = array(
		'color_header'		=> '',
		'color_title'		=> ''
	);
	
	// parse option value into predefined keys
	$data = shortcode_atts($default_values,$option_values);
	
	add_settings_section(
		$mainSection,							// ID used to identify this section and with which to register options
		'Styling',								// Title to be displayed on the administration page
		'style_callback',						// Callback used to render the description of the section
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
}
add_action ('admin_init', 'initialise_style_options');

// displays a description under the main_styling_section
function style_callback(){
	echo '<p>Here you can change the style of the website.</p>';
}

// option to change colors
function color_callback($args){
	printf(
			'<div>
				<input name="%1$s[%2$s]" data-alpha="true" class="color-field" value="%3$s">
				<p></p>
				<p class="description">%4$s</p>
			 </div>',
			$args['option_name'],
			$args['name'],
			$args['value'],
			$args['description']
			);
}
