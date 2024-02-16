<?php

function get_page_width_bbc( $field, $container, $post_id = false, $sub = false )  {

    if ( $field ) {

        $content_width = null;
        $container_class = null;

        if ( $post_id ) {
            $post_id = $post_id;
        } else {
            $post_id = false;
        }

        if ( $sub === true ) {
            $content_width = get_sub_field($field, $post_id);
        } else {
            $content_width = get_field($field, $post_id);
        }

        if ( $content_width ) {
            $container_class = $content_width;
            return $container_class;
        } else {
            return $container;
        }

    }

}

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

        if ( $sub == true ) {
            $background = get_sub_field($field);
        } else {
            $background = get_field($field);
        }

        if ( $background ) {

            $background_content = $background['content'];

            if ( ( $background_content !== 'none' ) && ( $background_content !== 'overlay' ) ) {

                $background_color = null;
                $overlay_color = null;

                $theme_colors = $background['color']['theme_colors'];
                $custom_color = $background['color']['custom_color'];
                $background_transparency = $background['color']['transparency'];

                if ( $custom_color ) {

                    $return_styles[] = 'background-color: ' . $custom_color . ';';
                    $overlay_color = 'background-color: ' . $custom_color . ';';

                } else {

                    $background_color = $theme_colors;

                }

                if ( $background_color ) {

                    $background_color = 'bg-' . $background_color;
                    
                    if ( $background_color ) {
                        $overlay_color = $background_color;
                    }
                    
                    $return_classes[] = $background_color;
                }

                if ( ( $background_content == 'image' ) || ( $background_content == 'video' ) ) {

                    $image = null;
                    $header_background_image_option = $background['background_image_source'];

                    if ( $header_background_image_option == 'featured' ) {

                        $post_id = get_the_ID();

                        $featured_image = get_the_post_thumbnail_url($post_id, '1536x1536');

                        if ( $featured_image ) {
                            $image = $featured_image;
                        }

                    } else {

                        $image = $background['image'];
                        $size = '1536x1536';

                        if( $image ) {
                            $image = wp_get_attachment_image_url( $image, $size );
                        }

                    }

                    $size = $background['size'];
                    $position = $background['position'];
                    $repeat = $background['repeat'];

                    if ( $image ) {

                        /* check whether image has webp */
                        $handle = curl_init($image . '.webp');
                        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

                        /* Get the HTML or whatever is linked in $url. */
                        $response = curl_exec($handle);

                        /* Check for 404 (file not found). */
                        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                        if( ( $httpCode === 403 ) || ( $httpCode === 404 ) ) {
                            $image = $image;
                        } else {
                            $image = $image . '.webp';
                        }

                        curl_close($handle);

                        $return_styles[] = 'background: url(' . $image . ');';
                        $return_styles[] = 'background-size: ' . $size . ';';
                        $return_styles[] = 'background-position: ' . $position . ';';
                        $return_styles[] = 'background-repeat: ' . $repeat . ';';

                    }

                }

                if ( $background_content == 'video' ) {

                    $video = $background['video'];
                    
                    if ( $video ) {
                        $video_src = null;
                        $js_video = null;
                        $video_id = rand(0,9999);

                        ?>
                        <?php
                        $video_src = '<script>updateVideoBgURL("'.strval($video).'");</script>';

                        $video_element = '<video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">'. $video_src .'</video>';
                    }

                    $return_classes[] = 'video-bg';

                }

                if ( ( $background_content == 'image' ) || ( $background_content == 'video' ) ) {

                    if ( $theme_colors || $custom_color ) {

                        if ( $background_transparency ) {
                            $background_transparency = 'opacity: ' . strval( $background_transparency / 100 ) . ';';
                        }
                        if ( $background_transparency > '0' ) {
                            if ( $custom_color ) {
                                $overlay = '<div class="overlay" style="'. $background_transparency . $overlay_color .'"></div>';
                            } else {
                                $overlay = '<div class="overlay '. $overlay_color .'" style="'. $background_transparency .'"></div>';
                            }
                        }

                    }

                }

                $return_classes = implode(' ', $return_classes);
                $return_styles = implode(' ', $return_styles);

                $return_array = ['classes' => $return_classes, 'styles' => $return_styles, 'overlay' => $overlay, 'video' => $video_element, 'video_script' => $video_script];

            } elseif ( $background_content === 'overlay' ) {

                $overlay_color = null;

                $overlay_theme_colors = $background['overlay_color']['theme_colors'];
                $overlay_custom_color = $background['overlay_color']['custom_color'];
                $overlay_background_transparency = $background['overlay_color']['transparency'];

                if ( $overlay_background_transparency ) {
                    $overlay_background_transparency = strval( $overlay_background_transparency / 100 );
                }

                if ( $overlay_theme_colors || $overlay_custom_color ) {
                
                    if ( $overlay_custom_color ) {
                        $overlay = '<div class="overlay" style="background-color: '. $overlay_custom_color .'; opacity: '. $overlay_background_transparency .';"></div>';
                    } else {
                        $overlay = '<div class="overlay bg-'. $overlay_theme_colors .'" style="opacity: '. $overlay_background_transparency .';"></div>';
                    }

                }

                $return_array = ['classes' => null, 'styles' => null, 'overlay' => $overlay, 'video' => null];

            }
            
            return $return_array;

        } else {

            return null;

        }

    }

}

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

