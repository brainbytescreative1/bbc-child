<?php

function get_color_bbc($field, $return_styles = false, $sub = false ) {

if ( $field ) {

    // initialize arrays
    $return_array = [];
    $classes = [];
    $styles = [];

    // determine if sub field
    if ( $sub ) {
        $field = get_sub_field($field);
    } else {
        $field = get_field($field);
    }

    $theme_colors = $field['theme_colors'];
    $transparency = $field['transparency'];
    $custom_color = $field['custom_color'];

    if ( $return_styles ) {

        $color = '';

        $transparency = ( $transparency / 100 );

        if ( $custom_color ) {

            $custom_color = str_replace( '#', '', $custom_color );

            $split_hex_color = str_split( $custom_color, 2 );
            $rgb1 = hexdec( $split_hex_color[0] );
            $rgb2 = hexdec( $split_hex_color[1] );
            $rgb3 = hexdec( $split_hex_color[2] );

            return 'rgba('. $rgb1 .', '. $rgb2 .', '. $rgb3 .', '. $transparency .')';

        } else {

            return 'var(--' . $theme_colors . ')';

        }

    }

}

}