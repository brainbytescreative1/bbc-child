<?php
/**
 * Single post partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php get_template_part( 'loop-templates/content', 'title' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
		$post_date = get_the_date();
		if ( $post_date ) {
			echo '<span class="post-date">' . $post_date . '</span>';
		}
		?>

		<?php
		the_content();
		understrap_link_pages();
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php understrap_entry_footer(); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