function get_spacing_bbc( $field, $field_type = false, $classes = false ) {

    $classes = [];

    // container defaults
    if ( $field_type === 'container' ) {

        $left_right_padding_container = get_field('left_right_padding_container', 'style');
        if ( $left_right_padding_container ) {
            if ( $left_right_padding_container == 'none' ) {
                $left_right_padding_container = '0';
            }
            $classes[] = 'px-lg-' . $left_right_padding_container;
        }

        $top_bottom_padding_container = get_field('top_bottom_padding_container', 'style');
        if ( $top_bottom_padding_container ) {
            if ( $top_bottom_padding_container == 'none' ) {
                $top_bottom_padding_container = '0';
            }
            $classes[] = 'py-lg-' . $top_bottom_padding_container;
        } else {
            $classes[] = 'py-3';
        }

        $left_right_padding_container_mobile = get_field('left_right_padding_container_mobile', 'style');
        if ( $left_right_padding_container_mobile ) {
            if ( $left_right_padding_container_mobile == 'none' ) {
                $left_right_padding_container_mobile = '0';
            }
            $classes[] = 'px-' . $left_right_padding_container_mobile;
        }

        $top_bottom_padding_container_mobile = get_field('top_bottom_padding_container_mobile', 'style');
        if ( $top_bottom_padding_container_mobile ) {
        
            if ( $top_bottom_padding_container_mobile == 'none' ) {
                $top_bottom_padding_container_mobile = '0';
            }
            $classes[] = 'py-' . $top_bottom_padding_container_mobile;
        } else {
            $classes[] = 'py-3';
        }

    }

    // column defaults
    if ( $field_type === 'column' ) {

        $left_right_padding_column = get_field('left_right_padding_column', 'style');
        if ( $left_right_padding_column ) {
            if ( $left_right_padding_column == 'none' ) {
                $left_right_padding_column = '0';
            }
            $classes[] = 'px-lg-' . $left_right_padding_column;
        }

        $top_bottom_padding_column = get_field('top_bottom_padding_column', 'style');
        if ( $top_bottom_padding_column ) {
            if ( $top_bottom_padding_column == 'none' ) {
                $top_bottom_padding_column = '0';
            }
            $classes[] = 'py-lg-' . $top_bottom_padding_column;
        }
        $left_right_padding_column_mobile = get_field('left_right_padding_column_mobile', 'style');
        if ( $left_right_padding_column_mobile ) {
            if ( $left_right_padding_column_mobile == 'none' ) {
                $left_right_padding_column_mobile = '0';
            }
            $classes[] = 'px-' . $left_right_padding_column_mobile;
        }

        $top_bottom_padding_column_mobile = get_field('top_bottom_padding_column_mobile', 'style');
        if ( $top_bottom_padding_column_mobile ) {
            if ( $top_bottom_padding_column_mobile == 'none' ) {
                $top_bottom_padding_column_mobile = '0';
            }
            $classes[] = 'py-' . $top_bottom_padding_column_mobile;
        }

    }

    if ( $field ) {

        $desktop_padding = $field['desktop_padding'];
        $desktop_margin = $field['desktop_margin'];
        $mobile_padding = $field['mobile_padding'];
        $mobile_margin = $field['mobile_margin'];

        // desktop padding
        if ( $desktop_padding['padding_top'] ) {
            if ( $desktop_padding['padding_top'] == 'none' ) {
                $desktop_padding['padding_top'] = '0';
            }
            $classes[] = 'pt-lg-'. $desktop_padding['padding_top'];
        }
        if ( $desktop_padding['padding_right'] ) {
            if ( $desktop_padding['padding_right'] == 'none' ) {
                $desktop_padding['padding_right'] = '0';
            }
            $classes[] = 'pe-lg-'. $desktop_padding['padding_right'];
        }
        if ( $desktop_padding['padding_bottom'] ) {
            if ( $desktop_padding['padding_bottom'] == 'none' ) {
                $desktop_padding['padding_bottom'] = '0';
            }
            $classes[] = 'pb-lg-'. $desktop_padding['padding_bottom'];
        }
        if ( $desktop_padding['padding_left'] ) {
            if ( $desktop_padding['padding_left'] == 'none' ) {
                $desktop_padding['padding_left'] = '0';
            }
            $classes[] = 'ps-lg-'. $desktop_padding['padding_left'];
        }

        // desktop margin
        if ( $desktop_margin['margin_top'] ) {
            if ( $desktop_margin['margin_top'] == 'none' ) {
                $desktop_margin['margin_top'] = '0';
            }
            $classes[] = 'mt-lg-'. $desktop_margin['margin_top'];
        }
        if ( $desktop_margin['margin_right'] ) {
            if ( $desktop_margin['margin_right'] == 'none' ) {
                $desktop_margin['margin_right'] = '0';
            }
            $classes[] = 'me-lg-'. $desktop_margin['margin_right'];
        }
        if ( $desktop_margin['margin_bottom'] ) {
            if ( $desktop_margin['margin_bottom'] == 'none' ) {
                $desktop_margin['margin_bottom'] = '0';
            }
            $classes[] = 'mb-lg-'. $desktop_margin['margin_bottom'];
        }
        if ( $desktop_margin['margin_left'] ) {
            if ( $desktop_margin['margin_left'] == 'none' ) {
                $desktop_margin['margin_left'] = '0';
            }
            $classes[] = 'ms-lg-'. $desktop_margin['margin_left'];
        }

        // mobile padding
        if ( $mobile_padding['padding_top'] ) {
            if ( $mobile_padding['padding_top'] == 'none' ) {
                $mobile_padding['padding_top'] = '0';
            }
            $classes[] = 'pt-'. $mobile_padding['padding_top'];
        }
        if ( $mobile_padding['padding_right'] ) {
            if ( $mobile_padding['padding_right'] == 'none' ) {
                $mobile_padding['padding_right'] = '0';
            }
            $classes[] = 'pe-'. $mobile_padding['padding_right'];
        }
        if ( $mobile_padding['padding_bottom'] ) {
            if ( $mobile_padding['padding_bottom'] == 'none' ) {
                $mobile_padding['padding_bottom'] = '0';
            }
            $classes[] = 'pb-'. $mobile_padding['padding_bottom'];
        }
        if ( $mobile_padding['padding_left'] ) {
            if ( $mobile_padding['padding_left'] == 'none' ) {
                $mobile_padding['padding_left'] = '0';
            }
            $classes[] = 'ps-'. $mobile_padding['padding_left'];
        }

        // mobile margin
        if ( $mobile_margin['margin_top'] ) {
            if ( $mobile_margin['margin_top'] == 'none' ) {
                $mobile_margin['margin_top'] = '0';
            }
            $classes[] = 'mt-'. $mobile_margin['margin_top'];
        }
        if ( $mobile_margin['margin_right'] ) {
            if ( $mobile_margin['margin_top'] == 'none' ) {
                $mobile_margin['margin_top'] = '0';
            }
            $classes[] = 'me-'. $mobile_margin['margin_right'];
        }
        if ( $mobile_margin['margin_bottom'] ) {
            if ( $mobile_margin['margin_bottom'] == 'none' ) {
                $mobile_margin['margin_bottom'] = '0';
            }
            $classes[] = 'mb-'. $mobile_margin['margin_bottom'];
        }
        if ( $mobile_margin['margin_left'] ) {
            if ( $mobile_margin['margin_left'] == 'none' ) {
                $mobile_margin['margin_left'] = '0';
            }
            $classes[] = 'ms-'. $mobile_margin['margin_left'];
        }

    }

    $classes = implode(' ', $classes);
    return $classes;

}

