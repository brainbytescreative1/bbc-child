<?php

// populate divider shapes
add_filter('acf/load_field/name=top_divider_shape', function($field) {

    $choices = [];

    $choices += array( 'none' => __('None', 'bbc') );
	
	$section_dividers = null;
    $section_dividers = get_field('section_dividers', 'dividers');

    if ( $section_dividers ) {
        foreach ( $section_dividers as $divider ) {
            $choices += array( $divider['shape_class'] => __($divider['shape_name'], 'bbc') );
        }
    }
	
	$field['choices'] = $choices;
	$field['default_value'] = 'none';
	return $field;

});

add_filter('acf/load_field/name=bottom_divider_shape', function($field) {

    $choices = [];

    $choices += array( 'none' => __('None', 'bbc') );
	
	$section_dividers = null;
    $section_dividers = get_field('section_dividers', 'dividers');

    if ( $section_dividers ) {
        foreach ( $section_dividers as $divider ) {
            $choices += array( $divider['shape_class'] => __($divider['shape_name'], 'bbc') );
        }
    }
	
	$field['choices'] = $choices;
	$field['default_value'] = 'none';
	return $field;

});