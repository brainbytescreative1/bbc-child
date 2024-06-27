<?php

function get_rgb_color_bbc( $field, $sub = false ) {
    if ( $field ) {
        $return_color = null;
        if ( $sub ) {
            $field = get_sub_field($field);
        } else {
            $field = get_field($field);
        }
        $transparency = null;
        if ( isset ( $field['transparency'] ) ) {
            if ( $field['transparency'] ) {
                $transparency = $field['transparency'];
            }
        }
        if ( !$transparency ) {
            $return_color = 'transparent';
        } else {
            if ( isset ( $field['custom_color'] ) ) {
                if ( $field['custom_color'] ) {
                    $return_color = $field['custom_color'];
                    if ( $transparency < 100 ) {
                        $return_color = hexToRgb($field['custom_color'], $transparency);
                    } else {
                        $return_color = $field['custom_color'];
                    }
                } elseif ( isset ( $field['theme_colors'] ) ) {
                    if ( $field['theme_colors'] ) {
                        if ( $transparency < 100 ) {
                            $return_color = hexToRgb(get_field($field['theme_colors'], 'style'), $transparency );
                        } else {
                            $return_color = 'var(--'. $field['theme_colors'] .')';
                        }
                    }
                }
            }
        }
        return $return_color;
    } else {
        return null;
    }
}

function hexToRgb($hex, $alpha = false) {
    if ( $hex ) {
        $hex      = str_replace('#', '', $hex);
        $length   = strlen($hex);
        $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
        $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
        $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
        if ( $alpha ) {
        $rgb['a'] = $alpha / 100;
        return 'rgba(' . $rgb['r'] . ', ' . $rgb['g'] . ', ' . $rgb['b'] . ', ' . $rgb['a'] . ')';
        } else {
            return 'rgb(' . $rgb['r'] . ', ' . $rgb['g'] . ', ' . $rgb['b'] . ')';
        }
    } else {
        return null;
    }
}

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