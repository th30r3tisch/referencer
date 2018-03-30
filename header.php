<?php
/**
 * The template for displaying the header
 *
 * @package WordPress
 * @subpackage Referencer	
 * @since Referencer 0.1.0
 **/
?>
<!DOCTYPE html>
<html lang="de">

	<?php 
		$style = get_option( "" ); 
		$default = get_option( "general_options" ); 
	?>
	
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?php echo $default['page_description'] ?>">

		<?php wp_head();?>

		<style>

		</style>
	</head>
	<body>
		<div id="header">
			<div class="menu">
				<button type="button">
					<div class="icon-bar"></div> 
					<div class="icon-bar"></div> 
					<div class="icon-bar"></div>
				</button>
			</div>
			<div class="logo"></div>
			<div class="flag">
				<span>
					<img src="<?php bloginfo('template_directory'); ?>/images/german-flag.svg" alt="german-flag">
				</span>
				<span>
					<img src="<?php bloginfo('template_directory'); ?>/images/english-flag.svg" alt="german-flag">
				</span>
			</div>
		</div>