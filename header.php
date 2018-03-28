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