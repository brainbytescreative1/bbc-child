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

<?php if ( is_active_sidebar( 'footerfull' ) ) : ?>

	<!-- ******************* The Footer Full-width Widget Area ******************* -->

	<footer class="wrapper-footer-full" id="wrapper-footer-full" role="complementary">

		<div class="<?php echo esc_attr( $container ); ?>" id="footer-full-content" tabindex="-1">

			<div class="row">

                <?php
                $global_reviews_widget = get_field('global_reviews_widget');
                if ( $global_reviews_widget !== 'hide' ) {
                    dynamic_sidebar( 'reviews' );
                }
                ?>
                <?php dynamic_sidebar( 'footerfull' ); ?>

			</div>

		</div>

	</footer><!-- #wrapper-footer-full -->

	<?php
endif;
