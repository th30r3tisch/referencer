<?php
/**
 * It the template that WordPress shows when links are broken or don’t work.
 * Generates a page when a page or post does not exist.
 * 
 * @package WordPress
 * @subpackage Referencer
 * @since Referencer 0.1.0
 * 
 */
get_header(); ?>

<div id="content">
	<div id="error">
		<p><?php _e("Oops !") ?></p>
		<p><?php _e("Entschuldigung, die aufgerufene Url existiert nicht.") ?></p>
	</div>
</div>

<?php get_footer(); ?>