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

// define null values
$flex = null;

// define overlay
$container_overlay = null;
$row_overlay = null;
$row_mobile_overlay = null;
$container_overlay = null;
$container_video = null;
$container_mobile_image_overlay = null;

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
    //$container_classes[] = 'alignfull';
    //$row_classes[] = 'wp-block-cover__inner-container';
} else {
    //$container_classes[] = 'alignfull';
}

$container_classes[] = 'element-container';

// get global style settings
$column_gap_global = get_field('column_gap', 'style');
if ( $column_gap_global && ( $column_gap_global === 'default' ) ) {
    $top_bottom_padding_container = get_field('top_bottom_padding_container', 'style');
    if ( $top_bottom_padding_container ) {
        $column_gap_global = $top_bottom_padding_container;
    } else {
        $column_gap_global = '3';
    }
} else {
    $column_gap_global = '3';
}

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

$content_alignment = get_field('content_alignment');
if ( $content_alignment ) {
    if ( $content_alignment === 'left' ) {
        $content_alignment = 'start';
    } elseif ( $content_alignment === 'center' ) {
        $content_alignment = 'center';
    } elseif ( $content_alignment === 'right' ) {
        $content_alignment = 'end';
    }
    $row_classes[] = 'text-' . $content_alignment;
}

// column options
$columns_per_row = get_field('columns_per_row');
$mobile_breakpoint = get_field('mobile_breakpoint');
$element_assignment = get_field('element_assignment');

// get global style settings
$column_gap_global = null;
$column_gap_global = get_field('column_gap', 'style');
if ( $column_gap_global && ( $column_gap_global === 'default' ) ) {
    $column_gap_global = '2';
}
/*
if ( $column_gap_global && ( $column_gap_global === 'default' ) ) {
    $top_bottom_padding_container = get_field('top_bottom_padding_container', 'style');
    if ( $top_bottom_padding_container ) {
        $column_gap_global = $top_bottom_padding_container;
    } else {
        $column_gap_global = '3';
    }
} else {
    $column_gap_global = '3';
}
*/

// column gap
$column_margin_bottom = null;
if ( $column_count > 1 ) {
    $column_gap = get_field('column_gap');
    if ( $column_gap && ( $column_gap === 'default' ) ) {
        $column_gap = $column_gap_global;
    }
    $column_margin_bottom = 'mb-'. $column_gap .' mb-lg-0';
}

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
    if ( $container_background['mobile_image_overlay'] ) {
        $container_mobile_image_overlay = $container_background['mobile_image_overlay'];
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
    if ( $row_background['mobile_image_overlay'] ) {
        $row_mobile_overlay = $row_background['mobile_image_overlay'];
    }
}

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
if ( $reverse_columns && ( $reverse_columns === 'reverse' ) ) {
    $row_classes[] = 'flex-lg-row';
    $row_classes[] = 'flex-column-reverse';
}

// row advanced
$row_additional_classes = get_field('row_additional_classes');
if ( $row_additional_classes ) {
    $row_classes[] = $row_additional_classes;
}

// dividers



// flex
$flex_element = get_field('flex_element');
if ( $flex_element != 'none' ) {
    $flex = get_flex_bbc(get_field('flex'));
    if ( $flex_element == 'row' ) {
        $row_classes[] = $flex;
    } elseif ( $flex_element == 'container' ) {
        $container_classes[] = $flex;
    }
}

// add number of columns to row
$column_count = get_field('columns');
if ( $column_count ) {
    $column_count = count($column_count); // get total number of columns
} else {
    $column_count = 0;
}
$row_classes[] = 'columns-' . $column_count;

// process global functions
$container_classes[] = get_spacing_bbc(get_field('container_spacing'), 'container');
$container_classes[] = get_borders_bbc(get_field('container_borders'));
$row_classes[] = get_spacing_bbc(get_field('row_spacing'));

