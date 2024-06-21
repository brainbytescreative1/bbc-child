<?php

function get_heading_bbc( $field ) {
    if ( $field ) {

        // initialize variables
        $heading = null;
        $classes = [];

        // content
        $text = $field['text'];
        $tag = $field['tag'];

        // spacing
        $spacing = $field['heading_spacing'];

        $text_styles = $field['text_styles'];

        if ( $text_styles ) {
            $classes[] = get_text_styles_bbc($text_styles );
        }

        $classes[] = get_spacing_bbc($spacing);

        $classes = trim(implode(' ', array_unique($classes)));

        $heading = '<' . $tag . ' class="'. esc_attr($classes) .'">' . $text . '</' . $tag . '>';

        return $heading;

    }
}