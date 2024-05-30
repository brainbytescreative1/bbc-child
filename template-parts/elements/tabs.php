<?php

if( get_row_layout() == 'tabbed_content' ):

    // get fields
    $tabs = get_sub_field('tabs');

    if ( $tabs ) {

        // wrapper
        $tabs_wrapper_classes = [];
        $tabs_wrapper_classes[] = 'tabs-wrapper';
        $tabs_wrapper_classes[] = 'tabs-element';
        $tabs_wrapper_classes[] = get_sub_field('additional_classes');
        $tabs_wrapper_classes[] = get_spacing_bbc(get_sub_field('tabs_spacing'));

        // tabs
        $tabs_classes = [];
        $tabs_classes[] = 'nav';
        $tabs_classes[] = 'nav-tabs';
        $tabs_classes[] = get_sub_field('nav');

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

        // pane
        $tab_pane_classes = [];
        $tab_pane_classes[] = 'tab-pane';
        $tab_pane_classes[] = 'fade';
        //$tab_pane_classes[] = 'show';
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
        $tab_text_classes[] = 'rounded-end';
        $tab_text_classes[] = 'd-flex';
        $tab_text_classes[] = 'flex-column';
        $tab_text_classes[] = 'justify-content-center';
        $tab_text_classes[] = get_sub_field('tab_text');

        // heading
        $heading_classes = [];
        $heading_settings = get_sub_field('heading_settings');
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
            #<?=$tabs_id?> .nav-link {
                color: var(--white);
                background: var(--secondary);
                color: <?php echo get_color_bbc('text_color_inactive', true, true); ?>;
                background: <?php echo get_color_bbc('background_color_inactive', true, true); ?>;
            }
            #<?=$tabs_id?> .nav-link.active {
                color: var(--white);
                background: var(--primary);
                color: <?php echo get_color_bbc('text_color_active', true, true); ?>;
                background: <?php echo get_color_bbc('background_color_active', true, true); ?>;
            }
            #<?=$tabs_id?>-content .tab-text {
                background-color: <?php echo get_color_bbc('text_background_color', true, true); ?>;
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
                                if ( $content_type === 'wysiwyg' ) {
                                    echo $tab_text_content;
                                } elseif ( $content_type === 'html' ) {
                                    echo $tab_html;
                                }
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