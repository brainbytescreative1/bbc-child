<?php
/*
Accepts 4 parameters
$field = get ACF name (required)
$classes = classes of the element (required)
$styles = styles of the element (required)
$sub = whether the field is an ACF sub-field (optional)
*/
function get_background_bbc($field, $classes, $styles, $sub = false) {
    
    if ( $field ) {

        $return_array = [];

        $return_classes = [];
        $return_styles = [];
        $overlay = null;
        $overlay_color = null;
        $video_element = null;
        $video_script = null;
        $mobile_image_overlay = null;

        if ( $sub == true ) {
            $background = get_sub_field($field);
        } else {
            $background = get_field($field);
        }

        if ( $background ) {

            $background_content = $background['content'];

            if ( $background_content !== 'none' ) {

                $hex_color = null;
                $overlay_color = null;

                $theme_colors = $background['color']['theme_colors'];
                $custom_color = $background['color']['custom_color'];
                $background_gradient = $background['background_gradient'];
                $background_transparency = $background['color']['transparency'];
                $background_image_size = $background['background_image_size'];
                $background_image_format = $background['background_image_format'];
                $background_size_mobile = $background['background_size_mobile'];
                $background_position_mobile = $background['background_position_mobile'];

                $image = null;

                if ( $custom_color ) {

                    $hex_color = hexToRgb($custom_color, $background_transparency );

                } elseif ( $theme_colors ) {

                    $rgb_color = get_field($theme_colors, 'style');
                    $hex_color = hexToRgb($rgb_color, $background_transparency );

                }

                if ( $hex_color ) {
                    $return_styles[] = 'background-color: ' . $hex_color . ';';
                    $overlay_color = 'background-color: ' . $hex_color . ';';
                }

                if ( ( $background_content == 'image' ) ) {

                    $image = null;
                    $header_background_image_option = $background['background_image_source'];

                    if ( $header_background_image_option == 'featured' ) {

                        $post_id = get_the_ID();

                        $featured_image = get_the_post_thumbnail_url($post_id, $background_image_size);

                        if ( $featured_image ) {
                            $image = $featured_image;
                        }

                    } else {

                        $image = null;
                        $image_mobile = null;
                        $image = $background['image'];
                        $image_mobile = $background['image_upload_mobile'];
                        $size = $background_image_size;

                        if( $image_mobile ) {
                            $image_mobile = wp_get_attachment_image_url( $image_mobile, 'medium_large' );
                        } else {
                            $image_mobile = wp_get_attachment_image_url( $image, 'medium_large' );
                        }

                        if( $image ) {
                            $image = wp_get_attachment_image_url( $image, $size );
                        }

                        $mobile_image_styles = [];

                        if ( $background_size_mobile === 'default' ) {
                            $background_size_mobile = $background['size'];
                        }

                        if ( $background_position_mobile === 'default' ) {
                            $background_position_mobile = $background['position'];
                        } else {
                            $background_position_mobile = str_replace('-', ' ', $background_position_mobile);
                        }

                        if ( $background_image_format === 'optimized' ) {

                            /* webp test */
                            $handle = curl_init($image_mobile . '.webp');
                            
                            $image_mobile = isUrlValid($image_mobile);

                        }

                        if ( $background_gradient ) {
                            $mobile_image_styles[] = 'background: '. $background_gradient . ', url(' . $image_mobile . ');';
                        } elseif ( $hex_color ) {
                            $mobile_image_styles[] = 'background: linear-gradient(0deg, '. $hex_color .', '. $hex_color .'), url(' . $image_mobile . ');';
                        } else {
                            $mobile_image_styles[] = 'background: url(' . $image_mobile . ');';
                        }
                        $mobile_image_styles[] = 'background-size: ' . $background_size_mobile . ';';
                        $mobile_image_styles[] = 'background-position: ' . $background_position_mobile . ';';

                        $mobile_image_styles = implode(' ', $mobile_image_styles);

                        $mobile_image_overlay = '<div class="background-mobile" style="'. $mobile_image_styles .'"></div>';

                    }

                    $size = $background['size'];
                    $position = $background['position'];
                    $repeat = $background['repeat'];
                    $overlay_visibility = $background['overlay_visibility'];

                    if ( $image ) {

                        if ( $background_image_format === 'optimized' ) {

                            $image = isUrlValid($image);

                        }

                        if ( $background_gradient ) {
                            $return_styles[] = 'background: '. $background_gradient . ', url(' . $image . ');';
                        } elseif ( $hex_color ) {
                            $return_styles[] = 'background: linear-gradient(0deg, '. $hex_color .', '. $hex_color .'), url(' . $image . ');';
                        } else {
                            $return_styles[] = 'background: url(' . $image . ');';
                        }
                        
                        $return_styles[] = 'background-repeat: ' . $repeat . ';';
                        $return_styles[] = 'background-size: ' . $size . ';';
                        $return_styles[] = 'background-position: ' . $position . ';';

                        $return_classes[] = 'background-desktop';
                        
                        if ( $background_size_mobile && ( $background_size_mobile !== 'default' ) ) {
                            $return_classes[] = 'background-size-mobile-' . $background_size_mobile;
                        }
                        if ( $background_position_mobile && ( $background_position_mobile !== 'default' ) ) {
                            $return_classes[] = 'background-position-mobile-' . $background_position_mobile;
                        }

                    }

                }

                if ( $background_content == 'video' ) {

                    $video = $background['video'];
                    
                    if ( $video ) {
                        $video_src = null;
                        $js_video = null;
                        $video_id = rand(0,9999);

                        $overlay_styles = [];

                        ?>
                        <?php
                        $video_src = '<script>updateVideoBgURL("'.strval($video).'");</script>';

                        $video_element = '<video class="mobile-hide" playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">'. $video_src .'</video>';

                        if ( $background_gradient ) {
                            $overlay_styles[] = 'background: '. $background_gradient . ';';
                        } elseif ( $hex_color ) {
                            $overlay_styles[] = 'background: linear-gradient(0deg, '. $hex_color .', '. $hex_color .');';
                        } else {
                            $overlay_styles[] = 'background: url(' . $hex_color . ');';
                        }

                        $overlay_styles = implode(' ', $overlay_styles);

                        $overlay = '<div class="overlay" style="'. $overlay_styles .'"></div>';

                    }

                    $return_classes[] = 'video-bg';

                }

                $return_classes = implode(' ', $return_classes);
                $return_styles = implode(' ', $return_styles);

                $return_array = [
                    'classes' => $return_classes, 
                    'styles' => $return_styles, 
                    'overlay' => $overlay, 
                    'video' => $video_element, 
                    'video_script' => $video_script,
                    'mobile_image_overlay' => $mobile_image_overlay
                ];

            }
            
            return $return_array;

        } else {

            return null;

        }

    }

}