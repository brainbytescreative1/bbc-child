<?php
/*
Accepts 2 parameters
$field = get ACF name (required)
$sub = whether the field is an ACF sub-field (optional)
*/
function get_background_bbc($field, $sub = false) {
    
    if ( $field ) {

        // get background field
        $background = null;
        if ( $sub === true ) {
            $background = get_sub_field($field);
        } else {
            $background = get_field($field);
        }

        if ( $background ) {

            $content = if_array_value($background, 'content');

            if ( $content !== 'none' ) {

                // color overlay
                $overlay = null;
                $overlay_classes = [];
                $overlay_classes[] = 'overlay';
                $color = if_array_value($background, 'color');
                $gradient = if_array_value($background, 'background_gradient');
                if ( $gradient ) {
                    $overlay_color = $gradient;
                } elseif ( $color ) {
                    $overlay_color = get_rgb_color_bbc($color, false);
                }
                $overlay_visibility = if_array_value($background, 'overlay_visibility');
                if ( $overlay_visibility === 'mobile' ) {
                    $overlay_classes[] = 'desktop-hide tablet-hide';
                } elseif ( $overlay_visibility === 'desktop' ) {
                    $overlay_classes[] = 'mobile-hide';
                }
                $overlay_classes = trim( implode(' ', $overlay_classes) );

                if ( $overlay_color ) {
                    $overlay = '<div class="'. $overlay_classes.'" style="background: '. $overlay_color .'"></div>';
                }

                // image
                $image = if_array_value($background, 'image');
                $image_source = if_array_value($background, 'background_image_source');
                $image_mobile = if_array_value($background, 'image_upload_mobile');

                if ( $image_source === 'featured' ) {
                    $post_id = get_the_ID();
                    $featured_image = get_post_thumbnail_id($post_id);
                    if ( $featured_image ) {
                        $image = $featured_image;
                    }
                }

                // initialize image mobile
                $image_classes_mobile = [];
                $image_classes_mobile[] = 'bg-image';
                $image_classes_mobile[] = 'desktop-hide';
                $image_classes_mobile[] = 'tablet-hide';
                
                // initialize image desktop
                $image_classes = [];
                $image_classes[] = 'bg-image';
                $image_classes[] = 'mobile-hide';

                // alt text
                $image_alt = get_post_meta($image, '_wp_attachment_image_alt', TRUE);
                $image_alt_mobile = get_post_meta($image_mobile, '_wp_attachment_image_alt', TRUE);

                // if no separate mobile image, assign to desktop
                if ( !$image_mobile ) {
                    $image_mobile = $image;
                    $image_alt_mobile = $image_alt;
                }

                // background object fit
                $object_fit = if_array_value($background, 'size');
                $object_fit_mobile = if_array_value($background, 'background_size_mobile');
                if ( $object_fit_mobile !== 'default' ) {
                    $image_classes[] = 'object-fit-md-' . $object_fit;
                    $image_classes[] = 'object-fit-' . $object_fit_mobile;

                    $image_classes_mobile[] = 'object-fit-md-' . $object_fit;
                    $image_classes_mobile[] = 'object-fit-' . $object_fit_mobile;
                } else {
                    $image_classes[] = 'object-fit-' . $object_fit;
                    $image_classes_mobile[] = 'object-fit-' . $object_fit;
                }

                // background object position
                $position = if_array_value($background, 'position');
                if ( $position ) {
                    $position = str_replace(' ', '-', $position);
                }
                $position_mobile = if_array_value($background, 'background_position_mobile');
                if ( $position_mobile ) {
                    $position_mobile = str_replace(' ', '-', $position_mobile);
                }
                if ( $position_mobile !== 'default' ) {
                    $image_classes[] = 'object-position-md-' . $position;
                    $image_classes[] = 'object-position-' . $position_mobile;

                    $image_classes_mobile[] = 'object-position-md-' . $position;
                    $image_classes_mobile[] = 'object-position-' . $position_mobile;
                } else {
                    $image_classes[] = 'object-position-' . $position;
                    $image_classes_mobile[] = 'object-position-' . $position;
                }

                // image max width
                $image_size = if_array_value($background, 'background_image_size');
                $size_max_width = null;
                switch ($image_size) {
                    case '2048x2048':
                        $size_max_width = '1920px';
                        break;
                    case 'large':
                        $size_max_width = '1024px';
                        break;
                    case 'medium_large':
                        $size_max_width = '768px';
                        break;
                    case 'medium':
                        $size_max_width = '300px';
                        break;
                    case 'thumbnail':
                        $size_max_width = '150px';
                        break;
                    default:
                        $size_max_width = '1024px';
                }

                $image_classes_mobile = trim( implode(' ', $image_classes_mobile) );
                $image_classes = trim( implode(' ', $image_classes) );                

                // video
                $video = if_array_value($background, 'video');

                ob_start();

                ?>

                <div class="bg-container">
                    <?php if ( $image && ( ( $content === 'image' ) || ( $content === 'video' ) ) ) { ?>
                    <div class="bg-image-container">
                        <img class="<?=$image_classes?>" fetchpriority="lazy" decoding="async" <?php get_responsive_image_bbc($image, $image_size, $size_max_width); ?>  alt="<?=$image_alt?>" />
                        <img class="<?=$image_classes_mobile?>" fetchpriority="lazy" decoding="async" <?php get_responsive_image_bbc($image_mobile, 'medium_large', '768px'); ?>  alt="<?=$image_alt?>" />
                    </div>                    
                    <?php } ?>

                    <?php if ( $video && ( $content === 'video' ) ) { ?>
                    <video class="video-bg mobile-hide" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop"><source src="<?=$video?>" type="video/mp4" /></video>
                    <?php } ?>

                    <?=$overlay?>
                </div>

                <?php

                return ob_get_clean();
            }

        }

    }

}
