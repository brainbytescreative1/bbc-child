<?php

function get_text_styles_bbc($field) {

    if ( $field ) {

        $classes = [];

        // add fields to classes
        if ( isset ( $field['alignment'] ) ) {
            if ( $field['alignment'] ) {
                $classes[] = 'align-' . $field['alignment'];
            }
        }
        if ( isset ( $field['theme_colors'] ) ) {
            if ( $field['theme_colors'] ) {
                $classes[] = 'text-' . $field['theme_colors'];
            }
        }
        if ( isset ( $field['font_size'] ) ) {
            if ( $field['font_size'] && ( $field['font_size'] !== 'default' ) ) {
                $classes[] = $field['font_size'];
            }
        }
        if ( isset ( $field['font_weight'] ) ) {
            if ( $field['font_weight'] && ( $field['font_weight'] !== 'default' ) ) {
                $classes[] = 'weight-' . $field['font_weight'];
            }
        }
        if ( isset ( $field['line_height'] ) ) {
            if ( $field['line_height'] && ( $field['line_height'] !== 'default' ) ) {
                $classes[] = 'lh-' . $field['line_height'];
            }
        }
        if ( isset ( $field['font_family'] ) ) {
            if ( $field['font_family'] ) {
                $classes[] = 'font-' . $field['font_family'];
            }
        }
        if ( isset ( $field['text_transform'] ) ) {
            if ( $field['text_transform'] ) {
                $classes[] = 'text-' . $field['text_transform'];
            }
        }
        if ( isset ( $field['text_decoration'] ) ) {
            if ( $field['text_decoration'] ) {
                $classes[] = 'text-decoration-' . $field['text_decoration'];
            }
        }
        if ( isset ( $field['additional_classes'] ) ) {
            if ( $field['additional_classes'] ) {
                $classes[] = $field['additional_classes'];
            }
        }
        
        if ( $classes ) {
            return implode(' ', $classes);
        }

    }    

}