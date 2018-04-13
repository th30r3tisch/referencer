<?php
/**
 * Shortcode to display picture gallery
 *
 * @package WordPress
 * @subpackage Referencer	
 * @since Referencer 0.1.0
 */
?>

<div id="pictureShortcode">
	<?php $args = array(
			'numberposts' 		=> -1,
			'category_name'		=> "picture-gallery"
			);
			$postslist = get_posts( $args );
		foreach ($postslist as $post) :  setup_postdata($post); 
		?>  
			<a href="<?php echo get_permalink($post->ID); ?>">
				<?php echo get_the_post_thumbnail( $post->ID, 'thumbnail'); ?>
			</a>
		<div>
			<?php $post_tags = get_the_tags($post->ID);
 
				if ( $post_tags ) {
    			foreach( $post_tags as $tag ) {
    			echo $tag->name . ' '; 
    			}
				} ?>
		</div>
		<?php endforeach; ?>
</div>
