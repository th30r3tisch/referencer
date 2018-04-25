<?php
/**
 * The template for displaying the footer in an ajax call
 *
 * @package WordPress
 * @subpackage Referencer	
 * @since Referencer 0.1.0
 */

$default = get_option( "general_options" );
$mediaOptions = get_option( "social_options" );

?>

<div id="footer-ajax">
	<div class="d-none d-sm-block">
		<?php echo $default['footer_text'] ?>
	</div>
	<div class="d-sm-none">
		<?php echo $default['footer_text_mobile'] ?>
	</div>
	<div>
		<div class="linksOfRight">
			<a href="<?php $url = admin_url(); echo esc_url( $url );?>">
				Login | </a>
			<a  href="<?php $url = get_home_url()."/datenschutz"; echo esc_url( $url );?>">
				<?php _e("Privacy policy") ?> | </a>
			<a href="<?php $url = get_home_url()."/impressum"; echo esc_url( $url );?>">
				<?php _e( "Imprint" )?></a>
		</div>
	</div>
	<div id="mediaLinks">
		<?php
		foreach ( $mediaOptions as $key => $val ) {
			if ( $mediaOptions[ $key ] != '' ) {
				echo '<a href="' . $mediaOptions[ $key ] . '" class="fab fa-' . $key . ' fa-2x"></a>';
			}
		}
		unset( $mediaOptions[ $key ] );
		?>
	</div>
</div>