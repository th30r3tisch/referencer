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
		<form name="shortcode_options_form" id="shortcode_options_form" method="post" action="options.php">
			<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
				<?php
				do_settings_sections( $tabUrl );
				settings_fields( 'shortcode_section' );
				?>
				<input class="tech-add-button button-primary" type="button" value="+">
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
		'shortcode_section',		// A settings group name.
		$option_name				// The name of an option group to save.
	);
	
	$default_values = generateDefaultArray(count($option_values));
	
	// Parse option values into predefined keys, throw the rest away.
	$data = shortcode_atts( $default_values, $option_values );
	
	add_settings_section(
		$mainSection,							// ID used to identify this section and with which to register options
		'Shortcode settings',					// Title to be displayed on the administration page
		'shortcode_callback',					// Callback used to render the description of the section
		$tabUrl									// Page on which to add this section of options
	);  
	

	// add option for the title
	add_settings_field(
		'tech_Title1',
		'1. Title',
		'title_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'tech_Title1',
			'value'			=> esc_attr($data['tech_Title1']),
			'option_name' 	=> $option_name,
			'description'	=> 'Here you can enter the title of your ability.'
		)
	);
	// add option for the description
	add_settings_field(
		'tech_description1',
		'1. Description',
		'input_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'tech_description1',
			'value'			=> esc_attr($data['tech_description1']),
			'option_name' 	=> $option_name,
			'description'	=> 'Write some details about the ability in the title. What have you done, what do you like or not.'
		)
	);
	// add option for the skill
	add_settings_field(
		'tech_skill1',
		'1. Skill',
		'title_callback',
		$tabUrl,
		$mainSection,
		array(
			'name'			=> 'tech_skill1',
			'value'			=> esc_attr($data['tech_skill1']),
			'option_name' 	=> $option_name,
			'description'	=> 'Enter a number between 0 and 100 to describe how good you are. 0 is really bad and 100 is professional.'
		)
	);

	
	generateFields(count($option_values), $tabUrl, $mainSection, $option_name, $data);
}
add_action ('admin_init', 'initialise_shortcode_options');


function generateDefaultArray($num){
	$default_array;
	for ($i = 1; $i <= $num/3; ++$i) {
		$default_array['tech_Title' .$i] = '';
		$default_array['tech_description' .$i] = '';
		$default_array['tech_skill' .$i] = '';
	}
	return $default_array;
}

function generateFields($num, $tabUrl, $mainSection, $option_name, $data){
	
	for ($i = 1; $i <= $num/3; ++$i) {
		
		add_settings_field(
			'tech_Title' .$i, 
			$i.'. Title', 
			'title_callback', 
			$tabUrl,
			$mainSection, 
			array( 
				'name' 			=> 'tech_Title' .$i,
				'value' 		=> esc_attr( $data[ 'tech_Title' .$i ] ),
				'option_name' 	=> $option_name,
				'description'	=> 'Here you can enter the title of your ability.'
			)
		);
		add_settings_field(
			'tech_description' .$i, 
			$i.'. Description', 
			'input_callback', 
			$tabUrl,
			$mainSection, 
			array( 
				'name' 			=> 'tech_description' .$i,
				'value' 		=> esc_attr( $data[ 'tech_description' .$i ] ),
				'option_name' 	=> $option_name,
				'description'	=> 'Write some details about the ability in the title. What have you done, what do you like or not.'
			)
		);
		add_settings_field(
			'tech_skill' .$i, 
			$i.'. Skill', 
			'title_callback', 
			$tabUrl,
			$mainSection, 
			array( 
				'name' 			=> 'tech_skill' .$i,
				'value' 		=> esc_attr( $data[ 'tech_skill' .$i ] ),
				'option_name' 	=> $option_name,
				'description'	=> 'Enter a number between 0 and 100 to describe how good you are. 0 is really bad and 100 is professional.'
			)
		);
		if($i > 1){
			add_settings_field(
				'tech-delete-button' .$i, 
				'', 
				'delete_callback', 
				$tabUrl,
				$mainSection, 
				array( 
					'name' 			=> 'tech-delete-button',
					'option_name' 	=> $option_name,
					'description'	=> 'Delete'
				)
			);
		}
	}
}
