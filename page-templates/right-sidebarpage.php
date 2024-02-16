<?php
/**
 * Template Name: Right Sidebar Layout
 *
 * This template can be used to override the default template and sidebar setup
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
$container = get_theme_mod( 'understrap_container_type' );

$column_left_classes = [];

$container = get_page_width_bbc('content_width', $container);
if ( $container = 'container-fluid' ) {
	$column_left_classes[] = 'p-0';
}

$column_left_classes = implode(' ', $column_left_classes);

?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content">

		<?php get_template_part( 'loop-templates/content', 'title' ); ?>

		<main class="site-main" id="main" role="main">
			<div class="row">
				<div class="<?php echo is_active_sidebar( 'right-sidebar' ) ? 'col-lg-9' : 'col-lg-12'; ?> content-area <?php echo $column_left_classes; ?>" id="primary">
					<?php
					the_content();
					understrap_link_pages();
					?>
				</div>
				<?php get_template_part( 'sidebar-templates/sidebar', 'right' ); ?>
			</div><!-- .row -->
		</main>

	</div><!-- #content -->

</div><!-- #page-wrapper -->

<?php
get_footer();
