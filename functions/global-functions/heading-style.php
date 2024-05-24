<?php

function get_heading_style_bbc( $field, $sub = false ) {

    if ( $field ) {
        
        if ( $sub == true ) {
            $field = get_sub_field($field);
        } else {
            $field = get_sub_field($field);
        }

        if ( $field ) {

            $classes = [];

            // style
            if ( $field['alignment'] && ( $field['alignment'] != 'default' ) ) {

                $alignment = '';

                if ( $field['alignment'] === 'left' ) {
                    $alignment = 'start';
                } elseif ( $field['alignment'] === 'right' ) {
                    $alignment = 'end';
                } else {
                    $alignment = 'center';
                }

                $classes[] = 'text-' . $alignment;
            } else {
                $classes[] = 'text-start';
            }
            if ( $field['theme_colors'] ) {
                $classes[] = 'text-' . $field['theme_colors'];
            }
            if ( $field['font_size'] && ( $field['font_size'] != 'default' ) ) {
                $classes[] = $field['font_size'];
            }
            if ( $field['font_weight'] && ( $field['font_weight'] != 'default' ) ) {
                $classes[] = 'weight-' . $field['font_weight'];
            }
            if ( $field['font_weight'] && ( $field['font_weight'] != 'default' ) ) {
                $classes[] = 'weight-' . $field['font_weight'];
            }
            if ( $field['font_family'] && ( $field['font_family'] != 'default' ) ) {
                $classes[] = 'font-' . $field['font_family'];
            }
            if ( $field['additional_classes'] ) {
                $classes[] = $field['additional_classes'];
            }

            $classes = implode(' ', $classes);

            return $classes;

        }

    }

}