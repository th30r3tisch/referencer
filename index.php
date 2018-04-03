<?php
/**
 * The main content template file
 *
 * @package WordPress
 * @subpackage Referencer	
 * @since Referencer 0.1.0
 */

get_header(); ?>

<div id="content">
	<?php get_sidebar('menu'); ?>

	<?php
			while ( have_posts() ): the_post();
			?>
			<div class="entry-content-page">
				<?php the_content(); ?>
			</div>
			<?php
			endwhile; //resetting the page loop
			wp_reset_query(); //resetting the page query
	?>
</div>

<?php get_footer(); ?>