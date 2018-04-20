<?php
/**
 * Shortcode to display references
 *
 * @package WordPress
 * @subpackage Referencer	
 * @since Referencer 0.1.0
 */

$reference_shortcode = get_option( "shortcode_options" );
?>

<div id="referenceShortcode">
	<?php
	foreach($reference_shortcode as $key => $value){
		if (strpos($key, "tech_Title") === 0){
			echo ("<div class='ref-wrapper'><h3>". $value ."</h3>");
		}
		if (strpos($key, "tech_description") === 0){
			echo ("<div>". $value ."</div>");
		}
		if (strpos($key, "tech_skill") === 0){
			echo ("<span>". $value ."</span><div class='circle'><div class='value'></div></div></div>");
		}
	}
	?>
</div>
