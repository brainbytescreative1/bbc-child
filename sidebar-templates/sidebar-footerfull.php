<?php
/**
 * Sidebar setup for footer full
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

?>

<?php if ( is_active_sidebar( 'footerfull' ) || is_active_sidebar( 'reviews' ) ) : ?>

	<!-- ******************* The Footer Full-width Widget Area ******************* -->

	<footer class="wrapper-footer-full" id="wrapper-footer-full" role="complementary">

        <div class="<?php echo esc_attr( $container ); ?>" id="footer-reviews-content" tabindex="-1">

            <div class="row">

                <?php dynamic_sidebar( 'reviews' ); ?>

            </div>

        </div>
    
        <div class="<?php echo esc_attr( $container ); ?>" id="footer-full-content" tabindex="-1">

			<div class="row">

                <?php dynamic_sidebar( 'footerfull' ); ?>

			</div>

		</div>

	</footer><!-- #wrapper-footer-full -->

	<?php
endif;
