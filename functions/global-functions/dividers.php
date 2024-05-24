<?php

function get_dividers_bbc($position = 'bottom') {

    // initialize classes
    $classes = [];
    $classes[] = 'element';
    $classes[] = 'shape-divider';
    $classes[] = 'divider-' . $position;

    // set defaults
    $color = 'primary';
    $flip_horizontally = 'no';
    $invert = 'no';
    $negative_margin = 'no';

    // get divider section fields
    $shape = get_field($position . '_divider_shape');
    $color = get_field($position . '_divider_color');
    $flip_horizontally = get_field($position . '_divider_flip_horizontally');
    $invert = get_field($position . '_divider_invert');

    // assign classes
    if ( $color['theme_colors'] ) {
        $classes[] = 'divider-' . $color['theme_colors'];
    }
    if ( $shape ) {
        $classes[] = $shape;
    }
    if ( $flip_horizontally === 'yes' ) {
        $classes[] = 'flip-horizontally';
    }
    if ( $invert === 'yes' ) {
        $classes[] = 'invert';
    }

    $classes = trim(implode(' ', $classes));

    return '<div class="'. $classes .'"><div class="divider-inner"></div></div>';

}