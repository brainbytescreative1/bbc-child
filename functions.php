<?php
/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



/**
 * Enqueue our stylesheet and javascript file
 */
function theme_enqueue_styles() {

	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";
	
	$css_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_styles );

	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $css_version );
	wp_enqueue_script( 'jquery' );
	
	$js_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_scripts );
	
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $js_version, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );



/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'add_child_theme_textdomain' );



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version() {
	return 'bootstrap5';
}
add_filter( 'theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20 );

// container width
function understrap_default_container_type() {
	return 'container';
}
add_filter( 'theme_mod_understrap_container_type', 'understrap_default_container_type', 20 );

// navigation type
function understrap_default_navbar_type() {
	return 'offcanvas';
}
add_filter( 'theme_mod_understrap_navbar_type', 'understrap_default_navbar_type', 20 );

// sidebar positioning
function understrap_default_sidebar_position() {
	return 'none';
}
add_filter( 'theme_mod_understrap_sidebar_position', 'understrap_default_sidebar_position', 20 );


/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js() {
	wp_enqueue_script(
		'understrap_child_customizer',
		get_stylesheet_directory_uri() . '/js/customizer-controls.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js' );


/*** custom functions ***/

// enqueue custom stylesheet
function bbc_stylesheet_js() {
	wp_enqueue_style( 'bbc-style', get_stylesheet_directory_uri() . '/style.css', false, '1.0.2' );
	wp_enqueue_script( 'bbc-scripts', get_stylesheet_directory_uri() . '/js/bbc-scripts.js', array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'bbc_stylesheet_js' );

// enqueue admin stylesheet
add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
	wp_enqueue_style( 'admin_css', get_stylesheet_directory_uri() . '/bbc-admin-style.css', false, '1.0.0' );
    wp_enqueue_style( 'admin_front_css', get_stylesheet_directory_uri() . '/style.css', false, '1.0.0' );
}

// enqueue acf admin stylesheet
//add_action('acf/input/admin_enqueue_scripts', 'my_acf_admin_enqueue_scripts');
function my_acf_admin_enqueue_scripts() {
    wp_enqueue_style( 'my-acf-input-css', get_stylesheet_directory_uri() . '/style.css', false, '1.0.0' );
}

// mce fix
function slug_editor_body_margin_fix( $settings ) {
	if ( isset( $settings['content_style'] ) ) {
		$settings['content_style'] .= ' body#tinymce { margin: 9px 10px; }';
	} else {
		$settings['content_style'] = 'body#tinymce { margin: 9px 10px; }';
	}
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'slug_editor_body_margin_fix' );

// add gutenberg styles
add_action( 'after_setup_theme', 'misha_gutenberg_css' );
function misha_gutenberg_css(){
	add_theme_support( 'editor-styles' );
	add_editor_style( get_stylesheet_directory_uri() . '/style.css' );
	add_editor_style( 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' );
}

// Enqueue WordPress theme styles within Gutenberg
function organic_origin_gutenberg_styles() {
	wp_enqueue_style( 'organic-origin-gutenberg', get_theme_file_uri( '/css/gutenberg.css' ), false, '1.0', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'organic_origin_gutenberg_styles' );

// register blocks
add_action( 'init', 'register_acf_blocks' );
function register_acf_blocks() {
	register_block_type( __DIR__ . '/template-parts/blocks/section' );
}

// disable wp jquery
//add_filter( 'wp_enqueue_scripts', 'change_default_jquery', PHP_INT_MAX );
function change_default_jquery( ){
    wp_dequeue_script( 'jquery');
    wp_deregister_script( 'jquery');   
}

// include separate functions files
require_once( __DIR__ . '/functions/options-pages.php');
require_once( __DIR__ . '/functions/root-style.php');
require_once( __DIR__ . '/functions/menus.php');
require_once( __DIR__ . '/functions/blocks.php');
require_once( __DIR__ . '/functions/post-types.php');
require_once( __DIR__ . '/functions/images.php');
require_once( __DIR__ . '/functions/shortcodes.php');
require_once( __DIR__ . '/functions/forms.php');
require_once( __DIR__ . '/functions/global-functions.php');