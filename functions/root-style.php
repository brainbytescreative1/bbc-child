<?php

require_once( __DIR__ . '/root-styles/root-styles-function.php');
require_once( __DIR__ . '/root-styles/button-colors.php');
require_once( __DIR__ . '/root-styles/color-palettes.php');
require_once( __DIR__ . '/root-styles/selected-colors.php');

// add site settings css variables
add_action('wp_head', 'global_site_variables');
add_action( 'enqueue_block_assets', 'global_site_variables' );