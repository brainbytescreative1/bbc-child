<?php

function get_flex_bbc( $field ) {

    $classes = [];

    if ( $field ) {

        $enable_flex = $field['enable_flex'];

        if ( $enable_flex == 'enable' ) {

            $classes[] = 'd-flex';

            $mobile_flex = $field['mobile_flex'];

            $flex_direction = $field['flex_direction'];
            $flex_wrap = $field['flex_wrap'];
            $align_content = $field['align_content'];
            $justify_content = $field['justify_content'];
            $align_items = $field['align_items'];

            $last_element = $field['last_element'];

            if ( $flex_direction != 'normal' ) {
                $classes[] = $flex_direction;
            }
            if ( $flex_wrap != 'normal' ) {
                $classes[] = $flex_wrap;
            }
            if ( $align_content != 'normal' ) {
                $classes[] = $align_content;
            }
            if ( $justify_content != 'normal' ) {
                $classes[] = $justify_content;
            }
            if ( $align_items != 'normal' ) {
                $classes[] = $align_items;
            }

        }

        $classes = trim(implode(' ', $classes));

        return $classes;

    } else {

        return null;

    }

}