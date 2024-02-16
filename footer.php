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
<button type="button" class="btn btn-floating btn-lg" id="btn-back-to-top">
  <i class="fas fa-chevron-up"></i>
</button>

<script>
	//Get the button
	let mybutton = document.getElementById("btn-back-to-top");

	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function () {
	scrollFunction();
	};

	function scrollFunction() {
	if (
		document.body.scrollTop > 20 ||
		document.documentElement.scrollTop > 20
	) {
		mybutton.style.display = "flex";
	} else {
		mybutton.style.display = "none";
	}
	}
	// When the user clicks on the button, scroll to the top of the document
	mybutton.addEventListener("click", backToTop);

	function backToTop() {
	document.body.scrollTop = 0;
	document.documentElement.scrollTop = 0;
	}
</script>

</body>

</html>