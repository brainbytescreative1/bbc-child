<?php

function get_advanced_bbc($field = false, $sub = true, $classes = false, $id = false) {

if ( $field ) {
    if ( $sub = false ) {
        $field = get_field($field);
    } else {
        $field = get_sub_field($field);
    }
}   

// initialize
$advanced_classes = [];
$advanced_id = '';

if ( $field ) {
    // classes
    if ( $field['classes'] ) {
        $advanced_classes[] = $field['classes'];
    }
    if ( $field['hide_desktop'] ) {
        $advanced_classes[] = 'desktop-hide';
    }
    if ( $field['hide_tablet'] ) {
        $advanced_classes[] = 'tablet-hide';
    }
    if ( $field['hide_mobile'] ) {
        $advanced_classes[] = 'mobile-hide';
    }
    // id
    if ( $field['unique_id'] ) {
        $advanced_id = trim( $field['unique_id'] );
        $advanced_id = $str=preg_replace('/\s+/', '', $advanced_id);
    }
}

// process
$advanced = array(
    'classes' => null,
    'id' => null,
);
if ( $advanced_classes ) {
    $advanced['classes'] = trim(implode(' ', $advanced_classes));
}
if ( $advanced_id ) {
    $advanced['id'] = $advanced_id;
}

return $advanced;

}