<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage Referencer	
 * @since Referencer 0.1.0
 */

$default = get_option( "general_options" );

?>

	<div id="footer">
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
					Privacy policy | </a>
				<a href="<?php $url = get_home_url()."/impressum"; echo esc_url( $url );?>">
					Imprint</a>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
	</body>
</html>