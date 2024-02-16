<?php
/**
 * Section Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during backend preview render.
 * @param   int $post_id The post ID the block is rendering content against.
 *          This is either the post ID currently being displayed inside a query loop,
 *          or the post ID of the post hosting this block.
 * @param   array $context The context provided to the block by the post or it's parent block.
 */

// Create class attribute allowing for custom "className" and "align" values.
$class_name = '';
if ( ! empty( $block['className'] ) ) {
    $class_name .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $class_name .= ' align' . $block['align'];
}
if ( ! empty( $block['backgroundColor'] ) ) {
    $class_name .= ' bg-' . $block['backgroundColor'];
}

$post_id = get_the_ID();

// define attribute arrays
$container_classes = [];
$row_classes = [];

$container_styles = [];
$row_styles = [];

// define overlay
$container_overlay = null;
$row_overlay = null;
$column_overlay = null;
$column_inner_overlay = null;
$container_video = null;
$column_video = null;
$column_inner_video = null;

$page_content_width = '';
$page_content_width = get_page_width_bbc('content_width', $page_content_width, $post_id);

// get number of columns
$column_count = null;
if( have_rows('columns') ):
    $column_count = count(get_field('columns'));
endif;

// get section styles
$section_width = get_field('section_width');
if ( $section_width == 'full' ) {
    $container_classes[] = 'container-fluid';
} else {
    $container_classes[] = 'container';
}

// add initial row classes
$row_classes[] = 'row';
$row_classes[] = 'element-row';

// make container row full width
if ( $section_width != 'full' ) {
    $container_classes[] = 'alignfull';
    $row_classes[] = 'wp-block-cover__inner-container';
} else {
    $container_classes[] = 'alignfull';
}

$container_classes[] = 'element-container';

// get global style settings
//$default_padding = get_field('default_padding', 'style');
//$container_classes[] = 'py-' . $default_padding;

// container classes and styling
$min_height_100vh_minus_menu_height = get_field('min_height_100vh_minus_menu_height');
$min_height = get_field('min_height');
if ( $min_height && ( $min_height_100vh_minus_menu_height !== 'enabled' ) ) {
    $value = $min_height['value'];
    if ( $value ) {
        $container_classes[] = 'has-min-height';
        $unit = $min_height['unit'];
        $min_height = 'min-height: ' . $value . $unit;
        $container_styles[] = $min_height . ';';
    }
} else {
    $header_height = get_field('header_height', 'header');
    $container_classes[] = 'has-min-height';
    $min_height = 'min-height: calc( 100vh - ' . $header_height . 'px)';
    $container_styles[] = $min_height . ';';
}

$max_width = get_field('max_width');
if ( $max_width ) {
    $value = $max_width['value'];
    if ( $value ) {
        $row_classes[] = 'has-max-width';
        $unit = $max_width['unit'];
        $max_width = 'max-width: ' . $value . $unit;
        $row_styles[] = $max_width . ';';
    }
}

$content_alignment = get_field('content_alignment');
if ( $content_alignment ) {
    if ( $content_alignment === 'left' ) {
        $content_alignment = 'start';
    } elseif ( $content_alignment === 'right' ) {
        $content_alignment = 'end';
    }
    $row_classes[] = 'text-' . $content_alignment;
}

// columns per row
$columns_per_row = get_field('columns_per_row');
$mobile_breakpoint = get_field('mobile_breakpoint');
$even_column_height = get_field('even_column_height');
if ( $even_column_height == 'even' ) {
    $row_classes[] = 'even-columns';
}

// column gap
$column_margin_bottom = null;
if ( $column_count > 1 ) {
    $column_gap = get_field('column_gap');
    if ( $column_gap == 'none' ) {
        $column_gap = '0';
    }
    if ( $column_gap === 'default' ) {
        $column_margin_bottom = null;
    } else {
        $row_classes[] = 'gx-' . $column_gap . ' gx-'. $mobile_breakpoint .'-' . $column_gap;
        $column_margin_bottom = 'mb-'. $column_gap .' mb-lg-0';
    }
}

