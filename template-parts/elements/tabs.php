<?php

if( get_row_layout() == 'tabbed_content' ):

    // get fields
    $tabs = get_sub_field('tabs');

    if ( $tabs ) {

        echo '<style>';
            include_once( __DIR__ . '/styles/tabs.css');
        echo '</style>';

        // wrapper
        $tabs_wrapper_classes = [];
        $tabs_wrapper_classes[] = 'tabs-wrapper';
        $tabs_wrapper_classes[] = 'tabs-element';
        $tabs_wrapper_classes[] = get_sub_field('additional_classes');
        $tabs_wrapper_classes[] = get_spacing_bbc(get_sub_field('tabs_spacing'));

        // colors
        $text_color_inactive = get_rgb_color_bbc('text_color_inactive', true);
        if ( !$text_color_inactive ) {
            $text_color_inactive = '#000';
        }
        $background_color_inactive = get_rgb_color_bbc('background_color_inactive', true);
        if ( !$background_color_inactive ) {
            $background_color_inactive = '#fff';
        }
        $text_color_active = get_rgb_color_bbc('text_color_active', true);
        if ( !$text_color_active ) {
            $text_color_active = '#fff';
        }
        $background_color_active = get_rgb_color_bbc('background_color_active', true);
        if ( !$background_color_active ) {
            $background_color_active = '#000';
        }
        $text_color = get_rgb_color_bbc('text_color', true);
        if ( !$text_color ) {
            $text_color = '#000';
        }
        $text_background_color = get_rgb_color_bbc('text_background_color', true);
        if ( !$text_background_color ) {
            $text_background_color = '#fff';
        }

        // tabs
        $tabs_classes = [];
        $tabs_classes[] = 'nav';
        $tabs_classes[] = get_sub_field('nav');

        if ( get_sub_field('tab_alignment') !== 'default' ) {
            $tabs_classes[] = get_sub_field('tab_alignment');
        }
        if ( get_sub_field('tab_appearance') !== 'default' ) {
            $tabs_classes[] = get_sub_field('tab_appearance');
        } else {
            $tabs_classes[] = 'nav-pills';
        }
        if ( get_sub_field('tab_width') !== 'default' ) {
            $tabs_classes[] = get_sub_field('tab_width');
        }
        if ( get_sub_field('tabs_margin_top') !== 'default' ) {
            $tabs_classes[] = 'mt-' . get_sub_field('tabs_margin_top');
        } else {
            $tabs_classes[] = 'mt-1';
        }
        if ( get_sub_field('tabs_margin_bottom') !== 'default' ) {
            $tabs_classes[] = 'mb-' . get_sub_field('tabs_margin_bottom');
        } else {
            $tabs_classes[] = 'mb-1';
        }
        if ( get_sub_field('tabs_margin_bottom') !== 'default' ) {
            $tabs_classes[] = 'mb-' . get_sub_field('tabs_margin_bottom');
        } else {
            $tabs_classes[] = 'mb-1';
        }

        // space between
        $tabs_space_between = get_sub_field('tabs_space_between');
        if ( $tabs_space_between !== 'default' ) {
            if ( $tabs_space_between === 'none' ) {
                $tabs_space_between = '0';
            } elseif ( $tabs_space_between === 'custom' ) {
                if ( get_sub_field('custom_space_between') ) {
                    $tabs_space_between = get_sub_field('custom_space_between');
                } else {
                    $tabs_space_between = '.5rem';
                }
            }
        } else {
            $tabs_space_between = '.5rem';
        }
        // border radius
        $tab_border_radius = get_sub_field('tab_border_radius');
        if ( $tab_border_radius !== 'default' ) {
            if ( $tab_border_radius === 'none' ) {
                $tab_border_radius = '0';
            } elseif ( $tab_border_radius === 'custom' ) {
                if ( get_sub_field('custom_tab_border_radius') ) {
                    $tab_border_radius = get_sub_field('custom_tab_border_radius');
                } else {
                    $tab_border_radius = '.5rem';
                }
            }
        } else {
            $tab_border_radius = 'var(--bs-nav-pills-border-radius)';
        }
        // tabs responsive
        $tabs_classes[] = 'flex-row';
        
        $mobile_breakpoint = get_sub_field('mobile_breakpoint');
        $mobile_tab_width_breakpoint = null;
        switch ($mobile_breakpoint) {
            case 'none':
                $mobile_tab_width_breakpoint = '1920px';
                break;
            case 'sm':
                $mobile_tab_width_breakpoint = '576px';
                break;
            case 'md':
                $mobile_tab_width_breakpoint = '768px';
                break;
            case 'xl':
                $mobile_tab_width_breakpoint = '1200px';
                break;
            case 'xxl':
                $mobile_tab_width_breakpoint = '1400px';
                break;
            default:
                $mobile_tab_width = '992px';
        }

        $mobile_tab_width = null;
        $mobile_columns = get_sub_field('mobile_columns');
        switch ($mobile_columns) {
            case 'two':
                $mobile_tab_width = '50%';
                break;
            default:
                $mobile_tab_width = '100%';
        }

        // nav_item
        $nav_item_classes = [];
        $nav_item_classes[] = 'nav-item';
        $nav_item_classes[] = get_sub_field('nav_item');

        // nav buttons
        $button_classes = [];
        $button_classes[] = 'nav-link';
        $button_classes[] = get_sub_field('nav_button');

        // content
        $tab_content_classes = [];
        $tab_content_classes[] = 'tab-content';
        $tab_content_classes[] = get_sub_field('tab_content');
        $tab_content_border_radius_custom_value = 'inherit';
        $tab_content_border_radius = get_sub_field('tab_content_border_radius');
        if ( $tab_content_border_radius !== 'default' ) {
            $tab_content_classes[] = 'overflow-hidden';
            if ( $tab_content_border_radius === 'custom' ) {
                if ( get_sub_field('tab_content_border_radius_custom') ) {
                    $tab_content_border_radius_custom_value = get_sub_field('tab_content_border_radius_custom');
                }
            } else {
                $tab_content_classes[] = 'rounded-' . $tab_content_border_radius;
            }
        }

        // pane
        $tab_pane_classes = [];
        $tab_pane_classes[] = 'tab-pane';
        $tab_pane_classes[] = 'fade';
        $tab_pane_classes[] = get_sub_field('tab_pane');

        // content inner
        $tab_content_inner_classes = [];
        $tab_content_inner_classes[] = 'd-flex';
        $tab_content_inner_classes[] = 'tab-content-inner';
        $tab_content_inner_classes[] = 'p-0';
        $tab_content_inner_classes[] = get_sub_field('tab_content_inner');

        // tab image
        $tab_image_classes = [];
        $tab_image_classes[] = 'tab-image';
        $tab_image_classes[] = 'col-md-' . get_sub_field('image_width');
        $tab_image_classes[] = get_sub_field('tab_image');

        // tab image styles
        $tab_image_styles = [];
        $image_min_height = get_sub_field('image_min_height');
        if ( $image_min_height ) {
            $tab_image_styles[] = 'min-height: ' . $image_min_height . 'px;';
            $tab_image_classes[] = 'tab-has-min-height';
        } else {
            $tab_image_styles[] = 'min-height: 400px;';
            $tab_image_classes[] = 'tab-has-min-height';
        }
        $image_background_position = get_sub_field('image_background_position');
        if ( $image_background_position ) {
            $tab_image_styles[] = 'background-position: ' . $image_background_position . ' !important;';
        } else {
            $tab_image_styles[] = 'background-position: center center !important;';
        }
        $tab_image_styles = trim(implode(' ', $tab_image_styles));

        // tab image inner
        $tab_image_inner_classes = [];
        $tab_image_inner_classes[] = 'tab-image-inner';
        $tab_image_inner_classes[] = get_sub_field('tab_image_inner');

        $tab_text_classes = [];
        $tab_text_classes[] = 'tab-text';
        $tab_text_classes[] = 'flex-grow-1';
        $tab_text_classes[] = 'no-margin-bottom';
        $tab_text_classes[] = 'd-flex';
        $tab_text_classes[] = 'flex-column';
        $tab_text_classes[] = 'justify-content-center';
        $tab_text_classes[] = 'p-2';
        $tab_text_classes[] = get_sub_field('tab_text');
        if ( get_sub_field('tab_content_spacing' ) !== 'default' ) {
            $tab_text_classes[] = 'p-' . $mobile_breakpoint . '-' . get_sub_field('tab_content_spacing' );
        }
        $tab_content_text_size = get_sub_field('tab_content_text_size');
        if ( $tab_content_text_size ) {
            $tab_text_classes[] = $tab_content_text_size;
        }

        // heading
        $heading_classes = [];
        $heading_settings = get_sub_field('heading_settings');
        $heading_classes[] = get_sub_field('heading_classes');
        $heading_classes[] = get_sub_field('nav_button_tag');
        $tag = $heading_settings['tag'];

        $heading_classes[] = 'mb-0';

        if ( $heading_settings['font_size'] && ( $heading_settings['font_size'] !== 'default' ) ) {
            $heading_classes[] = $heading_settings['font_size'];
            $heading_classes[] = 'tabs-font-size';
        }
        if ( $heading_settings['font_weight'] && ( $heading_settings['font_weight'] !== 'default' ) ) {
            $heading_classes[] = 'weight-' . $heading_settings['font_weight'];
        }
        if ( $heading_settings['font_family'] && ( $heading_settings['font_family'] !== 'default' ) ) {
            $heading_classes[] = 'font-' . $heading_settings['font_family'];
        }

        // unique ids
        $tabs_id = 'tabs-' . rand(0,9999);
        $tab_id = rand(0,9999);

        // process tabs classes and styles
        $tabs_wrapper_classes = trim(implode(' ', $tabs_wrapper_classes));
        $tabs_classes = trim(implode(' ', $tabs_classes));
        $nav_item_classes = trim(implode(' ', $nav_item_classes));
        $tab_pane_classes = trim(implode(' ', $tab_pane_classes));
        $tab_content_classes = trim(implode(' ', $tab_content_classes));
        $button_classes = trim(implode(' ', $button_classes));
        $heading_classes = trim(implode(' ', $heading_classes));
        $tab_content_inner_classes = trim(implode(' ', $tab_content_inner_classes));
        $tab_image_classes = trim(implode(' ', $tab_image_classes));
        $tab_image_inner_classes = trim(implode(' ', $tab_image_inner_classes));
        $tab_text_classes = trim(implode(' ', $tab_text_classes));

        ?>

        <style>
            .tabs-element .nav {
                gap: <?=$tabs_space_between?>;
            }
            .tabs-element .nav-link {
                color: <?=$text_color_inactive?>;
                background: <?=$background_color_inactive?>;
                border-radius: <?=$tab_border_radius?>;
            }
            .tabs-element .nav-link.active {
                color: <?=$text_color_active?>;
                background: <?=$background_color_active?>;
            }
            <?php if ( $tab_content_border_radius_custom_value ) { ?>
            .tabs-element .tab-content {
                border-radius: <?=$tab_content_border_radius_custom_value?>px;
            }
            <?php } ?>
            .tabs-element .tab-text {
                color: <?=$text_color?>;
                background: <?=$text_background_color?>;
            }
            @media screen and (max-width: <?=$mobile_tab_width_breakpoint?>) {
                .tabs-element .nav-item {
                    width: calc(<?=$mobile_tab_width?> - <?=$tabs_space_between?>);
                }
            }
        </style>

        <?php
        
        ?>

        <div class="<?=$tabs_wrapper_classes?>">
            <!-- Nav tabs -->
            <ul class="<?=$tabs_classes?>" id="<?=$tabs_id?>" role="tablist">
                <?php
                $tabs_count = 0;
                $tab_count = $tab_id;
                $active = 'active';
                $active_button = 'active';
                $selected = 'true';
                foreach ($tabs as $tab ) {
                    $tabs_count++;
                    ?>
                    <li class="<?=$nav_item_classes?>" role="presentation">
                        <button class="<?=$button_classes?> <?=$active?>" id="tab<?=$tab_count?>-tab" data-bs-toggle="tab" data-bs-target="#tab<?=$tab_count?>" type="button" role="tab" aria-controls="tab<?=$tab_count?>" aria-selected="<?=$active?>">
                            <?php if ( $tab['heading'] ) { ?>
                                <<?=$tag?> class="<?=$heading_classes?>"><?=$tab['heading']['text']?></<?=$tag?>>
                            <?php } ?>
                        </button>
                    </li>
                    <?php
                    if ( $active === 'active' ) {
                        $active = '';
                        $active_button = '';
                    }
                    if ( $selected === 'false' ) {
                        $selected = '';
                    }
                    $tab_count++;
                }
                ?>
            </ul>

            <!-- nav content -->
            <div class="<?=$tab_content_classes?>" id="<?=$tabs_id?>-content">
                <?php
                $tabs_count = 0;
                $tab_count = $tab_id;
                $active = 'active';
                $show = 'show';

                foreach ($tabs as $tab ) {
                    $tabs_count = 0;
                    $content_type = $tab['content_type'];
                    $tab_text = $tab['text'];
                    $tab_html = $tab['html'];
                    $tab_text_content = $tab_text['text'];
                    $tab_image = $tab['image'];
                    $image = $tab_image['image'];
                    $has_image = '';
                    $show_image = '';
                    if ( $image ) {
                        $show_image = $tab_image_classes;
                    }
                    
                    ?>
                    <div class="<?=$tab_pane_classes?> <?=$active?> <?=$show?>" id="tab<?=$tab_count?>" role="tabpanel" aria-labelledby="tab<?=$tab_count?>-tab">
                        <div class="<?=$tab_content_inner_classes?>">
                            <?php
                            if ( $image ) {
                                // Image variables.
                                $url = wp_get_attachment_image_url($image, 'medium_large');

                                // Thumbnail size attributes.
                                $url = isUrlValid($url);

                                ?>
                                <div class="<?=$show_image?>">
                                    <div class="<?=$tab_image_inner_classes?>" style="background: url(<?php echo esc_url($url); ?>);<?=$tab_image_styles?>"></div>
                                </div>
                            <?php } ?>
                            
                            <div class="<?=$tab_text_classes?><?=$has_image?>">
                                <?php
                                // text heading
                                echo get_heading_bbc($tab['content_heading']);
                                
                                // text content
                                if ( $content_type === 'wysiwyg' ) {
                                    echo $tab_text_content;
                                } elseif ( $content_type === 'html' ) {
                                    echo $tab_html;
                                }

                                // buttons
                                echo get_buttons_bbc($tab['content_buttons']);
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ( $active === 'active' ) {
                        $active = '';
                    }
                    if ( $show === 'show' ) {
                        $show = '';
                    }
                    $tab_count++;
                }
                ?>
            </div>
        </div>

    <?php }

endif;