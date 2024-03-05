<?php

if( get_row_layout() == 'icon_list' ):

    // content
    $icon_list = get_sub_field('icon_list');

    if ( $icon_list ) {
        
        // initialize classes arrays
        $list_container_classes = [];
        $list_classes = [];
        $list_item_classes = [];

        // add initial classes
        $list_container_classes[] = 'element';
        $list_container_classes[] = 'icon-list-container';
        $list_classes[] = 'icon-list';
        $list_classes[] = 'd-flex';

        // settings
        $icon_color = get_sub_field('icon_color');
        $text_color = get_sub_field('text_color');
        $desktop_orientation = get_sub_field('orientation');
        $mobile_orientation = get_sub_field('mobile_orientation');
        $icon_size = get_sub_field('icon_size');
        $alignment = get_sub_field('alignment');
        $mobile_alignment = get_sub_field('mobile_alignment');
        $item_spacing = get_sub_field('icon_spacing');
        $$mobile_item_spacing = null;
        $mobile_item_spacing = get_sub_field('mobile_item_spacing');
        $icon_margin = get_sub_field('icon_margin');
        $list_item_vertical_alignment = null;
        $list_item_vertical_alignment = get_sub_field('list_item_vertical_alignment');

        $breakpoint = 'lg';
        $mobile_breakpoint = null;
        $mobile_breakpoint = get_sub_field('mobile_breakpoint');
        if ( $mobile_breakpoint ) {
            $breakpoint = $mobile_breakpoint;
        }

        // advanced
        
        $unique_id = get_sub_field('unique_id');
        $list_container_classes_field = get_sub_field('list_container_classes');
        if ( $list_container_classes_field ) {
            $list_container_classes[] = $list_container_classes_field;
        }
        /*
        $list_classes_field = get_sub_field('list_classes');
        if ( $list_classes_field ) {
            $list_container_classes[] = $list_classes_field;
        }
        $list_item_classes_field = get_sub_field('list_item_classes');
        if ( $list_item_classes_field ) {
            $list_container_classes[] = $list_item_classes_field;
        }
        $icon_classes_field = get_sub_field('icon_classes');
        if ( $list_item_classes_field ) {
            $icon_classes[] = $icon_classes_field;
        }
        $text_classes_field = get_sub_field('icon_classes');
        if ( $text_classes_field ) {
            $text_classes[] = $text_classes_field;
        }
        $text_classes_field = get_sub_field('icon_classes');
        if ( $text_classes_field ) {
            $text_classes[] = $text_classes_field;
        }
        */
        
        

        // push classes to inside loop
        $list_item_classes_field = get_sub_field('list_item_classes');
        $icon_classes_field = get_sub_field('icon_classes');
        $text_classes_field = get_sub_field('text_classes');

        // heading
        $heading = get_sub_field('heading');
        $heading_position = get_sub_field('heading_position');
        if ( $heading_position == 'left' ) {
            $list_container_classes[] = 'd-flex';
            $list_container_classes[] = 'flex-'. $breakpoint .'-row';
            $list_container_classes[] = 'flex-column';
            $list_container_classes[] = 'align-items-center';
        } elseif ( $heading_position == 'top' ) {
            $list_container_classes[] = 'd-flex';
            $list_container_classes[] = 'flex-column';
            $list_container_classes[] = 'align-items-center';
        } elseif ( $heading_position == 'right' ) {
            $list_container_classes[] = 'd-flex';
            $list_container_classes[] = 'flex-'. $breakpoint .'-row-reverse';
            $list_container_classes[] = 'flex-column';
            $list_container_classes[] = 'align-items-center';
        } elseif ( $heading_position == 'bottom' ) {
            $list_container_classes[] = 'd-flex';
            $list_container_classes[] = 'flex-column-reverse';
            $list_container_classes[] = 'align-items-center';
        }

        // orientation
        if ( $desktop_orientation ) {
            $list_classes[] = 'orientation-' . $desktop_orientation;
            if ( $desktop_orientation === 'horizontal' ) {
                $list_classes[] = 'flex-'. $breakpoint .'-row';
            } elseif ( $desktop_orientation === 'vertical' ) {
                $list_classes[] = 'flex-'. $breakpoint .'-column';
            }
        }

        if ( $mobile_orientation ) {
            $list_classes[] = 'orientation-mobile-' . $mobile_orientation;
            if ( $mobile_orientation === 'horizontal' ) {
                $list_classes[] = 'flex-row';
            } elseif ( $mobile_orientation === 'vertical' ) {
                $list_classes[] = 'flex-column';
            } else {
                $list_classes[] = 'flex-column';
            }
        }

        // alignment
        if ( $alignment ) {

            $list_classes[] = 'd-flex';
            
            if ( $alignment === 'left' ) {
                $list_classes[] = 'ms-'. $breakpoint .'-0';
                $list_classes[] = 'me-'. $breakpoint .'-auto';
                $list_classes[] = 'align-items-'. $breakpoint .'-start';
                $list_classes[] = 'justify-content-'. $breakpoint .'-start';
            }
            if ( $alignment === 'center' ) {
                $list_classes[] = 'ms-'. $breakpoint .'-auto';
                $list_classes[] = 'me-'. $breakpoint .'-auto';
                $list_classes[] = 'align-items-'. $breakpoint .'-center';
                $list_classes[] = 'justify-content-'. $breakpoint .'-center';
            }
            if ( $alignment === 'right' ) {
                $list_classes[] = 'me-'. $breakpoint .'-0';
                $list_classes[] = 'ms-'. $breakpoint .'-auto';
                $list_classes[] = 'align-items-'. $breakpoint .'-end';
                $list_classes[] = 'justify-content-'. $breakpoint .'-end';
            }
            
        }

        if ( $mobile_alignment ) {

            $list_classes[] = 'd-flex';

            if ( $mobile_alignment === 'left' ) {
                $list_classes[] = 'ms-0';
                $list_classes[] = 'me-auto';
                $list_classes[] = 'align-items-start';
            }
            if ( $mobile_alignment === 'center' ) {
                $list_classes[] = 'ms-auto';
                $list_classes[] = 'me-auto';
                $list_classes[] = 'align-items-center';
            }
            if ( $mobile_alignment === 'right' ) {
                $list_classes[] = 'me-0';
                $list_classes[] = 'ms-auto';
                $list_classes[] = 'align-items-end';
            }
        }
        

        // spacing
        if ( $item_spacing ) {
            if ( !$mobile_item_spacing ) {
                $mobile_item_spacing = $item_spacing;
            }
            if ( $item_spacing == 'none' ) {
                $item_spacing = '0';
            }
            if ( $mobile_item_spacing == 'none' ) {
                $mobile_item_spacing = '0';
            }
            // desktop orientation
            if ( $desktop_orientation ) {
                if ( $desktop_orientation == 'horizontal' ) {
                    $list_item_classes[] = 'me-'. $breakpoint .'-' . $item_spacing;
                    $list_item_classes[] = 'mb-'. $breakpoint .'-0';
                } elseif ( $desktop_orientation == 'vertical' ) {
                    $list_item_classes[] = 'mb-'. $breakpoint .'-' . $item_spacing;
                    $list_item_classes[] = 'me-'. $breakpoint .'-0';
                }
            }
            // mobile orientation
            if ( $mobile_orientation ) {
                if ( $mobile_orientation === 'horizontal' ) {
                    $list_item_classes[] = 'me-'. $mobile_item_spacing;
                    $list_item_classes[] = 'mb-0';
                } elseif ( $mobile_orientation === 'vertical' ) {
                    $list_item_classes[] = 'mb-'. $mobile_item_spacing;
                    $list_item_classes[] = 'me-0';
                }
            } else {
                $list_item_classes[] = 'mb-'. $item_spacing;
            }
        }

        // spacing
        $list_classes[] = esc_attr(trim(get_spacing_bbc(get_sub_field('icon_list_spacing'))));

        //advanced
        if ( $list_item_classes_field ) {
            $list_item_classes[] = $list_item_classes_field;
        }

        // process classes array
        $list_container_classes = esc_attr( trim( implode(' ', $list_container_classes ) ) );
        $list_classes = esc_attr( trim( implode(' ', $list_classes ) ) );
        $list_item_classes = esc_attr( trim( implode(' ', $list_item_classes ) ) );

        // output
        echo '<div class="'. $list_container_classes .'">'; // start list container

        if ( $heading && $heading['text'] && $heading['tag'] ) {
            echo '<div class="icon-list-heading">' . get_heading_bbc($heading) . '</div>';
        }

        echo '<ul class="'. $list_classes .'">'; // icon list start

            foreach( $icon_list as $icon ) {

                // initialize classes arrays
                $icon_classes = [];
                $icon_styles = [];
                $text_classes = [];
                $link_text_classes = [];
                $list_item_classes = explode(' ', $list_item_classes);

                // get icon fields
                $link = $icon['link'];
                $separator = $icon['separator'];
                $text_content = $icon['text_content'];

                // add classes
                $icon_classes[] = 'icon';
                $icon_classes[] = 'mb-0';
                $icon_classes[] = $icon_classes_field;
                $text_classes[] = $text_classes_field;

                if ( $list_item_vertical_alignment ) {
                    if ( $list_item_vertical_alignment === 'start' ) {
                        $list_item_vertical_alignment = 'align-items: flex-start;';
                    }
                    if ( $list_item_vertical_alignment === 'center' ) {
                        $list_item_vertical_alignment = 'align-items: center;';
                    }
                    if ( $list_item_vertical_alignment === 'end' ) {
                        $list_item_vertical_alignment = 'align-items: flex-end;';
                    }
                } else {
                    $list_item_vertical_alignment = 'align-items: center;';
                }

                if ( $icon_color['theme_colors'] ) {
                    $icon_classes[] = 'text-' . $icon_color['theme_colors'];
                }

                if ( $text_color['theme_colors'] ) {
                    $text_classes[] = 'text-' . $text_color['theme_colors'];
                }

                if ( $icon_size ) {
                    $icon_classes[] = $icon_size;
                }
                
                if ( $icon_margin && ( $icon_margin !== 'default' ) ) {
                    if ( $icon_margin === 'none' ) {
                        $icon_classes[] = 'me-0';
                        $list_item_classes[] = 'me-0';
                    } else {
                        $icon_classes[] = 'me-' . $icon_margin;
                        $list_item_classes[] = 'me-' . $icon_margin;
                    }
                }

                if ( $separator && ( $separator === 'add' ) ) {
                    if ( $desktop_orientation === 'horizontal' ) {
                        $icon_styles[] = 'border-right: 1px solid var(--' . $icon_color['theme_colors'] . ');';
                        $list_item_classes[] = 'pe-' . $breakpoint . '-' . $item_spacing;
                        $list_item_classes[] = 'pe-' . $mobile_item_spacing;
                    } elseif ( $desktop_orientation === 'vertical' ) {
                        $icon_styles[] = 'border-bottom: 1px solid var(--' . $icon_color['theme_colors'] . ');';
                        $list_item_classes[] = 'pb-' . $breakpoint . '-' . $item_spacing;
                        $list_item_classes[] = 'pb-' . $mobile_item_spacing;
                    }
                }

                // process arrays
                $icon_classes = esc_attr( trim( implode(' ', $icon_classes ) ) );
                $icon_styles = esc_attr( trim( implode(' ', $icon_styles ) ) );
                $text_classes = esc_attr( trim( implode(' ', $text_classes ) ) );
                $link_text_classes = esc_attr( trim( implode(' ', $link_text_classes ) ) );
                $list_item_classes = esc_attr( trim( implode(' ', $list_item_classes ) ) );         

                if ( $link ) {
                    $value = $link['value'];
                    $title = $link['title'];
                    $target = $link['target'];
                    ?>
                    <li class="<?=$list_item_classes?>">
                        <a classes="<?=$link_text_classes?>" href="<?=$value?>" target="<?=$target?>" title="<?=$title?>" style="<?=$list_item_vertical_alignment?>">
                            <span class="<?=$icon_classes?>">
                                <?=$icon['icon']?>
                            </span>
                            <?php if ( $title ) { ?>
                            <span class="<?=$text_classes?>">
                                <?=$title?>
                            </span>
                        </a>
                        <?php } ?>
                    </li>
                    <?php

                } elseif ( $text_content ) { ?>

                    <li class="<?=$list_item_classes?> <?=$link_text_classes?>" style="<?=$icon_styles?> <?=$list_item_vertical_alignment?>">
                        <span class="<?=$icon_classes?>">
                            <?=$icon['icon']?>
                        </span>
                        <span class="<?=$text_classes?>">
                            <?=$text_content?>
                        </span>
                    </li>
                    
                <?php } else { ?>

                    <li class="<?=$list_item_classes?> <?=$link_text_classes?>" style="<?=$icon_styles?> <?=$list_item_vertical_alignment?>">
                        <span class="<?=$icon_classes?>">
                            <?=$icon['icon']?>
                        </span>
                    </li>

                <?php }

            }

        echo '</ul>'; // icon list end

        echo '</div>'; // end list container

    }

endif;