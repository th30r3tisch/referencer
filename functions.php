<?php
/**
 * Adds features and functions to the site.
 *
 * @package WordPress
 * @subpackage Referencer	
 * @since Referencer 0.1.0
 */


/**---------------------------------------------------------------------------
* adding scripts
*---------------------------------------------------------------------------**/

// Add scripts and stylesheets (wp_enqueue = instantly loaded || wp_register_ = registered and can be enqued later in the code)
function frontend_scripts() {
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap-4.0.0/css/bootstrap.min.css', array(), '4.0.0', 'all');
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap-4.0.0/js/bootstrap.min.js', array('jquery'), '4.0.0', true );
	wp_enqueue_script( 'mainJS', get_template_directory_uri() . '/js/main.js', array('jquery'));
	wp_enqueue_style( 'mainCSS', get_template_directory_uri() . '/css/main.css' );
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

    function referencer_localised( $locale ) {
        if ( isset( $_GET['l'] ) ) {
            return sanitize_key( $_GET['l'] );
        }
        return $locale;
    }
    add_filter( 'locale', 'referencer_localised' );

    load_theme_textdomain( 'referencer', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'referencer_localisation' );