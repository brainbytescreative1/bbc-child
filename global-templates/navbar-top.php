<?php

$top_menu_layout = get_field('top_menu_layout', 'header');

if ( $top_menu_layout ) {

    if ( $top_menu_layout === 'widget' ) {

        $widget_classes = [];
        $widget_styles = [];

        $widget_inner_classes = [];
        $widget_inner_styles = [];

        // background color
        $top_background_color = get_field('top_background_color', 'header');
        if ( $top_background_color['theme_colors'] !== 'default' ) {
            $widget_classes[] = 'bg-' . $top_background_color['theme_colors'];
        }

        // padding
        $menu_padding = null;
        if ( function_exists('get_menu_padding_bbc') ) {
            $menu_padding = get_menu_padding_bbc(get_field('top_menu_padding', 'header'));
            
            if ( $menu_padding['classes'] ) {
                $widget_classes[] = $menu_padding['classes'];
            }
            if ( $menu_padding['styles'] ) {
                $widget_styles[] = $menu_padding['styles'];
            }
        }

        $header_style = get_field('header_style', 'header');
        if ( $header_style === 'rounded' ) {
            $top_menu_max_width = get_field('top_menu_max_width', 'header');
            if ( $top_menu_max_width['value'] ) {
                $widget_styles[] = 'max-width: ' . $top_menu_max_width['value'] . $top_menu_max_width['unit'] . ';';
                if ( $top_menu_max_width['alignment'] ) {
                    if ( $top_menu_max_width['alignment'] === 'left' ) {
                        $widget_classes[] = 'me-auto';
                    } elseif ( $top_menu_max_width['alignment'] === 'center' ) {
                        $widget_classes[] = 'ms-auto';
                        $widget_classes[] = 'me-auto';
                    } elseif ( $top_menu_max_width['alignment'] === 'right' ) {
                        $widget_classes[] = 'ms-auto';
                    }
                }
            }
        }

        // compile
        $widget_classes = esc_attr( trim( implode(' ', $widget_classes ) ) );
        $widget_styles = esc_attr( trim( implode(' ', $widget_styles ) ) );
        $widget_inner_classes = esc_attr( trim( implode(' ', $widget_inner_classes ) ) );
        $widget_inner_styles = esc_attr( trim( implode(' ', $widget_inner_styles ) ) );

        echo '<nav id="top-menu-widget" class="'. $widget_classes .'" style="'. $widget_styles .'">';
            get_template_part( 'sidebar-templates/sidebar', 'topmenu' );
        echo '</nav>';

    } else {

        $top_menu_wrapper_classes = [];
        $top_menu_wrapper_styles = [];
    
        $top_menu_wrapper_classes[] = 'top-menu-wrapper';
    
        // container width
        $header_width = get_field('header_width', 'header');
        if ( $header_width ) {
            $top_menu_wrapper_classes[] = $header_width;
        } else {
            $top_menu_wrapper_classes[] = get_theme_mod( 'understrap_container_type' );
        }
    
        $top_menu_classes = [];
        $top_menu_styles = [];
    
        $top_menu_classes[] = 'top-menu-container';
        $top_menu_classes[] = 'top-layout-' . $top_menu_layout;
    
        // padding
        $menu_padding = null;
        if ( function_exists('get_menu_padding_bbc') ) {
            $menu_padding = get_menu_padding_bbc(get_field('top_menu_padding', 'header'), $top_menu_classes, $top_menu_styles);
            
            if ( $menu_padding['classes'] ) {
                $top_menu_classes = $menu_padding['classes'];
            }
            if ( $menu_padding['styles'] ) {
                $top_menu_styles = $menu_padding['styles'];
            }
        }
    
        // background color
        $top_background_color = get_field('top_background_color', 'header');
        if ( $top_background_color['theme_colors'] != 'default' ) {
            $top_menu_wrapper_classes[] = 'bg-' . $top_background_color['theme_colors'];
        }
    
        // text color
        $top_text_color = get_field('top_text_color', 'header');
        if ( $top_text_color['theme_colors'] != 'default' ) {
            $top_menu_classes[] = 'text-' . $top_text_color['theme_colors'];
        }
    
        // font
        $top_menu_font = get_field('top_menu_font', 'header');
        if ( $top_menu_font && ( $top_menu_font !== 'default' ) ) {
            $top_menu_classes[] = 'font-' . $top_menu_font;
        }
        $top_menu_font_weight = get_field('top_menu_font_weight', 'header');
        if ( $top_menu_font_weight && ( $top_menu_font_weight !== 'default' ) ) {
            $top_menu_classes[] = 'weight-' . $top_menu_font_weight;
        }
        $top_menu_font_size = get_field('top_menu_font_size', 'header');
        if ( $top_menu_font_size ) {
            $top_menu_classes[] = 'menu-size-' . $top_menu_font_size;
        } else {
            $top_menu_classes[] = 'menu-size-small';
        }
    
        // responsive
        $top_menu_classes[] = 'd-flex';
        $mobile_menu_behavior = get_field('mobile_menu_behavior', 'header');
        $mobile_breakpoint = get_field('mobile_breakpoint', 'header');
    
        // single menu
        if ( $top_menu_layout === 'both' ) {
            $top_menu_classes[] = 'justify-content-between';
        }

        // rounded style
        $top_menu_wrapper_styles = [];
        $header_style = get_field('header_style', 'header');
        if ( $header_style === 'rounded' ) {
            $top_menu_max_width = get_field('top_menu_max_width', 'header');
            if ( $top_menu_max_width['value'] ) {
                $top_menu_wrapper_styles[] = 'max-width: ' . $top_menu_max_width['value'] . $top_menu_max_width['unit'] . ';';
                if ( $top_menu_max_width['alignment'] ) {
                    if ( $top_menu_max_width['alignment'] === 'left' ) {
                        $top_menu_wrapper_classes[] = 'me-auto';
                    } elseif ( $top_menu_max_width['alignment'] === 'center' ) {
                        $top_menu_wrapper_classes[] = 'ms-auto';
                        $top_menu_wrapper_classes[] = 'me-auto';
                    } elseif ( $top_menu_max_width['alignment'] === 'right' ) {
                        $top_menu_wrapper_classes[] = 'ms-auto';
                    }
                }
            }
        }
    
        // compile
        $top_menu_classes = esc_attr( trim( implode(' ', $top_menu_classes ) ) );
        $top_menu_styles = esc_attr( trim( implode(' ', $top_menu_styles ) ) );
        $top_menu_wrapper_classes = esc_attr( trim( implode(' ', $top_menu_wrapper_classes ) ) );
        $top_menu_wrapper_styles = esc_attr( trim( implode(' ', $top_menu_wrapper_styles ) ) );
    
        echo '<div class="'. $top_menu_wrapper_classes .'" style="'. $top_menu_wrapper_styles .'">';
    
            echo '<nav class="'. $top_menu_classes .'" id="top-menu" style="'. $top_menu_styles .'">'; // top nav start
    
                if ( $top_menu_layout === 'single' ) { // single menu start
    
                    $single_menu_classes = [];
                    $single_menu_classes[] = 'top-single-menu-container';
                    $single_menu_classes[] = 'd-flex';
                    $single_menu_classes[] = 'w-100';
    
                    $single_menu_alignment = get_field('single_menu_alignment', 'header');
                    $single_menu_alignment_mobile = get_field('single_menu_alignment_mobile', 'header');
    
                    if ( $single_menu_alignment_mobile && ( $single_menu_alignment_mobile !== 'default' ) ) {
                        $single_menu_classes[] = 'justify-content-'. $single_menu_alignment_mobile;
                    }
    
                    if ( $single_menu_alignment ) {
                        $single_menu_classes[] = 'justify-content-'. $mobile_breakpoint .'-'. $single_menu_alignment;
                    } else {
                        $single_menu_classes[] = 'justify-content-'. $mobile_breakpoint .'-end';
                    }
                    
                    $single_menu_classes = esc_attr( trim( implode(' ', $single_menu_classes ) ) );
    
                    echo '<div class="'. $single_menu_classes .'">'; // single menu start
    
                        $single_menu_select = get_field('single_menu_select', 'header');
                            
                        if ( $single_menu_select ) {
                            echo get_menu_bbc( get_field('single_menu_select', 'header') );
                        }
    
                    echo '</div>'; // single menu end
    
                } elseif ( $top_menu_layout === 'both' ) { // both menus start
    
                    $left_menu = get_field('left_menu', 'header');
                    $right_menu = get_field('right_menu', 'header');
    
                    // get social icons if chosen
                    if ( ( $left_menu === 'social' ) || ( $right_menu === 'social' ) ) {
                        $social_icons = get_field('social_icons', 'social');
                        if ( $social_icons ) {
                            $social_icons = get_social_icons_bbc($social_icons);
                        }
                    }
    
                    // left menu
                    if ( $left_menu ) {
    
                        $top_left_menu_classes = [];
                        $top_left_menu_classes[] = 'top-left-menu-container';
    
                        $left_show_mobile = get_field('left_show_mobile', 'header');
                        if ( $left_show_mobile === 'hide' ) {
                            $top_left_menu_classes[] = 'd-'. $mobile_breakpoint .'-flex';
                            $top_left_menu_classes[] = 'd-none';
                        } else {
                            $top_left_menu_classes[] = 'd-flex';
                        }
    
                        $left_menu_alignment = get_field('left_menu_alignment', 'header');
                        if ( $left_menu_alignment ) {
                            $top_left_menu_classes[] = 'justify-content-'. $mobile_breakpoint .'-'. $left_menu_alignment;
                        } else {
                            $top_left_menu_classes[] = 'justify-content-'. $mobile_breakpoint .'-end';
                        }
    
                        $left_menu_alignment_mobile = get_field('left_menu_alignment_mobile', 'header');
                        if ( $left_menu_alignment_mobile ) {
                            if ( $left_menu_alignment_mobile === 'left' ) {
                                $top_left_menu_classes[] = 'justify-content-start';
                            } elseif ( $left_menu_alignment_mobile === 'center' ) {
                                $top_left_menu_classes[] = 'justify-content-center';
                            } elseif ( $left_menu_alignment_mobile === 'end' ) {
                                $top_left_menu_classes[] = 'justify-content-end';
                            }
                        } else {
                            $top_left_menu_classes[] = 'justify-content-end';
                        }
    
                        $top_left_menu_classes = esc_attr( trim( implode(' ', $top_left_menu_classes ) ) );
    
                        echo '<div class="'. $top_left_menu_classes .'">'; // left menu start
    
                            if ( $left_menu === 'social' ) {
    
                                echo $social_icons;
                            
                            } elseif ( $left_menu === 'menu' ) {
                            
                                $left_menu_select = get_field('left_menu_select', 'header');
                            
                                if ( $left_menu_select ) {
                                    echo get_menu_bbc( $left_menu_select );
                                }
                            
                            }
    
                        echo '</div>'; // left menu end
    
                    }
    
                    // right menu
                    if ( $right_menu ) {
    
                        $top_right_menu_classes = [];
                        $top_right_menu_classes[] = 'top-right-menu-container';
    
                        $right_show_mobile = get_field('right_show_mobile', 'header');
                        if ( $right_show_mobile === 'hide' ) {
                            $top_right_menu_classes[] = 'd-'. $mobile_breakpoint .'-flex';
                            $top_right_menu_classes[] = 'd-none';
                        } else {
                            $top_right_menu_classes[] = 'd-flex';
                        }
    
                        $right_menu_alignment = get_field('right_menu_alignment', 'header');
                        if ( $right_menu_alignment ) {
                            $top_right_menu_classes[] = 'justify-content-'. $mobile_breakpoint .'-'. $right_menu_alignment;
                        } else {
                            $top_right_menu_classes[] = 'justify-content-'. $mobile_breakpoint .'-end';
                        }
    
                        $right_menu_alignment_mobile = get_field('right_menu_alignment_mobile', 'header');
                        if ( $right_menu_alignment_mobile ) {
                            if ( $right_menu_alignment_mobile === 'left' ) {
                                $top_right_menu_classes[] = 'justify-content-start';
                            } elseif ( $right_menu_alignment_mobile === 'center' ) {
                                $top_right_menu_classes[] = 'justify-content-center';
                            } elseif ( $right_menu_alignment_mobile === 'end' ) {
                                $top_right_menu_classes[] = 'justify-content-end';
                            }
                        } else {
                            $top_right_menu_classes[] = 'justify-content-end';
                        }
                        
                        $top_right_menu_classes = esc_attr( trim( implode(' ', $top_right_menu_classes ) ) );
    
                        echo '<div class="'. $top_right_menu_classes .'">'; // right menu start
    
                            if ( $right_menu === 'social' ) {
    
                                echo $social_icons;
                            
                            } elseif ( $right_menu === 'menu' ) {
                            
                                $right_menu_select = get_field('right_menu_select', 'header');
                            
                                if ( $right_menu_select ) {
                                    echo get_menu_bbc( $right_menu_select );
                                }
                            
                            }
    
                        echo '</div>'; // right menu end
    
                    }
                }
    
            echo '</nav>';
    
        echo '</div>'; // top nav end
    
    }

}