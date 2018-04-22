<?php
/**
 * Adds features and functions to the site.
 *
 * @package WordPress
 * @subpackage Referencer	
 * @since Referencer 0.1.0
 */

require_once( __DIR__. '/includes/referencerOptions.php');
require_once( __DIR__. '/includes/bootstrap-wp-navwalker.php');

/**---------------------------------------------------------------------------
* adding scripts
*---------------------------------------------------------------------------**/

// Add scripts and stylesheets (wp_enqueue = instantly loaded || wp_register_ = registered and can be enqued later in the code)
function frontend_scripts() {
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/bootstrap-4.0.0/css/bootstrap.min.css');
	wp_enqueue_style( 'fonts', "https://fonts.googleapis.com/css?family=Righteous|Ubuntu", false);
	wp_enqueue_style( 'fontAwesome-css', get_template_directory_uri() . '/fontawesome-5.0.9/web-fonts-with-css/css/fontawesome-all.min.css');
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/bootstrap-4.0.0/js/bootstrap.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true);
	wp_enqueue_style( 'main-css', get_template_directory_uri() . '/css/main.css' );
	wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', false, '', false);
	wp_enqueue_script('popper');
	wp_register_script('jQueryCircle',  get_template_directory_uri() . '/jquery-circle-progress/dist/circle-progress.min.js', false, '', false);
	wp_enqueue_script('jQueryCircle');
}
add_action( 'wp_enqueue_scripts', 'frontend_scripts' );


// Add stylesheets for the admin area
function admin_scripts(){
	//Core media script
	wp_enqueue_media();
	// Add the color picker css file       
    wp_enqueue_style( 'wp-color-picker' );
	// added alpha to colorpicker
	wp_enqueue_script( 'wp-color-picker-alpha', get_template_directory_uri() . '/js/wp-color-picker-alpha.js', array( 'wp-color-picker' ), $current_version, $in_footer );
	// Include our custom jQuery file with WordPress Color Picker dependency
	wp_enqueue_script( 'admin-js', get_template_directory_uri() . '/js/admin.js', array( 'wp-color-picker' ), false, true);
	wp_enqueue_style( 'admin-css', get_template_directory_uri() . '/css/admin.css' ); 
}
add_action( 'admin_enqueue_scripts', 'admin_scripts' );


// load text domain for translation
function referencer_localisation(){
	add_theme_support('title-tag');
    load_theme_textdomain( 'referencer', get_template_directory() . '/languages' );
	add_theme_support('post-thumbnails');
	register_nav_menus(
			array(
					'primary' =>  'Primary'
				)
			);
}
add_action( 'after_setup_theme', 'referencer_localisation' );


/**---------------------------------------------------------------------------
* adding dashboard option
*---------------------------------------------------------------------------**/

// adds menu section for the referencer theme in the wordpress dashboard
function register_dshboard_menu_section() {
	add_menu_page(
			'referencer options', 											//The text to be displayed in the title tags of the page
			'Referencer', 													//The text to be used for the menu
			'administrator', 												//The capability
			'referencer_theme_options' , 									//The slug name to refer to this menu
			'create_main_menu_option', 										//The function to be called to output the content
			get_bloginfo( template_directory ) . '/images/menu-pic.png', 	//The URL to the icon to be used for this menu
			80);															//The position in the menu order
}
add_action('admin_menu', 'register_dshboard_menu_section');

//displays menu content
function create_main_menu_option(){
	new ReferencerOptions('referencer_theme_options');
}

// added shortcode for the picture gallery
 function picture_gallery_shortcode() {
	include("picture-gallery-shortcode.php");
}
add_shortcode('picture-gallery', 'picture_gallery_shortcode');

// added shortcode for the reference page
 function references_shortcode() {
	include("reference-shortcode.php");
}
add_shortcode('references', 'references_shortcode');

 add_action('the_content','ravs_content_div');
 function ravs_content_div( $content ){
  return '<div>'.$content.'</div>';
 }

//load pages with ajax
function fetch_page_content() {
  if ( isset($_REQUEST) ) {
    $page_name = $_REQUEST['pageName'];
 	$page = get_page_by_title( $page_name[0] );
	$content = apply_filters('the_content', $page->post_content);
	ob_start();
	include('footer-ajax.php');
	$footer = ob_get_clean();
	$content .= $footer;
	echo $content;
  }
  die();
}
add_action( 'wp_ajax_fetch_page_content', 'fetch_page_content' );
add_action( 'wp_ajax_nopriv_fetch_page_content', 'fetch_page_content' );


function fetch_modal_content() {
  if ( isset($_REQUEST) ) {
    $post_id = $_REQUEST['postID'];
	include("single-picture-gallery.php");
  }
  die();
}
add_action( 'wp_ajax_fetch_modal_content', 'fetch_modal_content' );
add_action( 'wp_ajax_nopriv_fetch_modal_content', 'fetch_modal_content' );