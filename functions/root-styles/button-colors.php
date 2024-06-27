<?php

// populate button colors
add_filter('acf/load_field/name=button_color', function($field) {
	
    $primary = 'primary';
	$secondary = 'secondary';
	$success = 'success';
    $info = 'info';
    $danger = 'danger';
    $warning = 'warning';
    $gray = 'gray';
    $light = 'light';
    $dark = 'dark';
	$white = 'white';
	
	$choices = [];

	//$choices += array( 'default' => __('Default', 'bbc') );

    $primary_button_enable = get_field('primary_button', 'style');
    if ( $primary_button_enable['enable'] === 'enable' ) {
        $choices += array( $primary => __('Primary', 'bbc') );
    }

    $secondary_button_enable = get_field('secondary_button', 'style');
    if ( $secondary_button_enable['enable'] === 'enable' ) {
        $choices += array( $secondary => __('Secondary', 'bbc') );
    }

    $success_button_enable = get_field('success_button', 'style');
    if ( $success_button_enable['enable'] === 'enable' ) {
        $choices += array( $success => __('Success', 'bbc') );
    }

    $info_button_enable = get_field('info_button', 'style');
    if ( $info_button_enable['enable'] === 'enable' ) {
        $choices += array( $info => __('Info', 'bbc') );
    }

    $danger_button_enable = get_field('danger_button', 'style');
    if ( $danger_button_enable['enable'] === 'enable' ) {
        $choices += array( $danger => __('Danger', 'bbc') );
    }

    $warning_button_enable = get_field('warning_button', 'style');
    if ( $warning_button_enable['enable'] === 'enable' ) {
        $choices += array( $warning => __('Warning', 'bbc') );
    }

    $light_button_enable = get_field('light_button', 'style');
    if ( $light_button_enable['enable'] === 'enable' ) {
        $choices += array( $light => __('Light', 'bbc') );
    }

    $gray_button_enable = get_field('gray_button', 'style');
    if ( $gray_button_enable['enable'] === 'enable' ) {
        $choices += array( $gray => __('Gray', 'bbc') );
    }

    $dark_button_enable = get_field('dark_button', 'style');
    if ( $dark_button_enable['enable'] === 'enable' ) {
        $choices += array( $dark => __('Dark', 'bbc') );
    }

    $white_button_enable = get_field('white_button', 'style');
    if ( $white_button_enable['enable'] === 'enable' ) {
        $choices += array( $white => __('White', 'bbc') );
    }
    $choices += array( $white => __('White', 'bbc') );
	
	$field['choices'] = $choices;
	$field['default_value'] = null;
	return $field;

});