// dividers
$top_divider = get_field('top_divider');
if ( $top_divider === 'enable' ) {
    $container_classes[] = 'container-divider-top';
    $top_divider_shape = get_field('top_divider_shape');
    if ( $top_divider_shape !== 'none' ) {
        $container_classes[] = $top_divider_shape;
    }

    $top_negative_margin = get_field('top_negative_margin');
    if ( $top_negative_margin === 'yes' ) {
        $container_classes[] = $top_divider_shape . '-container-negative-margin-top';
    }
}
$bottom_divider = get_field('bottom_divider');
if ( $bottom_divider === 'enable' ) {
    $container_classes[] = 'container-divider-bottom';
    $bottom_divider_shape = get_field('bottom_divider_shape');
    if ( $bottom_divider_shape !== 'none' ) {
        $container_classes[] = $bottom_divider_shape;
    }

    $bottom_negative_margin = get_field('bottom_negative_margin');
    if ( $bottom_negative_margin === 'yes' ) {
        $container_classes[] = $bottom_divider_shape . '-container-negative-margin-bottom';
    }
}

// process classes and styles
$container_classes = trim(implode(' ', $container_classes));
$row_classes = trim(implode(' ', $row_classes));

$container_styles = implode(' ', $container_styles);
$row_styles = implode(' ', $row_styles);

