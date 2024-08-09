<?php

if ( class_exists( 'GFCommon' ) ) {

    // add classes to submit button
    add_filter( 'gform_submit_button', 'add_custom_css_classes', 10, 2 );
    function add_custom_css_classes( $button, $form ) {

        $submit_classes = [];
        $submit_button_classes = get_field('submit_button_classes', 'forms');
        if ( $submit_button_classes ) {
            $submit_classes[] = $submit_button_classes;
        }
        $submit_classes = implode(' ', $submit_classes);

        $dom = new DOMDocument();
        $dom->loadHTML( '<?xml encoding="utf-8" ?>' . $button );
        $input = $dom->getElementsByTagName( 'input' )->item(0);
        $classes = $input->getAttribute( 'class' );
        $classes .= ' ' . $submit_classes;
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

    // populate forms
    add_filter('acf/load_field/name=form', function($field) {
        
        $forms = [];
        $forms_list = GFAPI::get_forms();
        foreach ($forms_list as $form) {
            $id = $form['id'];
            $title = $form['title'];
            $forms[] = [ $form['id'], $form['title'] ];
        }

        $choices = [];

        // if enabled and exist
        foreach ($forms as $form) {
            $choices += array( $form[0] => __(ucfirst($form[1]), 'bbc') );
        } 
        
        $field['choices'] = $choices;
        $field['default_value'] = null;
        return $field;

    });

    // after confirmation shortcode
    function bbc_after_confirmation_shortcode($atts) {

        $default = array(
            'event' => 'gravity_form_submission',
            'formID' => 'consult_form',
            'email' => '{Email:3}',
            'phone' => '{Phone:4}',
        );

        $a = shortcode_atts($default, $atts);

        ob_start();
        ?>

        <script>
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            'event': <?=$a['event']?>,
            'formID': <?=$a['formID']?>, 
            'email': <?=$a['email']?>,
            'phone': <?=$a['phone']?>
        });
        </script>

        <?php
        return ob_get_clean();

    }
    add_shortcode( 'after_confirmation', 'bbc_after_confirmation_shortcode' );

}