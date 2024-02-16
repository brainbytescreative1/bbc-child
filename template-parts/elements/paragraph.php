<?php

if( get_row_layout() == 'paragraph' ):
                
    // content
    $text = get_sub_field('text');

    if ( $text ) {

        $classes = [];
        $classes[] = 'text-wrapper';
        $classes[] = 'element';

        // style
        $remove_margin = get_sub_field('remove_margin_from_last_paragraph');
        if( $remove_margin && in_array('Remove', $remove_margin) ) {
            $classes[] = 'no-margin-bottom';
        }

        $colors = get_field('colors');

        $alignment = get_sub_field('alignment');
        if (  $alignment ) {
            $classes[] = 'align-' .  $alignment;
        }
        
        $color = get_sub_field('theme_colors');
        if ( $color && ( $color != 'default' ) ) {
            $classes[] = 'text-' . $color;
        }

        $font_size = get_sub_field('font_size');
        if ( $font_size && ( $font_size != 'default' ) ) {
            $classes[] = $font_size;
        }

        $font_weight = get_sub_field('font_weight');
        if ( $font_weight && ( $font_weight != 'default' ) ) {
            $classes[] = 'weight-' . get_sub_field('font_weight');
        }

        $classes[] = get_spacing_bbc(get_sub_field('paragraph_spacing'));

        $additional_classes = get_sub_field('additional_classes');
        if ( $additional_classes ) {
            $classes[] = $additional_classes;
        }

        $classes = implode(' ', $classes);

        ?>
        <div class="<?=$classes;?>">
            <?=$text;?>
        </div>
        <?php

    }

endif;