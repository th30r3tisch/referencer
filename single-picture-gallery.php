<?php
/**
 * displays a single post
 *
 * @package WordPress
 * @subpackage Referencer	
 * @since Referencer 0.1.0
 */
?>

<div id="post-modal">
	<div><?php echo get_the_title($post_id); ?></div>
	<div>
		<span><?php echo get_the_author_meta('nickname', get_post_field( 'post_author', $post_id )); ?></span>
		<span><?php $post_tags = get_the_tags($post_id);
			if ( $post_tags ) {
				foreach( $post_tags as $tag ) {
					echo $tag->name . ' | '; 
				}
			} ?></span>
		<span><?php echo get_post_field( 'post_date', $post_id ); ?></span>
	</div>
	<div>
		<?php echo get_post_field( 'post_content', $post_id ); ?>
	</div>
</div>