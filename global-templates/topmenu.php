<?php
/**
 * Top Menu setup
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( is_active_sidebar( 'topmenu' ) ) :
	?>

	<div class="wrapper" id="wrapper-top-full">

		<?php
		get_template_part( 'sidebar-templates/sidebar', 'topmenu' );
		?>

	</div>

	<?php
endif;