function get_heading_style_bbc( $field, $sub = false ) {

    if ( $field ) {
        
        if ( $sub == true ) {
            $field = get_sub_field($field);
        } else {
            $field = get_sub_field($field);
        }

        if ( $field ) {

            $classes = [];

            // style
            if ( $field['alignment'] && ( $field['alignment'] != 'default' ) ) {

                $alignment = '';

                if ( $field['alignment'] === 'left' ) {
                    $alignment = 'start';
                } elseif ( $field['alignment'] === 'right' ) {
                    $alignment = 'end';
                } else {
                    $alignment = 'center';
                }

                $classes[] = 'text-' . $alignment;
            } else {
                $classes[] = 'text-start';
            }
            if ( $field['theme_colors'] ) {
                $classes[] = 'text-' . $field['theme_colors'];
            }
            if ( $field['font_size'] && ( $field['font_size'] != 'default' ) ) {
                $classes[] = $field['font_size'];
            }
            if ( $field['font_weight'] && ( $field['font_weight'] != 'default' ) ) {
                $classes[] = 'weight-' . $field['font_weight'];
            }
            if ( $field['font_weight'] && ( $field['font_weight'] != 'default' ) ) {
                $classes[] = 'weight-' . $field['font_weight'];
            }
            if ( $field['font_family'] && ( $field['font_family'] != 'default' ) ) {
                $classes[] = 'font-' . $field['font_family'];
            }
            if ( $field['additional_classes'] ) {
                $classes[] = $field['additional_classes'];
            }

            $classes = implode(' ', $classes);

            return $classes;

        }

    }

}

