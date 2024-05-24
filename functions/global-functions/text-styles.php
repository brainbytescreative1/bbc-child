<?php

function get_text_styles_bbc($field, $classes, $styles = false, $sub = false) {

    if ( $field ) {

        // initialize return arrays
        $return_array = [];
        $return_classes = [];

        // initialize style field
        $style = null;

        // determine if sub field
        if ( $sub ) {
            $style = get_sub_field($field);
        } else {
            $style = get_field($field);
        }

        // add fields to classes
        if ( $style['alignment'] ) {
            $classes[] = 'align-' . $style['alignment'];
        }

        if ( $style['theme_colors'] ) {
            $classes[] = 'text-' . $style['theme_colors'];
        }

        if ( $style['font_size'] && ( $style['font_size'] != 'default' ) ) {
            $classes[] = $style['font_size'];
        }

        if ( $style['font_weight'] && ( $style['font_weight'] != 'default' ) ) {
            $classes[] = 'weight-' . $style['font_weight'];
        }

        if ( $style['additional_classes'] ) {
            $classes[] = $style['additional_classes'];
        }

        // convert arrays to strings
        $return_classes = implode(' ', $classes);

        $return_array = ['classes' => $return_classes];

        return $return_array;

    }

}