// flex
/*
$flex_vertical_align = get_field('flex_vertical_align');
$flex_horizontal_align = get_field('flex_horizontal_align');
if ( ( $flex_vertical_align !== 'normal' ) || ( $flex_vertical_align !== 'normal' ) ) {
    $container_classes[] = 'd-flex';
}
// flex vertical align
if ( $flex_vertical_align !== 'normal' ) {
    $container_classes[] = $flex_vertical_align;
    $row_classes[] = $flex_vertical_align;
}
// flex horizontal align
if ( $flex_horizontal_align !== 'normal' ) {
    $container_classes[] = $flex_horizontal_align;
    $row_classes[] = $flex_horizontal_align;
}
*/
$element_assignment = get_field('element_assignment');

// container background
$container_background = get_background_bbc('section_background', $container_classes, $container_styles);

if ( $container_background ) {
    if ( $container_background['classes'] ) {
        $container_classes[] = $container_background['classes'];
    }
    if ( $container_background['styles'] ) {
        $container_styles[] = $container_background['styles'];
    }
    if ( $container_background['overlay'] ) {
        $container_overlay = $container_background['overlay'];
    }
    if ( $container_background['video'] ) {
        $container_video = $container_background['video'];
        $container_video_script = $container_background['video_script'];
    }
}

// row background
$row_background = get_background_bbc('row_background', $row_classes, $row_styles);
if ( $row_background ) {
    if ( $row_background['classes'] ) {
        $row_classes[] = $row_background['classes'];
    }
    if ( $row_background['styles'] ) {
        $row_styles[] = $row_background['styles'];
    }
    if ( $row_background['overlay'] ) {
        $row_overlay = $row_background['overlay'];
    }
    if ( $row_background['video'] ) {
        $row_video = $row_background['video'];
    }
}

// remove row padding
/*
$remove_row_padding = get_field('remove_row_padding');
if ( $remove_row_padding == 'remove' ) {
    $row_classes[] = 'ps-0';
    $row_classes[] = 'pe-0';
}
*/

// container advanced
$additional_classes = get_field('additional_classes');
if ( $additional_classes ) {
    $container_classes[] = $additional_classes;
}

$data_id = get_field('data_id');
if ( $data_id ) {
    $data_id = $data_id;
}

$custom_id = get_field('custom_id');
if ( $custom_id ) {
    $custom_id = 'id="'. $custom_id .'"';
}

// reverse columns
$reverse_columns = get_field('reverse_columns');

// row advanced
$row_classes[] = get_field('row_additional_classes');

// dividers
$divider_top = null;
$divider_bottom = null;
$divider_color = null;
$divider_shape = null;
$divider_position = get_field('divider_position');
if ( $divider_position !== 'none' ) {
    $container_classes[] = 'position-relative';
    $divider_shape = get_field('divider_shape');
    if ( $divider_shape !== 'none' ) {
        $divider_color = get_field('divider_color');
        if ( $divider_color && $divider_color['theme_colors'] ) {
            $divider_color = 'var(--' . $divider_color['theme_colors'] . ')';
        }
        if ( $divider_shape === 'wave' ) {
            $divider_top = '<div class="divider-top"><svg data-name="'. $data_id .'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none"><path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill" fill="'. $divider_color .'"></path></svg></div>';
            $divider_bottom = '<div class="divider-bottom"><svg data-name="'. $data_id .'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path class="bg-dark" d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill" fill="'. $divider_color .'"></path></svg></div>';
        }
    }
}

// flex
/*
$flex_element = get_field('flex_element');
if ( $flex_element != 'none' ) {
    $flex = get_flex_bbc($flex_element);
    if ( $flex_element == 'row' ) {
        $row_classes[] = $flex;
    } elseif ( $flex_element == 'container' ) {
        $container_classes[] = $flex;
    }
}
*/
$flex_element = get_field('flex_element');
if ( $flex_element != 'none' ) {
    $flex = get_flex_bbc(get_field('flex'));
    if ( $flex_element == 'row' ) {
        $row_classes[] = $flex;
    } elseif ( $flex_element == 'container' ) {
        $container_classes[] = $flex;
    }
}

