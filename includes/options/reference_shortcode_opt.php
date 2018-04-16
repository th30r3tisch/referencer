<?php
class Shortcode {
	
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
		<form name="gshortcode_options_form" id="gshortcode_options_form" method="post" action="options.php">
			<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
				<?php
				do_settings_sections( $tabUrl );
				settings_fields( 'shortcode_section' );
				?>
				<input class="video-add-button button-primary" type="button" value="+">
				<?php
				submit_button();
				?>
		</form>
		<?php
	}
}

function initialise_shortcode_options(){
	$option_name = 'shortcode_options';
	$tabUrl = 'referencer_theme_options&tab=shortcode'; // same like the param in the constructor
	$mainSection = 'main_section';
	
	// fetch existing options
	$option_values = get_option($option_name);
	
	// is called to automate saving the values of the fields
	register_setting(
		'shortcode_section',			// A settings group name.
		$option_name				// The name of an option group to save.
	);
	
	$default_values = generateDefaultArray(count($option_values));

	// Parse option values into predefined keys, throw the rest away.
	$data = shortcode_atts( $default_values, $option_values );
	
	$default_values = array(
		'tech_Title'			=> '',
		'tech_description'		=> '',
		'tech_skill'			=> ''
	);
	
	// parse option value into predefined keys
	$data = shortcode_atts($default_values,$option_values);
	
	add_settings_section(
		$mainSection,							// ID used to identify this section and with which to register options
		'Shortcode settings',					// Title to be displayed on the administration page
		'shortcode_callback',					// Callback used to render the description of the section
		$tabUrl									// Page on which to add this section of options
	);  
	

	// add option for the title
	add_settings_field(
		'tech_Title',
		'Title',
		'title_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'tech_Title',
			'value'			=> esc_attr($data['tech_Title']),
			'option_name' 	=> $option_name,
			'description'	=> 'Here you can enter the title of your ability.'
		)
	);
	// add option for the description
	add_settings_field(
		'tech_description',
		'Description',
		'input_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'tech_description',
			'value'			=> esc_attr($data['tech_description']),
			'option_name' 	=> $option_name,
			'description'	=> 'Write some details about the ability in the title. What have you done, what do you like or not.'
		)
	);
	// add option for the skill
	add_settings_field(
		'tech_skill',
		'Skill',
		'title_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'tech_skill',
			'value'			=> esc_attr($data['tech_skill']),
			'option_name' 	=> $option_name,
			'description'	=> 'Enter a number between 0 and 100 to describe how good you are. 0 is really bad and 100 is professional'
		)
	);

	
	generateFields(count($option_values), $tabUrl, $mainSection, $option_name, $data);
}
add_action ('admin_init', 'initialise_shortcode_options');

function generateDefaultArray($num){
	$default_array;
	for ($i = 1; $i <= $num; ++$i) {
		$default_array[$i] = '';
	}
	return $default_array;
}

function generateFields($num, $tabUrl, $mainSection, $option_name, $data){
		
	for ($i = 2; $i <= $num; ++$i) {
		add_settings_field(
			'tech_Title' .$i, 
			$i.'. Title', 
			'title_callback', 
			$tabUrl,
			$mainSection, 
			array( 
				'name' => 'tech_Title' .$i,
				'value' => esc_attr( $data[ 'tech_Title' .$i ] ),
				'option_name' => $option_name
			)
		);
	}
}
