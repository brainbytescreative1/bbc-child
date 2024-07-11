<?php

$top_menu_layout = get_field('top_menu_layout', 'header');

if ( $top_menu_layout ) { // top menu fields start

    $top_menu_classes = [];
    $top_menu_styles = [];

    // container width
    $header_width = get_field('header_width', 'header');
    if ( $header_width ) {
        $top_menu_classes[] = $header_width;
    } else {
        $top_menu_classes[] = get_theme_mod( 'understrap_container_type' );
    }

    $top_menu_classes[] = 'top-menu-container';
    $top_menu_classes[] = 'top-layout-' . $top_menu_layout;

    // colors
    $top_text_color = get_field('top_text_color', 'header');
    if ( $top_text_color['theme_colors'] != 'default' ) {
        $top_menu_classes[] = 'text-' . $top_text_color['theme_colors'];
    }

    $top_background_color = get_field('top_background_color', 'header');
    if ( $top_background_color['theme_colors'] != 'default' ) {
        $top_menu_classes[] = 'bg-' . $top_background_color['theme_colors'];
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

    // responsive
    $top_menu_classes[] = 'd-flex';
    $mobile_menu_behavior = get_field('mobile_menu_behavior', 'header');
    $mobile_breakpoint = get_field('mobile_breakpoint', 'header');

    // single menu
    if ( $top_menu_layout === 'both' ) {
        $top_menu_classes[] = 'justify-content-between';
    }

    $top_menu_classes = esc_attr( trim( implode(' ', $top_menu_classes ) ) );
    $top_menu_styles = esc_attr( trim( implode(' ', $top_menu_styles ) ) );

    echo '<nav class="'. $top_menu_classes .'" id="top-menu" style="'. $top_menu_styles .'">'; // top nav start

        if ( $top_menu_layout === 'single' ) { // single menu start

            $single_menu_classes = [];
            $single_menu_classes[] = 'top-single-menu-container';
            $single_menu_classes[] = 'd-flex';
            $single_menu_classes[] = 'justify-content-center';
            $single_menu_classes[] = 'w-100';
            $single_menu_alignment = get_field('single_menu_alignment', 'header');
            if ( $single_menu_alignment ) {
                $single_menu_classes[] = 'justify-content-'. $mobile_breakpoint .'-'. $single_menu_alignment;
            } else {
                $single_menu_classes[] = 'justify-content-'. $mobile_breakpoint .'-end';
            }
            
            $single_menu_classes = esc_attr( trim( implode(' ', $single_menu_classes ) ) );

            echo '<div class="'. $single_menu_classes .'">'; // single menu start

                $single_menu_select = get_field('single_menu_select', 'header');
                    
                if ( $single_menu_select ) {
                    echo $single_menu_select;
                }

            echo '</div>'; // single menu end

        } elseif ( $top_menu_layout == 'both' ) { // both menus start

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
                $top_left_menu_classes[] = 'justify-content-center';
                if ( $left_menu_alignment ) {
                    $top_left_menu_classes[] = $left_menu_alignment;
                } else {
                    $top_right_menu_classes[] = 'justify-content-'. $mobile_breakpoint .'-start';
                }
                
                $top_left_menu_classes = esc_attr( trim( implode(' ', $top_left_menu_classes ) ) );

                echo '<div class="'. $top_left_menu_classes .'">'; // left menu start

                    if ( $left_menu === 'social' ) {

                        echo $social_icons;
                    
                    } elseif ( $left_menu === 'menu' ) {
                    
                        $left_menu_select = get_field('left_menu_select', 'header');
                    
                        if ( $left_menu_select ) {
                            echo $left_menu_select;
                        }
                    
                    } elseif ( $left_menu === 'topmenu' ) {

                        dynamic_sidebar( 'topmenuwidget' );

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
                $top_right_menu_classes[] = 'justify-content-center';
                if ( $right_menu_alignment ) {
                    $top_right_menu_classes[] = 'justify-content-'. $mobile_breakpoint .'-'. $right_menu_alignment;
                } else {
                    $top_right_menu_classes[] = 'justify-content-'. $mobile_breakpoint .'-end';
                }
                
                $top_right_menu_classes = esc_attr( trim( implode(' ', $top_right_menu_classes ) ) );

                echo '<div class="'. $top_right_menu_classes .'">'; // right menu start

                    if ( $right_menu === 'social' ) {

                        echo $social_icons;
                    
                    } elseif ( $right_menu === 'menu' ) {
                    
                        $right_menu_select = get_field('right_menu_select', 'header');
                    
                        if ( $right_menu_select ) {
                            echo $right_menu_select;
                        }
                    
                    } elseif ( $right_menu === 'topmenu' ) {

                        dynamic_sidebar( 'topmenuwidget' );

                    }

                echo '</div>'; // right menu end

            }
        }

    echo '</nav>'; // top nav end

} // top menu fields end