// process global functions
$container_classes[] = get_spacing_bbc(get_field('container_spacing'), 'container');
$container_classes[] = get_borders_bbc(get_field('container_borders'));
$row_classes[] = get_spacing_bbc(get_field('row_spacing'));

// process classes and styles
$container_classes = trim(implode(' ', $container_classes));
$row_classes = trim(implode(' ', $row_classes));

$container_styles = implode(' ', $container_styles);
$row_styles = implode(' ', $row_styles);

$column_count = get_field('columns');
if ( $column_count ) {
    $column_count = count($column_count); // get total number of columns
} else {
    $column_count = 0;
}

if ( get_field('columns') && ( $column_count > 0 ) ) {

$column_number = 1; // start number columns

echo '<div class="'. esc_attr($container_classes) . esc_attr($class_name) .'" style="'. esc_attr($container_styles) .'"'. $custom_id .' data-id="'. $data_id .'">'; // container start

    if ( ( $divider_position === 'top' ) || ( $divider_position === 'top-bottom' ) ) {
        echo $divider_top;
    }

    $custom_css = get_field('custom_css');
    if ( $custom_css ) { ?>
        <style>
            [data-id="<?=$data_id?>"] {
                <?=$custom_css?>
            }
        </style>
    <?php }

    if ( $container_video ) {
        echo $container_video;
        echo $container_video_script;
    }

    if ( $container_overlay ) {
        echo $container_overlay;
    }

    $masonry = get_field('masonry');

    ?>
    <div class="<?=esc_attr($row_classes)?>"<?php if ( $masonry === 'enabled' ) { ?> data-masonry='{"percentPosition": true }' <?php } ?> style="<?=esc_attr($row_styles)?>">
    <?

        if ( $row_overlay ) {
            echo $row_overlay;
        }

        if( have_rows('columns') ): // if columns start

            while( have_rows('columns') ) : the_row(); // columns loop start

                // define column attribute arrays
                $col_classes = [];
                $col_inner_classes = [];
                $column_inner_content_classes = [];
                $col_styles = [];
                $col_inner_styles = [];

                // add initial column classes
                $col_classes[] = 'col-element';
                $col_inner_classes[] = 'col-inner';
                $column_inner_content_classes[] = 'col-inner-content';

                // calculate column widths
                $column_width_value = null;

                // get container and column width settings
                $column_container_width = $columns_per_row;
                $column_element_width = get_sub_field('column_width');
                
                // determine if width is defined by container or by column
                if ( $column_container_width === 'auto' ) {
                    $column_width_value = ( 12 / $column_count );
                } elseif ( $column_container_width === 'column-element' ) {
                    if ( $column_element_width === 'auto' ) {
                        $column_width_value = ( 12 / $column_count );
                    } else {
                        $column_width_value = $column_element_width;
                    }
                } else {
                    $column_width_value = $column_container_width;
                }

                // column width
                if ( $column_element_width === 'custom' ) {

                    $column_custom_width = get_sub_field('custom_width');
                    $column_alignment = get_sub_field('column_alignment');

                    if ( $column_custom_width ) {

                        $column_custom_width_value = $column_custom_width['value'];

                        if ( $column_custom_width_value ) {

                            $column_custom_width = 'max-width: ' . $column_custom_width_value . $column_custom_width['unit'] . ';';
                            $column_alignment = 'column-align-' . $column_alignment;

                            if ( $element_assignment == 'outer') {
                                $col_classes[] = $column_alignment;
                                $col_styles[] = $column_custom_width;
                            } else {
                                $col_inner_classes[] = $column_alignment;
                                $col_inner_styles[] = $column_custom_width;
                            }
                            
                        }

                    }
                    
                }

                if ( $column_width_value ) {
                    switch ($mobile_breakpoint) {
                        case 'xxl':
                            $col_classes[] = 'col-xxl-'. $column_width_value;
                            break;
                        case 'xl':
                            $col_classes[] = 'col-xl-'. $column_width_value;
                            break;
                        case 'lg':
                            $col_classes[] = 'col-lg-'. $column_width_value;
                            break;
                        case 'md':
                            $col_classes[] = 'col-md-'. $column_width_value;
                            break;
                        case 'sm':
                            $col_classes[] = 'col-sm-'. $column_width_value;
                            break;
                    }
                }

                // get background
                $column_background = get_background_bbc('column_background', $col_inner_classes, $col_inner_styles, true);
                if ( $column_background ) {

                    if ( $element_assignment == 'outer') {

                        if ( $column_background['classes'] ) {
                            $col_classes[] = $column_background['classes'];
                        }
                        if ( $column_background['styles'] ) {
                            $col_styles[] = $column_background['styles'];
                        }
                        if ( $column_background['overlay'] ) {
                            $column_overlay = $column_background['overlay'];
                        }
                        if ( $column_background['video'] ) {
                            $column_video = $column_background['video'];
                        }
                    } else {

                        if ( $column_background['classes'] ) {
                            $col_inner_classes[] = $column_background['classes'];
                        }
                        if ( $column_background['styles'] ) {
                            $col_inner_styles[] = $column_background['styles'];
                        }
                        if ( $column_background['overlay'] ) {
                            $column_inner_overlay = $column_background['overlay'];
                        }
                        if ( $column_background['video'] ) {
                            $column_inner_video = $column_background['video'];
                        }

                    }

                }

                if ( $reverse_columns === 'reverse' ) {
                    if ( $column_count == 2 ) {
                        if ( $column_number == 1 ) {
                            $col_classes[] = 'order-2';
                            $col_classes[] = 'order-' . $mobile_breakpoint . '-1';
                        } elseif ( $column_number == 2 ) {
                            $col_classes[] = 'order-1';
                            $col_classes[] = 'order-' . $mobile_breakpoint . '-2';
                        }
                    } elseif ( $column_count == 3 ) {
                        if ( $column_number == 1 ) {
                            $col_classes[] = 'order-3';
                            $col_classes[] = 'order-' . $mobile_breakpoint . '-1';
                        } elseif ( $column_number == 2 ) {
                            $col_classes[] = 'order-2';
                            $col_classes[] = 'order-' . $mobile_breakpoint . '-2';
                        } elseif ( $column_number == 3 ) {
                            $col_classes[] = 'order-1';
                            $col_classes[] = 'order-' . $mobile_breakpoint . '-3';
                        }
                    } elseif ( $column_count == 4 ) {
                        if ( $column_number == 1 ) {
                            $col_classes[] = 'order-4';
                            $col_classes[] = 'order-' . $mobile_breakpoint . '-1';
                        } elseif ( $column_number == 2 ) {
                            $col_classes[] = 'order-3';
                            $col_classes[] = 'order-' . $mobile_breakpoint . '-2';
                        } elseif ( $column_number == 3 ) {
                            $col_classes[] = 'order-2';
                            $col_classes[] = 'order-' . $mobile_breakpoint . '-3';
                        } elseif ( $column_number == 4 ) {
                            $col_classes[] = 'order-1';
                            $col_classes[] = 'order-' . $mobile_breakpoint . '-4';
                        }
                    }
                }

                // flex
                $column_flex = get_sub_field('flex_element');
                if ( $column_flex != 'none' ) {
                    $flex = get_flex_bbc(get_sub_field('flex_column'));
                    if ( $column_flex == 'element' ) {
                        $col_classes[] = $flex;
                    } elseif ( $column_flex == 'inner' ) {
                        $col_inner_classes[] = $flex;
                    } elseif ( $column_flex == 'content' ) {
                        $column_inner_content_classes[] = $flex;
                    }
                }

                // additional classes and id
                $additional_classes = get_sub_field('additional_classes');
                if ( $additional_classes ) {
                    $col_classes[] = $additional_classes;
                }

                // add margin
                $col_classes[] = $column_margin_bottom;

                if ( $section_width == 'full' ) {
                    //$col_classes[] = 'ps-0 pe-0';
                }

                // process global functions
                $col_spacing = get_spacing_bbc(get_sub_field('column_spacing'), 'column');

                $column_border_element = get_sub_field('column_border_element');
                $borders = get_borders_bbc(get_sub_field('column_borders'));

                if ( $borders && ( $column_border_element !== 'default' ) ) {
                    if ( $column_border_element === 'col-element' ) {
                        $col_classes[] = $borders;
                    } elseif ( $column_border_element === 'col-inner' ) {
                        $col_inner_classes[] = $borders;
                    } elseif ( $column_border_element === 'col-inner-content' ) {
                        $column_inner_content_classes[] = $borders;
                    }
                } elseif ( $borders ) {
                    if ( $element_assignment == 'outer') {
                        $col_classes[] = $borders;
                    } else {
                        $col_inner_classes[] = $borders;
                    }
                }
                
                if ( $element_assignment == 'outer') {
                    $col_classes[] = $col_spacing;
                } else {
                    $col_inner_classes[] = $col_spacing;
                }

                // element-specific classes
                $col_classes[] = trim(get_sub_field('column_element_classes'));
                $col_inner_classes[] = trim(get_sub_field('column_inner_classes'));
                $column_inner_content_classes[] = trim(get_sub_field('column_inner_content_classes'));
                
                // procces column classes
                $col_classes = implode(' ', $col_classes);
                $col_inner_classes = implode(' ', $col_inner_classes);
                $column_inner_content_classes = implode(' ', $column_inner_content_classes);
                $col_styles = implode(' ', $col_styles);
                $col_inner_styles = implode(' ', $col_inner_styles);

                $column_link = get_sub_field('column_link');
                if ( $column_link ) {
                    $js = null;
                    $url = $column_link['url'];
                    $target = $column_link['target'];
                    
                    ?>
                    <div class="column-link <?=esc_attr($col_classes)?>" style="<?=esc_attr($col_styles)?>" <?php if ( $target !== '_blank' ) { ?> onclick="window.location.href='<?=$url?>';"<?php } else { ?> onclick="window.open('<?=$url?>')" <?php } ?>>
                <?php } else {
                    echo '<div class="'. esc_attr($col_classes) .'" style="'. esc_attr($col_styles) .'">'; // column start
                }

                    echo '<div class="'. esc_attr($col_inner_classes) .'" style="'. esc_attr($col_inner_styles) .'">'; // column inner start

                        if ( $column_overlay ) {
                            echo $column_overlay;
                        }
                        if ( $column_video ) {
                            echo $column_video;
                        }

                        echo '<div class="'. esc_attr($column_inner_content_classes) .'">'; // column inner content start

                        if ( $column_inner_overlay ) {
                            echo $column_inner_overlay;
                        }
                        if ( $column_inner_video ) {
                            echo $column_inner_video;
                        }

                        if( have_rows('elements') ): // if elements start

                            while ( have_rows('elements') ) : the_row(); // elements loop start

                                // add elements
                                include( __DIR__ . '../../../elements/heading.php');
                                include( __DIR__ . '../../../elements/paragraph.php');
                                include( __DIR__ . '../../../elements/buttons.php');
                                include( __DIR__ . '../../../elements/image.php');
                                include( __DIR__ . '../../../elements/staff.php');
                                include( __DIR__ . '../../../elements/carousel.php');
                                include( __DIR__ . '../../../elements/divider.php');
                                include( __DIR__ . '../../../elements/accordion.php');
                                include( __DIR__ . '../../../elements/tabs.php');
                                include( __DIR__ . '../../../elements/icon-list.php');
                                include( __DIR__ . '../../../elements/gallery.php');
                                include( __DIR__ . '../../../elements/post-carousel.php');
                                include( __DIR__ . '../../../elements/html.php');
                                include( __DIR__ . '../../../elements/form.php');
                                //include( __DIR__ . '../../../elements/video-popup.php');
                                include( __DIR__ . '../../../elements/modal.php');

                            endwhile; // elements loop end

                        endif; // if elements end

                        echo '</div>'; // column inner content end

                    echo '</div>'; // column inner end

                echo '</div>'; // column end

                $column_number++; // end numbering columns

            endwhile; // columns loop end

        endif; // if columns end

    echo '</div>'; // row end

    if ( ( $divider_position === 'bottom' ) || ( $divider_position === 'top-bottom' ) ) {
        echo $divider_bottom;
    }

    echo '</div>'; // container end

} else {
    echo 'Please add columns';
}