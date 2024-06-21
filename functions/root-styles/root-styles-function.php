<?php

function global_site_variables(){

// initialize variables
// colors
$primary = null;
$primary_hover = null;

$secondary = null;
$secondary_hover = null;

$success = null;
$success_hover = null;

$info = null;
$info_hover = null;

$danger = null;
$danger_hover = null;

$warning = null;
$warning_hover = null;

$text = null;
$text_hover = null;

$light = null;
$light_hover = null;

$dark = null;
$dark_hover = null;

$gray = null;
$gray_hover = null;

$white = null;
$white_hover = null;

// typography
$base_font_size = '16';
$base_font_weight = '400';
$max_width = null;
$section_padding = null;
$button_border = null;
$border_radius = null;
$button_letter_spacing = null;

// logo
$logo_width = null;
$sticky_logo_width = null;
$logo_width = get_field('logo_width', 'header');
$sticky_logo_width = get_field('sticky_logo_width', 'header');

// main menu style
$main_menu_text_color = null;
$main_menu_text_color = get_field('main_text_color', 'header');
$main_menu_font_family = null;
$main_menu_font_family = get_field('main_menu_font_family', 'header');
$main_menu_font_weight = null;
$main_menu_font_weight = get_field('main_menu_font_weight', 'header');

// colors
$primary = get_field('primary', 'style');
$primary_hover = get_field('primary_hover', 'style');
//$primary_rgb = hexToRgb($primary);

$secondary = get_field('secondary', 'style');
$secondary_hover = get_field('secondary_hover', 'style');

$success = get_field('success', 'style');
$success_hover = get_field('success_hover', 'style');

$info = get_field('info', 'style');
$info_hover = get_field('info_hover', 'style');

$danger = get_field('danger', 'style');
$danger_hover = get_field('danger_hover', 'style');

$warning = get_field('warning', 'style');
$warning_hover = get_field('warning_hover', 'style');

$text = get_field('text', 'style');
$text_hover = get_field('text_hover', 'style');

$light = get_field('light', 'style');
$light_hover = get_field('light_hover', 'style');

$dark = get_field('dark', 'style');
$dark_hover = get_field('dark_hover', 'style');

$gray = get_field('gray', 'style');
$gray_hover = get_field('gray_hover', 'style');

$white = get_field('white', 'style');
$white_hover = get_field('white_hover', 'style');

// typography
$base_font_size = get_field('base_font_size', 'style');
$base_font_weight = get_field('base_font_weight', 'style');
$primary_font = get_field('primary_font', 'style');
$secondary_font = get_field('secondary_font', 'style');
$text_link_color = get_field('text_link_color', 'style');
$text_link_weight = get_field('text_link_weight', 'style');

// containers & columns
$max_width = get_field('max_width', 'style');

// buttons
$button_border = get_field('button_border', 'style');
if ( $button_border == 'radius' ) {
    $border_radius = get_field('border_radius', 'style');
} elseif ( $button_border == 'square' ) {
    $border_radius = '0';
} elseif ( $button_border == 'round' ) {
    $border_radius = '1000';
}


?>


<style>

:root {
/* typography */
--bs-body-font-family: var(--font-primary);
/* colors */
<?php if ( $primary ) { ?>	
--primary: <?=$primary;?>;
<?php } ?>
<?php if ( $primary_hover ) { ?>
--primary_hover: <?=$primary_hover;?>;
<?php } ?>
<?php if ( $secondary ) { ?>
--secondary: <?=$secondary;?>;
<?php } ?>
<?php if ( $secondary_hover ) { ?>
--secondary_hover: <?=$secondary_hover;?>;
<?php } ?>
<?php if ( $success ) { ?>
--success: <?=$success;?>;
<?php } ?>
<?php if ( $success_hover ) { ?>
--success_hover: <?=$success_hover;?>;
<?php } ?>
<?php if ( $info ) { ?>
--info: <?=$info;?>;
<?php } ?>
<?php if ( $info_hover ) { ?>
--info_hover: <?=$info_hover;?>;
<?php } ?>
<?php if ( $danger ) { ?>
--danger: <?=$danger;?>;
<?php } ?>
<?php if ( $danger_hover ) { ?>
--danger_hover: <?=$danger_hover;?>;
<?php } ?>
<?php if ( $warning ) { ?>
--warning: <?=$warning;?>;
<?php } ?>
<?php if ( $warning_hover ) { ?>
--warning_hover: <?=$warning_hover;?>;
<?php } ?>
<?php if ( $text ) { ?>
--text: <?=$text;?>;
<?php } ?>
<?php if ( $text_hover ) { ?>
--text_hover: <?=$text_hover;?>;
<?php } ?>
<?php if ( $light ) { ?>
--light: <?=$light;?>;
<?php } ?>
<?php if ( $light_hover ) { ?>
--light_hover: <?=$light_hover;?>;
<?php } ?>
<?php if ( $dark ) { ?>
--dark: <?=$dark;?>;
<?php } ?>
<?php if ( $dark_hover ) { ?>
--dark_hover: <?=$dark_hover;?>;
<?php } ?>
<?php if ( $gray ) { ?>
--gray: <?=$gray;?>;
<?php } ?>
<?php if ( $gray_hover ) { ?>
--gray_hover: <?=$gray_hover;?>;
<?php } ?>
<?php if ( $white ) { ?>
--white: <?=$white;?>;
<?php } ?>
<?php if ( $white_hover ) { ?>
--white_hover: <?=$white_hover;?>;
<?php } ?>

/* row gap */
<?php
$horizontal_gap = get_field('horizontal_gap', 'style');
if ( $horizontal_gap ) { ?>
--custom-gutter-x: <?=$horizontal_gap?>rem;
<?php }
?>

/* buttons */
<?php

$primary_background = null;
$primary_color = null;
$primary_button = get_field('primary_button', 'style');
if ( $primary_button ) {
    $primary_background = $primary_button['primary_background']['theme_colors'];
    $primary_color = $primary_button['primary_color']['theme_colors'];
}
if ( $primary_background ) {
    echo '--primary_background: var(--' . $primary_background . ');';
    echo "\r\n";
}
if ( $primary_color ) {
    echo '--primary_color: var(--' . $primary_color . ');';
    echo "\r\n";
}

$secondary_background = null;
    $secondary_color = null;
    $secondary_button = get_field('secondary_button', 'style');
    if ( $secondary_button ) {
        $secondary_background = $secondary_button['secondary_background']['theme_colors'];
        $secondary_color = $secondary_button['secondary_color']['theme_colors'];
    }
if ( $secondary_background ) {
    echo '--secondary_background: var(--' . $secondary_background . ');';
    echo "\r\n";
}
if ( $secondary_color ) {
    echo '--secondary_color: var(--' . $secondary_color . ');';
    echo "\r\n";
}

$success_background = null;
$success_color = null;
$success_button = get_field('success_button', 'style');
if ( $success_button ) {
    $success_background = $success_button['success_background']['theme_colors'];
    $success_color = $success_button['success_color']['theme_colors'];
}
if ( $success_background ) {
    echo '--success_background: var(--' . $success_background . ');';
    echo "\r\n";
}
if ( $success_color ) {
    echo '--success_color: var(--' . $success_color . ');';
    echo "\r\n";
}

$info_background = null;
$info_color = null;
$info_button = get_field('info_button', 'style');
if ( $info_button ) {
    $info_background = $info_button['info_background']['theme_colors'];
    $info_color = $info_button['info_color']['theme_colors'];
}
if ( $info_background ) {
    echo '--info_background: var(--' . $info_background . ');';
    echo "\r\n";
}
if ( $info_color ) {
    echo '--info_color: var(--' . $info_color . ');';
    echo "\r\n";
}

$danger_background = null;
$danger_color = null;
$danger_button = get_field('danger_button', 'style');
if ( $danger_button ) {
    $danger_background = $danger_button['danger_background']['theme_colors'];
    $danger_color = $danger_button['danger_color']['theme_colors'];
}
if ( $danger_background ) {
    echo '--danger_background: var(--' . $danger_background . ');';
    echo "\r\n";
}
if ( $danger_color ) {
    echo '--danger_color: var(--' . $danger_color . ');';
    echo "\r\n";
}

$warning_background = null;
$warning_color = null;
$warning_button = get_field('warning_button', 'style');
if ( $warning_button ) {
    $warning_background = $warning_button['warning_background']['theme_colors'];
    $warning_color = $warning_button['warning_color']['theme_colors'];
}
if ( $warning_background ) {
    echo '--warning_background: var(--' . $warning_background . ');';
    echo "\r\n";
}
if ( $warning_color ) {
    echo '--warning_color: var(--' . $warning_color . ');';
    echo "\r\n";
}

$light_background = null;
$light_color = null;
$light_button = get_field('light_button', 'style');
if ( $light_button ) {
    $light_background = $light_button['light_background']['theme_colors'];
    $light_color = $light_button['light_color']['theme_colors'];
}
if ( $light_background ) {
    echo '--light_background: var(--' . $light_background . ');';
    echo "\r\n";
}
if ( $light_color ) {
    echo '--light_color: var(--' . $light_color . ');';
    echo "\r\n";
}

$gray_background = null;
$gray_color = null;
$gray_button = get_field('gray_button', 'style');
if ( $gray_button ) {
    $gray_background = $gray_button['gray_background']['theme_colors'];
    $gray_color = $gray_button['gray_color']['theme_colors'];
}
if ( $gray_background ) {
    echo '--gray_background: var(--' . $gray_background . ');';
    echo "\r\n";
}
if ( $gray_color ) {
    echo '--gray_color: var(--' . $gray_color . ');';
    echo "\r\n";
}

$dark_background = null;
$dark_color = null;
$dark_button = get_field('dark_button', 'style');
if ( $dark_button ) {
    $dark_background = $dark_button['dark_background']['theme_colors'];
    $dark_color = $dark_button['dark_color']['theme_colors'];
}
if ( $dark_background ) {
    echo '--dark_background: var(--' . $dark_background . ');';
    echo "\r\n";
}
if ( $dark_color ) {
    echo '--dark_color: var(--' . $dark_color . ');';
    echo "\r\n";
}

$white_background = null;
$white_color = null;
$white_button = get_field('white_button', 'style');
if ( $white_button ) {
    $white_background = $white_button['white_background']['theme_colors'];
    $white_color = $white_button['white_color']['theme_colors'];
}
if ( $white_background ) {
    echo '--white_background: var(--' . $white_background . ');';
    echo "\r\n";
}
if ( $white_color ) {
    echo '--white_color: var(--' . $white_color . ');';
    echo "\r\n";
}
?>

/* logo */
--logo_width: <?=$logo_width;?>px;
--sticky_logo_width: <?=$sticky_logo_width;?>px;

/* typography */
<?php if ( $base_font_size ) { ?>
--base_font_size: <?=$base_font_size;?>px;
--base_font_size_small: 16px;
<?php } ?>

/* font weight */
<?php if ( $base_font_weight && ( $base_font_weight !== 'default' ) ) { ?>
--bs-body-font-weight: <?=$base_font_weight?>;
<?php } ?>

/* sections */
--max-width: <?=$max_width;?>px;

/* font families */
--font-primary: <?=$primary_font;?>;
--font-secondary: <?=$secondary_font;?>;

/* text link color */
<?php if ( $text_link_color ) { ?>
--bs-link-color: var(--<?=$text_link_color['theme_colors']?>);
--bs-link-hover-color: var(--<?=$text_link_color['theme_colors']?>_hover);
<?php } ?>

/* text link weight */
<?php if ( $text_link_weight && ( $text_link_weight !== 'default' ) ) { ?>
--bs-link-weight: <?=$text_link_weight?>;
<?php } ?>

/* header */
<?php if ( $main_menu_text_color ) { ?>
--main_menu_text_color: var(--<?=$main_menu_text_color['theme_colors']?>);
<?php } ?>

/* buttons */
--button_border-radius: <?=$border_radius;?>px;
<?php
$border_width = get_field('border_width', 'style');
if ( $border_width ) { ?>
--button_border_width: <?=$border_width?>px;
<?php } ?>
<?php
$button_font_weight = get_field('button_font_weight', 'style');
if ( $button_font_weight ) { ?>
--button_font_weight: <?=$button_font_weight?>;
<?php } ?>
<?php
$button_font_family = get_field('button_font_family', 'style');
if ( $button_font_family ) { ?>
--button_font_family: var(--font-<?=$button_font_family?>);
<?php } ?>
<?php
$button_letter_spacing = get_field('button_letter_spacing', 'style');
if ( $button_letter_spacing ) { ?>
--button_letter_spacing: <?=$button_letter_spacing?>px;
<?php } ?>
<?php
/* desktop border radius */
$desktop_radius_1 = get_field('desktop_radius_1', 'style');
if ( $desktop_radius_1 ) {
    echo '--bs-border-radius-sm: ' . $desktop_radius_1 . 'rem;';
    echo "\r\n";
}
$desktop_radius_2 = get_field('desktop_radius_2', 'style');
if ( $desktop_radius_2 ) {
    echo '--bs-border-radius-md: ' . $desktop_radius_2 . 'rem;';
    echo "\r\n";
}
$desktop_radius_3 = get_field('desktop_radius_3', 'style');
if ( $desktop_radius_3 ) {
    echo '--bs-border-radius-lg: ' . $desktop_radius_3 . 'rem;';
    echo "\r\n";
}
$desktop_radius_4 = get_field('desktop_radius_4', 'style');
if ( $desktop_radius_4 ) {
    echo '--bs-border-radius-xl: ' . $desktop_radius_4 . 'rem;';
    echo "\r\n";
}
$desktop_radius_5 = get_field('desktop_radius_5', 'style');
if ( $desktop_radius_5 ) {
    echo '--bs-border-radius-2xl: ' . $desktop_radius_5 . 'rem;';
    echo "\r\n";
}
/* mobile radius */
$mobile_radius_1 = get_field('mobile_radius_1', 'style');
if ( $mobile_radius_1 ) {
    echo '--mobile-border-radius-sm: ' . $mobile_radius_1 . 'rem;';
    echo "\r\n";
}
$mobile_radius_2 = get_field('mobile_radius_2', 'style');
if ( $mobile_radius_2 ) {
    echo '--mobile-border-radius-md: ' . $mobile_radius_2 . 'rem;';
    echo "\r\n";
}
$mobile_radius_3 = get_field('mobile_radius_3', 'style');
if ( $mobile_radius_3 ) {
    echo '--mobile-border-radius-lg: ' . $mobile_radius_3 . 'rem;';
    echo "\r\n";
}
$mobile_radius_4 = get_field('mobile_radius_4', 'style');
if ( $mobile_radius_4 ) {
    echo '--mobile-border-radius-xl: ' . $mobile_radius_4 . 'rem;';
    echo "\r\n";
}
$mobile_radius_5 = get_field('mobile_radius_5', 'style');
if ( $mobile_radius_5 ) {
    echo '--mobile-border-radius-2xl: ' . $mobile_radius_5 . 'rem;';
    echo "\r\n";
}
?>

/* main menu */
<?php
// main menu color

// main font family
if ($main_menu_font_family && ( $main_menu_font_family !== 'default')) {
    echo '--main_menu_font_family: ' . 'var(--font-'. $main_menu_font_family .');';
    echo "\r\n";
}
// main font weight
if ($main_menu_font_weight && ( $main_menu_font_weight !== 'default')) {
    echo '--main_menu_font_weight: '. $main_menu_font_weight .';';
    echo "\r\n";
}

// dividers
$section_dividers = [];
$section_dividers = get_field('section_dividers', 'dividers');
if ( $section_dividers ) {
    foreach ( $section_dividers as $divider ) {
        echo '--divider-'. $divider['shape_class'] .'-height: ' . $divider['height'] . 'px;';
        echo "\r\n";
        echo '--divider-'. $divider['shape_class'] .'-negative-height: -' . $divider['height'] . 'px;';
        echo "\r\n";
    }
}

?>

}

<?php
$section_dividers = [];
$section_dividers = get_field('section_dividers', 'dividers');
if ( $section_dividers ) {
    foreach ( $section_dividers as $divider ) {

        $shape = $divider['shape'];
        $class = $divider['shape_class'];
        $width = $divider['width'];
        $height = $divider['height'];

        $tablet_height = $height / 2;
        $mobile_height = $height / 3;

?>
<?='.'?><?=$class?> .divider-inner {
    mask: url('<?=$shape?>') no-repeat;
    -webkit-mask: url('<?=$shape?>') no-repeat;
    mask-size: <?=$width?>% <?=$height?>%;
    -webkit-mask-size: <?=$width?>% <?=$height?>px;
    width: <?=$width?>%;
    height: <?=$height?>px;
}
<?='.'?><?=$class?>-container-negative-margin-top {
    margin-top: -<?=$height?>px;
}
<?='.'?><?=$class?>-container-negative-margin-top .row {
    margin-top: <?=$height?>px;
}
<?='.'?><?=$class?>-container-negative-margin-bottom {
    margin-bottom: -<?=$height?>px;
}
<?='.'?><?=$class?>-container-negative-margin-bottom .row {
    margin-bottom: <?=$height?>px;
}
@media screen and (max-width: 991px) {
    <?='.'?><?=$class?> .divider-inner {
        mask-size: <?=$width?>% <?=$tablet_height?>% !important;
        -webkit-mask-size: <?=$width?>% <?=$tablet_height?>px !important;
        height: <?=$tablet_height?>px !important;
    }
    <?='.'?><?=$class?>-container-negative-margin-top {
        margin-top: -<?=$tablet_height?>px;
    }
    <?='.'?><?=$class?>-container-negative-margin-top .row {
        margin-top: <?=$tablet_height?>px;
    }
    <?='.'?><?=$class?>-container-negative-margin-bottom {
        margin-bottom: -<?=$tablet_height?>px;
    }
    <?='.'?><?=$class?>-container-negative-margin-bottom .row {
        margin-bottom: <?=$tablet_height?>px;
    }
}
@media screen and (max-width: 768px) {
    <?='.'?><?=$class?> .divider-inner {
        mask-size: <?=$width?>% <?=$mobile_height?>% !important;
        -webkit-mask-size: <?=$width?>% <?=$mobile_height?>px !important;
        height: <?=$mobile_height?>px !important;
    }
    <?='.'?><?=$class?>-container-negative-margin-top {
        margin-top: -<?=$mobile_height?>px;
    }
    <?='.'?><?=$class?>-container-negative-margin-top .row {
        margin-top: <?=$mobile_height?>px;
    }
    <?='.'?><?=$class?>-container-negative-margin-bottom {
        margin-bottom: -<?=$mobile_height?>px;
    }
    <?='.'?><?=$class?>-container-negative-margin-bottom .row {
        margin-bottom: <?=$mobile_height?>px;
    }
}
<?php
    }
}
?>

/* h1 */
<?php $h1 = get_field('h1', 'style'); ?>
.front h1, 
.front .h1,
.edit-post-visual-editor h1:not(.wp-block-post-title),
.edit-post-visual-editor .h1:not(.wp-block-post-title) {
<?php
if ( $h1 ) {
    // family
    if ( $h1['font_family'] ) {
        echo 'font-family: var(--font-' . $h1['font_family'] . ');';
        echo "\r\n";
    }
    // color
    if ( $h1['theme_colors'] ) {
        echo 'color: var(--' . $h1['theme_colors'] . ');';
        echo "\r\n";
    }
    // weight
    if ( $h1['font_weight'] ) {
        echo 'font-weight: ' . $h1['font_weight'] . ';';
        echo "\r\n";
    }
}
?>
}

@media screen and (min-width: 992px) {
    .front h1, 
    .front .h1,
    .edit-post-visual-editor h1:not(.wp-block-post-title),
    .edit-post-visual-editor .h1:not(.wp-block-post-title) {
        <?php
        // size
        if ( $h1['font_size'] ) {
            if ( $h1['font_size']['value'] ) {
                echo 'font-size: ' . $h1['font_size']['value'] . $h1['font_size']['unit'] . ';';
                echo "\r\n";
            }
        }
        ?>
    }
}

/* h2 */
<?php $h2 = get_field('h2', 'style'); ?>
.front h2, 
.front .h2,
.edit-post-visual-editor h2:not(.wp-block-post-title),
.edit-post-visual-editor .h2:not(.wp-block-post-title) {
<?php
if ( $h2 ) {
    // family
    if ( $h2['font_family'] ) {
        echo 'font-family: var(--font-' . $h2['font_family'] . ');';
        echo "\r\n";
    }
    // color
    if ( $h2['theme_colors'] ) {
        echo 'color: var(--' . $h2['theme_colors'] . ');';
        echo "\r\n";
    }
    // weight
    if ( $h2['font_weight'] ) {
        echo 'font-weight: ' . $h2['font_weight'] . ';';
        echo "\r\n";
    }
}
?>
}

@media screen and (min-width: 992px) {
    .front h2, 
    .front .h2,
    .edit-post-visual-editor h2:not(.wp-block-post-title),
    .edit-post-visual-editor .h2:not(.wp-block-post-title) {
        <?php
        // size
        if ( $h2['font_size'] ) {
            if ( $h2['font_size']['value'] ) {
                echo 'font-size: ' . $h2['font_size']['value'] . $h2['font_size']['unit'] . ';';
                echo "\r\n";
            }
        }
        ?>
    }
}

/* h3 */
<?php $h3 = get_field('h3', 'style'); ?>
.front h3, 
.front .h3,
.edit-post-visual-editor h3:not(.wp-block-post-title),
.edit-post-visual-editor .h3:not(.wp-block-post-title) {
<?php
if ( $h3 ) {
    // family
    if ( $h3['font_family'] ) {
        echo 'font-family: var(--font-' . $h3['font_family'] . ');';
        echo "\r\n";
    }
    // color
    if ( $h3['theme_colors'] ) {
        echo 'color: var(--' . $h3['theme_colors'] . ');';
        echo "\r\n";
    }
    // weight
    if ( $h3['font_weight'] ) {
        echo 'font-weight: ' . $h3['font_weight'] . ';';
        echo "\r\n";
    }
}
?>
}

@media screen and (min-width: 992px) {
    .front h3, 
    .front .h3,
    .edit-post-visual-editor h3:not(.wp-block-post-title),
    .edit-post-visual-editor .h3:not(.wp-block-post-title) {
        <?php
        // size
        if ( $h3['font_size'] ) {
            if ( $h3['font_size']['value'] ) {
                echo 'font-size: ' . $h3['font_size']['value'] . $h3['font_size']['unit'] . ';';
                echo "\r\n";
            }
        }
        ?>
    }
}

/* h4 */
<?php $h4 = get_field('h4', 'style'); ?>
.front h4, 
.front .h4,
.edit-post-visual-editor h4:not(.wp-block-post-title),
.edit-post-visual-editor .h4:not(.wp-block-post-title) {
<?php
if ( $h4 ) {
    // family
    if ( $h4['font_family'] ) {
        echo 'font-family: var(--font-' . $h4['font_family'] . ');';
        echo "\r\n";
    }
    // color
    if ( $h4['theme_colors'] ) {
        echo 'color: var(--' . $h4['theme_colors'] . ');';
        echo "\r\n";
    }
    // weight
    if ( $h4['font_weight'] ) {
        echo 'font-weight: ' . $h4['font_weight'] . ';';
        echo "\r\n";
    }
}
?>
}

@media screen and (min-width: 992px) {
    .front h4, 
    .front .h4,
    .edit-post-visual-editor h4:not(.wp-block-post-title),
    .edit-post-visual-editor .h4:not(.wp-block-post-title) {
        <?php
        // size
        if ( $h4['font_size'] ) {
            if ( $h4['font_size']['value'] ) {
                echo 'font-size: ' . $h4['font_size']['value'] . $h4['font_size']['unit'] . ';';
                echo "\r\n";
            }
        }
        ?>
    }
}

/* h5 */
<?php $h5 = get_field('h5', 'style'); ?>
.front h5, 
.front .h5,
.edit-post-visual-editor h5:not(.wp-block-post-title),
.edit-post-visual-editor .h5:not(.wp-block-post-title) {
<?php
if ( $h5 ) {
    // family
    if ( $h5['font_family'] ) {
        echo 'font-family: var(--font-' . $h5['font_family'] . ');';
        echo "\r\n";
    }
    // color
    if ( $h5['theme_colors'] ) {
        echo 'color: var(--' . $h5['theme_colors'] . ');';
        echo "\r\n";
    }
    // weight
    if ( $h5['font_weight'] ) {
        echo 'font-weight: ' . $h5['font_weight'] . ';';
        echo "\r\n";
    }
}
?>
}

@media screen and (min-width: 992px) {
    .front h5, 
    .front .h5,
    .edit-post-visual-editor h5:not(.wp-block-post-title),
    .edit-post-visual-editor .h5:not(.wp-block-post-title) {
        <?php
        // size
        if ( $h5['font_size'] ) {
            if ( $h5['font_size']['value'] ) {
                echo 'font-size: ' . $h5['font_size']['value'] . $h5['font_size']['unit'] . ';';
                echo "\r\n";
            }
        }
        ?>
    }
}

/* h6 */
<?php $h6 = get_field('h6', 'style'); ?>
.front h6, 
.front .h6,
.edit-post-visual-editor h6:not(.wp-block-post-title),
.edit-post-visual-editor .h6:not(.wp-block-post-title) {
<?php
if ( $h6 ) {
    // family
    if ( $h6['font_family'] ) {
        echo 'font-family: var(--font-' . $h6['font_family'] . ');';
        echo "\r\n";
    }
    // color
    if ( $h6['theme_colors'] ) {
        echo 'color: var(--' . $h6['theme_colors'] . ');';
        echo "\r\n";
    }
    // weight
    if ( $h6['font_weight'] ) {
        echo 'font-weight: ' . $h6['font_weight'] . ';';
        echo "\r\n";
    }
}
?>
}

@media screen and (min-width: 992px) {
    .front h6, 
    .front .h6,
    .edit-post-visual-editor h6:not(.wp-block-post-title),
    .edit-post-visual-editor .h6:not(.wp-block-post-title) {
        <?php
        // size
        if ( $h6['font_size'] ) {
            if ( $h6['font_size']['value'] ) {
                echo 'font-size: ' . $h6['font_size']['value'] . $h6['font_size']['unit'] . ';';
                echo "\r\n";
            }
        }
        ?>
    }
}

<?php
$theme_css = get_field('theme_css', 'css');
if ( $theme_css ) {
echo $theme_css;
}
echo "\r\n";
?>

/** admin **/
/* backgrounds */
:root {
    .editor-styles-wrapper .bg-primary {
        background-color: var(--primary) !important;
    }
    .editor-styles-wrapper .bg-secondary {
        background-color: var(--secondary) !important;
    }
    .editor-styles-wrapper .bg-success {
        background-color: var(--success) !important;
    }
    .editor-styles-wrapper .bg-info {
        background-color: var(--info) !important;
    }
    .editor-styles-wrapper .bg-danger {
        background-color: var(--danger) !important;
    }
    .editor-styles-wrapper .bg-warning {
        background-color: var(--warning) !important;
    }
    .editor-styles-wrapper .bg-light {
        background-color: var(--light) !important;
    }
    .editor-styles-wrapper .bg-dark {
        background-color: var(--dark) !important;
    }
    .editor-styles-wrapper .bg-gray {
        background-color: var(--gray) !important;
    }
    .editor-styles-wrapper .bg-white {
        background-color: var(--white) !important;
    }
    /* text */
    .editor-styles-wrapper .text-primary {
        color: var(--primary) !important;
    }
    .editor-styles-wrapper .text-secondary {
        color: var(--secondary) !important;
    }
    .editor-styles-wrapper .text-info {
        color: var(--info) !important;
    }
    .editor-styles-wrapper .text-danger {
        color: var(--danger) !important;
    }
    .editor-styles-wrapper .text-warning {
        color: var(--warning) !important;
    }
    .editor-styles-wrapper .text-light {
        color: var(--light) !important;
    }
    .editor-styles-wrapper .text-dark {
        color: var(--dark) !important;
    }
    .editor-styles-wrapper .text-gray {
        color: var(--gray) !important;
    }
    .editor-styles-wrapper .text-white {
        color: var(--white) !important;
    }
}

</style>
    
<?php

}