function get_buttons_bbc( $field ) {

    if ( $field ) {

        $buttons = $field['buttons'];

            if ( $buttons ) {

            // start content
            ob_start();

            $button_group_classes = [];

            $alignment = $field['alignment'];
            $space_between = $field['space_between'];

            $button_margin = '';

            if ( $space_between !== 'default' ) {
                $button_group_classes[] = 'gap-' . $space_between;
            } elseif ( count($buttons) > 1 ) {
                $space_between = 1;
                $button_group_classes[] = 'gap-' . $space_between;
                $button_margin = 'mb-lg-' . $space_between;
            }

            $button_group_classes[] = 'element';
            $button_width = null;


            switch ($alignment) {
                case 'left':
                    $button_group_classes[] = 'd-block';
                    break;
                case 'center':
                    $button_group_classes[] = 'd-lg-grid';
                    $button_group_classes[] = 'd-lg-flex justify-content-lg-center';
                    break;
                case 'right':
                    $button_group_classes[] = 'd-lg-grid';
                    $button_group_classes[] = 'd-lg-flex justify-content-lg-end';
                    break;
                case 'auto-resize':
                    $button_group_classes[] = 'd-lg-grid';
                    $button_width = 'col-md-' . ( 12 / count($buttons) );
                    $button_group_classes[] = 'btn-group';
                    $button_group_classes[] = 'd-lg-flex';
                    if ( $space_between === 'default' ) {
                        $button_group_classes[] = 'gap-2';
                    }
                    break;
                case 'stacked':
                    $button_group_classes[] = 'd-lg-grid';
                    $button_group_classes[] = '';
                    break;
                default;
                    $button_group_classes[] = 'd-lg-flex';
                    break;
            }

            $full_width_mobile = $field['full_width_mobile'];
            if ( $full_width_mobile == 'enabled' ) {
                $button_group_classes[] = 'd-grid';
            }

            // get custom spacing
            $button_group_classes[] = get_spacing_bbc($field['buttons_spacing']);

            // advanced
            $button_group_classes[] = $field['additional_classes'];

            // process button group styles
            $button_group_classes = trim(implode(' ', $button_group_classes));

            echo '<div class="'. $button_group_classes .'" role="group">';

            foreach ( $buttons as $button ) {

                $button_classes = [];
                $button_styles = [];
                $text_classes = [];
                
                // content
                $button_link = $button['button_link'];
                
                $title = $button_link['title'];
                $url = $button_link['url'];
                $target = $button_link['target'];
                if ( $target ) {
                    $target = ' target="' . $target . ' "';
                }

                // style
                $button_classes[] = 'element';
                $button_color = $button['button_color'];
                $button_font = $button['button_font'];
                if ( $button_font ) {
                    $text_classes[] = 'font-' . $button_font;
                }

                // button style
                $button_style = $button['button_style'];
                if ( $button_style == 'underline' ) {
                    $button_classes[] = 'btn-underline';
                    $button_classes[] = 'p-0';
                    $button_classes[] = 'border-bottom';
                    $button_classes[] = 'border-' . $button_color;
                } elseif ( $button_style == 'outline' ) {
                    $button_classes[] = 'btn';
                    $button_classes[] = 'btn-'. $button_style . '-' . $button_color;
                    $button_classes[] = 'btn-outline';
                } elseif ( $button_style == 'link' ) {
                    $button_classes[] = 'btn';
                    $button_classes[] = 'btn-link';
                    $button_classes[] = 'text-' . $button_color;
                } else {
                    $button_classes[] = 'btn';
                    $button_classes[] = 'btn-'. $button_color;
                }

                // button size
                $button_size = $button['button_size'];
                if ( $button_size != 'normal' ) {
                    $button_classes[] = 'btn-'. $button_size;
                }

                if ( $alignment === 'left' ) {
                    $button_classes[] = $button_margin;
                }

                $button_classes[] = $button_width;

                // icon / image
                $button_icon = null;
                $button_icon_styles = null;
                $add_icon_image = $button['add_icon_image'];

                if ( $add_icon_image === 'icon' ) {

                    $button_icon = $button['button_icon'];
                
                    if ( $button_icon ) {
                        $button_classes[] = 'button-icon';
                        $button_classes[] = 'icon-position-' . $button['icon_position'];
                        $button_icon = '<i class="'. $button_icon . ' icon-' . $button['icon_position'] .'" aria-hidden="true"></i>';
                    }

                } elseif ( $add_icon_image === 'image' ) {

                    $button_image = $button['button_image'];

                    $icon_image_size = $button['icon_image_size'];
                    if ( $icon_image_size ) {
                        $image_width = $icon_image_size['width'];
                        $image_height = $icon_image_size['height'];
                        $button_icon_styles = 'width: ' . $image_width . 'px; height: ' . $image_height . 'px;';
                    }

                    if ( $button_image ) {

                        $button_classes[] = 'button-image';
                        $button_classes[] = 'icon-position-' . $button['icon_position'];
                        $button_icon = '<img src="' . $button['button_image'] . '" style="'. $button_icon_styles .'" />';

                    }

                }

                if ( count($buttons) > 1 ) {
                    $button_classes[] = 'mb-lg-0 mb-' . $space_between;
                }

                // additional classes
                $additional_classes = $button['additional_classes'];
                if ( $additional_classes ) {
                    $button_classes[] = $additional_classes;
                }
                
                // process button styles
                $button_classes = implode(' ', $button_classes);
                $button_styles = implode(' ', $button_styles);
                $text_classes = implode(' ', $text_classes);

                $button_tag_start = '<a type="button" href="'. esc_attr($url) .'" title="'. esc_attr($title) .'" class="'. esc_attr($button_classes) .'" style="'. esc_attr($button_styles) .'"'. $target .'>';

                $button_content = '<span class="'. $text_classes .'">' . esc_attr($title) . '</span>';

                $button_tag_end = '</a>';

                if ( $button_icon && ( ( $button['icon_position'] == 'left' ) || ( $button['icon_position'] == 'top' ) ) ) {
                    echo $button_tag_start . $button_icon . $button_content . $button_tag_end;
                } elseif ( $button_icon && ( ( $button['icon_position'] == 'right' ) || ( $button['icon_position'] == 'bottom' ) ) ) {
                    echo $button_tag_start . $button_content . $button_icon . $button_tag_end;
                } else {
                    echo $button_tag_start . $button_content . $button_tag_end;
                }
                $secondary_button_enable = get_field('secondary_button', 'style');

            }

            echo '</div>';

            // return content
            return ob_get_clean();

        } else {

            return null;
            
        }

    }

}