if ( get_field('columns') && ( $column_count > 0 ) ) {

$column_number = 1; // start number columns

$wrapper_classes = [];
$wrapper_classes[] = 'container-wrapper';
$wrapper_classes[] = get_field('section_wrapper_classes');
$wrapper_classes = trim(implode(' ', $wrapper_classes));

echo '<section class="'. esc_attr($wrapper_classes) .'">'; // section start

    // top divider
    $top_divider = get_field('top_divider');
    if ( $top_divider === 'enable' ) {

        echo get_dividers_bbc('top');

    }

    echo '<div class="'. esc_attr($container_classes) . esc_attr($class_name) .'" style="'. esc_attr($container_styles) .'"'. $custom_id .' data-id="'. $data_id .'">'; // container start

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

        if ( $container_mobile_image_overlay ) {
            echo $container_mobile_image_overlay;
        }

        if ( $container_overlay ) {
            echo $container_overlay;
        }

        $masonry = get_field('masonry');

        ?>
        <div class="<?=esc_attr($row_classes)?>"<?php if ( $masonry === 'enabled' ) { ?> data-masonry='{"percentPosition": true }' <?php } ?> style="<?=esc_attr($row_styles)?>">
        <?

            if ( $row_mobile_overlay ) {
                echo $row_mobile_overlay;
            }
            if ( $row_overlay ) {
                echo $row_overlay;
            }

            // start inner row if max width
            //$max_width = [];
            $max_width = get_field('max_width');

            if ( $max_width ) {
                $value = $max_width['value'];
                if ( $value ) {

                    $justify_container_row = get_field('justify_container_row');

                    $row_inner_classes = [];
                    $row_inner_styles = [];

                    $row_inner_classes[] = 'row-inner';

                    $unit = $max_width['unit'];
                    $max_width = 'max-width: ' . $value . $unit;
                    $row_inner_styles[] = $max_width . ';';

                    if ( $justify_container_row ) {
                        if ( $justify_container_row === 'left' ) {
                            $row_inner_classes[] = 'me-' . $mobile_breakpoint . '-auto ms-' . $mobile_breakpoint . '-0';
                        } elseif ( $justify_container_row === 'center' ) {
                            $row_inner_classes[] = 'me-' . $mobile_breakpoint . '-auto ms-' . $mobile_breakpoint . '-auto';
                        } elseif ( $justify_container_row === 'right' ) {
                            $row_inner_classes[] = 'ms-' . $mobile_breakpoint . '-auto me-' . $mobile_breakpoint . '-0';
                        }
                    } else {
                        $row_inner_classes[] = 'me-' . $mobile_breakpoint . '-auto ms-' . $mobile_breakpoint . '-auto';
                    }

                    $row_inner_classes[] = $flex;

                    $row_inner_classes = trim(implode(' ', $row_inner_classes));
                    $row_inner_styles = trim(implode(' ', $row_inner_styles));

                    echo '<div class="'. $row_inner_classes .'" style="'. $row_inner_styles .'">';
                }
            }

            if( have_rows('columns') ): // if columns start

                while( have_rows('columns') ) : the_row(); // columns loop start

                    // define column attribute arrays
                    $col_classes = [];
                    $col_inner_classes = [];
                    $column_inner_content_classes = [];
                    $col_styles = [];
                    $col_inner_styles = [];
                    $col_inner_content_styles = [];

                    $column_overlay = null;
                    $column_inner_overlay = null;
                    $column_video = null;
                    $column_inner_video = null;
                    $mobile_image_overlay = null;
                    $column_mobile_overlay = null;
                    $column_inner_mobile_overlay = null;

                    // add initial column classes
                    $col_classes[] = 'col-element';
                    $col_classes[] = 'column-' . $column_number;
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

                    // custom column max width
                    $column_max_width_enable = get_sub_field('column_max_width_enable');
                    if ( $column_max_width_enable && ( $column_max_width_enable === 'enable' ) ) {
                        $column_max_width_value = get_sub_field('column_max_width_value');
                        if ( $column_max_width_value ) {
                            
                            $column_max_width_unit = get_sub_field('column_max_width_unit');

                            // alignment
                            $column_max_width_alignment = get_sub_field('column_max_width_alignment');
                            if ( $column_max_width_alignment === 'left' ) {
                                $column_max_width_alignment = 'ms-0 me-auto';
                            } elseif ( $column_max_width_alignment === 'center' ) {
                                $column_max_width_alignment = 'ms-auto me-auto';
                            } elseif ( $column_max_width_alignment === 'right' ) {
                                $column_max_width_alignment = 'ms-auto me-0';
                            }

                            // assignment
                            $column_max_width_assignment = get_sub_field('column_max_width_assignment');
                            if ( $column_max_width_assignment === 'col-inner' ) {
                                $col_inner_classes[] = $column_max_width_alignment;
                                $col_inner_styles[] = 'max-width: ' . $column_max_width_value . $column_max_width_unit;
                            } elseif ( $column_max_width_assignment === 'col-inner' ) {
                                $column_inner_content_classes[] = $column_max_width_alignment;
                                $col_inner_content_styles[] = 'max-width: ' . $column_max_width_value . $column_max_width_unit;
                            }
                            
                        }
                    }
                    

                    // column width
                    /*
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
                    */

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

                        if ( $element_assignment === 'outer') {
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
                            if ( $column_background['mobile_image_overlay'] ) {
                                $column_mobile_overlay = $column_background['mobile_image_overlay'];
                            }
                        } elseif ( $element_assignment === 'inner') {
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
                            if ( $column_background['mobile_image_overlay'] ) {
                                $column_inner_mobile_overlay = $column_background['mobile_image_overlay'];
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

                    // add default column spacing
                    $default_column_top_bottom_padding = get_sub_field('default_column_top_bottom_padding');
                    if ( $default_column_top_bottom_padding && ( $default_column_top_bottom_padding === 'add' ) ) {

                        // get fields from global styles
                        $top_bottom_padding_column = get_field('top_bottom_padding_column', 'style');
                        $top_bottom_padding_column_mobile = get_field('top_bottom_padding_column_mobile', 'style');

                        // assign values if global styles empty
                        if ( !$top_bottom_padding_column ) {
                            $top_bottom_padding_column = '2';
                        }
                        if ( !$top_bottom_padding_column_mobile ) {
                            $top_bottom_padding_column_mobile = '2';
                        }

                        // assign spacing to column assignment element
                        if ( $element_assignment === 'inner') {
                            $col_inner_classes[] = 'py-' . $mobile_breakpoint . '-' . $top_bottom_padding_column;
                            $col_inner_classes[] = 'py-' . $top_bottom_padding_column_mobile;
                        } elseif ( $element_assignment === 'outer') {
                            $col_classes[] = 'py-' . $mobile_breakpoint . '-' . $top_bottom_padding_column;
                            $col_classes[] = 'py-' . $top_bottom_padding_column_mobile;
                        }

                    }
                    $default_column_left_right_padding = get_sub_field('default_column_left_right_padding');
                    if ( $default_column_top_bottom_padding && ( $default_column_top_bottom_padding === 'add' ) ) {

                        // get fields from global styles
                        $left_right_padding_column = get_field('left_right_padding_column', 'style');
                        $left_right_padding_column_mobile = get_field('left_right_padding_column_mobile', 'style');

                        // assign values if global styles empty
                        if ( !$left_right_padding_column ) {
                            $left_right_padding_column = '2';
                        }
                        if ( !$left_right_padding_column_mobile ) {
                            $left_right_padding_column_mobile = '2';
                        }

                        // assign spacing to column assignment element
                        if ( $element_assignment === 'inner') {
                            $col_inner_classes[] = 'px-' . $mobile_breakpoint . '-' . $left_right_padding_column;
                            $col_inner_classes[] = 'px-' . $left_right_padding_column_mobile;
                        } elseif ( $element_assignment === 'outer') {
                            $col_classes[] = 'px-' . $mobile_breakpoint . '-' . $left_right_padding_column;
                            $col_classes[] = 'px-' . $left_right_padding_column_mobile;
                        }

                    }

                    // custom spacing
                    $col_spacing = null;
                    $col_spacing = get_spacing_bbc(get_sub_field('column_spacing'), 'column');

                    // add margin
                    $col_classes[] = $column_margin_bottom;

                    // borders
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

                    // additional classes and id
                    $additional_classes = get_sub_field('additional_classes');
                    if ( $additional_classes ) {
                        $col_classes[] = $additional_classes;
                    }
                    
                    // procces column classes
                    $col_classes = trim(implode(' ', $col_classes));
                    $col_inner_classes = trim(implode(' ', $col_inner_classes));
                    $column_inner_content_classes = trim(implode(' ', $column_inner_content_classes));
                    $col_styles = trim(implode(' ', $col_styles));
                    $col_inner_styles = trim(implode(' ', $col_inner_styles));
                    $col_inner_content_styles = trim(implode(' ', $col_inner_content_styles));

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
                        
                        if ( $column_mobile_overlay ) {
                            echo $column_mobile_overlay;
                        }
                        if ( $column_video ) {
                            echo $column_video;
                        }
                        if ( $column_overlay ) {
                            echo $column_overlay;
                        }

                        echo '<div class="'. esc_attr($col_inner_classes) .'" style="'. esc_attr($col_inner_styles) .'">'; // column inner start
    
                            if ( $column_inner_mobile_overlay ) {
                                echo $column_inner_mobile_overlay;
                            }
                            if ( $column_inner_video ) {
                                echo $column_inner_video;
                            }
                            if ( $column_inner_overlay ) {
                                echo $column_inner_overlay;
                            }

                            echo '<div class="'. esc_attr($column_inner_content_classes) .'" style="'. esc_attr($col_inner_content_styles) .'">'; // column inner content start

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
                                    include( __DIR__ . '../../../elements/modal.php');

                                endwhile; // elements loop end

                            endif; // if elements end

                            echo '</div>'; // column inner content end

                        echo '</div>'; // column inner end

                    echo '</div>'; // column end

                    $column_number++; // end numbering columns

                endwhile; // columns loop end

            endif; // if columns end

            // start inner row if justifed
            $max_width = [
                'value' => '',
                'unit' => ''
            ];
            $max_width = get_field('max_width');
            if ( $max_width ) {
                $value = $max_width['value'];
                if ( $value ) {
                    echo '</div>';
                }
            }

        echo '</div>'; // row end

    echo '</div>'; // container end

    // bottom divider
    $bottom_divider = get_field('bottom_divider');
    if ( $bottom_divider === 'enable' ) {

        echo get_dividers_bbc('bottom');

    }

echo '</section>'; // section end

} else {
    echo 'Please add columns';
}