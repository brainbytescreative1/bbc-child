<?php

// add classes to submit button
add_filter( 'gform_submit_button', 'add_custom_css_classes', 10, 2 );
function add_custom_css_classes( $button, $form ) {
	$dom = new DOMDocument();
	$dom->loadHTML( '<?xml encoding="utf-8" ?>' . $button );
	$input = $dom->getElementsByTagName( 'input' )->item(0);
	$classes = $input->getAttribute( 'class' );
	$classes .= " btn btn-success";
	$input->setAttribute( 'class', $classes );
	return $dom->saveHtml( $input );
}

add_action( 'gform_admin_pre_render', 'add_merge_tags' );
function add_merge_tags($form) { ?>    
    <script type = "text/javascript" >
        gform.addFilter('gform_merge_tags', 'add_merge_tags');

    function add_merge_tags(mergeTags, elementId, hideAllFields, excludeFieldTypes, isPrepop, option) {
        mergeTags["custom"].tags.push({
            tag: '{Site_Name}',
            label: 'Site Name'
        });
        return mergeTags;
    } </script> 
<?php
    //return the form object from the php hook  
    return $form;
}

add_filter('gform_replace_merge_tags', 'replace_site_name', 10, 7);

function replace_site_name($text, $form, $entry, $url_encode, $esc_html, $nl2br, $format) {
    $custom_merge_tag = '{Site_Name}';
    if (strpos($text, $custom_merge_tag) === false) {
        return $text;
    }
    $siteName = get_bloginfo('name');
    $text = str_replace($custom_merge_tag, $siteName, $text);
    return $text;
}