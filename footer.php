<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<?php // Closing div#page from header.php. ?>
</div><!-- #page -->

<?php wp_footer(); ?>

<?php 
// custom code 
$footer_code = get_field('footer', 'code');

if ( $footer_code ) {
	echo $footer_code;
} 
?>

<!-- back to top button -->
<button type="button" class="btn-back-to-top" id="btn-back-to-top">
  <i class="fas fa-chevron-up"></i>
</button>

<script>
	backToTopButton();
</script>

</body>

</html>