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
		$styleHeader = get_option( "header_style_options" );
		$styleContent = get_option( "content_style_options" );
		$default = get_option( "general_options" );
	?>
	
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?php echo $default['page_description'] ?>">
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon-16x16.png" />
		<?php wp_head();?>

		<style>
			#header{
				background: <?php echo $styleHeader['color_header'] ?>; 
				<?php if ( $styleHeader['header_line'] === 'true' ) { ?>
				border-bottom: 2px solid <?php echo $styleHeader['color_header_line'] ?>;
				<?php }else{ ?>
				border-bottom: none;
				<?php } ?>
			}
			.logo{color: <?php echo $styleHeader['color_title'] ?>;}
			.menu .icon-bar{background-color: <?php echo $styleHeader['color_burger'] ?>;}
			.flag img {
				<?php if ( $styleHeader['shadow_flag'] === 'true' ) { ?>
				box-shadow: 2px 2px 7.5px; 
				<?php }else{ ?>
				box-shadow: none;
				<?php } ?>
				<?php if ( $styleHeader['translatable'] === 'true' ) { ?>
				display: inline-block; 
				<?php }else{ ?>
				display: none;
				<?php } ?>
			}
			.welcomeTitle{color: <?php echo $styleContent['color_welcomeTitle'] ?>;}
			.welcomeSubtitle{color: <?php echo $styleContent['color_welcomeSubTitle'] ?>;}
			#content{ background-image: <?php if($styleContent['background_image']) echo ('url("' . $styleContent['background_image'] . '")')?>;
		</style>
		<script>
		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
		</script>
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
			<div class="logo"><?php echo $default['headerTitle'] ?></div>
			<div class="flag">
				<span>
					<img src="<?php bloginfo('template_directory'); ?>/images/german-flag.svg" alt="german-flag">
				</span>
				<span>
					<img src="<?php bloginfo('template_directory'); ?>/images/english-flag.svg" alt="german-flag">
				</span>
			</div>
		</div>