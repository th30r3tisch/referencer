<?php
/**
 * Template Name: Start page
 *
 * @package WordPress
 * @subpackage Referencer	
 * @since Referencer 0.1.0
 */

$default = get_option( "general_options" );

get_header(); ?>
<div id="content">
	<?php get_sidebar('menu'); ?>
	<div class="entry-content-page">
		<div id="startpage">
			<div class="welcomeTitle"><?php echo $default['welcomeTitle'] ?></div>
			<div class="welcomeSubtitle"><?php echo $default['welcomeSubtitle'] ?></div>
		</div>
	</div>
	<div id="menuCloseBtn">
		<i class="far fa-caret-square-left fa-2x"></i>
	</div>
	<?php get_footer(); ?>
</div>