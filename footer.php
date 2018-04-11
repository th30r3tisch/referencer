<?php
/**
 * The template for displaying the footer
 *
 * @package WordPress
 * @subpackage Referencer	
 * @since Referencer 0.1.0
 */

?>

	<div id="footer">
		<div class="d-none d-sm-block">
		Copyright © 2018 &nbsp; &nbsp; Theodor Günther
		</div>
		<div class="d-sm-none">
		© 2018  &nbsp; T.Günther
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