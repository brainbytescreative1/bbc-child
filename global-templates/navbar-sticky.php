<?php
/**
 * Header Navbar (bootstrap5)
 *
 * @package Understrap
 * @since 1.1.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// container width
$wrapper_classes = [];
$container_classes = [];

$wrapper_classes[] = 'navbar';
$wrapper_classes[] = 'navbar-expand-lg';

$menu_contrast_colors = get_field('menu_contrast_colors', 'header');
if ( $menu_contrast_colors ) {
    $wrapper_classes[] = 'navbar-' . $menu_contrast_colors;
}

$main_text_color = get_field('main_text_color', 'header');
if ( $main_text_color ) {
    $wrapper_classes[] = 'text-' . $main_text_color['theme_colors'];
}

$main_background_color = get_field('main_background_color', 'header');
if ( $main_background_color ) {
    $wrapper_classes[] = 'bg-' . $main_background_color['theme_colors'];
}

$main_menu_width = get_field('main_menu_width', 'header');
if ( $main_menu_width ) {
	$container_classes[] = $main_menu_width;
	$container_classes[] = 'container';
} else {
	$container_classes[] = get_theme_mod( 'understrap_container_type' );
	$container_classes[] = 'container';
}

$show_dropdown_indicators = get_field('show_dropdown_indicators', 'header');
if ( $show_dropdown_indicators == 'hide' ) {
	$container_classes[] = 'hide-dropdown-arrows';
}

$header_style = get_field('header_style', 'header');

$wrapper_classes = esc_attr( trim( implode(' ', $wrapper_classes ) ) );
$container_classes = esc_attr( trim( implode(' ', $container_classes ) ) );

?>

<nav id="main-nav-sticky" class="<?=$wrapper_classes?>" aria-labelledby="main-nav-label">

	<div id="main-nav-label" class="screen-reader-text">
		<?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
	</div>

	<div class="<?php echo esc_attr( $container_classes ); ?>">

		<?php 
		if ( $header_style === 'centered' ) { ?>

			<div class="col-lg-2 col-4 centered-logo">

				<!-- Your site branding in the menu -->
				<?php get_template_part( 'global-templates/navbar-branding-sticky' ); ?>

			</div>

			<div class="col-lg-8 centered-menu">

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

				<div class="offcanvas offcanvas-end <?=$menu_contrast_colors?>" tabindex="-1" id="navbarNavOffcanvas">

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
							'menu_class'      => 'navbar-nav justify-content-center flex-grow-1',
							'fallback_cb'     => '',
							'menu_id'         => 'main-menu',
							'depth'           => 2,
							'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
						)
					);
					?>
				</div><!-- .offcanvas -->

			</div>

			<?php
			$cta_buttons = get_field('cta_buttons', 'header');
			if ( $cta_buttons ) {
				echo '<div class="col-2 centered-cta">';
					echo get_buttons_bbc($cta_buttons);
				echo '</div>';
			}
			?>
			

		<?php } else { ?>

			<!-- Your site branding in the menu -->
			<?php get_template_part( 'global-templates/navbar-branding-sticky' ); ?>

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

			<div class="offcanvas offcanvas-end <?=$menu_contrast_colors?>" tabindex="-1" id="navbarNavOffcanvas">

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
						'menu_class'      => 'navbar-nav justify-content-end flex-grow-1',
						'fallback_cb'     => '',
						'menu_id'         => 'main-menu',
						'depth'           => 2,
						'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
					)
				);
				?>
			</div><!-- .offcanvas -->

		<?php } ?>

	</div><!-- .container(-fluid) -->

</nav><!-- #main-nav -->

