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
    $image = null;
	$sticky_logo_width = null;
	
    $sticky_logo = get_field('sticky_logo', 'header');
	$sticky_logo_width = get_field('sticky_logo_width', 'header');
	if ( $sticky_logo_width ) {
		$sticky_logo_width = 'max-width: ' . $sticky_logo_width . 'px;';
	}
    if ( $sticky_logo ) {
        $image = wp_get_attachment_image( $sticky_logo, 'medium' );
    } else {
        $image = wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'medium' );
    }
	?>
	<a href="<?=esc_attr($home_url)?>" class="navbar-brand custom-logo-link" rel="home" aria-current="page" style="<?=$sticky_logo_width?>">
		<?=$image?>
	</a>
	<?php
}
