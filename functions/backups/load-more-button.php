<?php
/**
 * Add data attributes to the query block to describe the block query.
 *
 * @param string $block_content Default query content.
 * @param array  $block Parsed block.
 * @return string
 */
function query_render_block( $block_content, $block ) {
	if ( 'core/query' === $block['blockName'] ) {
		$query_id      = $block['attrs']['queryId'];
		$container_end = strpos( $block_content, '>' );

		$paged = absint( $_GET[ 'query-' . $query_id . '-page' ] ?? 1 );

		$block_content = substr_replace( $block_content, ' data-paged="' . esc_attr( $paged ) . '" data-attrs="' . esc_attr( json_encode( $block ) ) . '"', $container_end, 0 );
	}

	return $block_content;
}
\add_filter( 'render_block', __NAMESPACE__ . '\query_render_block', 10, 2 );

/**
 * Replace the pagination block with a View More button.
 *
 * @param string $block_content Default pagination content.
 * @param array  $block Parsed block.
 * @return string
 */
function query_pagination_render_block( $block_content, $block ) {
	if ( 'core/query-pagination' === $block['blockName'] ) {
		$block_content = sprintf( '<a href="#" class="view-more-query button">%s</a>', esc_html__( 'View More' ) );
	}

	return $block_content;
}
\add_filter( 'render_block', __NAMESPACE__ . '\query_pagination_render_block', 10, 2 );

/**
 * AJAX function render more posts.
 *
 * @return void
 */
function query_pagination_render_more_query() {
	$block = json_decode( stripslashes( $_GET['attrs'] ), true );
	$paged = absint( $_GET['paged'] ?? 1 );

	if ( $block ) {
		$block['attrs']['query']['offset'] += $block['attrs']['query']['perPage'] * $paged;

		echo render_block( $block );
	}

	exit;
}
add_action( 'wp_ajax_query_render_more_pagination', __NAMESPACE__ . '\query_pagination_render_more_query' );
add_action( 'wp_ajax_nopriv_query_render_more_pagination', __NAMESPACE__ . '\query_pagination_render_more_query' );