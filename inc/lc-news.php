<?php
/**
 * News and pagination functions for the theme.
 *
 * @package lc-kav2025
 */

/**
 * Numeric Page Navi (built into theme by default).
 *
 * @return void
 */
function numeric_posts_nav() {

	if ( is_singular() ) {
		return;
	}

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/** Add current page to the array */
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}

	/** Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul>' . "\n";

	/** Previous Post Link */
	if ( get_previous_posts_link() ) {
		printf( '<li>%s</li>' . "\n", wp_kses_post( get_previous_posts_link() ) );
	}

	/** Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links, true ) ) {
		$class = 1 === $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", esc_attr( $class ), esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links, true ) ) {
			echo '<li>…</li>';
		}
	}

	/** Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged === $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", esc_attr( $class ), esc_url( get_pagenum_link( $link ) ), esc_html( $link ) );
	}

	/** Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links, true ) ) {
		if ( ! in_array( $max - 1, $links, true ) ) {
			echo '<li>…</li>' . "\n";
		}

		$class = $paged === $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", esc_attr( $class ), esc_url( get_pagenum_link( $max ) ), esc_html( $max ) );
	}

	/** Next Post Link */
	if ( get_next_posts_link() ) {
		printf( '<li>%s</li>' . "\n", wp_kses_post( get_next_posts_link() ) );
	}

	echo '</ul></div>' . "\n";
}

/**
 * Display previous and next post navigation links.
 *
 * @return void
 */
function lc_post_nav() {
	?>
<div class="d-flex justify-content-between">
	<?php
	$prev_post_obj = get_adjacent_post( '', '', true );
	if ( $prev_post_obj ) {
		$prev_post_id   = isset( $prev_post_obj->ID ) ? $prev_post_obj->ID : '';
		$prev_post_link = get_permalink( $prev_post_id );
		?>
	<a href="<?= esc_url( $prev_post_link ); ?>" rel="prev"
		class="btn btn-previous">Previous</a>
		<?php
	}

	$next_post_obj = get_adjacent_post( '', '', false );
	if ( $next_post_obj ) {
		$next_post_id   = isset( $next_post_obj->ID ) ? $next_post_obj->ID : '';
		$next_post_link = get_permalink( $next_post_id );
		?>
	<a href="<?= esc_url( $next_post_link ); ?>" rel="next"
		class="btn btn-next">Next</a>
		<?php
	}
	?>
</div>
	<?php
}
