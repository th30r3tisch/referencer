<?php
/**
 * Adds features and functions to the site.
 *
 * @package WordPress
 * @subpackage Referencer	
 * @since Referencer 0.1.0
 */

require_once( __DIR__. '\includes\referencerOptions.php');

/**---------------------------------------------------------------------------
* adding scripts
*---------------------------------------------------------------------------**/

// Add scripts and stylesheets (wp_enqueue = instantly loaded || wp_register_ = registered and can be enqued later in the code)
function frontend_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap-4.0.0/css/bootstrap.min.css');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap-4.0.0/js/bootstrap.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'mainJS', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true);
	wp_enqueue_style( 'mainCSS', get_template_directory_uri() . '/css/main.css' );
	wp_register_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', false, '', true);
	wp_enqueue_script('popper');
}
add_action( 'wp_enqueue_scripts', 'frontend_scripts' );


// Add stylesheets for the admin area
function admin_scripts(){
	//Core media script
	wp_enqueue_media();
	
	wp_enqueue_script( 'adminJS', get_template_directory_uri() . '/js/admin.js');
	wp_enqueue_style( 'adminCSS', get_template_directory_uri() . '/css/admin.css' );
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
			'RefO', 														//The text to be used for the menu
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