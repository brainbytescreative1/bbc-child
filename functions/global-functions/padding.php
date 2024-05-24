<?php

function get_menu_padding_bbc($field, $classes, $styles) {

    if ( $field ) {

        if ( $field && ( $field !== 'default' ) ) {
            $padding_styles = [
                '.25rem',
                '.25rem',
                '.5rem',
                '.75rem',
                '1rem',
                '1.25rem',
                '1.5rem',
                '1.75rem',
                '2rem'
            ];
            $padding_classes = [
                '1',
                '2',
                '3',
                '4',
                '5'
            ];
            if ( in_array( $field, $padding_styles ) ) {
                $styles[] = 'padding-top: '. $field . ';';
                $styles[] = 'padding-bottom: '. $field . ';';
            } elseif ( in_array( $field, $padding_classes ) ) {
                $classes[] = 'py-lg-' . $field;
            }
        }

        $return_array = [
            'classes' => $classes, 
            'styles' => $styles
        ];

        return $return_array;

    } else {
        return null;
    }

}