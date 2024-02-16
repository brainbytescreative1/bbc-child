<?php
if ( ! is_page_template( 'page-templates/no-title.php' ) ) {

    // define attribute arrays
    $container_classes = [];
    $row_classes = [];
    $title_classes = [];

    $container_styles = [];
    $row_styles = [];
    $title_styles = [];

    $overlay = null;
    $video = null;

    $container_classes[] = 'page-title';

    // get global post options
    $content_alignment = get_field('content_alignment', 'post-settings');
    $text_color = get_field('text_theme_colors', 'post-settings');
    $background_color = get_field('background_theme_colors', 'post-settings');
    $max_width = get_field('max_width', 'post-settings');
    $min_height = get_field('min_height', 'post-settings');

    // get single post options
    $title = get_the_title();
    $title_override = get_field('title_override');
    if ( $title_override ) {
        $title = $title_override;
    }

    // process global post settings
    if ( $min_height ) {
        $container_styles[] = 'min-height: ' . $min_height['value'] . $min_height['unit'] . ';';
    }
    /*
    if ( $max_width ) {
        $row_styles[] = 'max-width: ' . $max_width['value'] . $max_width['unit'] . ';';
    }
    */

    // below title content
    $add_title_content = get_field('add_title_content');
    if ( $add_title_content ) {
        $text = get_field('text');
        $remove_margin_from_last_paragraph = get_field('remove_margin_from_last_paragraph');
        $alignment = get_field('alignment');
        $color = get_field('theme_colors');
    }

    // add classes
    if ( $background_color ) {
        $container_classes[] = 'bg-' . $background_color;
    }
    if ( $content_alignment ) {
        $row_classes[] = 'align-' . $content_alignment;                     
    }
    if ( $text_color ) {
        $title_classes[] = 'text-' . $text_color;
    }

    $background = get_background_bbc('background', $container_classes, $container_styles);
    if ( $background ) {
        if ( $background['classes'] ) {
            $container_classes[] = $background['classes'];
        }
        if ( $background['styles'] ) {
            $container_styles[] = $background['styles'];
        }
        if ( $background['overlay'] ) {
            $overlay = $background['overlay'];
        }
        if ( $background['video'] ) {
            $video = $background['video'];
        }
    }

    // width / height
    $width_height = get_field('width_height');
    if ( $width_height ) {

        // max-width
        $max_width = $width_height['max_width'];
        if ( $max_width && $max_width['value'] ) {
            $row_styles[] = 'max-width: ' . $max_width['value'] . $max_width['unit'] . ';';
        }

        // min-height
        $min_height = $width_height['min_height'];
        if ( $min_height && $min_height['value'] ) {
            $container_styles[] = 'min-height: ' . $min_height['value'] . $min_height['unit'] . ';';
        }
    }

    // spacing
    $container_classes[] = get_spacing_bbc(get_field('container_spacing'), 'container');

    // additional classes
    $container_classes[] = trim(get_field('header_additional_classes'));

    // convert arrays to strings
    $container_classes = implode(' ', $container_classes);
    $row_classes = implode(' ', $row_classes);
    $title_classes = implode(' ', $title_classes);

    $container_styles = implode(' ', $container_styles);
    $row_styles = implode(' ', $row_styles);
    $title_styles = implode(' ', $title_styles);

    ?>

    <div class="container post-title wp-block-cover alignfull element-container <?=$container_classes;?>" style="<?=$container_styles?>">

        <?php
        if ( $overlay ) {
            echo $overlay;
        }
        if ( $video ) {
            echo $video;
        }
        ?>

        <div class="row wp-block-cover__inner-container <?=$row_classes;?>" style="<?=$row_styles?>">
            <h1 class="<?=$title_classes?>" style="<?=$title_styles?>"><?=$title?></h1>
            <?php

            // content
            $title_content = get_field('title_content');
            $text_styles = get_field('text_styles');
            
            // style
            $text_classes = [];
            $text_styles = [];

            /*
            $title_content_data = get_heading_style_bbc('title_content', $text_classes, $text_styles, false);
            if ( $title_content_data['classes'] ) {
                $text_classes[] = $title_content_data['classes'];
            }
            */

            $text_classes = implode(' ', $text_classes);

            if ( $title_content['text'] ) {

                ?>
                <div class="element <?=$text_classes;?>">
                    <?=$title_content['text']?>
                </div>
                <?php

            }

            // buttons
            echo get_buttons_bbc(get_field('title_buttons'));

            ?>
        </div>
    </div>
<?php }	?>