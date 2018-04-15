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
	<div id="modalHead">
		<span class="downToInfo">Info</span>
		<button type="button" class="close" data-dismiss="modal">Close</button>
	</div>
	<?php echo get_the_post_thumbnail( $post_id); ?>
	<h2><?php echo get_the_title($post_id); ?></h2>
	<div class="picPostInfo">
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
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>