<?php
/**
 * Navbar branding
 *
 * @package Understrap
 * @since 1.2.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! has_custom_logo() ) { ?>

	<?php if ( is_front_page() && is_home() ) : ?>

		<h1 class="navbar-brand mb-0">
			<a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url">
				<?php bloginfo( 'name' ); ?>
			</a>
		</h1>

	<?php else : ?>

		<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" itemprop="url">
			<?php bloginfo( 'name' ); ?>
		</a>

	<?php endif; ?>

	<?php
} else {
	//the_custom_logo();
	$home_url = get_home_url();
    $logo_size = get_field('logo_size', 'header');
	$image = wp_get_attachment_image( get_theme_mod( 'custom_logo' ), $logo_size );
	?>
	<a href="<?=esc_attr($home_url)?>" class="navbar-brand custom-logo-link" rel="home" aria-current="page">
		<?=$image?>
	</a>
	<?php
}