function get_text_styles_bbc($field, $classes, $styles = false, $sub = false) {

    if ( $field ) {

        // initialize return arrays
        $return_array = [];
        $return_classes = [];

        // initialize style field
        $style = null;

        // determine if sub field
        if ( $sub ) {
            $style = get_sub_field($field);
        } else {
            $style = get_field($field);
        }

        // add fields to classes
        if ( $style['alignment'] ) {
            $classes[] = 'align-' . $style['alignment'];
        }

        if ( $style['theme_colors'] ) {
            $classes[] = 'text-' . $style['theme_colors'];
        }

        if ( $style['font_size'] && ( $style['font_size'] != 'default' ) ) {
            $classes[] = $style['font_size'];
        }

        if ( $style['font_weight'] && ( $style['font_weight'] != 'default' ) ) {
            $classes[] = 'weight-' . $style['font_weight'];
        }

        if ( $style['additional_classes'] ) {
            $classes[] = $style['additional_classes'];
        }

        // convert arrays to strings
        $return_classes = implode(' ', $classes);

        $return_array = ['classes' => $return_classes];

        return $return_array;

    }

}

function get_borders_bbc($field) {

    $classes = [];

    if ( $field ) {

        if ( $field['border_radius_all'] !== 'default' ) {
            $classes[] = 'rounded-' . $field['border_radius_all'];
        }
        
        if ( $field['border-top-left-radius'] !== 'default' ) {
            $classes[] = 'border-top-left-radius-' . $field['border-top-left-radius'];
            $classes[] = 'overflow-hidden';
        }
        if ( $field['border-top-right-radius'] !== 'default' ) {
            $classes[] = 'border-top-right-radius-' . $field['border-top-right-radius'];
            $classes[] = 'overflow-hidden';
        }
        if ( $field['border-bottom-left-radius'] !== 'default' ) {
            $classes[] = 'border-bottom-left-radius-' . $field['border-bottom-left-radius'];
            $classes[] = 'overflow-hidden';
        }
        if ( $field['border-bottom-right-radius'] !== 'default' ) {
            $classes[] = 'border-bottom-right-radius-' . $field['border-bottom-right-radius'];
            $classes[] = 'overflow-hidden';
        }

        $classes = array_unique($classes);
        $classes = trim(implode(' ', $classes));

        return $classes;

    } else {

        return null;

    }

}

function get_color_bbc($field, $return_styles = false, $sub = false ) {

    if ( $field ) {

        // initialize arrays
        $return_array = [];
        $classes = [];
        $styles = [];

        // determine if sub field
        if ( $sub ) {
            $field = get_sub_field($field);
        } else {
            $field = get_field($field);
        }

        $theme_colors = $field['theme_colors'];
        $transparency = $field['transparency'];
        $custom_color = $field['custom_color'];

        if ( $return_styles ) {

            $color = '';

            $transparency = ( $transparency / 100 );

            if ( $custom_color ) {

                $custom_color = str_replace( '#', '', $custom_color );

                $split_hex_color = str_split( $custom_color, 2 );
                $rgb1 = hexdec( $split_hex_color[0] );
                $rgb2 = hexdec( $split_hex_color[1] );
                $rgb3 = hexdec( $split_hex_color[2] );

                return 'rgba('. $rgb1 .', '. $rgb2 .', '. $rgb3 .', '. $transparency .')';

            } else {

                return 'var(--' . $theme_colors . ')';

            }

        }

    }

}