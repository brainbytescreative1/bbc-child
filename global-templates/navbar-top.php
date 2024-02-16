<?php
// custom fields
$top_menu_layout = get_field('top_menu_layout', 'header');

$top_menu_wrapper_classes = [];

$top_menu_wrapper_classes = esc_attr( trim( implode(' ', $top_menu_wrapper_classes ) ) );

if ( $top_menu_layout ) { // top menu fields start

    $top_menu_classes = [];

    // container width
    $container = null;

    /*$top_menu_width = get_field('top_menu_width', 'header');
    if ( $top_menu_width ) {
        $top_menu_classes[] = $top_menu_width;
    } else {
        $top_menu_classes[] = get_theme_mod( 'understrap_container_type' );
    }*/

    $top_menu_classes[] = 'top-menu-container';
    $top_menu_classes[] = 'small';
    $top_menu_classes[] = 'px-2';

    $top_text_color = get_field('top_text_color', 'header');
    $top_background_color = get_field('top_background_color', 'header');

    if ( $top_text_color['theme_colors'] != 'default' ) {
        $top_menu_classes[] = 'text-' . $top_text_color['theme_colors'];
    }

    if ( $top_background_color['theme_colors'] != 'default' ) {
        $top_menu_classes[] = 'bg-' . $top_background_color['theme_colors'];
    }
    
    $top_menu_classes = esc_attr( trim( implode(' ', $top_menu_classes ) ) );

    echo '<div class="'. $top_menu_classes .'" id="top-menu">'; // top menu container start

    if ( $top_menu_layout == 'both' ) {

        $left_menu = get_field('left_menu', 'header');
        $right_menu = get_field('right_menu', 'header');

        if ( $left_menu == 'social' ) {

            echo '<ul class="social-icons-menu">'; // start social icons

                $social_icons = get_field('social_icons', 'social');

                if ( $social_icons ) {

                    $icon_list = $social_icons['icon_list'];

                    if ( $icon_list ) {
                        
                        foreach( $icon_list as $icon ) {

                            // initialize classes arrays
                            $icon_classes = [];
                            $icon_styles = [];
                            $text_classes = [];
            
                            // get icon fields
                            $link = $icon['link'];
                            $separator = $icon['separator'];
                            $text_content = $icon['text_content'];
            
                            // add classes
                            $icon_classes[] = 'icon';
                            $icon_classes[] = 'lead';
            
                            if ( $top_text_color['theme_colors'] ) {
                                $icon_classes[] = 'text-' . $top_text_color['theme_colors'];
                            }
            
                            if ( $top_text_color['theme_colors'] ) {
                                $text_classes[] = 'text-' . $top_text_color['theme_colors'];
                            }
            
                            if ( $separator != 'none' ) {
                                $icon_styles[] = 'border-' . $separator . ': 1px solid ' . $icon_color['theme_colors'];
                            }
            
                            // process arrays
                            $icon_classes = esc_attr( trim( implode(' ', $icon_classes ) ) );
                            $icon_styles = esc_attr( trim( implode(' ', $icon_styles ) ) );
                            $text_classes = esc_attr( trim( implode(' ', $text_classes ) ) );
            
                            if ( $link ) {
    
                                $list_item_classes = [];
    
                                $value = $link['value'];
                                $title = $link['title'];
                                $target = $link['target'];
    
                                $list_item_classes = esc_attr( trim( implode(' ', $list_item_classes ) ) );
            
                                ?>
                                <li class="<?=$list_item_classes?>" style="<?=$icon_styles?>">
                                    <a href="<?=$value?>" title="<?=$title?>" target="<?=$target?>">
                                        <span class="<?=$icon_classes?>">
                                            <?=$icon['icon']?>
                                        </span>
                                    </a>
                                </li>
                                <?php
                            } elseif ( $text_content ) { ?>
            
                                <li class="<?=$list_item_classes?>" style="<?=$icon_styles?>">
                                    <span class="<?=$icon_classes?>">
                                        <?=$icon['icon']?>
                                    </span>
                                </li>
                                
                            <?php } else { ?>
            
                                <li class="<?=$list_item_classes?>" style="<?=$icon_styles?>">
                                    <span class="<?=$icon_classes?>">
                                        <?=$icon['icon']?>
                                    </span>
                                </li>
            
                            <?php }
            
                        }

                    }

                }

            echo '</ul>'; // end social icons

        } else {

            $left_menu_select = get_field('left_menu_select', 'header');

            if ( $right_menu_select ) {
                echo '<div class="top-left-menu-container">'. $left_menu_select .'</div>';
            }

        }

        if ( $right_menu == 'social' ) {

            echo '<ul class="social-icons-menu">'; // start social icons

                $social_icons = get_field('social_icons', 'social');
                $icon_list = $social_icons['icon_list'];

                foreach( $icon_list as $icon ) {

                    // initialize classes arrays
                    $icon_classes = [];
                    $icon_styles = [];
                    $text_classes = [];
    
                    // get icon fields
                    $link = $icon['link'];
                    $separator = $icon['separator'];
                    $text_content = $icon['text_content'];
    
                    // add classes
                    $icon_classes[] = 'icon';
    
                    if ( $top_text_color['theme_colors'] ) {
                        $icon_classes[] = 'text-' . $top_text_color['theme_colors'];
                    }
    
                    if ( $top_text_color['theme_colors'] ) {
                        $text_classes[] = 'text-' . $top_text_color['theme_colors'];
                    }
    
                    if ( $separator != 'none' ) {
                        $icon_styles[] = 'border-' . $separator . ': 1px solid ' . $icon_color['theme_colors'];
                    }
    
                    // process arrays
                    $icon_classes = esc_attr( trim( implode(' ', $icon_classes ) ) );
                    $icon_styles = esc_attr( trim( implode(' ', $icon_styles ) ) );
                    $text_classes = esc_attr( trim( implode(' ', $text_classes ) ) );
    
                    if ( $link ) {

                        $list_item_classes = [];

                        $value = $link['value'];
                        $title = $link['title'];
                        $target = $link['target'];

                        $list_item_classes = esc_attr( trim( implode(' ', $list_item_classes ) ) );
    
                        ?>
                        <li class="<?=$list_item_classes?>" style="<?=$icon_styles?>">
                            <a href="<?=$value?>" title="<?=$title?>" target="<?=$target?>">
                                <span class="<?=$icon_classes?>">
                                    <?=$icon['icon']?>
                                </span>
                            </a>
                        </li>
                        <?php
                    } elseif ( $text_content ) { ?>
    
                        <li class="<?=$list_item_classes?>" style="<?=$icon_styles?>">
                            <span class="<?=$icon_classes?>">
                                <?=$icon['icon']?>
                            </span>
                        </li>
                        
                    <?php } else { ?>
    
                        <li class="<?=$list_item_classes?>" style="<?=$icon_styles?>">
                            <span class="<?=$icon_classes?>">
                                <?=$icon['icon']?>
                            </span>
                        </li>
    
                    <?php }
    
                }

            echo '</div>'; //social icons end

        } else {

            $right_menu_select = get_field('right_menu_select', 'header');

            if ( $right_menu_select ) {
                echo '<div class="top-right-menu-container">'. $right_menu_select .'</div>';
            }

        }
        
    } elseif ( $top_menu_layout == 'single' ) {

        $single_menu_classes = [];

        $single_menu_classes[] = 'container';
        $single_menu_classes[] = 'single-menu-container';

        $single_menu_select = get_field('single_menu_select', 'header');
        $single_menu_alignment = get_field('single_menu_alignment', 'header');

        if ( $single_menu_alignment ) {
            $single_menu_classes[] = 'd-flex';
            if ( $single_menu_alignment === 'left' ) {
                $single_menu_classes[] = 'justify-content-start';
            } elseif ( $single_menu_alignment === 'center' ) {
                $single_menu_classes[] = 'justify-content-center';
            } elseif ( $single_menu_alignment === 'right' ) {
                $single_menu_classes[] = 'justify-content-end';
            }
        }

        $single_menu_classes = esc_attr( trim( implode(' ', $single_menu_classes ) ) );

        if ( $single_menu_select ) {
            echo '<div class="'. $single_menu_classes .'">'. $single_menu_select .'</div>';
        }

    }

    //echo '</div>'; // top menu row end
    echo '</div>'; // top menu container end

} // top menu fields end