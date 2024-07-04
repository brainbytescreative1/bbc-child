<?php

// disable wp jquery
//add_filter( 'wp_enqueue_scripts', 'change_default_jquery', PHP_INT_MAX );
function change_default_jquery( ){
    wp_dequeue_script( 'jquery');
    wp_deregister_script( 'jquery');   
}

// disable gutenberg frontend styles
//add_filter('wp_enqueue_scripts', 'disable_gutenberg_wp_enqueue_scripts', 100);
function disable_gutenberg_wp_enqueue_scripts() {
	
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	
	wp_dequeue_style('wc-block-style'); // disable woocommerce frontend block styles
	wp_dequeue_style('storefront-gutenberg-blocks'); // disable storefront frontend block styles
	
}

// enqueue acf admin stylesheet
//add_action('acf/input/admin_enqueue_scripts', 'my_acf_admin_enqueue_scripts');
function my_acf_admin_enqueue_scripts() {
    // Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	// Grab asset urls.
	$theme_styles  = "/css/child-theme{$suffix}.css";
	$theme_scripts = "/js/child-theme{$suffix}.js";
	
	$css_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . $theme_styles );

    wp_enqueue_style( 'my-acf-input-css', get_stylesheet_directory_uri() . '/style.css', false, $css_version );
}