<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 * @since 1.1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$header_style = get_field('header_style', 'header');

// initialize classes and styles
$wrapper_classes = [];
$container_classes = [];
$wrapper_styles = [];

$wrapper_classes[] = 'menu-' . $header_style;

$header_width = get_field('header_width', 'header');
if ( $header_width ) {
	$container_classes[] = $header_width;
} else {
	$container_classes[] = get_theme_mod( 'understrap_container_type' );
}

$wrapper_classes[] = 'navbar';
if ( $header_style === 'toggle' ) {
    $wrapper_classes[] = 'navbar-expand-*';
} else {
    $wrapper_classes[] = 'navbar-expand-lg';
}

$menu_contrast_colors = get_field('menu_contrast_colors', 'header');
if ( $menu_contrast_colors && ( $menu_contrast_colors !== 'default' ) ) {
    $wrapper_classes[] = 'navbar-' . $menu_contrast_colors;
}

$main_background_color = get_field('main_background_color', 'header');
if ( $main_background_color ) {
    $wrapper_classes[] = 'bg-' . $main_background_color['theme_colors'];
}

$show_dropdown_indicators = get_field('show_dropdown_indicators', 'header');
if ( $show_dropdown_indicators == 'hide' ) {
	$container_classes[] = 'hide-dropdown-arrows';
}

// padding
$menu_padding = null;
if ( function_exists('get_menu_padding_bbc') ) {
    $menu_padding = get_menu_padding_bbc(get_field('main_menu_padding_updated', 'header'), $wrapper_classes, $wrapper_styles);

    if ( $menu_padding['classes'] ) {
        $wrapper_classes = $menu_padding['classes'];
    }
    if ( $menu_padding['styles'] ) {
        $wrapper_styles = $menu_padding['styles'];
    }
}

// gap
$gap = ' gap-1';
$cta_buttons = get_field('cta_buttons', 'header');
if ( $cta_buttons && ( ( $header_style === 'centered' ) || ( $header_style === 'toggle' ) ) ) {
    $gap = ' gap-' . $cta_buttons['space_between'];
}

$wrapper_classes = esc_attr( trim( implode(' ', $wrapper_classes ) ) );
$wrapper_styles = esc_attr( trim( implode(' ', $wrapper_styles ) ) );
$container_classes = esc_attr( trim( implode(' ', $container_classes ) ) );

?>

<nav id="main-nav" class="<?=$wrapper_classes?>" aria-labelledby="main-nav-label" style="<?=$wrapper_styles?>">

	<div id="main-nav-label" class="screen-reader-text">
		<?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
	</div>

	<div class="<?php echo esc_attr( $container_classes ); ?>">

        <?php get_template_part( 'global-templates/navbar-branding' ); ?>

    <?php if ( $header_style !== 'centered' ) { ?>
        <div class="menu-buttons-container<?=$gap?>"><!-- menu and buttons container start -->
    <?php } ?>
    
            <div class="menu-container"><!-- menu start -->

                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#navbarNavOffcanvas"
                    aria-controls="navbarNavOffcanvas"
                    aria-expanded="false"
                    aria-label="<?php esc_attr_e( 'Open menu', 'understrap' ); ?>"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarNavOffcanvas"><!-- offcanvas menu start -->

                    <div class="offcanvas-header justify-content-end">
                        <button
                            class="btn-close btn-close-text text-reset"
                            type="button"
                            data-bs-dismiss="offcanvas"
                            aria-label="<?php esc_attr_e( 'Close menu', 'understrap' ); ?>"
                        ></button>
                    </div><!-- .offcancas-header -->

                    <!-- The WordPress Menu goes here -->
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location'  => 'primary',
                            'container_class' => 'offcanvas-body',
                            'container_id'    => '',
                            'menu_class'      => 'navbar-nav',
                            'fallback_cb'     => '',
                            'menu_id'         => 'main-menu',
                            'depth'           => 2,
                            'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                        )
                    );
                    ?>
                </div><!-- offcanvas menu end -->

            </div><!-- menu end -->

            <?php
            // cta buttons start
            if ( $cta_buttons && ( ( $header_style === 'centered' ) || ( $header_style === 'toggle' ) ) ) {
                echo '<div class="buttons-container">';
                    if ( function_exists('get_buttons_bbc') ) {
                        echo get_buttons_bbc($cta_buttons);
                    }
                echo '</div>';
            } // cta buttons end
            ?>

    <?php if ( $header_style !== 'centered' ) { ?>        
        </div><!-- menu and buttons container end -->
    <?php } ?>

	</div><!-- .container(-fluid) -->

</nav><!-- #main-nav -->