<?php

// populate selected colors
add_filter('acf/load_field/name=theme_colors', function($field) {
	
	$primary = 'primary';
	$secondary = 'secondary';
	$success = 'success';
    $info = 'info';
    $danger = 'danger';
    $warning = 'warning';
    $text = 'text';
    $gray = 'gray';
    $light = 'light';
    $dark = 'dark';
	$white = 'white';
	
	$choices = [];

	if ( $text ) {
		$choices += array( $text => __('Text', 'bbc') );
	}

    if ( get_field('enable_primary', 'style') === 'enable' ) {
        $choices += array( $primary => __('Primary', 'bbc') );
    }

	if ( get_field('enable_secondary', 'style') === 'enable' ) {
		$choices += array( $secondary => __('Secondary', 'bbc') );
	}

    if ( get_field('enable_success', 'style') === 'enable' ) {
		$choices += array( $success => __('Success', 'bbc') );
	}

    if ( get_field('enable_info', 'style') === 'enable' ) {
		$choices += array( $info => __('Info', 'bbc') );
	}

    if ( get_field('enable_danger', 'style') === 'enable' ) {
		$choices += array( $danger => __('Danger', 'bbc') );
	}

    if ( get_field('enable_warning', 'style') === 'enable' ) {
		$choices += array( $warning => __('Warning', 'bbc') );
	}
	
	if ( get_field('enable_light', 'style') === 'enable' ) {
		$choices += array( $light => __('Light', 'bbc') );
	}

	if ( get_field('enable_dark', 'style') === 'enable' ) {
		$choices += array( $dark => __('Dark', 'bbc') );
	}

    if ( get_field('enable_gray', 'style') === 'enable' ) {
		$choices += array( $gray => __('Gray', 'bbc') );
	}
	
	if ( get_field('enable_white', 'style') === 'enable' ) {
		$choices += array( $white => __('White', 'bbc') );
	}
    
	
	$field['choices'] = $choices;
	$field['default_value'] = null;
	return $field;

});