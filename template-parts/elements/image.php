<?php

if( get_row_layout() == 'image' ):
                                        
    $image = get_sub_field('image');
    $image_size = get_sub_field('image_size');    
    
    if( $image ):

        $classes = [];
        $styles = [];

        $classes[] = 'img';
        $classes[] = 'element';

        $link_wrapper_tag = 'div';
        $image_link = get_sub_field('image_link');

        if ( $image_link ) {

            $title = $image_link['title'];
            $url = $image_link['url'];
            $target = $image_link['target'];
            if ( $target ) {
                $target = ' target="' . $target . ' "';
            }

            $link_wrapper_tag = 'a '. $target .' href="'. $url .'"';

        }

        // image settings
        $image_alignment = get_sub_field('image_alignment');
        if ( $image_alignment ) {
            if ( $image_alignment == 'left' ) {
                $classes[] = 'align-left';
                $classes[] = 'me-auto';
            } elseif ( $image_alignment == 'center' ) {
                $classes[] = 'align-center';
                $classes[] = 'ms-auto';
                $classes[] = 'me-auto';
            } elseif ( $image_alignment == 'right' ) {
                $classes[] = 'align-right';
                $classes[] = 'ms-auto';
            }
        }

        $force_full_width = get_sub_field('force_full_width');
        if ( $force_full_width && ( $force_full_width == 'yes' ) ) {
            $classes[] = 'force-full-width';
        }

        $max_width = get_sub_field('max_width');
        if ( $max_width && ( $max_width['value'] ) ) {
            $styles[] = 'max-width: ' . $max_width['value'] . $max_width['unit'] . ';';
        }

        $max_height = get_sub_field('max_height');
        if ( $max_height && ( $max_height['value'] ) ) {
            $styles[] = 'max-height: ' . $max_height['value'] . $max_height['unit'] . ';';
        }

        // Image variables.
        $url = $image['url'];
        $title = $image['title'];
        $alt = $image['alt'];
        $caption = $image['caption'];
    
        // Thumbnail size attributes.
        $size = $image_size;
        $thumb = $image['sizes'][ $size ];
        $width = $image['sizes'][ $size . '-width' ];
        $height = $image['sizes'][ $size . '-height' ];

        $classes[] = get_spacing_bbc(get_sub_field('image_spacing'));

        $classes[] = trim(get_sub_field('additional_classes'));

        $classes = trim(implode(' ', $classes));
        $styles = trim(implode(' ', $styles));

        ?>
        <<?=$link_wrapper_tag?> class="<?=$classes?>">
            <img src="<?=$thumb?>" alt="<?=$alt?>" style="<?=$styles?>" />
        </<?=$link_wrapper_tag?>>
    
    <?php endif;

endif;