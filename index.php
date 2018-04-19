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
	<?php get_sidebar('menu'); 
	
		while ( have_posts() ): the_post();
		?>
		<div class="entry-content-page">
			<?php 
			if(!is_home() && ! is_front_page()){
				the_title('<h2>', '</h2>');
			}
			the_content(); ?>
		</div>
		<?php
		endwhile; //resetting the page loop
		wp_reset_query(); //resetting the page query
	?>
	
	<div id="menuCloseBtn">
		<i class="far fa-caret-square-left fa-2x"></i>
	</div>
</div>

<?php get_footer(); ?>