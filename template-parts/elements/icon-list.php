<?php

if( get_row_layout() == 'icon_list' ):

    // content
    $icon_list = get_sub_field('icon_list');

    if ( $icon_list ) {
        
        // initialize classes array
        $list_classes = [];
        $list_item_classes = [];

        // add classes
        $list_classes[] = 'element';
        $list_classes[] = 'icon-list';

        // settings
        $icon_color = get_sub_field('icon_color');
        $text_color = get_sub_field('text_color');
        $orientation = get_sub_field('orientation');
        $icon_size = get_sub_field('icon_size');
        $alignment = get_sub_field('alignment');
        $icon_spacing = get_sub_field('icon_spacing');

        // advanced
        $additional_classes = get_sub_field('additional_classes');
        $unique_id = get_sub_field('unique_id');
        if ( $additional_classes ) {
            $list_classes[] = $additional_classes;
        }

        if ( $orientation ) {
            $list_classes[] = 'orientation-' . $orientation;
        }

        if ( $alignment ) {
            $list_classes[] = 'align-' . $alignment;
        }

        if ( $icon_spacing ) {
            if ( $icon_spacing == 'none' ) {
                $icon_spacing = '0';
            }
            if ( $orientation == 'horizontal' ) {
                $list_item_classes[] = 'pe-' . $icon_spacing;
            } elseif ( $orientation == 'vertical' ) {
                $list_item_classes[] = 'pb-' . $icon_spacing;
            }
        }

        // spacing
        $list_classes[] = get_spacing_bbc(get_sub_field('icon_list_spacing'));

        // process classes array
        $list_classes = esc_attr( trim( implode(' ', $list_classes ) ) );
        $list_item_classes = esc_attr( trim( implode(' ', $list_item_classes ) ) );

        // output
        echo '<ul class="'. $list_classes .'">'; // icon list start

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

                if ( $icon_color['theme_colors'] ) {
                    $icon_classes[] = 'text-' . $icon_color['theme_colors'];
                }

                if ( $text_color['theme_colors'] ) {
                    $text_classes[] = 'text-' . $text_color['theme_colors'];
                }

                if ( $icon_size ) {
                    $icon_classes[] = $icon_size;
                }

                if ( $separator != 'none' ) {
                    $icon_styles[] = 'border-' . $separator . ': 1px solid ' . $icon_color['theme_colors'];
                }

                // process arrays
                $icon_classes = esc_attr( trim( implode(' ', $icon_classes ) ) );
                $icon_styles = esc_attr( trim( implode(' ', $icon_styles ) ) );
                $text_classes = esc_attr( trim( implode(' ', $text_classes ) ) );

                if ( $link ) {
                    $value = $link['value'];
                    $title = $link['title'];
                    $target = $link['target'];

                    ?>
                    <li class="<?=$list_item_classes?>" style="<?=$icon_styles?>">
                        <a href="<?=$value?>" title="<?=$title?>" target="<?=$target?>">
                            <span class="<?=$icon_classes?>">
                                <?=$icon['icon']?>
                            </span>
                            <span class="<?=$text_classes?>">
                                <?=$title?>
                            </span>
                        </a>
                    </li>
                    <?php
                } elseif ( $text_content ) { ?>

                    <li class="<?=$list_item_classes?>" style="<?=$icon_styles?>">
                        <span class="<?=$icon_classes?>">
                            <?=$icon['icon']?>
                        </span>
                        <span class="<?=$text_classes?>">
                            <?=$text_content?>
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

        echo '</ul>'; // icon list end

    }

endif;